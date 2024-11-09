$(document).ready(function(){
    $("#"+link).addClass("active");
    $("#"+sub_link).addClass("active");
  	/************************************** Session Authentication **************************************/
	
		/*var path = base_url+"clogin/check_session_status";      
	    $.ajax({
	        type:'POST',
	        url:path,
	        success:function(resp)
	        {
	            alert(resp);
	        },
	        error:function(resp)
	        {
	        }
	    });*/
});
const trigger_search = () => $("#search_form").trigger("click");
const zoom = () => $(".pan").pan();
const compress_image = async (id) => {
	const imageFile = $(`#${id}`)[0].files[0];
	if (!imageFile) return {};
	const options = {
		maxSizeMB: 1,
		maxWidthOrHeight: 750,
		useWebWorker: true,
	};
	try {
		return await imageCompression(imageFile, options);
	} catch (error) {
		throw error;
	}
};
const compress_multiple_image = async (id) => {
	const imageFile = $(`#${id}`)[0].files;
	if(!imageFile) return {};
	const options = {
		maxSizeMB: 1,
		maxWidthOrHeight: 750,
		useWebWorker: true,
	};
	try {
		compressedFile = [];	
		for(i=0;i<imageFile.length; i++){
			compressedFile[i]  = await imageCompression(imageFile[i], options);
		}
		return compressedFile;	
	} catch (error) {
		throw error;
	}
};