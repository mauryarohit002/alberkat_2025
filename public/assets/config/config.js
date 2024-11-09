var l = window.location;
var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1]+ "/" + l.pathname.split('/')[2];
base_url += '/';

/************************************** Display Error Function **************************************/

    function display_alert(type,message)
    {
    	var alert_msg = '';

        if(type == 'err')
        {
        	alert_msg += '<div class="alert alert-danger" role="alert">';
            alert_msg += '<span><strong>'+message+'</strong></span></div>';
        }
        else if(type == 'warn')
        {
            alert_msg += '<div class="alert alert-warning" role="alert">';
            alert_msg += '<span ><strong>'+message+'</strong></span></div>';
        }
        else if(type == 'succ')
        {
            alert_msg += '<div class="alert alert-success" role="alert">';
            alert_msg += '<span><strong>'+message+'</strong></span></div>';
        }

        $(".alert_msg").html(alert_msg);

        setTimeout(function(){
    		$(".alert_msg").html("");
        },5000);
    }

    function display_alert_popup(type,message)
    {
        var alert_msg = '';

        if(type == 'err')
        {
            alert_msg += '<div class="alert alert-danger" role="alert">';
            alert_msg += '<span><strong>'+message+'</strong></span></div>';
        }
        else if(type == 'warn')
        {
            alert_msg += '<div class="alert alert-warning" role="alert">';
            alert_msg += '<span ><strong>'+message+'</strong></span></div>';
        }
        else if(type == 'succ')
        {
            alert_msg += '<div class="alert alert-success" role="alert">';
            alert_msg += '<span><strong>'+message+'</strong></span></div>';
        }

        $(".alert_msg_popup").html(alert_msg);

        setTimeout(function(){
            $(".alert_msg_popup").html("");
        },5000);
    }

    function reload_page()
    {
        window.location.reload();
    }

