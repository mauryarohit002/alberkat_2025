$(document).ready(function(){
    $("#st_date, #sl_date,#sm_order_date").datepicker({
        format: 'dd-mm-yyyy'
    });
    $("#gvc_sbt_btn").prop('disabled', false);
    $("select.flexselect").flexselect();
    $("#dob").datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
    });
});
  
     function admin_user_login()
    {
        var user_mob        = $("#user_mob").val();
        var dob             = $("#dob").val();
        var user_password   = $("#user_password").val();
        var check           = 1;
        var name            = 0;
        var dob_check       = 0;
        var pass            = 0;
        if($("#user_mob").val() == '')
        {
            $("#user_mob").css({'border-color':'red'});
            check = 0;
            name = 1;
        }
        else
        {
            $("#user_mob").css({'border-color':'#CCC'}); 
        }
        if($("#dob").val() == '')
        {
            $("#dob").css({'border-color':'red'});
            check = 0;
            dob_check = 1;
        }
        else
        {
            $("#dob").css({'border-color':'#CCC'}); 
        }
        if($("#user_password").val() == '')
        {
            $("#user_password").css({'border-color':'red'});
            check = 0;
            pass = 1;
        }
        else
        {
            $("#user_password").css({'border-color':'#CCC'});    
        }
        if(check == 0)
        {
            if(name == 1)
            {
                var msg = 'Please Enter your Registered Mobile No.';
                display_alert('err',msg);
            }
            else if(dob_check == 1)
            {
                var msg = 'Please Enter your Childs Date of Birth ';
                display_alert('err',msg);
            }
            else if(pass == 1)
            {
                var msg = 'Please Enter your Password';
                display_alert('err',msg);
            } 
            $("body, html").animate({'scrollTop':0},1000); 
        }
        else
        {     
            var path = base_url+"admin/clogin/login_action";   
            $("#loading").show();
            $.ajax({
                type:'POST',
                url:path,
                data:'user_mob='+user_mob+'&dob='+dob+'&user_password='+user_password,
                dataType:'JSON',
                success:function(resp)
                {
                    if(resp['flag'] == 1)
                    {
                        window.location.href = base_url+"chome/student_reg_form/"+resp['rm_id'];
                    }
                    else if(resp == 2)
                    {
                        var msg = 'Wrong Password';
                        display_alert('err',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                    }
                    else if(resp == 3)
                    {
                        var msg = 'Invalid Mobile Number';
                        display_alert('err',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                    }
                    else if(resp == 4)
                    {
                        var msg = 'You had already submited the form Please wait for our reply';
                        display_alert('err',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                    }
                    else if(resp == 5)
                    {
                        var msg = 'Wrong Date of Bitrh';
                        display_alert('err',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                    }
                    else
                    {
                        var msg = 'Unknown Error ! Please try again later';
                        display_alert('err',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                    }
                    $("#loading").hide();
                },
                error:function(resp)
                {
                    console.log(resp);
                }   
            });
        }
    }