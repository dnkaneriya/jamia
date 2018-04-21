var $ = jQuery.noConflict();

$(document).ready(function($) {
	"use strict";

	/*-------------------------------------------------*/
	/* =  Dropdown Menu - Superfish
	/*-------------------------------------------------*/
	try {
		$('ul.sf-menu').superfish({
			delay: 400,
			autoArrows: false,
			speed: 'fast',
			animation: {opacity:'show', height:'show'}
		});
	} catch (err){

	}




	/*-------------------------------------------------*/
	/* =  Mobile Menu
	/*-------------------------------------------------*/
	// Create the dropdown base
    $("<select />").appendTo("#nav");
    
    
    // Create default option "Go to..."
    $("<option />", {
		"selected": "selected",
		"value"   : "",
		"text"    : "Navigate to..."
    }).appendTo("#nav select");
    
    // Populate dropdown with menu items
    $(".sf-menu a").each(function() {
		var el = $(this);
		$("<option />", {
			"value"   : el.attr("href"),
			"text"    : el.text()
		}).appendTo("#nav select");
    });

    $("#nav select").change(function() {
		window.location = $(this).find("option:selected").val();
    });

    

	/*-------------------------------------------------*/
	/* =  Input & Textarea Placeholder
	/*-------------------------------------------------*/
	$('input[type="text"], textarea').each(function(){
		$(this).attr({'data-value': $(this).attr('placeholder')});
		$(this).removeAttr('placeholder');
		$(this).attr({'value': $(this).attr('data-value')});
	});

	$('input[type="text"], textarea').focus(function(){
		$(this).removeClass('error');
		if($(this).val().toLowerCase() === $(this).attr('data-value').toLowerCase()){
			$(this).val('');
		}	
	}).blur( function(){ 
		if($(this).val() === ''){
			$(this).val($(this).attr('data-value'));
		}
	});

    /*-------------------------------------------------*/
    /* =  Scroll to TOP
	/*-------------------------------------------------*/
	$('a[href="#top"]').click(function () {
	    $('html, body').animate({ scrollTop: 0 }, 'slow');
	    return false;
	});


	jQuery(document).ready(function () {
	    var offset = 220;
	    var duration = 500;
	    jQuery(window).scroll(function () {
	        if (jQuery(this).scrollTop() > offset) {
	            jQuery('.back-to-top').fadeIn(duration);
	        } else {
	            jQuery('.back-to-top').fadeOut(duration);
	        }
	    });

	    jQuery('.back-to-top').click(function (event) {
	        event.preventDefault();
	        jQuery('html, body').animate({ scrollTop: 0 }, duration);
	        return false;
	    })
	});



   
});
