$(function(){
    
});
function nextStep()
{
    $("#a1a,#stu_det").removeClass('active');
    $("#arrow_img_rg").hide();
    $("#a2a,#fam_det").addClass('active');
    $("#arrow_img_lf").show();
    $("body, html").animate({'scrollTop':0},1000);
}
function show_arrow(id)
{
    if (id == 1)
    {
        $("#arrow_img_rg").show();
        $("#arrow_img_lf").hide();
    }
    else if (id == 2)
    {
        $("#arrow_img_lf").show();
        $("#arrow_img_rg").hide();
    }
}
function get_school_name_ip(sl_id)
{
    // alert(sl_id);
    var data ="";
    if (sl_id == 'YES')
    {
        data += '<input type="text" id="rm_child_pre_school_name" name="rm_child_pre_school_name" placeholder="ENTER SCHOOL NAME"  class="form-control form-control_login">';
       $("#pre_school_ip").html(data);
    }
    else
    {
        $("#pre_school_ip").html("");
    }
}
function showImage(src, target) {
    var fr = new FileReader();
    fr.onload = function(){
        target.src = fr.result;
    }
    fr.readAsDataURL(src.files[0]);
}
function putImage(img_src,img_show)
{
    var src = document.getElementById(img_src);
    var target = document.getElementById(img_show);
    showImage(src, target);
}
function putPdf(file_name,img_src,img_show)
{
    var str = file_name.value;
    var name_array = str.split("\\");
    var pdf_name = name_array.pop();
}
function open_model_img(param,title)
{
    var data = '';
    var imgSrc = $(param).attr("src");
    data += '<img id="pop_img" src="'+imgSrc+'" class="img-responsive" >';
    $(".modal-body-sm").html(data);
    $(".modal-title-sm").html(title);
    $("#popup_modal_sm").modal('show');
}
$(".add_copy").click(function(){
    var addr    = $("#rm_child_per_add_house_no").val();
    var c       = $("#rm_child_per_add_town").val();
    var p       = $("#rm_child_per_add_pin_code").val();
    var s       = $("#rm_child_per_add_state").val();
    if($(this).is(':checked'))
    {
        $("#rm_child_temp_add_house_no").val(addr);
        $("#rm_child_temp_add_town").val(c);
        $("#rm_child_temp_add_pin_code").val(p);
        $("#rm_child_temp_add_state").val(s);
    }
    else
    {
        $("#rm_child_temp_add_house_no").val('');
        $("#rm_child_temp_add_town").val('');
        $("#rm_child_temp_add_pin_code").val('');
        $("#rm_child_temp_add_state").val('');
    }
});
cs_frow_cnt = 1;
function add_siblings_row()
{
    var check = 1;
    if($("#st_name").val() == 0 || $("#st_name").val() == "")
    {
        $("#st_name").css({'border-color':'red'});
        check = 0;
    }
    else
    {
        $("#st_name").css({'border-color':'#CCC'});
    }
    if($("#st_std").val() == 0 || $("#st_std").val() == "")
    {
        $("#st_std").css({'border-color':'red'});
        check = 0;
    }
    else
    {
        $("#st_std").css({'border-color':'#CCC'});
    }
    if($("#st_div").val() == 0 || $("#st_div").val() == "")
    {
        $("#st_div").css({'border-color':'red'});
        check = 0;
    }
    else
    {
        $("#st_div").css({'border-color':'#CCC'});
    }
    if(check == 1)
    {
        var st_school   = $("#st_school").val();
        var st_gr_no    = $("#st_gr_no").val();
        var st_name     = $("#st_name").val();
        var st_std      = $("#st_std").val();
        var st_div      = $("#st_div").val();
        var st_roll_no  = $("#st_roll_no").val();
        var data = '';
        data += '<tr id="rowid_'+cs_frow_cnt+'">';
        data += '<td>';
        data += '<input type="text" name="sbltr_school[]" class="form-control" value="'+st_school+'" style="text-transform: uppercase;" readonly/>';
        data += '</td>';
        data += '<td>';
        data += '<input type="text" name="sbltr_gr_no[]" class="form-control" value="'+st_gr_no+'" style="text-transform: uppercase;" readonly/>';
        data += '</td>';
        data += '<td>';
        data += '<input type="text" class="form-control" name="sbltr_sbl_name[]" value="'+st_name+'" style="text-transform: uppercase;" readonly/>';
        data += '</td>';
        data += '<td>';
        data += '<input type="text" name="sbltr_sbl_std[]" class="form-control" value="'+st_std+'" style="text-transform: uppercase;" readonly/>';
        data += '</td>';
        data += '<td>';
        data += '<input type="text" name="sbltr_sbl_div[]" class="form-control" value="'+st_div+'" style="text-transform: uppercase;" readonly/>';
        data += '</td>';
        data += '<td>';
        data += '<input type="text" name="sbltr_sbl_roll_no[]" class="form-control" value="'+st_roll_no+'" style="text-transform: uppercase;" readonly/>';
        data += '</td>';
         data += '<td style="text-align:right;"><button type="button" class="btn btn-danger" onClick="remove_siblings_row('+cs_frow_cnt+')">Remove</button></td>';
        data += '</tr>';
        cs_frow_cnt++;
        $("#siblings_wrapper").append(data);
        $("#st_name,#st_gr_no,#st_std,#st_div,#st_roll_no").val('');
    }
}
function remove_siblings_row(id_cnt)
{
    $("#rowid_"+id_cnt).detach();
}
function update_student_data(id)
{
    var check = 1;
    var check_mon = 1;
    if($("#rm_child_surname").val() == "")
    {
        $("#rm_child_surname").css({'border-color':'red'});
        check = 0;
    }
    else
    {
        $("#rm_child_surname").css({'border-color':'#CCC'});
    }
    if($("#rm_child_name").val() == "")
    {
        $("#rm_child_name").css({'border-color':'red'});
        check = 0;
    }
    else
    {
        $("#rm_child_name").css({'border-color':'#CCC'});
    }
    if($("#rm_child_birth_date").val() == "")
    {
        $("#rm_child_birth_date").css({'border-color':'red'});
        check = 0;
    }
    else
    {
        $("#rm_child_birth_date").css({'border-color':'#CCC'});
    }
     if($("#rm_child_birth_state").val() == "")
    {
        $("#rm_child_birth_state").css({'border-color':'red'});
        check = 0;
    }
    else
    {
        $("#rm_child_birth_state").css({'border-color':'#CCC'});
    }
     if($("#rm_child_birth_town").val() == "")
    {
        $("#rm_child_birth_town").css({'border-color':'red'});
        check = 0;
    }
    else
    {
        $("#rm_child_birth_town").css({'border-color':'#CCC'});
    }
     if($("#rm_child_nationality").val() == "")
    {
        $("#rm_child_nationality").css({'border-color':'red'});
        check = 0;
    }
    else
    {
        $("#rm_child_nationality").css({'border-color':'#CCC'});
    }
    if($("#rm_child_religion").val() == "")
    {
        $("#rm_child_religion").css({'border-color':'red'});
        check = 0;
    }
    else
    {
        $("#rm_child_religion").css({'border-color':'#CCC'});
    }
    if($("#rm_child_family_monthly_income").val() == "")
    {
        $("#rm_child_family_monthly_income").css({'border-color':'red'});
        check_mon = 0;
    }
    else
    {
        $("#rm_child_family_monthly_income").css({'border-color':'#CCC'});
    }
    if($(".gender_class").is(":checked")==false)
    {
        $(".gender_alert").css({'color':'red'});
    check = 0;
    }
    else
    {
        $(".gender_alert").css({'color':'#000'});
    }
    if(check == 0)
    {
        var msg = 'Oh snap ! You Forgot to Enter Some Student Details';
        display_alert('err',msg);
        $("body, html").animate({'scrollTop':0},1000);
        $("#a1a,#stu_det").addClass('active');
        $("#arrow_img_rg").show();
        $("#a2a,#fam_det").removeClass('active');
        $("#arrow_img_lf").hide();
    }
    else if (check_mon == 0)
    {
        var msg = 'Oh snap ! You Forgot to Enter Monthly Details';
        display_alert('err',msg);
        $("body, html").animate({'scrollTop':0},1000);
        $("#a2a,#fam_det").addClass('active');
        $("#arrow_img_rg").hide();
        $("#a1a,#stu_det").removeClass('active');
        $("#arrow_img_lf").show();
    }
    else
    {
        var form_obj = document.getElementById("student_details_form");
        var form_data_obj = new FormData(form_obj);
        var path = base_url+"admin/cmaster/update_student_data/"+id;
        // var form_data = $("#add_apparel").serialize();
        $("#loader").show();
        $("#sbt_btn").prop('disabled', true);
        $.ajax({
            type:'POST',
            url:path,
            data:form_data_obj,
            contentType:false,
            processData:false,
            success:function(resp)
            {
                console.log(resp);
                if(resp == 1)
                {
                    var msg = 'Student Save Successfully';
                    display_alert('succ',msg);
                    $("body, html").animate({'scrollTop':0},1000);
                    setTimeout(function(){
                        window.close();
                    },2000);
                }
                else if(resp == 2)
                {
                    var msg = 'Unknown Error ! Please try again later';
                    display_alert('warn',msg);
                    $("body, html").animate({'scrollTop':0},1000);
                }
                // else
                // {
                //     var msg = 'Unknown Error ! Please try again later';
                //     display_alert('warn',msg);
                //     $("body, html").animate({'scrollTop':0},1000);
                // }
                $("#loader").hide();
            },
            error:function(resp){
                console.log(resp);
            }
        });
    }
}
