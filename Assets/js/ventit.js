jQuery(document).ready(function() {

	 jQuery('#post_text').emojioneArea({
			 pickerPosition:"bottom"
	 });


jQuery('#sendData').click(function(){

		jQuery.ajax({
			type: "POST",
			url: "includes/ajax/profileData.php",
			data: jQuery('form.popoutdataframe').serialize(),
			success: function(msg) {
				jQuery("#ModalLabel").modal('hide');
				location.reload();
				},
			error: function() {
				alert('Couldnt submit post!!');
			}
		});
});
});


jQuery(document).ready(function() {
  jQuery('.searchbtn').on('click', function() {
    document.liveData.submit();
  })

  });

  function formData(value) {

  	jQuery.post("includes/ajax/livesearch.php", {query:value}, function(data) {

  	if(jQuery(".lowertab")[0]) {
  			jQuery(".lowertab").toggleClass("bottomlink");
  			jQuery(".lowertab").toggleClass("lowertab");
  		}

  		jQuery('.dataRetrieved').html(data);
  		jQuery('.bottomlink').html("<a href='search.php?q=" + value + "'>View all search data</a>");

  		if(data == "") {
  			jQuery('.bottomlink').html("");
  			jQuery('.bottomlink').toggleClass(".lowertab");
  			jQuery('.bottomlink').toggleClass(".bottomlink");
  		}

  	});

  }



function getSmsData(owner, type) {

	if(jQuery(".smsnotificationScreen").css("height") == "0px") {

		var menuTab;

		if(type == 'alerts') {

			menuTab = "smsAlerts.php";
			jQuery("span").remove("#notViewed");


		}

		else if (type == 'sms') {

			menuTab = "smsMenu.php";
			jQuery("span").remove("#textnotViewed");
		}

		var ajaxreq = jQuery.ajax({
			url: "includes/ajax/" + menuTab,
			type: "POST",
			data: "page=1&loggedInUser=" + owner,
			cache: false,

			//if sending data is successfull ,msg as parameter of the Ajax
			success: function(msg) {
				//on the smsnotcaionScreen we print the message as .html(msg)
				jQuery(".smsnotificationScreen").html(msg);
				//we make it visible now by changing the height from 0-300
				jQuery(".smsnotificationScreen").css({"padding":"0px", "height": "300px", "border" : "1px solid #E5DCC3"});
				//cal val() function on the smsdatascreen id
				jQuery("#smsdatascreen").val(type);
			}

		});

	}
	else {

		$(".smsnotificationScreen").html("");
		$(".smsnotificationScreen").css({"padding" : "0px", "height": "0px", "border" : "none"});
	}

}
