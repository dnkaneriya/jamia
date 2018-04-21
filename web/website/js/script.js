/* ********************************************************************************************
   Fixed Mac Issue
*********************************************************************************************** */

if (navigator.userAgent.indexOf('Mac OS X') != -1) {
  $("body").addClass("mac");
} else {
  $("body").addClass("pc");
}
    
/* ********************************************************************************************
   Accordion
*********************************************************************************************** */

$(document).on('click', ".opener", function () {
    var ele = $(this).parent('.mobile-accordion');   
    if ($(ele).hasClass("active")) {
        $(ele).removeClass('active');
        $(ele).find(".block-content").slideUp(400);
    }
    else {
        $(ele).addClass('active');	
        $(ele).find(".block-content").slideDown(400);
    }
});

/* ********************************************************************************************
   Fixed Header
*********************************************************************************************** */

jQuery(function($){
    var myHeader = $('.navbar-fixed-top');
    myHeader.data( 'position', myHeader.position() );
    $(window).scroll(function(){
        var hPos = myHeader.data('position'), scroll = getScroll();
         if ( hPos != undefined && hPos.top < scroll.top ){
            myHeader.addClass('sticky-navbar');
        }
        else {
            myHeader.removeClass('sticky-navbar');
        }
    });
    
    function getScroll () {
        var b = document.body;
        var e = document.documentElement;
        return {
            left: parseFloat( window.pageXOffset || b.scrollLeft || e.scrollLeft ),
            top: parseFloat( window.pageYOffset || b.scrollTop || e.scrollTop )
        };
    }
});

jQuery(function($){
    var myHeader = $('.arrow-bottom');
    myHeader.data( 'position', myHeader.position() );
    $(window).scroll(function(){
        var hPos = myHeader.data('position'), scroll = getScroll();
         if ( hPos != undefined && hPos.top < scroll.top ){
            myHeader.addClass('hidden');
        }
        else {
            myHeader.removeClass('hidden');
        }
    });
    
    function getScroll () {
        var b = document.body;
        var e = document.documentElement;
        return {
            left: parseFloat( window.pageXOffset || b.scrollLeft || e.scrollLeft ),
            top: parseFloat( window.pageYOffset || b.scrollTop || e.scrollTop )
        };
    }
});


/* ********************************************************************************************
   SmoothScroll
*********************************************************************************************** */

$(function() {
  $('.smoothScroll').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      console.log(target);
      target = target.length ? target : $('[name=', this.hash.slice(1) + ']');
      
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 2000); // The number here represents the speed of the scroll in milliseconds
        return false;
      }
    }
  });
  
  setTimeout(function(){
      var link = location.href.split('#');
      var target = link[1];
      $('.smoothScroll').each(function(){
          if ($(this).attr('href') == '#'+target) {
              $(this).trigger('click');
          }
      });
      
  },100);
});
    
    

