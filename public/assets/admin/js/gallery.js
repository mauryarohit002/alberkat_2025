$(document).ready(function () {
    $(`#_title_name`).select2(
        select2_default({
            url: `admin/gallery_cmaster/get_select2/_title_name`,
            placeholder: `TITLE NAME`,
        })
    ).on(`change`, () => trigger_search());
    $(`#_status`).on(`change`, () => trigger_search());
}); 
/*********** core function ***************/
    let img_cnt = 1;
    const add_gallery_image=(id)=>{
        let check = true;
        if($(`#gallery_image`).val() == '' || $(`#gallery_image`).val() == undefined){
            $(`#gallery_image`).css(`border-color`,`red`);
            check = false;
        }else{
            $(`#gallery_image`).css(`border-color`,`#d2d6de`);
        }
        if(!check)
        {
            let msg = `Oh snap ! You Forgot to Enter Some Details.`;
            display_alert(`err`,msg);
            $("body, html").animate({'scrollTop':0},1000);
        }
        else
        {
            $("#loading").show();
            $(".btn").prop("disabled", true);
            compress_multiple_image("gallery_image")
            .then((compressedImage) => {
                // console.log(compressedImage);
                let path = `${base_url}admin/gallery_cmaster/add_gallery_images/${id}`;   
                // let form_data = $(`#event_form`).serialize();
                let form_id = document.getElementById(`gallery_form`);
                let form_data = new FormData(form_id);
                if (compressedImage.length>0){
                    form_data.delete(`gallery_image[]`);
                    $.each(compressedImage,(index,value)=>{
                        form_data.append(`gallery_image[]`, compressedImage[index],value.name);
                    });
                }
                $.ajax({
                    type : "POST",
                    url : path,
                    data: form_data,
                    dataType:'JSON',
                    contentType:false,
                    processData:false,
                    success:resp=>{
                        let {status,data,folder_name,msg}=resp;
                        if(status)
                        {
                            if(data.length>0){
                                for(let i=0; i<data.length;i++){
                                    let tr = `<div class="col-sm-6 col-md-2 col-lg-2" id="irowid_${img_cnt}">
                                        <img 
                                            class="img-thumbnail pan form_loading" 
                                            onclick="zoom(this)" 
                                            title="click to zoom in and zoom out" 
                                            src="${data[i]}" 
                                            data-big="${data[i]}" 
                                            style="width: 200px; height: 200px; object-fit: contain;"
                                        />
                                        <input type="hidden" class="form-control" name="gallery_image[]" id="gallery_image_${img_cnt}"  value="${data[i]}" placeholder="" >
                                        <br>
                                        <br>
                                        <a type="button" class="btn btn-primary" onclick="remove_gallery_image(${img_cnt})" style="width:100%;">&nbsp;&nbsp;Remove</a>
                                    </div>`;
                                    $(`#image_wrapper`).prepend(tr);
                                    img_cnt++;
                                }    
                            }  
                            $(`#gallery_image`).val('');
                            display_alert('succ',msg);
                        }
                        else if(!status)
                        {
                            display_alert('err',msg);
                        }
                        else
                        {
                            msg = 'Database Error ! Please try again letter';
                            display_alert('warn',msg);
                        }
                        $(".btn").prop("disabled", false);
                        $("#loading").hide();
                    },
                    error : resp=>{
                        console.log(resp);
                        $("#loading").hide();
                    }           
                });
            });    
        }
    }
    const remove_gallery_image=(cnt)=>{
        $(`#irowid_${cnt}`).detach();
    }
    const add_update_gallery =(id)=>{
        let check = true;
        let trans = true;
        if($(`#gallery_title_name`).val() == '' || $(`#gallery_title_name`).val() == undefined){
            $(`#gallery_title_name`).css(`border-color`,`red`);
            check = false;
        }else{
            $(`#gallery_title_name`).css(`border-color`,`#d2d6de`);
        }
        if($(`#image_wrapper div`).length < 1){
            trans = false;
        }
        if(!check)
        {
            let msg = `Oh snap ! You Forgot to Enter Some Details.`;
            display_alert(`err`,msg);
            $("body, html").animate({'scrollTop':0},1000);
        }else if(!trans){
            let msg = `Please add atleast one image.`;
            display_alert(`err`,msg);
            $("body, html").animate({'scrollTop':0},1000);
        }
        else
        {     
            $("#loading").show();
            $(".btn").prop("disabled", true);
    
            let path = `${base_url}admin/gallery_cmaster/gallery_insert/${id}`;   
            let form_data = $(`#gallery_form`).serialize();
            // let form_id = document.getElementById(`event_gallery_form`);
            // let form_data = new FormData(form_id);
            $.ajax({
                type : "POST",
                url : path,
                data: form_data,
                dataType:'JSON',
                // contentType:false,
                // processData:false,
                success : resp=>
                {
                    let {status,data,msg}=resp;
                    if(status)
                    {
                        display_alert('succ',msg);
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                    }
                    else if(!status)
                    {
                        display_alert('err',msg);
                    }
                    else
                    {
                        msg = 'Database Error ! Please try again letter';
                        display_alert('warn',msg);
                    }
                    $("body, html").animate({'scrollTop':0},1000);
                    $(".btn").prop("disabled", false);
                    $("#loading").hide();
                },
                error : resp=>{
                    console.log(resp);
                    $("#loading").hide();
                }           
            });
        }
    }
    const delete_gallery=(id)=>{
        let ans = confirm("Are you sure? You want to delete this gallery data.");
        if(ans == true){
            let path = `${base_url}admin/gallery_cmaster/gallery_delete/${id}`;   
            $("#sbtdel_btn").prop('disabled',true);
            $.ajax({
                type:'POST',
                url:path,
                dataType:'json',
                success:resp=>{   
                    // console.log(resp);
                    let {status,data,msg}=resp;
                    if(status){
                        alert(msg);
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000); 
                    }
                    else if(!status){
                        alert(msg);
                        $("#sbtdel_btn").prop('disabled',false);
                    }
                    else{
                        alert("Database Error ! Please try again letter");
                        $("#sbtdel_btn").prop('disabled',false);
                    }
                },
                error:err=>{console.log(err);}
            });
        }
    }
/*********** core function ***************/
