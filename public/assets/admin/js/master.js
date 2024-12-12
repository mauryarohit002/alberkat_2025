+$(document).ready(function(){
    $(".master_table").dataTable();
    $(".dash_date").datepicker({
        format:'dd-mm-yyyy',
        autoclose:true
    })
    /*$("#rm_child_birth_date").datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        endDate: '31-12-2019',
        startDate: '01-01-2000',
    })*/
    $("#rm_child_birth_date").datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        endDate: '30-09-2019',
        startDate: '01-10-2016',
    });
});
/********************************* Common Function *********************************/
    function delete_item(id, path)
    {
        var ans = confirm("Are you sure? You want to delete item.");
        if(ans == true)
        {
            var update_path = base_url+"cmaster/"+path+"/"+id;
            $("#loading").show();
            $.ajax({
                type:'POST',
                url:update_path,
                success:function(resp)
                {
                    // console.log(resp);
                    if(resp == 2)
                    {
                        alert("You can not delete this item!");
                    }
                    else
                    {
                        window.location.reload();
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
    function preview_student(id)
    {
        var path = base_url+"admin/cmaster/get_student_data_fr_preview/"+id;
        var img_logo = base_url+'public/assets/images/albarkaat_letter_head3.jpg';
        $.ajax({
            type:'POST',
            url:path,
            dataType:'json',
            success:function(resp)
            {
                console.log(resp);
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
                data += '<div style="border-bottom:1px solid #000;text-align:center;">'+resp['user_data'][0]['rm_child_class']+' - </div>';
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
                data += '<th class="pr_title">relation rith student</th>';
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
                data += '<p><b>k]  </b> The school fees referenced in the Application Form are subject to change from time to time at the discretion of the management without any prior notification. At present the fees structure for new admission for academic year <b>2025-2026</b> of pre-primary section (Nursery/Junior/Senior), is Rs: 58600/- Per Annum, w.e.f. April-2025 to March-2026.</p>';
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
                var barcode_no = barcode+barcode_date;
                $("#barcode").JsBarcode(barcode_no, {format: "CODE128B",width: 1, height: 50,displayValue: false});
                /*terms and condition*/
                if ($("#rm_tnc").is(":checked")){
                    $("#save_btn_div").show();
                }
                else{
                    $("#save_btn_div").hide();
                }
                $("#rm_tnc").click(function (){
                    if ($(this).is(":checked")){
                        $("#save_btn_div").show();
                    }
                    else{
                        $("#save_btn_div").hide();
                    }
                });
            }
        });
    }
    function print_student(id,without=0)
    {
        if(without==1){
            window.open(base_url+"admin/cmaster/print_student_app/"+id+"/1",'newwindow1','width=1024, height=768');
        }else{
            window.open(base_url+"admin/cmaster/print_student_app/"+id,'newwindow1','width=1024, height=768');
        }
    }
    function print_teach_form(id)
    {
        window.open(base_url+"admin/cmaster/print_teachers_form/"+id,'newwindow1','width=1024, height=768');
    }
    function add_th_td(value,cnt)
    {
        if(value == 5)
        {
            var data =  "<th>Details</th>";
            $("#table_heading").html(data);
            var data2 = "<td><input type='text' id='rm_inter_date' name='rm_inter_date' class='form-control dash_cust_ip' placeholder='DATE'style='border-bottom:1px solid #ccc;' ><br/><textarea type='text' class='form-control dash_cust_ip' id='rm_inter_desc' name='rm_inter_desc' placeholder='Description'></textarea></td>";
            $("#table_content_"+cnt).html(data2);
            $("#rm_inter_date").datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
            });
        }
        if(value == 1)
        {
            var data =  "<th>Details</th>";
            $("#table_heading").html(data);
            var data2 = "<td><textarea type='text' class='form-control dash_cust_ip' id='rm_incomp_app_desc' name='rm_incomp_app_desc' placeholder='Description'></textarea></td>";
            $("#table_content_"+cnt).html(data2);
        }
    }
    function app_status_update(rm_id,cnt)
    {
        var path = base_url+"admin/cmaster/update_app_status/"+rm_id;
        var form_data = $("#app_status_approve_"+cnt).serialize();
        $("#loading").show();
        $("#save_btn").prop('disabled', true);
        $.ajax({
            type:'POST',
            url:path,
            data:form_data,
            dataType:"json",
            success:function(resp)
            {
                // console.log(resp);
                let {status,data,msg}=resp;
                if(status)
                {
                    // var msg = 'Successfully Updated!';
                    display_alert('succ',msg);
                    $("body, html").animate({'scrollTop':0},1000);
                    setInterval(function(){window.location.reload()},1500);
                }else if(!status){
                    display_alert('warn',msg);
                    $("#body, html").animate({'scrollTop':0},1000);
                }
                else
                {
                    msg = 'Unknown Error ! Please try again letter';
                    display_alert('warn',msg);
                    $("#body, html").animate({'scrollTop':0},1000);
                }
                $("#loading").hide();
            },
            error:function(resp)
            {
                console.log(resp);
            }
        });
    }
    function clear_search_keyword()
	{
		$("#search_keyword").val("");
	}
    function update_mob_no(app_id)
    {
        var data = '';
        data += '<div class="alert_msg_popup"></div>';
        data += '<div class="row">';
        data += '<div class="col-md-12">'
        data += '<form class="form-horizontal" id="rm_mob_form">';
        data += '<div class="form-group"><label for="inputEmail3" class="col-sm-3 control-label">Mobile No.</label><div class="col-sm-9"><input type="text" name="rm_parent_mob_no" class="form-control" id="rm_parent_mob_no"></div></div>';
        data += '</form>';
        data += '</div>';
        data += '</div>';
        $(".modal-body-sm").html(data);
        var sbt_btn = '<button type="button" class="btn btn-default" onClick="reload_page();" data-dismiss="modal">Close</button>';
        if(app_id != 0)
        {
            var update_path = base_url+"admin/cmaster/get_single_mob_no/"+app_id;
            $.ajax({
                type:'POST',
                url:update_path,
                dataType:'json',
                success:function(resp)
                {
                    $("#rm_parent_mob_no").val(resp[0]['rm_parent_mob_no']);
                },
                error:function(resp)
                {
                    console.log(resp);
                }
            });
            sbt_btn += '<button type="button" class="btn btn-success" onClick="update_mobile('+app_id+')">Submit</button>';
            $(".modal-title-sm").html("Update Mobile");
        }
        $(".modal-footer-sm").html(sbt_btn);
        $("#loading").hide();
        $("#popup_modal_sm").modal('show');
    }
    function update_mobile(rm_id)
    {
        var path = base_url+"admin/cmaster/update_mobile_no/"+rm_id;
        var form_data = $("#rm_mob_form").serialize();
        $("#loading").show();
        $.ajax({
            type:'POST',
            url:path,
            data:form_data,
            success:function(resp)
            {
               console.log(resp);
                if(resp == 1)
                {
                    var msg = 'Successfully Updated!';
                    display_alert_popup('succ',msg);
                    $("body, html").animate({'scrollTop':0},1000);
                    setInterval(function(){window.location.reload()},1500);
                }
                else
                {
                    var msg = 'Unknown Error ! Please try again letter';
                    display_alert_popup('warn',msg);
                    $("#body, html").animate({'scrollTop':0},1000);
                }
                $("#loading").hide();
            },
            error:function(resp)
            {
                console.log(resp);
            }
        });
    }
    function ajaxcall(path,formdata,re,er)
    {
        $.ajax({
            type:"POST",
            url:path,
            data:formdata,
            success:function(response){
                re(response)
            },
            error:function(err){
                er(err)
            }
        })
    }
    function open_cust_msg_box(id) {
        var data = '';
        data += '<div class="alert_msg_popup"></div>';
        data += '<div class="row">';
        data += '<div class="col-md-12">'
        data += '<form class="form-horizontal" id="msg_form">';
        data += '<div class="form-group">';
        data += '<label for="inputEmail3" class="col-sm-2 control-label">Message</label>';
        data += '<div class="col-sm-10">';
        data += '<textarea name="cust_msg" id="cust_msg" class="form-control" style="border:none;border-bottom:1px solid;"></textarea>';
        data += '</div>';
        data += '</div>';
        data += '</form>';
        data += '</div>';
        data += '</div>';
        $(".modal-body-sm").html(data);
        var sbt_btn = '<button type="button" class="btn btn-default" onClick="reload_page();" data-dismiss="modal">Close</button>';
        sbt_btn += '<button type="button" class="btn btn-success" onClick="send_custom_sms('+id+')">Submit</button>';
        $(".modal-title-sm").html("Send SMS");
        $(".modal-footer-sm").html(sbt_btn);
        $("#loading").hide();
        $("#popup_modal_sm").modal('show');
    }
    function send_custom_sms(rm_id)
    {
        var check = 1;
        if ($("#cust_msg").val() == '')
        {
            $("#cust_msg").css({'border-color':'red'});
            check = 0;
        }
        else
        {
            $("#cust_msg").css({'border-color':'#ccc'});
        }
        if (check == 0)
        {
            var msg = 'Please insert some information';
            display_alert_popup('err',msg);
        }
        else
        {
            var path = base_url+"admin/cmaster/send_custom_sms_to_parent/"+rm_id;
            var form_data = $("#msg_form").serialize();
            ajaxcall(path,form_data,function(res){
                if(res == 1)
                {
                    var msg = 'Message Sent Successfully !';
                    display_alert_popup('succ',msg);
                    setInterval(function(){window.location.reload()},1500);
                }
                else
                {
                    var msg = 'Unknown Error ! Please try again letter';
                    display_alert_popup('warn',msg);
                }
            },function(errmsg){
                console.log(errmsg);
            });
        }
    }
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
            if($("#rm_child_birth_date").val() == "" || year != 2016)
            {
                $("#rm_child_birth_date").css({'border-color':'red'});
                check = 0;
                check_dob = 1;
            }
            else
            {
                $("#rm_child_birth_date").css({'border-color':'#CCC'});
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
                else if(check_dob == 1)
                {
                    var msg = 'Invalid Birth Date - Should be Between Jan and Dec 2015';
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
                            window.location.href = base_url+"admin/cmaster/student_search_form/"+resp['student_data'][0]['rm_id'];
                        }
                        else if(resp == 2)
                        {
                            var msg = 'Invalid Mobile Number';
                            display_alert('err',msg);
                            $("body, html").animate({'scrollTop':0},1000);
                        }
                        else if(resp == 3)
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
                    error:function(resp){
                        console.log(resp);
                    }
                });
            }
    }