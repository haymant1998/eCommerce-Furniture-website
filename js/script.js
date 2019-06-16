$(document).ready(function(){

	if($("#ei-slider").length != 0){
		 $('#ei-slider').eislideshow({
		 	autoplay	: true,
			easing		: 'easeOutCubic',
			titleeasing	: 'easeOutBounce',
			titlespeed	: 1200
	    });
	}

	height = '500px';

    finalHeight = height;
    	$('.home_page #home_header_fixed, .home_page header, .ei-slider').css({
	      'height': "500px",
	    }); 

   	$("#go_to_top").click(function() {
	  $("html, body").animate({ scrollTop: 0 }, 2000);
	  return false;
	});   


});

 
 		 
