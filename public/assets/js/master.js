$(document).ready(function(){
	$(".master_table").dataTable();
    application_status_dd();
     $("#rm_child_birth_date").datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
    });
    /*$("#rm_child_birth_date").datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
    });*/
});
/********************************* Common Function *********************************/
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
    function delete_item(id, path)
    {
        var ans = confirm("Are you sure? You want to delete item.");
        if(ans == true)
        {
            var update_path = base_url+path+"/"+id;
            $("#loading").show();
            $.ajax({
                type:'POST',
                url:update_path,
                success:function(resp)
                {
                    $("#loading").hide();
                    if(resp == 4){
                        var msg = "You can't delete this user! Because a CLP Entry is asscociated with this user.";
                        display_alert('err',msg);
                    }
                    else{
                        window.location.reload();
                    }
                },
                error:function(resp)
                {
                    console.log(resp);
                }
            });
        }
    }
    // ***********************sid start************************
   $(".interview").slideUp();
    var app_status=0;
    function application_status_dd()
    {
        var ans = $("#ba_app_status").val();
        if(ans==1)
        {
            $(".rejection").slideUp();
            $(".interview").slideDown();
            $("#err_interview_reason").html("");
            app_status=1;
        }
        else if(ans==0)
        {
            $(".interview").slideUp();
            $(".rejection").slideDown();
            $("#err_interview_date").html("");
            $("#err_interview_details").html("");
            app_status=0;
        }
    }
    function submit_status()
    {
        // alert($("#rm_app_no").val());
        var ans = confirm("Are you sure? You want to UPDATE FORM STATUS. One SMS will be sent to the parent");
        if(ans == true)
        {
                var check = 1;
            if($("#ba_app_status").val() == 0 && $("#ba_app_reg").val() == "")
            {
                $("#ba_app_reg").css({
                    'border-color':'red'
                });
                check = 0;
            }
            else
            {
                $("#ba_app_reg").css({
                    'border-color':'#CCC'
                });
            }
            if($("#ba_app_status").val() == 1 && $("#ba_interview_date").val() == "")
            {
                $("#ba_interview_date").css({
                    'border-color':'red'
                });
                check = 0;
            }
            else
            {
                $("#ba_interview_date").css({
                    'border-color':'#CCC'
                });
            }
            if($("#ba_app_status").val() == 1 && $("#ba_interview_details").val() == "")
            {
                $("#ba_interview_details").css({
                    'border-color':'red'
                });
                check = 0;
            }
            else
            {
                $("#ba_interview_details").css({
                    'border-color':'#CCC'
                });
            }
            if($("#ba_app_status").val() == 0 && $("#ba_admi_status").val() == 1)
            {
                $("#ba_admi_status").css({
                    'border-color':'red'
                });
                check = 0;
            }
            else
            {
                $("#ba_admi_status").css({
                    'border-color':'#CCC'
                });
            }
            if(check == 0)
            {
                var msg = 'Oh snap ! You forgot to enter some information';
                    $(".modal-body").css("color","#052E3E");
                    $(".modal-body").css("font-weight","bold");
                    $(".modal-body").css("text-align","center");
                    $(".modal-body").html(msg);
                    $("#popup_modal_sm").modal('show');
                    // alert(msg);
                    $("body, html").animate({
                        'scrollTop':0
                    },1000);
            }
            else
            {
                var mob = $("#rm_sr_mob").val();
                var app_no = $("#rm_app_no").val()
                var path = base_url+"cmaster/update_app_status/"+mob+"/"+app_no;
                var form_data = $("#edit_app_status").serialize();
                    // alert(form_obj);
                $("#loading").show();
                $.ajax({
                    type:'POST',
                    url:path,
                    data:form_data,
                    success:function(resp)
                    {
                        alert(resp);
                        console.log(resp);
                        if(resp == 1)
                        {
                                var msg = 'Status Updated Successfully!';
                                $(".modal-body").css("color","#052E3E");
                                $(".modal-body").css("font-weight","bold");
                                $(".modal-body").css("text-align","center");
                                $(".modal-body").html(msg);
                                $("#popup_modal_sm").modal('show');
                                $("body, html").animate({
                                    'scrollTop':0
                                },1000);
                                // $("#stud_reg_form")[0].reset();
                                $("#loading").hide();
                        }
                        else
                        {
                            var msg = 'Unknown Error ! Please try again later';
                            $(".modal-body").css("color","#052E3E");
                            $(".modal-body").css("font-weight","bold");
                            $(".modal-body").css("text-align","center");
                            $(".modal-body").html(msg);
                            $("#popup_modal_sm").modal('show');
                            $("body, html").animate({
                                'scrollTop':0
                            },1000);
                        }
                        $("#loading").hide();
                    },
                    error:function(resp){
                        console.log(resp);
                    }
                });
            }
        }
    }
    // ***********************sid end*******************
/********************************* User Master *********************************/
    function add_update_user_popup(user_id, role){
        var path = base_url+"cmaster/get_role";
        $("#loading").show();
        $.ajax({
            type:'POST',
            url:path,
            dataType:'json',
            success:function(resp)
            {
                var data = '';
                data += '<div class="alert_msg"></div>';
                data += '<div class="row">';
                data += '<div class="col-md-12">';
                data += '<form class="form-horizontal" id="user_form">';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">User Name<span style="color:red">*</span></label><div class="col-sm-9"><input type="text" name="user_name" class="form-control" id="user_name"></div></div>';
                data += '<br />';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Full Name<span style="color:red">*</span></label><div class="col-sm-9"><input type="text" name="user_full_name" class="form-control" id="user_full_name"></div></div>';
                data += '<br />';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Password<span style="color:red">*</span></label><div class="col-sm-9"><input type="password" name="user_password" class="form-control" id="user_password"></div></div>';
                data += '<br />';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Email<span style="color:red">*</span></label><div class="col-sm-9"><input type="email" name="user_email" class="form-control" id="user_email"></div></div>';
                data += '<br />';
            if(session_role == 1)
            {
                if(session_role == 1)
                {
                    data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Role</label><div class="col-sm-9">';
                    data += '<select name="user_role_id" id="user_role_id" class="form-control">';
                $.each(resp['role'], function(index, value){
                    data += '<option value="'+index+'">'+value+'</option>';
                });
                    data += '</select>';
                    data += '</div></div>';
                    data += '<br />';
                    data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Status</label><div class="col-sm-9">';
                    data += '<select name="user_status" id="user_status" class="form-control">';
                $.each(resp['user_status'], function(index, value){
                    data += '<option value="'+index+'">'+value+'</option>';
                });
                    data += '</select>';
                    data += '</div></div>';
                    data += '<br />';
                }
                else
                {
                    data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Role</label><div class="col-sm-9"><input type="hidden" name="user_role_id" class="form-control" id="user_role_id" value="2" ><input type="text" class="form-control" value="USER" readonly/></div></div>';
                }
                    data += '<br />';
            }
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Address</label><div class="col-sm-9"><textarea name="user_address" class="form-control" id="user_address"></textarea></div></div>';
                data += '<br />';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Telephone</label><div class="col-sm-9"><input type="text" name="user_telephone" class="form-control" id="user_telephone"></div></div>';
                data += '<br />';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Mobile</label><div class="col-sm-9"><input type="text" name="user_mobile" class="form-control" id="user_mobile"></div></div>';
                data += '</form>';
                data += '</div>';
                data += '</div>';
                $(".modal-body-sm").html(data);
                var sbt_btn = '<button type="button" class="btn btn-default" onClick="#" data-dismiss="modal">Close</button>';
                if(user_id == 0)
                {
                    sbt_btn += '<button type="button" class="btn btn-success" onClick="add_user(0)">Submit</button>';
                    $(".modal-title-sm").html("Add User");
                     // $(".modal-title-sm").html("Update User");
                    $(".modal-title-sm").css("background-color","#093334");
                    $(".modal-title-sm").css("text-align","center");
                    $(".modal-title-sm").css("color","white");
                }
                else
                {
                    var update_path = base_url+"cmaster/get_single_user/"+user_id;
                    $("#loading").show();
                    $.ajax({
                        type:'POST',
                        url:update_path,
                        dataType:'json',
                        success:function(resp)
                        {
                            console.log(resp);
                            $("#user_name").val(resp[0]['user_name']);
                            $("#user_full_name").val(resp[0]['user_full_name']);
                            if(session_role == 1)
                            {
                                $("#user_role_id").val(resp[0]['user_role_id']);
                                $("#user_department_id").val(resp[0]['user_department_id']);
                                $("#user_status").val(resp[0]['user_status']);
                            }
                            $("#user_address").html(resp[0]['user_address']);
                            $("#user_mobile").val(resp[0]['user_mobile']);
                            $("#user_telephone").val(resp[0]['user_telephone']);
                            $("#user_email").val(resp[0]['user_email']);
                            $("#user_password").val(resp[0]['user_visible_password']);
                            $("#loading").hide();
                        },
                        error:function(resp)
                        {
                            console.log(resp);
                        }
                    });
                    sbt_btn += '<button type="button" class="btn btn-success" onClick="add_user('+user_id+')">Submit</button>';
                    $(".modal-title-sm").html("Update User");
                    $(".modal-title-sm").css("background-color","#093334");
                    $(".modal-title-sm").css("text-align","center");
                    $(".modal-title-sm").css("color","white");
                }
                $(".modal-footer-sm").html(sbt_btn);
                $("#loading").hide();
                $("#popup_modal_sm").modal('show');
            },
            error:function(resp)
            {
                console.log(resp);
            }
        });
    }
    function add_update_user_popup_by_admin(user_id, role){
        var path = base_url+"cmaster/get_role";
        $("#loading").show();
        $.ajax({
            type:'POST',
            url:path,
            dataType:'json',
            success:function(resp)
            {
                var data = '';
                data += '<div class="alert_msg"></div>';
                data += '<div class="row">';
                data += '<div class="col-md-12">';
                data += '<form class="form-horizontal" id="user_form">';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">User Name<span style="color:red">*</span></label><div class="col-sm-9"><input type="text" name="user_name" class="form-control" id="user_name"></div></div>';
                data += '<br />';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Full Name<span style="color:red">*</span></label><div class="col-sm-9"><input type="text" name="user_full_name" class="form-control" id="user_full_name"></div></div>';
                data += '<br />';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Password<span style="color:red">*</span></label><div class="col-sm-9"><input type="password" name="user_password" class="form-control" id="user_password"></div></div>';
                data += '<br />';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Email<span style="color:red">*</span></label><div class="col-sm-9"><input type="email" name="user_email" class="form-control" id="user_email"></div></div>';
                data += '<br />';
            if(session_role == 1)
            {
                if(session_role == 1)
                {
                    data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Role</label><div class="col-sm-9">';
                    data += '<select name="user_role_id" id="user_role_id" class="form-control">';
                $.each(resp['role'], function(index, value){
                    data += '<option value="'+index+'">'+value+'</option>';
                });
                    data += '</select>';
                    data += '</div></div>';
                    data += '<br />';
                    data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Status</label><div class="col-sm-9">';
                    data += '<select name="user_status" id="user_status" class="form-control">';
                $.each(resp['user_status'], function(index, value){
                    data += '<option value="'+index+'">'+value+'</option>';
                });
                    data += '</select>';
                    data += '</div></div>';
                    data += '<br />';
                }
                else
                {
                    data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Role</label><div class="col-sm-9"><input type="hidden" name="user_role_id" class="form-control" id="user_role_id" value="2" ><input type="text" class="form-control" value="USER" readonly/></div></div>';
                }
                    data += '<br />';
            }
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Address</label><div class="col-sm-9"><textarea name="user_address" class="form-control" id="user_address"></textarea></div></div>';
                data += '<br />';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Telephone</label><div class="col-sm-9"><input type="text" name="user_telephone" class="form-control" id="user_telephone"></div></div>';
                data += '<br />';
                data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Mobile</label><div class="col-sm-9"><input type="text" name="user_mobile" class="form-control" id="user_mobile"></div></div>';
                data += '</form>';
                data += '</div>';
                data += '</div>';
                $(".modal-body-sm").html(data);
                var sbt_btn = '<button type="button" class="btn btn-default" onClick="#" data-dismiss="modal">Close</button>';
                if(user_id == 0)
                {
                    sbt_btn += '<button type="button" class="btn btn-success" onClick="add_user(0)">Submit</button>';
                    $(".modal-title-sm").html("Add User");
                     // $(".modal-title-sm").html("Update User");
                    $(".modal-title-sm").css("background-color","#093334");
                    $(".modal-title-sm").css("text-align","center");
                    $(".modal-title-sm").css("color","white");
                }
                else
                {
                    var update_path = base_url+"cmaster/get_single_user/"+user_id;
                    $("#loading").show();
                    $.ajax({
                        type:'POST',
                        url:update_path,
                        dataType:'json',
                        success:function(resp)
                        {
                            console.log(resp);
                            $("#user_name").val(resp[0]['user_name']);
                            $("#user_full_name").val(resp[0]['user_full_name']);
                            if(session_role == 1)
                            {
                                $("#user_role_id").val(resp[0]['user_role_id']);
                                $("#user_department_id").val(resp[0]['user_department_id']);
                                $("#user_status").val(resp[0]['user_status']);
                            }
                            $("#user_address").html(resp[0]['user_address']);
                            $("#user_mobile").val(resp[0]['user_mobile']);
                            $("#user_telephone").val(resp[0]['user_telephone']);
                            $("#user_email").val(resp[0]['user_email']);
                            $("#user_password").val(resp[0]['user_visible_password']);
                            $("#loading").hide();
                        },
                        error:function(resp)
                        {
                            console.log(resp);
                        }
                    });
                    sbt_btn += '<button type="button" class="btn btn-success" onClick="add_user_by_admin('+user_id+')">Submit</button>';
                    $(".modal-title-sm").html("Update User");
                    $(".modal-title-sm").css("background-color","#093334");
                    $(".modal-title-sm").css("text-align","center");
                    $(".modal-title-sm").css("color","white");
                }
                $(".modal-footer-sm").html(sbt_btn);
                $("#loading").hide();
                $("#popup_modal_sm").modal('show');
            },
            error:function(resp)
            {
                console.log(resp);
            }
        });
    }
    function add_user(id)
    {
        var check = 1;
        var user_check = 1;
        var pass_check = 1;
        var user_full_check = 1;
        var user_email_check = 1;
        if($("#user_name").val() == '')
        {
            $("#user_name").css({
                'border-color':'#093334'
            });
            check = 0;
            user_check = 0;
        }
        else
        {
            $("#user_name").css({
                'border-color':'#CCC'
            });
        }
        if(id == 0)
        {
            if($("#user_password").val() == 0)
            {
                $("#user_password").css({
                    'border-color':'#093334'
                });
                check = 0;
                pass_check = 0;
            }
            else
            {
                $("#user_password").css({
                    'border-color':'#CCC'
                });
            }
        }
        if($("#user_email").val() == '')
        {
            $("#user_email").css({
                'border-color':'#093334'
            });
            check = 0;
            user_email_check = 0;
        }
        else
        {
            $("#user_email").css({
                'border-color':'#CCC'
            });
        }
        if($("#user_full_name").val() == '')
        {
            $("#user_full_name").css({
                'border-color':'#093334'
            });
            check = 0;
            user_full_check = 0;
        }
        else
        {
            $("#user_full_name").css({
                'border-color':'#CCC'
            });
        }
        if(check == 0)
        {
            if(user_check == 0)
            {
                var msg = 'Please Enter User Name';
            }
            else if(pass_check == 0)
            {
                var msg = 'Please Enter Password';
            }
            else if(user_email_check == 0)
            {
                var msg = 'Please Enter User Email';
            }
             else if(user_full_check == 0)
            {
                var msg = 'Please Enter User Full Name';
            }
            display_alert('err',msg);
            $("body, html").animate({'scrollTop':0},1000);
        }
        else
        {
            var path = base_url+"cmaster/user_insert/"+id;
            var form_data = $("#user_form").serialize();
            $("#loading").show();
            $.ajax({
                type:'POST',
                url:path,
                data:form_data,
                success:function(resp)
                {
                   alert(resp);
                    if(resp == 1)
                    {
                        if(id == 0)
                        {
                            var msg = 'Successfully added!';
                            display_alert('succ',msg);
                            $("#user_form")[0].reset();
                            $("body, html").animate({
                                'scrollTop':0
                            },1000);
                        }
                        else
                        {
                            var msg = 'Successfully updated!';
                            display_alert_popup('succ',msg);
                            $("body, html").animate({
                                'scrollTop':0
                            },1000);
                        }
                    }
                    else if(resp == 2)
                    {
                        var msg = 'User already exists!';
                        display_alert('err',msg);
                        $("body, html").animate({
                            'scrollTop':0
                        },1000);
                    }
                    else
                    {
                        var msg = 'Unknown Error ! Please try again later';
                        display_alert('warn',msg);
                        $("body, html").animate({
                            'scrollTop':0
                        },1000);
                    }
                    $("#loading").hide();
                },
                error:function(resp){
                    console.log(resp);
                }
            });
        }
    }
     function add_user_by_admin(id){
        var check = 1;
        if($("#user_name").val() == '')
        {
            $("#user_name").css({
                'border-color':'#093334'
            });
            check = 0;
        }
        else
        {
            $("#user_name").css({
                'border-color':'#CCC'
            });
        }
        if(id == 0)
        {
            if($("#user_password").val() == 0)
            {
                $("#user_password").css({
                    'border-color':'#093334'
                });
                check = 0;
            }
            else
            {
                $("#user_password").css({
                    'border-color':'#CCC'
                });
            }
        }
        if($("#user_full_name").val() == '')
        {
            $("#user_full_name").css({
                'border-color':'#093334'
            });
            check = 0;
        }
        else
        {
            $("#user_full_name").css({
                'border-color':'#CCC'
            });
        }
        if($("#user_email").val() == '')
        {
            $("#user_email").css({
                'border-color':'#093334'
            });
            check = 0;
        }
        else
        {
            $("#user_email").css({
                'border-color':'#CCC'
            });
        }
        if(check == 0)
        {
            var msg = 'Oh snap ! You forgot to enter some information';
            display_alert('err',msg);
            $("body, html").animate({
                'scrollTop':0
            },1000);
        }
        else
        {
            var path = base_url+"cmaster/user_insert_by_admin/"+id;
            var form_data = $("#user_form").serialize();
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
                        if(id == 0)
                        {
                            var msg = 'Successfully added!';
                            display_alert('succ',msg);
                            $("#user_form")[0].reset();
                            $("body, html").animate({
                                'scrollTop':0
                            },1000);
                        }
                        else
                        {
                            var msg = 'Successfully updated!';
                            display_alert('succ',msg);
                            $("body, html").animate({
                                'scrollTop':0
                            },1000);
                        }
                    }
                    else if(resp == 2)
                    {
                        var msg = 'User already exists!';
                        display_alert('err',msg);
                        $("body, html").animate({
                            'scrollTop':0
                        },1000);
                    }
                    else
                    {
                        var msg = 'Unknown Error ! Please try again later';
                        display_alert('warn',msg);
                        $("body, html").animate({
                            'scrollTop':0
                        },1000);
                    }
                    $("#loading").hide();
                },
                error:function(resp){
                    console.log(resp);
                }
            });
        }
    }
