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
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 2000); // The number here represents the speed of the scroll in milliseconds
        return false;
      }
    }
  });
});

    //$(".navbar a").click(function(evn){
    //    evn.preventDefault();
    //    $('html,body').scrollTo(this.hash, this.hash); 
    //});
    //
    //var aChildren = $(".nav li").children(); // find the a children of the list items
    //var aArray = []; // create the empty aArray
    //for (var i=0; i < aChildren.length; i++) {    
    //    var aChild = aChildren[i];
    //    var ahref = $(aChild).attr('href');
    //    aArray.push(ahref);
    //} // this for loop fills the aArray with attribute href values
    //
    //$(window).scroll(function(){
    //    var windowPos = $(window).scrollTop(); // get the offset of the window from the top of page
    //    var windowHeight = $(window).height(); // get the height of the window
    //    var docHeight = $(document).height();
    //    
    //    for (var i=0; i < aArray.length; i++) {
    //        var theID = aArray[i];
    //        var divPos = $(theID).offset().top; // get the offset of the div from the top of page
    //        var divHeight = $(theID).height(); // get the height of the div in question
    //        if (windowPos >= divPos && windowPos < (divPos + divHeight)) {
    //            $("a[href='" + theID + "']").addClass("");
    //        } else {
    //            $("a[href='" + theID + "']").removeClass("");
    //        }
    //    }
    //    
    //    if(windowPos + windowHeight == docHeight) {
    //        if ($("#navbar li:last-child a").hasClass("anchor")) {
    //            var navActiveCurrent = $(".anchor").attr("href");
    //            $("a[href='" + navActiveCurrent + "']").removeClass("anchor");
    //            $("#navbar li:last-child a").addClass("anchor");
    //        }
    //    }
    //  });
    
    

