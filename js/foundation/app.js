
(function( $ ) {

    /*
    orion menu
    */

    jQuery.fn.orion = function(options){
        var settings = {
            speed               : 500,                  // dropdown speed (ms)
            animation           : "fade",             // dropdown animation
            indicator           : true                  // dropdown indicator
        }
        $.extend( settings, options );
        var menu = $(".forest-menu");
        var lastScreenWidth = window.innerWidth;
        $(menu).prepend("<li class='showhide'><span class='title'>MENU</span><span class='icon'><em></em><em></em><em></em></span></li>");
        
        if(settings.indicator == true){
            $(menu).find("li").each(function(){
                if($(this).children("ul").length > 0){
                    $(this).append("<span class='indicator'></span>");
                }
            });
        }
        
        detectScreen();
        
        $(window).resize(function() {
            if(lastScreenWidth <= 1024 && window.innerWidth > 1024){
                unbindEvents();
                hideCollapse();
                bindHover();
            }
            if(lastScreenWidth > 1024 && window.innerWidth <= 1024){
                unbindEvents();
                showCollapse();
                bindClick();
            }
            lastScreenWidth = window.innerWidth;
        });
        
        function detectScreen(){
            if(window.innerWidth <= 1024){
                showCollapse();
                bindClick();
            }
            else{
                hideCollapse();
                bindHover();
            }
        }
        function bindHover(){
            if (navigator.userAgent.match(/Mobi/i) || window.navigator.msMaxTouchPoints > 0){                       
                $(menu).find("a").on("click touchstart", function(e){
                    e.stopPropagation(); 
                    e.preventDefault();
                    $(this).parent("li").siblings("li").find("ul").stop(true, true).fadeOut(settings.speed);
                    if($(this).siblings("ul").css("display") == "none"){
                        $(this).siblings("ul").stop(true, true).fadeIn(settings.speed).addClass(settings.animation);
                        return false; 
                    }
                    else{
                        $(this).siblings("ul").stop(true, true).fadeOut(settings.speed).removeClass(settings.animation);
                        $(this).siblings("ul").find("ul").stop(true, true).fadeOut(settings.speed).removeClass(settings.animation);
                    }
                    window.location.href = $(this).attr("href");
                });
                
                $(document).bind("click.menu touchstart.menu", function(ev){
                    if($(ev.target).closest(menu).length == 0){
                        $(menu).find("ul").fadeOut(settings.speed);
                    }
                });
            } /*else{
                //full screen controll removed
                $(menu).find("li").bind("mouseenter", function(){
                    $(this).children("ul").stop(true, true).fadeIn(settings.speed).addClass(settings.animation);
                }).bind("mouseleave", function(){
                    $(this).children("ul").stop(true, true).fadeOut(settings.speed).removeClass(settings.animation);
                });
            }*/
        }

        function bindClick(){ 
            $(menu).find("li:not(.showhide)").each(function(){ 
                if($(this).children("ul").length > 0){
                    $(this).children(".indicator").on("click", function(){
                        if($(this).siblings("ul").css("display") == "none"){
                            $(this).siblings("ul").slideDown(settings.speed).addClass(settings.animation).addClass("showing");
                            $(this).parent("li").siblings("li").find("ul").stop(true, true).slideUp(settings.speed);
                            return false; 
                        } 
                        else{ 
                            $(this).siblings("ul").slideUp(settings.speed).removeClass(settings.animation).removeClass("showing"); 
                        } 
                    }); 
                } 
            }); 
        }
        
        
        function showCollapse(){
            $(menu).children("li:not(.showhide)").hide(0);
            $(menu).children("li.showhide").show(0).bind("click", function(){
                if($(menu).children("li").is(":hidden")){
                    $(menu).children("li").slideDown(settings.speed);
                }
                else{
                    $(menu).children("li:not(.showhide)").slideUp(settings.speed);
                    $(menu).find("ul").hide(settings.speed);
                    $(menu).children("li.showhide").show(0);
                }
            });
        }
        function hideCollapse(){
            $(menu).children("li").show(0);
            $(menu).children("li.showhide").hide(0);
        }
        function unbindEvents(){
            $(menu).find("li, a").unbind();
            $(document).unbind("click.menu touchstart.menu");
            $(menu).find("ul").hide(0);
        }
    }




    jQuery(document).ready( function() {
        
        //fire up foundation
        jQuery('html').foundation();       
        
    });

    //detect if body has scrolled class and add it if not
    function addBodyClass() {
        
        if ( !$('body').hasClass('scrolled')){

            $('body').addClass('scrolled');

        }

    }

    //remove body class
    function removeBodyClass() {
        
        if ($('body').hasClass('scrolled')){

            $('body').removeClass('scrolled');

        }

    }

    function detectmob() {
       if(window.innerWidth <= 768 ) {
         return true;
       } else {
         return false;
       }
    }

    //completely initiate and restroy fullpage plugin 
    function InitFUllpage() {
         
        if ( detectmob()==false ) {

            if ( $("#fullpage").height() > 0 && !$("html").hasClass("fp-enabled") ) {
                var anchorArray;
                if ( $(".home").height() > 0 ) {
                    anchorArray = ["Home_slider", "What_we_do", "Video", "Testimonials", "Blog"];
                } else {
                    anchorArray = ["Section1", "Section2", "Section3", "Section4", "Section5"];
                }
                    
                    jQuery('#fullpage').fullpage({
                        normalScrollElements: '.scrollable-element',
                        anchors: anchorArray,
                        navigation: true,
                        navigationPosition: 'right',
                        onLeave: function(anchorLink, index){
                            // fist section loaded
                            if(index > 1){

                                addBodyClass();

                            } else {

                                removeBodyClass();

                            }
                        }
                    });

            }

        } else {

            //remove full page functionality
            if ( $("html").hasClass("fp-enabled") ) {
                $.fn.fullpage.destroy('all');
            }
            
        }
    }

    jQuery(document).ready( function() { 
        
        //fire up the menu
        jQuery().orion();

        //click functionality
        $(".forest-menu .indicator").click(function(){
              
            if ( $(".forest-menu > ul > .menu-item-has-children").hasClass("showing-ul") ) {
                //exclude this element
                var myParent = $(this).closest(".mobile-menu > ul > .menu-item-has-children");
                $(".forest-menu > ul > .menu-item-has-children").not(myParent).removeClass("showing-ul").children(".sub-menu").slideUp();
            }

            //show signling
            if ( $(this).parent().hasClass("showing-ul") )  {
                $(this).siblings(".sub-menu").slideUp();
                $(this).parent().removeClass("showing-ul");
            } else {
                //
                $(this).siblings(".sub-menu").slideDown();
                $(this).parent().addClass("showing-ul");
            }       

        });

        //initiate full page
        InitFUllpage(); 
    });

    $(window).on( "resize", function() { InitFUllpage(); });

    //show or hide the top menu
    $(window).on( "scroll load", function() {

        //header is fixed
        if ($(window).scrollTop() >= 1 ) {
          
            addBodyClass();          
                                                                      
        //reverse it back    
        } else if ($(window).scrollTop() < 220){
                    
            removeBodyClass();
     
        }

        //show the back arrow
        if ($(this).scrollTop() > 500) {
            $('#back-top').addClass("visible");
        } else {
            $('#back-top').removeClass("visible");
        }
            
    });

    //Check to see if the window is top if not then display button

    $("#back-top").click( function(){ 
        //sections
        if ( $("html").hasClass("fp-enabled") ) {
            $.fn.fullpage.moveSectionUp();
        //regular page    
        } else {
            $('html, body').animate({scrollTop : 0},500);
            return false;
        }
    });

})(jQuery);
