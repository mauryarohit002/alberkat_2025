
    function admin_login()
    {
        var user_name       = $("#user_name").val();
        var user_password   = $("#user_password").val();
        var check   = 1;
        var name    = 0;
        var pass    = 0;
        if($("#user_name").val() == '')
        {
            $("#user_name").css({'border-color':'red'});
            check   = 0;
            name    = 1;
        }
        else
        {
            $("#user_name").css({'border-color':'#CCC'});
        }
        if($("#user_password").val() == '')
        {
            $("#user_password").css({'border-color':'red'});
            check   = 0;
            pass    = 1;
        }
        else
        {
            $("#user_password").css({'border-color':'#CCC'});
        }
        if(check == 0)
        {
            if(name == 1)
            {
                var msg = 'Please Enter your User Name';
                display_alert('err',msg);
            }
            else if(pass == 1)
            {
                var msg = 'Please Enter your Password';
                display_alert('err',msg);
            }
        }
        else
        {
            var path = base_url+"admin/clogin/admin_login_action";
            $("#loading").show();
            $.ajax({
                type:'POST',
                url:path,
                data:'user_name='+user_name+'&user_password='+user_password,
                success:function(resp)
                {
                    // alert(resp);
                    if(resp == 1)
                    {
                        // alert(base_url+"cmaster/index");
                        window.location.href = base_url+"admin/cmaster/";
                    }
                    else if(resp == 2)
                    {
                        var msg = 'Wrong Password.';
                        display_alert('err',msg);
                    }
                    else if(resp == 3)
                    {
                        var msg = 'Invalid Username.';
                        display_alert('err',msg);
                    }
                    else
                    {
                        var msg = 'Unknown Error ! Please try again later';
                        display_alert('warn',msg);
                    }
                    $("#loading").hide();
                },
                error:function(resp){
                    console.log(resp);
                }
            });
        }
    }