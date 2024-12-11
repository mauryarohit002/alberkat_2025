$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({
        placement: "left",
        trigger: "focus"
    });
    //captcha is hide thats y this is commented 
    // captcha();
    $("#loader").hide();
});
    function nextStep()
    {
        $("#a1a,#stu_det").removeClass('active');
        $("#arrow_img_rg").hide();
        $("#a2a,#fam_det").addClass('active');
        $("#arrow_img_lf").show();
        $("body, html").animate({'scrollTop':0},1000);
    }
    function check_cpassword()
    {
        if($("#rm_confirm_password").val() != $("#rm_password").val())
        {
            $("#rm_confirm_password").css({'border-color':'red'});
        }
        else
        {
            $("#rm_confirm_password").css({'border-color':'#CCC'});
        }
    }
    function change_child_class(){
        if($("#rm_child_birth_date").val() != "" && $("#rm_child_birth_date").val()!=null)
        {
            let dob = $("#rm_child_birth_date").val();
            let dobarray = dob.split('-');
            // console.log(dobarray);
            let dobnew = new Date(dobarray[2],dobarray[1]-1,dobarray[0]);
            let dobtime = dobnew.getTime();
            // console.log(dobtime);
            let dobdate = dobnew.getDate();
            let dobmonth = dobnew.getMonth();
            let dobyear = dobnew.getFullYear();
            // console.log(dobmonth);
            let fromtoday = new Date();
            let fromyear = fromtoday.getFullYear();
            let frommonth = fromtoday.getMonth();
            if(frommonth > 6){
                fromyear = fromyear + 1;
            }
            // console.log(fromyear,frommonth);
            
            let startdate = new Date(`${fromyear - 6}-10-01T00:00:00`);
            // console.log(startdate);
            startdate = startdate.getTime();
            let startdate1 = new Date(`${fromyear - 5}-10-01T00:00:00`);
            // console.log(startdate1);
            startdate1 = startdate1.getTime();
            let startdate2 = new Date(`${fromyear - 4}-10-01T00:00:00`);
            // console.log(startdate2);
            startdate2 = startdate2.getTime();
            let enddate = new Date(`${fromyear - 5}-09-30T23:59:59`);
            // console.log(enddate);
            enddate = enddate.getTime();
            let enddate1 = new Date(`${fromyear - 4}-09-30T23:59:59`);
            // console.log(enddate1);
            enddate1 = enddate1.getTime();
            let enddate2 = new Date(`${fromyear - 3}-12-31T23:59:59`);
            // console.log(enddate2);
            enddate2 = enddate2.getTime();
            
            if((dobyear >= (fromyear - 3) && dobmonth >= 11 && dobdate > 31) || (dobyear <= (fromyear - 6) && dobmonth <= 8 && dobdate <= 30) || (dobtime <startdate) || (dobtime > enddate2)){
                alert("Your Date of birth criteria doesnot match our requirement. for further queries please contact School admin office!");
                $(`#rm_child_birth_date`).val('');
                $("#rm_child_birth_date").css({'border-color':'red'});
                check = 0;
                check_dob = 1;
                $("#rm_child_class option:selected").text('NURSERY');
                $("#rm_child_class option:selected").val('NURSERY');
                $("#rm_child_class").val('NURSERY');
                $("#rm_child_class1").val('NURSERY');
                $('#rm_child_class').attr("disabled", false); 
                return;
            }
            // sr kg
            // if((parseInt(dobyear) >= 2017 && parseInt(dobmonth) >= 9 && parseInt(dobdate) >= 1) && (parseInt(dobyear) <= 2018 && parseInt(dobmonth) <= 8 && parseInt(dobdate) <= 30))
            if(dobtime >= startdate && dobtime <= enddate)
            {
                // alert("Admissions for SENIOR KG (SRKG) are closed due to full capacity.");
                // $(`#rm_child_birth_date`).val('');
                // $("#rm_child_birth_date").css({'border-color':'red'});
                // return;
                $("#rm_child_class option:selected" ).text('SR KG');
                $("#rm_child_class option:selected" ).val('SRKG');
                $("#rm_child_class").val('SRKG');
                $("#rm_child_class1").val('SRKG');
                $('#rm_child_class').attr("disabled", true); 
                // console.log(1);
            }
            // else if((parseInt(dobyear) >= 2018 && parseInt(dobmonth) >= 9 && parseInt(dobdate) >= 1) && (parseInt(dobyear) <= 2019 && parseInt(dobmonth) <= 8 && parseInt(dobdate) <= 30))//jr kg
            else if(dobtime >= startdate1 && dobtime <= enddate1)
            {
                // alert("Admissions for JUNIOR KG (JRKG) are closed due to full capacity.");
                // $(`#rm_child_birth_date`).val('');
                // $("#rm_child_birth_date").css({'border-color':'red'});
                // return;
                $("#rm_child_class option:selected" ).text('JR KG');
                $("#rm_child_class option:selected" ).val('JRKG');
                $("#rm_child_class").val('JRKG');
                $("#rm_child_class1").val('JRKG');
                $('#rm_child_class').attr("disabled", true);
                // console.log(2); 
            }
            // else if((parseInt(dobyear) >= 2019 && parseInt(dobmonth) >= 9 && parseInt(dobdate) >= 1) && (parseInt(dobyear) <= 2020 && parseInt(dobmonth) <= 8 && parseInt(dobdate) <= 30)) //nursery 
            else if(dobtime >= startdate2 && dobtime <= enddate2)
            {
                $("#rm_child_class option:selected").text('NURSERY');
                $("#rm_child_class option:selected").val('NURSERY');
                $("#rm_child_class").val('NURSERY');
                $("#rm_child_class1").val('NURSERY');
                $('#rm_child_class').attr("disabled", true); 
                // console.log(3);
            }   
        }
    }
var captcha_data='';    
    function captcha()
    {
        // var no1 = Math.round(Math.random()*10);
        // alert(no1);
        // var no2 = Math.round(Math.random()*10);
        // var sum = no1 + no2;
        // alert("Enter "+no1+" + " + no2)
        var captcha = "";
         // var charset = "ABCDEFGHIJLMNPQRSTUVWXYZabcdefghijlmnpqrstuvwxyz123456789";//for alfanumeric 
         var charset = "123456789";//for numeric
            for( var i=0; i < 6; i++ )
                captcha += charset.charAt(Math.floor(Math.random() * charset.length));
            // alert(captcha);
        // $("#cap_no").html(captcha);
        // $("#cap_no").html("Captcha "+no1+" + " + no2 + " = ");
        $("#cap_data_verify").html(captcha);
        captcha_data = captcha;
        // console.log(captcha)
        // document.getElementById("cap_no").innerHTML = "Enter "+no1+" + " + no2;
        // document.getElementById("cap_data_verify").value = sum;
        send_captcha_on_whatsapp(captcha);
    }
    let send_captcha_on_whatsapp =(captcha)=>{
        let reg_mobile = /^[0-9]{10}$/;
        // let reg_email = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        let reg_email =  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        let mobile_no = $("#rm_parent_mob_no").val();
        let family_email_id = $("#rm_child_family_email_id").val();
        let check = 1;
        let check_mob    = 0;
        var check_email  = 0;
        let check_dob    = 0;
        let check_pw     = 0;
        let check_cpw    = 0;
        let check_cap    = 0;
        let check_aadhar = 0;
        
        if(isNaN(mobile_no) || mobile_no=='' || !reg_mobile.test(mobile_no) || mobile_no==undefined){
            $("#rm_parent_mob_no").css({'border-color':'red'});
            check = 0;
            check_mob = 1;
        }else{
            $("#rm_parent_mob_no").css({'border-color':'#CCC'});
        }
        if(family_email_id == "" || !reg_email.test(family_email_id) || family_email_id==undefined)
        {
            $("#rm_child_family_email_id").css({'border-color':'red'});
            check = 0;
            check_email = 1;
        }
        else
        {
            $("#rm_child_family_email_id").css({'border-color':'#CCC'});
        }
        if($("#rm_child_birth_date").val() == "")
        {
            $("#rm_child_birth_date").css({'border-color':'red'});
            check = 0;
            check_dob = 1;
        }
        else
        {   
            let dob = $("#rm_child_birth_date").val();
            let dobarray = dob.split('-');
            // console.log(dobarray);
            let dobnew = new Date(dobarray[2],dobarray[1]-1,dobarray[0]);
            let dobtime = dobnew.getTime();
            // console.log(dobtime);
            let dobdate = dobnew.getDate();
            let dobmonth = dobnew.getMonth();
            let dobyear = dobnew.getFullYear();
            // console.log(dobyear);
            let fromtoday = new Date();
            let fromyear = fromtoday.getFullYear();
            let frommonth = fromtoday.getMonth();
            if(frommonth > 6){
                fromyear = fromyear + 1;
            }
            
            let startdate = new Date(`${fromyear - 6}-10-01T00:00:00`);
            startdate = startdate.getTime();
            let startdate1 = new Date(`${fromyear - 5}-10-01T00:00:00`);
            startdate1 = startdate1.getTime();
            let startdate2 = new Date(`${fromyear - 4}-10-01T00:00:00`);
            startdate2 = startdate2.getTime();
            let enddate = new Date(`${fromyear - 5}-09-30T23:59:59`);
            enddate = enddate.getTime();
            let enddate1 = new Date(`${fromyear - 4}-09-30T23:59:59`);
            enddate1 = enddate1.getTime();
            let enddate2 = new Date(`${fromyear - 3}-12-31T23:59:59`);
            enddate2 = enddate2.getTime();
            // console.log(dobtime);
            // console.log(enddate2);
            
            if((dobyear >= (fromyear - 3) && dobmonth >= 11 && dobdate > 31) || (dobyear <= (fromyear - 6) && dobmonth <= 8 && dobdate <= 30) || (dobtime <startdate) || (dobtime > enddate2)){
                alert("Your Date of birth criteria doesnot match our requirement. for further queries please contact School admin office!");
                $("#rm_child_birth_date").css({'border-color':'red'});
                check = 0;
                check_dob = 1;
                $("#rm_child_class option:selected").text('NURSERY');
                $("#rm_child_class option:selected").val('NURSERY');
                $("#rm_child_class").val('NURSERY');
                $("#rm_child_class1").val('NURSERY');
                $('#rm_child_class').attr("disabled", false); 
                return;
            }
            // sr kg
            // if((parseInt(dobyear) >= 2017 && parseInt(dobmonth) >= 9 && parseInt(dobdate) >= 1) && (parseInt(dobyear) <= 2018 && parseInt(dobmonth) <= 8 && parseInt(dobdate) <= 30))
            if(dobtime >= startdate && dobtime <= enddate)
            {
                $("#rm_child_class option:selected" ).text('SR KG');
                $("#rm_child_class option:selected" ).val('SRKG');
                $("#rm_child_class").val('SRKG');
                $("#rm_child_class1").val('SRKG');
                $('#rm_child_class').attr("disabled", true); 
                // console.log(1);
            }
            // else if((parseInt(dobyear) >= 2018 && parseInt(dobmonth) >= 9 && parseInt(dobdate) >= 1) && (parseInt(dobyear) <= 2019 && parseInt(dobmonth) <= 8 && parseInt(dobdate) <= 30))//jr kg
            else if(dobtime >= startdate1 && dobtime <= enddate1)
            {
                $("#rm_child_class option:selected" ).text('JR KG');
                $("#rm_child_class option:selected" ).val('JRKG');
                $("#rm_child_class").val('JRKG');
                $("#rm_child_class1").val('JRKG');
                $('#rm_child_class').attr("disabled", true);
                // console.log(2); 
            }
            // else if((parseInt(dobyear) >= 2019 && parseInt(dobmonth) >= 9 && parseInt(dobdate) >= 1) && (parseInt(dobyear) <= 2020 && parseInt(dobmonth) <= 8 && parseInt(dobdate) <= 30)) //nursery 
            else if(dobtime >= startdate2 && dobtime <= enddate2)
            {
                $("#rm_child_class option:selected").text('NURSERY');
                $("#rm_child_class option:selected").val('NURSERY');
                $("#rm_child_class").val('NURSERY');
                $("#rm_child_class1").val('NURSERY');
                $('#rm_child_class').attr("disabled", true); 
                // console.log(3);
            }   
            
            $("#rm_child_birth_date").css({'border-color':'#CCC'});
        }
        if($("#rm_password").val() == "" || $("#rm_password").val().length <= 5)
        {
            $("#rm_password").css({'border-color':'red'});
            check = 0;
            check_pw = 1;
        }
        else
        {
            $("#rm_password").css({'border-color':'#CCC'});
        }
        if($("#rm_confirm_password").val() == "" || $("#rm_confirm_password").val() != $("#rm_password").val()  )
        {
            $("#rm_confirm_password").css({'border-color':'red'});
           check = 0;
           check_cpw = 1;
        }
        else
        {
            $("#rm_confirm_password").css({'border-color':'#CCC'});
        }
        if(check == 0)
        {
            if(check_mob == 1)
            {
                var msg = 'Invalid Mobile Number';
                display_alert('err',msg);
            }
            else if(check_email == 1)
            {
                var msg = 'Invalid Email ID';
                display_alert('err',msg);
            }
            else if(check_dob == 1)
            {
                var msg = 'Invalid Birth Date - Should be Between Jan and Dec 2015';
                display_alert('err',msg);
            }
            else if(check_aadhar == 1)
            {
                var msg = 'Please Insert Childs Aadhar Card Details';
                display_alert('err',msg);
            }
            else if(check_pw == 1)
            {
                var msg = 'Invalid Password - Minimum 6 characters';
                display_alert('err',msg);
            }
             else if(check_cpw == 1)
            {
                var msg = 'Invalid Conform Password - Password do not match';
                display_alert('err',msg);
            }
            
            $("body, html").animate({'scrollTop':0},1000);
        }else{
            if($(`#cap_data_type`).val()==1){
                let path = base_url+"chome/send_captcha_on_whatsapp/"+mobile_no+"/"+captcha;
                $.ajax({
                    type:"POST",
                    data:{family_email_id:family_email_id},
                    url:path,
                    success:(resp)=>{
                        $("#captcha_box").css({"display":"block"});
                        $("#register_btn").css({"display":"block"});
                        $("#send_capta_btn").val("RESEND OTP");
                    }
                });
            }else{
                $("#captcha_box").css({"display":"block"});
                $("#register_btn").css({"display":"block"});
                $("#send_capta_btn").val("REGENERATE CAPTCHA");
            }    
        }    
    }
    function send_otp()
    {
        var check = 1;
        var reg_mobile = /^[0-9]{10}$/
        if($("#rm_parent_mob_no").val() == "" || isNaN($("#rm_parent_mob_no").val()) || !reg_mobile.test($("#rm_parent_mob_no").val()))
        {
            $("#rm_parent_mob_no").css({'border-color':'red'});
            check = 0;
            var check_mob = 1;
        }
        else
        {
            $("#rm_parent_mob_no").css({'border-color':'#CCC'});
        }
        if(check == 0)
        {
            var msg = 'Invalid Mobile Number';
            $(".modal-body").css("color","#052E3E");
            $(".modal-body").css("font-weight","bold");
            $(".modal-body").css("text-align","center");
            $(".modal-body").html(msg);
            $("#popup_modal_sm").modal('show');
        }
        else
        {
            var no1 = Math.round(Math.random()*9);
            var no2 = Math.round(Math.random()*9);
            var no3 = Math.round(Math.random()*9);
            var no4 = Math.round(Math.random()*9);
            var otp = ""+no1+no2+no3+no4;
            window.otp_value = otp;
            // alert(otp);
            var mob = $("#rm_parent_mob_no").val();
            var path = base_url+"chome/send_otp/"+mob+"/"+otp;
            $.ajax({
                    type:'POST',
                    url:path,
                    success:function(resp)
                    {
                        // alert(resp);
                        // console.log(resp);
                        var msg = 'Please check your mobile or email to enter One Time Password OTP' ;
                        $(".modal-body").css("color","#052E3E");
                        $(".modal-body").css("font-weight","bold");
                        $(".modal-body").css("text-align","center");
                        $(".modal-body").html(msg);
                        $("#popup_modal_sm").modal('show');
                    }
                });
        }
    }
 function class_popup()
 {      
       
        var dob     = $("#rm_child_birth_date").val();
        dob_array   = dob.split("-");
        var year    = dob_array[2];
        var new_date = dob_array[2]+'-'+dob_array[1]+'-'+dob_array[0];
        const x = new Date(new_date);
        let fromtoday = new Date();
        let fromyear = fromtoday.getFullYear();
        let frommonth = fromtoday.getMonth();
        if(frommonth > 6){
            fromyear = fromyear + 1;
        }
        const start_nursary = new Date(`${fromyear - 4}-10-1`);
        const end_nursary = new Date(`${fromyear - 3}-12-31`);
        const start_jr = new Date(`${fromyear - 5}-10-1`);
        const end_jr = new Date(`${fromyear - 4}-9-30`);
        const start_sr = new Date(`${fromyear - 6}-10-1`);
        const end_sr = new Date(`${fromyear - 5}-9-30`);
      
         if(x >= start_nursary && x < end_nursary)
        {
          
                $("#rm_child_class option:selected").text('NURSERY');
                $("#rm_child_class option:selected").val('NURSERY');
                $("#rm_child_class1").val('NURSERY');
                $('#rm_child_class').attr("disabled", true); 
        }
         else if(x >= start_jr && x < end_jr)
        {
          var ans = confirm("Your child's age is eligible for Jr Kg as per age criteria, Do you want to proceed further Or Register/Seek Admission for Nursery.");
             if (ans === true)
            {
                $("#rm_child_class option:selected" ).text('JR KG');
                $("#rm_child_class option:selected" ).val('JRKG');
                $("#rm_child_class1").val('JRKG');
                $('#rm_child_class').attr("disabled", true); 
               
            } else
            {
                $("#rm_child_class option:selected" ).text('NURSERY');
                $("#rm_child_class option:selected" ).val('NURSERY');
                $("#rm_child_class1").val('NURSERY');
                $('#rm_child_class').attr("disabled", true); 
            }
        }
         else if(x >= start_sr && x < end_sr)
        {
           var ans =  confirm("Your child's age is eligible for Sr Kg as per age criteria, Do you want to proceed further Or Register/Seek Admission for Nursery.");
             if (ans  === true)
            {
                 $("#rm_child_class option:selected" ).text('SR KG');
                 $("#rm_child_class option:selected" ).val('SRKG');
                 $("#rm_child_class1").val('SRKG');
                 $('#rm_child_class').attr("disabled", true); 
            } else
            {
                 $("#rm_child_class option:selected" ).text('NURSERY');
                 $("#rm_child_class option:selected" ).val('NURSERY');
                 $("#rm_child_class1").val('NURSERY');
                 $('#rm_child_class').attr("disabled", true); 
            }
        }
        else
        {
                $("#rm_child_class1").val('NURSERY');
                $('#rm_child_class').attr("disabled", true); 
        }
         
 }
// function date_to_word()
// {
//     var date = $("#rm_sd_dob").val();
//     // alert(date);
//     var ans=date.split("-");
//     //alert(ans);
//     var days=["First","Second","Third","Fourth","Fifth","Sixth","Seventh","Eighth","Ninth","Tenth","Eleventh","Twelveth","Thirteenth","Fourteenth","Fifteenth"
//     ,"Sixteenth","Seventeenth","Eighteenth","Ninteenth","Twentyth","Twenty First","Twenty Second","Twenty Third","Twenty Fourth","Twenty Fifth","Twenty Sixth","Twenty Seventh","Twenty Eighth","Twenty Ninth","Thirtyth","Thirty First"];
//     var dayindex=parseInt(ans[0]);
//     var day=days[dayindex-1];
//     var months=["January","February","March","April","May","June","July","August","September","October","November","December"];
//     var monthindex=parseInt(ans[1]);
//     //alert(monthindex);
//     if(monthindex<13)
//     {
//         var month=months[monthindex-1];
//     }
//     else
//     {
//         var month="Invalid month";
//     }
//     //alert(day+1);
//     //var day=toWords(ans[0]);
//     //alert(day);
//     //alert(days[30]);
//     var year = toWords(ans[2]);
//     var dob_word = day+" "+month+" "+year;
//     //alert(day+" "+month+" "+year);
//     // $("#std_dob_day").val(day);
//     // $("#std_dob_month").val(month);
//     // $("#std_dob_year").val(year);
//     $("#rm_sd_dob_w").val(dob_word);
// }
    function register_student()
    {
    	// alert(window.otp_value);
        var dob     = $("#rm_child_birth_date").val();
        dob_array   = dob.split("-");
        var year    = dob_array[2];
        // alert(year);
        var check_mob    = 0;
        var check_email  = 0;
        var check_dob    = 0;
        var check_pw     = 0;
        var check_cpw    = 0;
        var check_cap    = 0;
        var check_aadhar = 0;
    	var check = 1;
    	
    	// display_alert('err','Admission is closed due to full capacity of school.');
    	// return;
        
        if($("#rm_parent_mob_no").val() == "" || isNaN($("#rm_parent_mob_no").val()))
        {
            $("#rm_parent_mob_no").css({'border-color':'red'});
            check = 0;
            check_mob = 1;
        }
        else
        {
            $("#rm_parent_mob_no").css({'border-color':'#CCC'});
        }
        if($("#rm_child_family_email_id").val() == "" || $("#rm_child_family_email_id").val()==undefined)
        {
            $("#rm_child_family_email_id").css({'border-color':'red'});
            check = 0;
            check_email = 1;
        }
        else
        {
            $("#rm_child_family_email_id").css({'border-color':'#CCC'});
        }
        if($("#rm_child_birth_date").val() == "")
        {
            $("#rm_child_birth_date").css({'border-color':'red'});
            check = 0;
            check_dob = 1;
        }
        else
        {
            let dob = $("#rm_child_birth_date").val();
            let dobarray = dob.split('-');
            // console.log(dobarray);
            let dobnew = new Date(dobarray[2],dobarray[1]-1,dobarray[0]);
            let dobtime = dobnew.getTime();
            // console.log(dobtime);
            let dobdate = dobnew.getDate();
            let dobmonth = dobnew.getMonth();
            let dobyear = dobnew.getFullYear();
            // console.log(dobyear);
            let fromtoday = new Date();
            let fromyear = fromtoday.getFullYear();
            let frommonth = fromtoday.getMonth();
            if(frommonth > 6){
                fromyear = fromyear + 1;
            }
            
            let startdate = new Date(`${fromyear - 6}-10-01T00:00:00`);
            startdate = startdate.getTime();
            let startdate1 = new Date(`${fromyear - 5}-10-01T00:00:00`);
            startdate1 = startdate1.getTime();
            let startdate2 = new Date(`${fromyear - 4}-10-01T00:00:00`);
            startdate2 = startdate2.getTime();
            let enddate = new Date(`${fromyear - 5}-09-30T23:59:59`);
            enddate = enddate.getTime();
            let enddate1 = new Date(`${fromyear - 4}-09-30T23:59:59`);
            enddate1 = enddate1.getTime();
            let enddate2 = new Date(`${fromyear - 3}-12-31T23:59:59`);
            enddate2 = enddate2.getTime();
            // console.log(startdate);
            // console.log(enddate);
            
            if((dobyear >= (fromyear - 3) && dobmonth >= 11 && dobdate > 31) || (dobyear <= (fromyear - 6) && dobmonth <= 8 && dobdate <= 30) || (dobtime <startdate) || (dobtime > enddate2)){
                alert("Your Date of birth criteria doesnot match our requirement. for further queries please contact School admin office!");
                $("#rm_child_birth_date").css({'border-color':'red'});
                check = 0;
                check_dob = 1;
                $("#rm_child_class option:selected").text('NURSERY');
                $("#rm_child_class option:selected").val('NURSERY');
                $("#rm_child_class").val('NURSERY');
                $("#rm_child_class1").val('NURSERY');
                $('#rm_child_class').attr("disabled", false); 
                return;
            }
            // sr kg
            // if((parseInt(dobyear) >= 2017 && parseInt(dobmonth) >= 9 && parseInt(dobdate) >= 1) && (parseInt(dobyear) <= 2018 && parseInt(dobmonth) <= 8 && parseInt(dobdate) <= 30))
            if(dobtime >= startdate && dobtime <= enddate)
            {
                $("#rm_child_class option:selected" ).text('SR KG');
                $("#rm_child_class option:selected" ).val('SRKG');
                $("#rm_child_class").val('SRKG');
                $("#rm_child_class1").val('SRKG');
                $('#rm_child_class').attr("disabled", true); 
                // console.log(1);
            }
            // else if((parseInt(dobyear) >= 2018 && parseInt(dobmonth) >= 9 && parseInt(dobdate) >= 1) && (parseInt(dobyear) <= 2019 && parseInt(dobmonth) <= 8 && parseInt(dobdate) <= 30))//jr kg
            else if(dobtime >= startdate1 && dobtime <= enddate1)
            {
                $("#rm_child_class option:selected" ).text('JR KG');
                $("#rm_child_class option:selected" ).val('JRKG');
                $("#rm_child_class").val('JRKG');
                $("#rm_child_class1").val('JRKG');
                $('#rm_child_class').attr("disabled", true);
                // console.log(2); 
            }
            // else if((parseInt(dobyear) >= 2019 && parseInt(dobmonth) >= 9 && parseInt(dobdate) >= 1) && (parseInt(dobyear) <= 2020 && parseInt(dobmonth) <= 8 && parseInt(dobdate) <= 30)) //nursery 
            else if(dobtime >= startdate2 && dobtime <= enddate2)
            {
                $("#rm_child_class option:selected").text('NURSERY');
                $("#rm_child_class option:selected").val('NURSERY');
                $("#rm_child_class").val('NURSERY');
                $("#rm_child_class1").val('NURSERY');
                $('#rm_child_class').attr("disabled", true); 
                // console.log(3);
            }   
            
            $("#rm_child_birth_date").css({'border-color':'#CCC'});
        }
        // if ($("#rm_child_aadhar_no").val() == "")
        // {
        //     $("#rm_child_aadhar_no").css({'border-color':'red'});
        //     check = 0;
        //     check_aadhar = 1;
        // }
        // else
        // {
        //     $("#rm_child_aadhar_no").css({'border-color':'#CCC'});
        // }
        if($("#rm_password").val() == "" || $("#rm_password").val().length <= 5)
        {
            $("#rm_password").css({'border-color':'red'});
            check = 0;
            check_pw = 1;
        }
        else
        {
            $("#rm_password").css({'border-color':'#CCC'});
        }
        if($("#rm_confirm_password").val() == "" || $("#rm_confirm_password").val() != $("#rm_password").val()  )
        {
            $("#rm_confirm_password").css({'border-color':'red'});
           check = 0;
           check_cpw = 1;
        }
        else
        {
            $("#rm_confirm_password").css({'border-color':'#CCC'});
        }
    	// if($("#cap_data").val() != captcha_data)
     //    {
     //        $("#cap_data").css({'border-color':'red'});
     //        check = 0;
     //        check_cap = 1;
     //    }
     //    else
     //    {
     //        $("#cap_data").css({'border-color':'#CCC'});
     //    }
         /*if($("#rm_sr_otp").val() == "" || $("#rm_sr_otp").val() != window.otp_value)
         {
            $("#rm_sr_otp").css({'border-color':'red'});
        check = 0;
             check_otp = 1;
        }
         else
         {
             $("#rm_sr_otp").css({'border-color':'#CCC'});
        }*/
        if(check == 0)
        {
            if(check_mob == 1)
            {
                var msg = 'Invalid Mobile Number';
                display_alert('err',msg);
            }
            else if(check_email == 1)
            {
                var msg = 'Invalid Email ID';
                display_alert('err',msg);
            }
            else if(check_dob == 1)
            {
                var msg = 'Invalid Birth Date - Should be Between Jan and Dec 2015';
                display_alert('err',msg);
            }
            else if(check_aadhar == 1)
            {
                var msg = 'Please Insert Childs Aadhar Card Details';
                display_alert('err',msg);
            }
            else if(check_pw == 1)
            {
                var msg = 'Invalid Password - Minimum 6 characters';
                display_alert('err',msg);
            }
             else if(check_cpw == 1)
            {
                var msg = 'Invalid Conform Password - Password do not match';
                display_alert('err',msg);
            }
            else if(check_cap == 1)
            {
                if($(`#cap_data_type`).val()==1){
                    var msg = 'Invalid OTP';
                }else{
                    var msg = 'Invalid CAPTCHA';
                }    
                
                display_alert('err',msg);
            }
            
            $("body, html").animate({'scrollTop':0},1000);
        }
    	else
        {
        	var rm_sr_mob = $("#rm_parent_mob_no").val();
            var rm_sd_dob = $("#rm_child_birth_date").val();
            // $("#rm_sd_dob1").val(rm_sd_dob);
            // date_to_word();
            var form_obj = document.getElementById("stud_reg_form");
            var form_data_obj = new FormData(form_obj);
        	var path = base_url+"chome/add_update_student_registration";
                // var form_data = $("#add_apparel").serialize();
            $("#loader").show();
            $.ajax({
                type:'POST',
                url:path,
                data:form_data_obj,
                dataType:'json',
                contentType:false,
                processData:false,
                success:function(resp)
                {
                    // alert(resp);
                    // console.log(resp);
                    if(resp['flag'] == 1)
                    {
                        window.location.href=base_url +"chome/student_reg_form/"+resp['reg_id'];
                    }else if(resp == 5){
                        alert("Your Date of birth criteria doesnot match our requirement. for further queries please contact School admin office!");
                        $("#rm_child_birth_date").css({'border-color':'red'});
                        $("#rm_child_class option:selected").text('NURSERY');
                        $("#rm_child_class option:selected").val('NURSERY');
                        $("#rm_child_class1").val('NURSERY');
                        $('#rm_child_class').attr("disabled", false); 
                    }
                    else
                    {
                        var msg = 'Unknown Error ! Please try again later';
                        display_alert('warn',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                    }
                    $("#loader").hide();
                },
                error:function(resp){
                    console.log(resp);
                }
            });
    	}
    }
    function get_password()
    {
        var check_mob   = 0;
        var check_pw    = 0;
        var check_cpw   = 0;
        var check = 1;
        if($("#rm_parent_mob_no").val() == "" || isNaN($("#rm_parent_mob_no").val()))
        {
            $("#rm_parent_mob_no").css({'border-color':'red'});
            check = 0;
            check_mob = 1;
        }
        else
        {
            $("#rm_parent_mob_no").css({'border-color':'#CCC'});
        }
        if($("#rm_sr_otp").val() == "" || $("#rm_sr_otp").val() != window.otp_value)
        {
            $("#rm_sr_otp").css({'border-color':'red'});
            check = 0;
            check_otp = 1;
        }
        else
        {
            $("#rm_sr_otp").css({'border-color':'#CCC'});
        }
        if(check == 0)
        {
            if(check_mob == 1)
            {
                var msg = 'Invalid Mobile Number';
                display_alert('err',msg);
            }
            else if(check_otp == 1)
            {
                var msg = 'Invalid OTP - Please Click on Send OTP';
                display_alert('err',msg);
            }
            $("body, html").animate({'scrollTop':0},1000);
        }
        else
        {
            var rm_sr_mob       = $("#rm_parent_mob_no").val();
            var form_data       = $("#user_forget_form").serialize();
            var path            = base_url+"chome/send_forget_password";
            $("#loading").show();
            $.ajax({
                type:'POST',
                url:path,
                data:form_data,
                dataType:'JSON',
                success:function(resp)
                {
                    if (resp['flag'] == 1)
                    {
                        var data = '';
                        data += '<div class="alert_msg_popup"></div>';
                        data += '<div class="row">';
                        data += '<div class="col-md-12">'
                        data += '<form class="form-horizontal" id="reset_pass_form">';
                        data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">New Password</label>';
                        data += '<div class="col-sm-9"><input type="text" name="rm_password" class="form-control" id="rm_password"></div></div><br/>';
                        data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Confirm Password</label>';
                        data += '<div class="col-sm-9"><input type="text" class="form-control" id="rm_confirm_password"></div></div>';
                        data += '</form>';
                        data += '</div>';
                        data += '</div>';
                        $(".modal-body-sm").html(data);
                        var sbt_btn = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                            sbt_btn += '<button type="button" class="btn btn-success" onClick="update_password('+resp['id']+')">Submit</button>';
                        $(".modal-footer-sm").html(sbt_btn);
                        $("#loading").hide();
                        $("#popup_modal_sm").modal('show');
                    }
                    else
                    {
                        var msg = 'Mobile no is not Registered !';
                        display_alert('err',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                    }
                    $("#loading").hide();
                },
                error:function(resp){
                    console.log(resp);
                }
            });
        }
    }
    function update_password(id)
    {
        var  check = 1
        var  check_pw = 0;
        var  check_cpw = 0;
        if($("#rm_password").val() == "" || $("#rm_password").val().length <= 5)
        {
            $("#rm_password").css({'border-color':'red'});
            check = 0;
            check_pw = 1;
        }
        else
        {
            $("#rm_password").css({'border-color':'#CCC'});
        }
        if($("#rm_confirm_password").val() == "" || $("#rm_confirm_password").val() != $("#rm_password").val()  )
        {
            $("#rm_confirm_password").css({'border-color':'red'});
           check = 0;
           check_cpw = 1;
        }
        else
        {
            $("#rm_confirm_password").css({'border-color':'#CCC'});
        }
        if(check == 0)
        {
            if(check_pw == 1)
            {
                var msg = 'Invalid Password - Minimum 6 characters';
                display_alert_popup('err',msg);
            }
             else if(check_cpw == 1)
            {
                var msg = 'Invalid Conform Password - Password do not match';
                display_alert_popup('err',msg);
            }
            $("body, html").animate({'scrollTop':0},1000);
        }
        else
        {
            var form_data   = $("#reset_pass_form").serialize();
            var path        = base_url+"chome/update_password/"+id;
            $("#loading").show();
            $.ajax({
                type:'POST',
                url:path,
                data:form_data,
                dataType:'json',
                success:function(resp)
                {
                    if(resp == 1)
                    {
                        var msg = 'Password Updated Successfully !';
                        display_alert_popup('succ',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                         setTimeout(function(){
                            window.location.href=base_url +"chome/user_login/";
                        },2000);
                    }
                    else
                    {
                        var msg = 'Unknown Error ! Please try again later';
                        display_alert_popup('warn',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                    }
                    $("#loading").hide();
                },
                error:function(resp){
                    console.log(resp);
                }
            });
        }
    }
// edit start
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
        var path = base_url+"chome/update_student_data/"+id;
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
                    // alert(resp);
                    console.log(resp);
                    if(resp == 1)
                    {
                        var msg = 'Student Save Successfully';
                        display_alert('succ',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                        // reload_page();
                        setTimeout(function(){
                            // reload_page()
                             preview(id)
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
        // $("#reg_box").parent().removeClass("col-md-4");
        // $("#reg_box").parent().removeClass("col-md-offset-4");
        // $("#reg_box").parent().addClass("col-md-10");
        // $("#reg_box").parent().addClass("col-md-offset-1");
    }
}
// edit end
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
    // alert(111);
    $("#rowid_"+id_cnt).detach();
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
    function preview(id)
    {
        // alert(id);
        var path = base_url+"chome/get_stud_all_data/"+id;
        var img_logo = base_url+'public/assets/images/albarkaat_letter_head3.jpg';
        $.ajax({
            type:'POST',
            url:path,
            dataType:'json',
            success:function(resp)
            {
                // console.log(resp);
                var img_child = base_url+'public/uploads/product/'+resp['user_data'][0]['rm_child_photo'];
                var img_mother = base_url+'public/uploads/product/'+resp['user_data'][0]['rm_child_mother_photo'];
                var img_father = base_url+'public/uploads/product/'+resp['user_data'][0]['rm_child_father_photo'];
                var child_name = resp['user_data'][0]['rm_child_surname']+' '+resp['user_data'][0]['rm_child_name']+' '+resp['user_data'][0]['rm_child_father_name'];
                var appno = resp['user_data'][0]['rm_app_no'];
                var data = '';
                data += '<div class="container-fluid">';
                data += '<div class="row">';
                data += '<div class="col-sm-12">';
                data += '<h5 class="iso"> <span style="float:left;">C.B.S.E. AFFILIATION NO. 1130375</span> An ISO : 9001 - 2015 Certified School</h5>';
                data += '<img src="'+img_logo+'" alt="" class="img-responsive">';
                data += '</div>';
                // data += '<div class="col-sm-2">';
                // data += '<img src="'+img_child+'" alt="" class="img-responsive" style="height: 180px;">';
                // data += '<p class="text-center">child photo</p>';
                // data += '</div>';
                // data += '<div class="col-sm-2">';
                // data += '<img src="'+img_parent+'" alt="" class="img-responsive" style="height: 180px;">';
                // data += '<p class="text-center">parent photo</p>';
                // data += '</div>';
                data += '</div>';
                data += '<div class="row">';
                data += '<div class="col-sm-3">';
                data += '<canvas id="barcode"></canvas>';
                data += '</div>';
                data += '<div class="col-sm-7">';
                data += '<h3 class="text-center" style="font-weight: bold;text-decoration: underline;">ONLINE APPLICATION FORM 2025-2026</h3>';
                data += '</div>';
                data += '<div class="col-sm-2">';
                data += '</div>';
                data += '</div>';
                data += '<div class="row">';
                data += '<div class="col-sm-4">';
                data += '<h4 class="text-center" style="font-weight: bold;">PEN ID:</h4><br>';
                data += '<div style="border-bottom:1px solid #000;">&nbsp;</div>';
                data += '</div>';
                data += '<div class="col-sm-4">';
                data += '<h4 class="text-center" style="font-weight: bold;">GR. NO: </h4><br>';
                data += '<div style="border-bottom:1px solid #000;">&nbsp;</div>';
                data += '</div>';
                data += '<div class="col-sm-4">';
                data += '<h4 class="text-center" style="font-weight: bold;">STD/DIV:</h4><br>';
                data += '<div style="border-bottom:1px solid #000;">'+resp['user_data'][0]['rm_child_class']+'</div>';
                data += '</div>'; 
                data += '</div><br>';
                data += '<div class="row">';
                data += '<div class="col-sm-4">';
                data += '<div style="border:1px solid #000;height:250px;text-align: center;"><img src="'+img_child+'" alt="" class="img-responsive" style="height: 248px;"></div>';
                data += '<p class="text-center" >CHILD PHOTO</p>';
                data += '</div>';
                data += '<div class="col-sm-4">';
                data += '<div style="border:1px solid #000;height:250px;text-align: center;"><img src="'+img_father+'" alt="" class="img-responsive" style="height: 248px;"></div>';
                data += '<p class="text-center" >FATHER PHOTO</p>';
                data += '</div>';
                data += '<div class="col-sm-4">';
                data += '<div style="border:1px solid #000;height:250px;text-align: center;"><img src="'+img_mother+'" alt="" class="img-responsive" style="height: 248px;"></div>';
                data += '<p class="text-center" >MOTHER PHOTO</p>';
                data += '</div>'; 
                data += '</div>';
                data += '<div class="container-fluid">';
                data += '<div class="row">';
                data += '<table class="table table-striped">';
                data += '<tr><td class="pr_header" colspan="4"><h4>Registration Details</h4></td></tr>';
                data += '<tr></tr>';
                data += '<tr>';
                data += '<th class="pr_title">Application No.</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_app_no']+'</td>';
                data += '<th class="pr_title">Date</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_reg_date']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">Mobile No.</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_parent_mob_no']+'</td>';
                data += '<th class="pr_title">Class</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_class']+'</td>';
                data += '</tr>';
                data += '<tr></tr>';
                data += '<tr><td class="pr_header" colspan="4"><h4>Student Details</h4></td></tr>';
                data += '<tr>';
                data += '<th class="pr_title">student name</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_surname']+' '+resp['user_data'][0]['rm_child_name']+' '+resp['user_data'][0]['rm_child_father_name']+'</td>';
                data += '<th class="pr_title">gender</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_gender']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">Date of Birth</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_birth_date']+'</td>';
                data += '<th class="pr_title">place of bitrh</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_birth_town']+' '+resp['user_data'][0]['rm_child_birth_state']+' '+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">community</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_community']+'</td>';
                data += '<th class="pr_title">mother tongue</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_mother_tongue']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">religion</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_religion']+'</td>';
                data += '<th class="pr_title">Nationality</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_nationality']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">permanent address</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_per_add_house_no']+', '+resp['user_data'][0]['rm_child_per_add_town']+' - '+resp['user_data'][0]['rm_child_per_add_pin_code']+','+resp['user_data'][0]['rm_child_per_add_state']+', Ward '+resp['user_data'][0]['rm_child_per_add_municipality_ward']+'</td>';
                data += '<th class="pr_title">temporary address</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_temp_add_house_no']+', '+resp['user_data'][0]['rm_child_temp_add_town']+' - '+resp['user_data'][0]['rm_child_temp_add_pin_code']+','+resp['user_data'][0]['rm_child_temp_add_state']+'</td>';
                data += '</tr>';
                data += '<tr></tr>';
                data += '<tr><td class="pr_header" colspan="4"><h4>Family Details</h4></td></tr>';
                data += '<tr>';
                data += '<th class="pr_title">father`s name</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_father_name']+' '+resp['user_data'][0]['rm_child_father_middle_name']+' '+resp['user_data'][0]['rm_child_father_last_name']+'</td>';
                data += '<th class="pr_title">father`s age</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_father_age']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">father`s qualification</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_father_qualification']+'</td>';
                data += '<th class="pr_title">father`s occupation</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_father_occupation']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">mother`s name</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_mother_name']+'</td>';
                data += '<th class="pr_title"></th>';
                data += '<td class="pr_data"></td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">mother`s qualification</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_mother_qualification']+'</td>';
                data += '<th class="pr_title">mother`s occupation</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_mother_occupation']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">office address</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_family_office_add']+', '+resp['user_data'][0]['rm_child_family_office_add_city']+' - '+resp['user_data'][0]['rm_child_family_office_add_pin_code']+','+resp['user_data'][0]['rm_child_family_office_add_state']+'</td>';
                data += '<th class="pr_title">phone /mobile no.</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_family_phone_no']+' / '+resp['user_data'][0]['rm_child_family_mob_no']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">Email</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_family_email_id']+'</td>';
                data += '<th class="pr_title">monthly income</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_family_monthly_income']+'</td>';
                data += '</tr>';
                data += '<tr></tr>';
                data += '<tr><td class="pr_header" colspan="4"><h4>Student Guardian`s Details</h4></td></tr>';
                data += '<tr>';
                data += '<th class="pr_title">guardian`s name</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_guardian_fname']+' '+resp['user_data'][0]['rm_child_guardian_mname']+' '+resp['user_data'][0]['rm_child_guardian_lname']+'</td>';
                data += '<th class="pr_title">guardian`s age</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_guardian_age']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">guardian`s occupation</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_guardian_occupation']+'</td>';
                data += '<th class="pr_title">guardian`s designation</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_guardian_designation']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">relation with student</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_guardian_relationship']+'</td>';
                data += '<th class="pr_title">mother tongue</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_guardian_mother_tongue']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">office address</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_guardian_office_add']+', '+resp['user_data'][0]['rm_child_guardian_office_add_city']+' - '+resp['user_data'][0]['rm_child_guardian_office_add_pin_code']+','+resp['user_data'][0]['rm_child_guardian_office_add_state']+'</td>';
                data += '<th class="pr_title">phone /mobile no.</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_guardian_phone_no']+' / '+resp['user_data'][0]['rm_child_guardian_mobile_no']+'</td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">Email</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_guardian_email_id']+'</td>';
                data += '<th class="pr_title">monthly income</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_guardian_monthly_income']+'</td>';
                data += '</tr>';
                data += '<tr></tr>';
                data += '<tr><td class="pr_header" colspan="4"><h4>Student Details</h4></td></tr>';
                data += '<tr>';
                data += '<th class="pr_title">Languages Spoken at Home</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_lng_spkn_at_home_1']+', '+resp['user_data'][0]['rm_child_lng_spkn_at_home_2']+', '+resp['user_data'][0]['rm_child_lng_spkn_at_home_3']+'</td>';
                data += '<th class="pr_title"></th>';
                data += '<td class="pr_data"></td>';
                data += '</tr>';
                data += '<tr>';
                data += '<th class="pr_title">pre school attended</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_pre_school_attend']+'</td>';
                data += '<th class="pr_title">Last School Name</th>';
                data += '<td class="pr_data">'+resp['user_data'][0]['rm_child_pre_school_name']+'</td>';
                data += '</tr>';
                data += '<tr></tr>';
                data += '</table>';
                data += '<table class="table table-striped">';
                data += '<tr><td class="pr_header" colspan="5"><h4>Student Siblings Details</h4></td></tr>';
                data += '<tr>';
                data += '<th class="pr_title">GR NO.</th>';
                data += '<th class="pr_title">name</th>';
                data += '<th class="pr_title">std</th>';
                data += '<th class="pr_title">div</th>';
                data += '<th class="pr_title">roll no</th>';
                data += '</tr>';
                 $.each(resp['siblings_data'], function(index,value){
                data += '<tr>';
                data += '<td class="pr_data">'+value['sbltr_gr_no']+'</td>';
                data += '<td class="pr_data">'+value['sbltr_sbl_name']+'</td>';
                data += '<td class="pr_data">'+value['sbltr_sbl_std']+'</td>';
                data += '<td class="pr_data">'+value['sbltr_sbl_div']+'</td>';
                data += '<td class="pr_data">'+value['sbltr_sbl_roll_no']+'</td>';
                data += '</tr>';
                 });
                data += '<tr><td class="pr_header" colspan="5"><h4>Instructions</h4></td></tr>';
                data += '<tr>';
                data += '<td colspan="5" class="t_n_c">';
                data += '<p><b>a]  </b> Parents seeking admission in <b>Pre-Primary Section</b> are requested to submit the updated Aadhar Card and Birth Certificate of their child issued by the Municipal Corporation (in English only). For admission from <b>Standard I to X,</b> preceding School Leaving Certificate, along with the updated Aadhar Card and Birth Certificate issued by the Municipal Corporation (in English only), must be submitted. The school will not assume responsibility for confirming admission or processing fee refund if admission is pursued without submitting mandatory mentioned documents. </p>';
                data += '<p><b>b]  </b> Al - Barkaat Malik Muhammad Islam English School is a <b>PRIVATE</b> and <b>PERMANENTLY UNAIDED</b> institution and does not receive any grant from the government and any other sources.</p>';
                data += '<p><b>c]  </b> As a private unaided institution and given that the school already maintains a reasonable fee structure in comparison to its contemporaries, parents are urged not to request any concession or relaxation in the school fees.</p>';
                data += '<p><b>d]  </b> Parents are requested to settle their monthly fee installments on or before the <b>10th</b> day of every calendar month.</p>';
                data += '<p><b>e]  </b> Fees once paid, are non-refundable/transferable under any circumstances. </p>';
                data += '<p><b>f]  </b> Parents are urged to communicate with the school management and authorities in a respectful language and refrain from using derogatory or unparliamentary language. If found to behaving to the contrary, strict action will be taken against the violator.</p>';
                data += '<p><b>g]  </b> Parents are requested to refrain from making defamatory or derogatory remarks about the institution on any search engine or Social Media platforms. In the event of a violation, appropriate action will be initiated against the offender.</p>';
                data += '<p><b>h]  </b> Parents are requested to abstain themselves from involvement, participation, or association with any group, either offline or online, that is politically/socially motivated and harbors malicious intentions to discredit the institution’s reputation.</p>';
                data += '<p><b>i]  </b> Parents are requested to ensure the punctuality of their children, especially those who employ private or third-party transportation services to drop them off and pick them up from the school.</p>';
                data += '<p><b>j]  </b> As the school does not offer any transportation services, parents are at liberty to either personally drop off and pick up their child from the school or engage the services of any private or third-party transportation at their own risk and cost. The school, will not assume any responsibility in the event of any untoward incident that may occur during transportation.</p>';
                data += '<p><b>k]  </b> The school fees referenced in the Application Form are subject to change from time to time at the discretion of the management without any prior notification. At present the fees structure for new admission for academic year <b>2025-2026</b> of pre-primary section (Nursery/Junior/Senior), is Rs: 58600/- Per Annum, w.e.f. April -2025 to March-2026.</p>';
                data += '<p><b>l] </b> The school management is at liberty to add to, amend, vary, alter and/or rescind any of the instructions mentioned hereinabove.</p>';
                data += '</td>';
                data += '</tr>';
                data += '<tr><td class="pr_header" colspan="5"><h4>UNDER TAKING CUM DECLARATION</h4></td></tr>';
                data += '<tr>';
                data += '<td colspan="5" class="t_n_c">';
                data += '<p> &nbsp; &nbsp;  &nbsp; I, the undersigned Parents/Guardian of Master/ Miss <b>'+child_name+'</b>, seeking admission in <b>'+resp['user_data'][0]['rm_child_class']+'</b> for the academic year 2025-26 do hereby solemnly declare & undertake as under:</p>';
                data += '<p><b>a]  </b> I have read all the applicable Rules and Regulations, Instructions, Guidelines and Eligibility Criteria related to admission.</p>';
                data += '<p><b>b]  </b> The information filled in by me in this form is complete, correct and true to the best of my knowledge & belief. I will personally be responsible and liable for any discrepancy arising out of any incorrect, incomplete documentation, or details filled by me in the admission form.</p>';
                data += '<p><b>c]  </b> I understand that if admission to my child is delayed, denied or cancelled, on account of any reason, including the availability of seats & submission of incorrect information and/or documents, then I shall not hold the school or its staff responsible for the consequences thereof, and/or as a result, the school is liable for any monetary or other consequences. I undertake to indemnify the school without any demur.</p>';
                data += '<p><b>d]  </b> I understand that the acceptance of the Admission Form does not guarantee admission. Further, even after acceptance of the payment of fees, admission to my child is           PROVISIONAL, subject to approval by the School Management/Authorities.</p>';
                data += '<p><b>e]  </b> I understand and am satisfied that the school Management is very cautious about the safety and welfare of children. Despite best efforts, all possible precautions, and safety measures taken by the school, any mishappening may occur due to any factors beyond the control of the school, I shall not blame the school Management in any manner, and I shall have no claim whatsoever.</p>';
                data += '<p><b>f]  </b> I hereby undertake that the school will not be liable for any damages or charges on account of any misfortune, or injuries which may be sustained by my child at any time while taking part in any curricular, or extracurricular activities, or while participating in sports, or during travelling or any other normal activities, or by contracting any illness or disease inside or outside the school premises. All expenses that may be incurred on the treatment of such injuries will be borne by me.</p>';
                data += '<p><b>g]  </b> I comprehend that the school may capture videos and Photographs of myself and of my child for inclusion in the School Prospectus, Brochures, School Website, Social Media Channels, and other multipurpose educational needs as and when required. I undertake to give My Consent/No Objection to using mine and my child’s videos and Photographs, and I affirm that I shall not demand any monetary benefit or compensation in return.</p>';
                data += '<p><b>h]  </b> I undertake to abide by the decisions and actions taken by the school authorities from time to time in maintaining discipline, and the decision of the authorities shall be final.</p>';
                data += '<p><b>i]  </b> I authorize the school to take disciplinary action in the interest of my child in case he/she does not abide by the rules & regulations mentioned in the school policy. I undertake to accept the decision in this regard.</p>';
                data += '<p><b>j]  </b> I understand that Al - Barkaat Malik Muhammad Islam English School is a private unaided institution. Nevertheless, I voluntarily choose to enroll my child in the school.</p>';
                data += '<p><b>k]  </b> I declare and undertake to abstain from challenging, either personally or on behalf of any other parent and vice versa, the existing and future fee structure of the school.</p>';
                data += '<p><b>l]  </b> I undertake to pay the school fees regularly within the stipulated date as mentioned by the school authority. Failing this, I understand that it would result in additional late fines, and penalties, along with strict actions as set out in school norms.</p>';
                data += '<p><b>m]  </b> I undertake that I shall not initiate any legal or other proceedings against the school authorities and its staff for any mishappening or disciplinary action taken by the school.</p>';
                data += '<p><b>n]  </b> I understand and acknowledge that this Application Form may be presented to the concerned authorities for necessary purposes as and when required. I hereby declare that I have no disputes or objections regarding the fees, instructions mentioned hereinabove, and rules and regulations of the institution.</p>';
                data += '<p><b>o]  </b> I undertake to abide by the Rules and Regulations made thereunder, as per the school policy, and shall not act contrary there to.</p>';
                data += '<p><b>p]  </b> I hereby declare that I have carefully read and understood the contents stated hereunder, and I voluntarily affix my signature without any fear or favor, coercion or undue influence from anybody.</p>';
                data += '<p><b>q]  </b> I hereby grant my CONSENT, UNDERTAKING AND EXPRESS NO OBJECTION,               authorizing the School Management to proceed with the admission procedure.</p>';
                data += '</td>';
                data += '</tr>';
                data += '</table>';
                if (resp['user_data'][0]['rm_tnc'] == '0'){
                data += '<div class="row">';
                data += '<div class="col-sm-10 style="padding-left: 0px;">';
                data += '<input type="checkbox" name="rm_tnc" id="rm_tnc" value="1" style="width: 20px;height: 18px;" checked/>';
                data += '<span class="tnc"><a href="#" style="font-size: 20px;color: #d04747;font-weight: bold;"> I have read, understood, and agreed to the above terms & conditions</a></span>';
                data += '</div>';
                data += '</div>';
                data += '<br>';
                }
                data += '<div class="row" id="save_btn_div">';
                // data += '<div class="col-sm-2 col-sm-offset-1"><button class="btn btn-primary" onClick="print_appl('+id+')">Download PDF</button></div>';
                //this button for payment gateway codeing
                if (resp['user_data'][0]['rm_payment_status'] == '3'){
                data += '<div class="col-sm-2"><a onclick="make_payment('+id+','+appno+')" class="btn btn-success">Make Payment</a></div>';
                data += '<div class="col-sm-2"><button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" onClick="reload_page()">Edit-Form</button></div>';
                }
                data += '</div>';
                data += '</div>';
                data += '</div>';
                data += '</div>';
                // $(".modal-body").css("color","#052E3E");
                // $(".modal-body").css("font-weight","bold");
                // $(".modal-body").css("text-align","center");
                $(".modal-body").html(data);
                $("#popup_modal_lg").modal('show');
                var barcode = resp['user_data'][0]['rm_app_no'];
                var barcode_date = (resp['user_data'][0]['rm_child_birth_date']).replace( /-/g,"" );
                var reg_date = (resp['user_data'][0]['rm_reg_date']).replace( /-/g,"" );
                var barcode_no = barcode+barcode_date;
                $("#barcode").JsBarcode(barcode_no, {format: "CODE128B",width: 1, height: 50,displayValue: false});
                /*terms and condition*/
                // if ($("#rm_tnc").is(":checked")){
                //     $("#save_btn_div").show();
                // }
                // else{
                //     $("#save_btn_div").hide();
                // }
                // $("#rm_tnc").click(function (){
                //     if ($(this).is(":checked")){
                //         $("#save_btn_div").show();
                //     }
                //     else{
                //         $("#save_btn_div").hide();
                //     }
                // });
                
            }
        });
    }
    function make_payment(id,app_no)
    {
        var checkbox =  $('#rm_tnc').is(':checked');
        if (checkbox == false)
        {
            var msg = 'Please accept terms & conditions';
            alert(msg);
        }
        else
        {
            window.location.href = base_url+"chome/payment_form/"+id+"/"+app_no;
        }
    }
    function print_appl(id)
    {
        window.open(base_url+"chome/print_application/"+id,'newwindow1','width=1024, height=768');
    }
    // function final_submission_pay(id)
    // {
    //     var path = base_url+"chome/final_submission/"+id;
    // }
    function reload_page()
    {
        window.location.reload();
    }
    function final_submission(id)
    {
        var path = base_url+"chome/final_submission/"+id;
        $("#loading").show();
        $.ajax({
            url:path,
            success:function(resp)
            {
                if(resp != "")
                {
                    var msg = 'Thank you for your Registration. your form has been Successfully registered!';
                    $(".modal-body-sm").css("color","#052E3E");
                    $(".modal-body-sm").css("font-weight","bold");
                    $(".modal-body-sm").css("text-align","center");
                    $(".modal-body-sm").html(msg);
                    $("#popup_modal_lg").modal('hide');
                    $("#popup_modal_sm").modal('show');
                    $("body, html").animate({'scrollTop':0},1000);
                    $("#loading").hide();
                    setInterval(function(){window.location.href= base_url+"chome/logout";}, 3000);
                }
                else
                {
                    var msg = 'Unknown Error ! Please try again later';
                    $(".modal-body-sm").css("color","#052E3E");
                    $(".modal-body-sm").css("font-weight","bold");
                    $(".modal-body-sm").css("text-align","center");
                    $(".modal-body-sm").html(msg);
                    $("#popup_modal_sm").modal('show');
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
/********* VSG *********/
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
// function show_save_btn()
// {
// $("#rm_tnc").on("click",function() {
//     $("#save_btn_div").toggle(this.checked);
//   });
    // alert(11212);
    // if($('#rm_tnc').is(":checked"))
    //     $("#save_btn_div").show();
    // else
    //     $("#save_btn_div").hide();
// }
function search_student_app_status()
{
    // alert(window.otp_value);
    // alert(12345);
    var dob     = $("#rm_child_birth_date").val();
    dob_array   = dob.split("-");
    var year    = dob_array[2];
    // alert(year);
    var check_mob   = 0;
    var check_dob   = 0;
    var check_otp   = 0;
    var check       = 1;
        if($("#rm_parent_mob_no").val() == "" || isNaN($("#rm_parent_mob_no").val()))
        {
            $("#rm_parent_mob_no").css({'border-color':'red'});
            check = 0;
            check_mob = 1;
        }
        else
        {
            $("#rm_parent_mob_no").css({'border-color':'#CCC'});
        }
        if($("#rm_child_birth_date").val() == "")
        {
            $("#rm_child_birth_date").css({'border-color':'red'});
            check = 0;
            check_dob = 1;
        }
        else
        {
            $("#rm_child_birth_date").css({'border-color':'#CCC'});
        }
        if($("#rm_password").val() == "")
        {
            $("#rm_password").css({'border-color':'red'});
            check = 0;
            check_otp = 1;
        }
        else
        {
            $("#rm_password").css({'border-color':'#CCC'});
        }
        if(check == 0)
        {
            if(check_mob == 1)
            {
                var msg = 'Invalid Mobile Number';
                display_alert('err',msg);
            }
            else if(check_dob == 1)
            {
                var msg = 'Invalid Birth Date - Should be Between Jan and Dec 2015';
                display_alert('err',msg);
            }
            else if(check_otp == 1)
            {
                var msg = 'Please Enter Password';
                display_alert('err',msg);
            }
            $("body, html").animate({'scrollTop':0},1000);
        }
        else
        {
            var form_obj = document.getElementById("stud_app_search_form");
            var form_data_obj = new FormData(form_obj);
            var path = base_url+"clogin/search_student_application_status";
            $("#loading").show();
            $.ajax({
                type:'POST',
                url:path,
                data:form_data_obj,
                dataType:'json',
                contentType:false,
                processData:false,
                success:function(resp)
                {
                    if(resp['flag'] == 1)
                    {
                        window.location.href = base_url+"clogin/student_search_form/"+resp['student_id'];
                    }
                    else if(resp == 2)
                    {
                        var msg = 'Invalid Application Number';
                        display_alert('err',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                    }
                    else if(resp == 3)
                    {
                        var msg = 'Wrong Date of Bitrh';
                        display_alert('err',msg);
                        $("body, html").animate({'scrollTop':0},1000);
                    }
                    else if(resp == 4)
                    {
                        var msg = 'Wrong Password';
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
                error:function(resp){
                    console.log(resp);
                }
            });
        }
}
function set_father_name(fath_name)
{
    $("#father_name").val(fath_name)
}
function set_mother_name(moth_name)
{
    $("#rm_child_mother_full_name").val(moth_name)
}
function set_sur_name(moth_name)
{
    $("#rm_child_father_last_name").val(moth_name)
}