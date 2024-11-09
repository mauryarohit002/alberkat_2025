
$(document).ready(function(){
	$("#date_start, #date_end").datepicker({
	        format: 'dd-mm-yyyy'
	});
});
function get_party_by_ledger(){
	var ledger = $("#ledger").val();
	var path = base_url+"creport/get_party_by_ledger";
            
    $("#loading").show();  
    $.ajax({
        type:'GET',
        url:path,
        data:'ledger='+ledger,
        dataType:'json',
        success:function(resp)
        {
        	var data = '';
        	data += '<option value="0">ALL</option>';
        	$.each(resp, function(index, value){
        		data += '<option value="'+value['acc_id']+'">'+value['acc_name']+'</option>';
        	});
        	$("#party").html(data);
        	$("#loading").hide();
        },
        error:function(resp)
        {
        	console.log(resp);
        }
    });	
}