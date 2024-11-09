function final_basecase(em_id)
{
	// alert(em_id);
	var path = base_url+"cscenario/data_update_for_stage3/"+em_id;   
    

    $("#loading").show();
    $.ajax({
        type:'POST',
        url:path,
        success:function(resp)
        {
            //alert(resp);
            $("#loading").hide();
        },
        error:function(resp){
            console.log(resp);
        }   
    });
}

function preview_final_basecase1(em_id)
{
    // alert(111);
    var path = base_url+"cbasecase/preview_final_basecase/"+em_id;  
    var form_data = $("#final_basecase_form").serialize();
    // alert(form_data);
    

    $("#loading").show();
    $.ajax({
        type:'POST',
        url:path,
        data:form_data,
        dataType:'json',
        success:function(resp)
        {
            // alert(resp);
            console.log(resp);
            var data = '';

            data += '<div class="alert_msg_popup"></div>';
            // data += '<div style="background-color:#eee;border:3px solid #eee;border-radius:10px;">';

            data += '<form id="final_basecase_form_2">';

            data += '<h3 style="text-align:center;padding-top:0px;margin-top:0px;"></h3>';

            

                if(typeof resp['current_events'] !== 'undefined')
                {

                    data += '<table class="table table-bordered">';
                    data += '<tr style="background-color:#333333;color:white;border-radius:10px;">';
                    data += '<th width="15%" style="border-radius:10px;">BASECASE</th>';
                    data += '<th width="15%" style="border-radius:10px;">DOWNSIDE</th>';
                    data += '<th width="15%" style="border-radius:10px;">UPSIDE</th>';
                    
                    data += '</tr>';



                    $.each(resp['current_events'], function(index, value)
                    {
                        data += '<tr>';

                        if(index != 0 && value['ev_id'] == resp['current_events'][index-1]['ev_id'])
                        {

                            // data += '<td colspan="2 "></td>';
                        }
                        else
                        {

                            data += '<td>'+value['ev_name'];
                            data += '<input type="hidden" name="ev_id[]" value="'+value['ev_id']+'">';
                            data += '<input type="hidden" name="ev_name[]" value="'+value['ev_name']+'">';
                            data += '</td>';
                            data += '<td>'+value['se_dw_desp'];
                            data += '<input type="hidden" name="se_dw_desp[]" value="'+value['se_dw_desp']+'">';
                            data += '</td>';
                            data += '<td>'+value['se_up_desp'];
                            data += '<input type="hidden" name="se_up_desp[]" value="'+value['se_up_desp']+'">';
                            data += '</td>';
                        }
                        data += '</tr>';

                    });

                     

                    data += '</table>';
                }
                else
                {
                    data += '<h4>No event selected !</h4>';
                }
                    data += '</table>';
               

           

            data += '</form>';
            // data += '</div>';
            

            $(".modal-body").html(data);
            $(".modal-title").html("SCENARIO CONSENSUS");
            $(".modal-title").css("text-align","center");

            if(typeof resp['current_events'] !== 'undefined')
            {
                var sbt_btn = '<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>';  

                sbt_btn += '<button type="button" class="btn btn-success" onClick="finalize_basecase_preview('+em_id+');">Confirm</button>';
            }
            else
            {
                var sbt_btn = '<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>';  
            }

            

            // var path1 = base_url+"cbasecase/finalize_basecase_preview_print_data/"+em_id;
            // sbt_btn += '<button type="button" class="btn btn-warning" onClick="finalize_basecase_preview_print('+em_id+');">Print</button>';
            // sbt_btn += '<a href="'+path1+'" class="btn btn-warning">Print</a>';

            $(".modal-footer").html(sbt_btn);

            $("#popup_modal_lg").modal('show'); 
            $("#loading").hide();
            $("#loading").hide();
        },
        error:function(resp){
            console.log(resp);
        }   
    });
}//mohit


// function preview_final_basecase1(em_id)
// {
//     // alert(111);
//     var path = base_url+"cbasecase/preview_final_basecase/"+em_id;  
//     form_data = $("#final_basecase_form").serialize();
    

//     $("#loading").show();
//     $.ajax({
//         type:'POST',
//         url:path,
//         data:form_data,
//         dataType:'json',
//         success:function(resp)
//         {
//             // alert(id_cnt1);
//             // alert(resp);
//             console.log(resp);
//             var data = '';

//             data += '<div class="alert_msg_popup"></div>';
//             // data += '<div style="background-color:#eee;border:3px solid #eee;border-radius:10px;">';

//             data += '<form id="final_basecase_form_2">';

//             data += '<h3 style="text-align:center;padding-top:0px;margin-top:0px;"></h3>';

//             if(typeof resp['current_events'] !== 'undefined')
//             {
//                 data += '<table class="table table-bordered">';
//                 data += '<tr style="background-color:#333333;color:white;border-radius:10px;">';
//                 data += '<th width="15%" style="border-radius:10px;">BASECASE</th>';
//                 data += '<th width="15%" style="border-radius:10px;">DOWNSIDE</th>';
//                 data += '<th width="15%" style="border-radius:10px;">UPSIDE</th>';
//                 // data += '<th width="15%" style="border-radius:10px;">USERNAME</th>';
//                 // data += '<th width="15%" style="border-radius:10px;">COMMENTS</th>';
                
//                 data += '</tr>';


//                 $.each(resp['current_events'], function(index, value)
//                 {
//                     data += '<tr>';
//                     data += '<td>'+value['ev_id']+'</td>';
//                     data += '<input type="hidden" name="ev_id[]" value="'+value['ev_id']+'">';
//                     data += '<input type="hidden" name="ev_name[]" value="'+value['ev_name']+'">';
//                     data += '<td>'+value['se_dw_desp']+'</td>';
//                     data += '<td>'+value['se_up_desp']+'</td>';
//                     // data += '<td>'+value['review_by']+'</td>';
//                     // data += '<td>'+value['sr_up_desp_comment']+'</td>';
//                     data += '</tr>';

//                 });

//                 data += '</table>';
//             }
//             else{

//                 data += '<h4>No event selected !</h4>';
//             }

               
           

           

//             data += '</form>';
//             // data += '</div>';
            

//             $(".modal-body").html(data);
//             $(".modal-title").html("Final Basecase List");
//             $(".modal-title").css("text-align","center");

//             var sbt_btn = '<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>';  

//             sbt_btn += '<button type="button" class="btn btn-success" onClick="finalize_basecase_preview('+em_id+');">Confirm</button>';

//             $(".modal-footer").html(sbt_btn);

//             $("#popup_modal_lg").modal('show'); 
//             $("#loading").hide();
//             $("#loading").hide();
//         },
//         error:function(resp){
//             console.log(resp);
//         }   
//     });
// }

function finalize_basecase_preview(em_id)
{
    // alert(em_id);
    var path = base_url+"cbasecase/finalize_basecase_preview/"+em_id;   
    var form_data = $("#final_basecase_form_2").serialize();

    $("#loading").show();
    $.ajax({
        type:'POST',
        url:path,
        data:form_data,
        success:function(resp)
        {
            // alert(resp);
            if(resp == 1)
            {
                var msg = 'Successfully added!';
                display_alert_popup('succ',msg);

                setTimeout(function(){

                    window.location.href = base_url+"cscenario/dashboard6?id="+em_id;
                     // window.location.href = base_url+"cscenario/preview_final_basecase?id="+em_id;
                },3000);
            }
            else if(resp == 2)
            {
                var msg = 'Please select atleast one event.';
                display_alert_popup('warn',msg);
            }
            else
            {
                var msg = 'Unknown Error ! Please try again later';
                display_alert_popup('warn',msg);
            }

            $("#loading").hide();
        },
        error:function(resp){
            console.log(resp);
        }   
    });
}




