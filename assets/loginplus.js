/* MEDIA UPLOADER */
jQuery(document).ready(function($){

	$('#imageU').click(function (e) {
		e.preventDefault();
		var image = wp.media({
			title:    'Upload Image',
			multiple: false
		}).open().on('select', function (e) {
			var image_url = image.state().get('selection').first().toJSON().url;
			$('#imageUrl').val(image_url);
			//$('#thumbnail_adr').val('');
			showCurrentImage();
		});
		return false;
	});

	/**
	 * Show current image in item form
	 */
	var showCurrentImage = function () {
		var src = $('#imageUrl').val();
		src && $('#imgPreview').empty().append(
			'<a class="afp-item-form-image-preview" href="' +
			src +
			'" target="_blank"><img src="'+src+'" class="imgResponsive"/></a>'
		);
	};
	showCurrentImage();
});



jQuery(document).ready( function() {
  jQuery('#loginPlusForm').submit(function(e){
	e.preventDefault();
	var imageUrl=jQuery("#imageUrl").val();
	var logoUrl=jQuery("#logoUrl").val();
	var status=jQuery('input[name=status]:checked').val();
	var statusClass;
	//var data = jQuery(this).serialize();
    jQuery("#result").html('<p class="spsuccess">Wait Quering...</p>');
		jQuery.ajax({
		    type:"POST",
			url: ajaxurl,
			data: { 
                    action: "login_Plus_Saved",
                    imageUrl : imageUrl,
                    logoUrl  : logoUrl,
                    status : status
            },
			//dataType: 'json',
			success:function(data){
				//jQuery("#result").html(data);
			 
			  if(data==0){
			  	jQuery("#result").html('<div class="sperror">Failed To Update</div>');
			  }
			  if(data==1){
			  	 jQuery("#result").html('<div class="spsuccess">Successfully Updated</div>');
			  	 if(status=='Inactive')
				   statusClass='sperror';
				 else
				   statusClass='spsuccess';

			  	 jQuery("#statusPreview").html(status);
			  	 jQuery('#statusPreview').removeClass('sperror spsuccess')
			  	 jQuery('#statusPreview').addClass(statusClass)
			  }
			}
		});
	});
});

jQuery(document).ready( function() {
  jQuery('#loginPlussettings').submit(function(e){
	e.preventDefault();
	var deleteOption=jQuery("#deleteOption").val();
	
	if(deleteOption==""){
      jQuery("#settingsProcess").html('<div class="sperror">Please Select a Option</div>');
	}else{
    jQuery("#settingsProcess").html('<p class="spsuccess">Wait Quering...</p>');
		jQuery.ajax({
		    type:"POST",
			url: ajaxurl,
			data: { 
                    action: "login_plus_deleteLogs",
                    deleteOption : deleteOption
            },
			//dataType: 'json',
			success:function(data){
				//jQuery("#result").html(data);
			 
			  if(data==0){
			  	jQuery("#settingsProcess").html('<div class="sperror">Failed To Delete</div>');
			  }
			  if(data==1){
			  	 jQuery("#settingsProcess").html('<div class="spsuccess">Successfully Deleted</div>');
			  }
			}
		});
   }
});
});