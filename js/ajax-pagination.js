/* Ajax pagination
=====================================*/

var i = 0;
function buttonClick() {
    document.getElementById('load-more').data = ++i;
}

(function($) {

    function cb () {
                    
    }

    $("#load-more").click( function( event ){ 

        event.preventDefault();
        
        buttonClick();

        $(this).addClass("faded");

        var currentPage = document.getElementById('load-more').data+1;
        var maxPage = document.getElementById('load-more').getAttribute('data-max');

        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: 'post',
            data: {
                action: 'ajax_pagination',
                query_vars: ajaxpagination.query_vars,
                page: currentPage
            },
            success: function( result ) {
                //append the 
                $("#posts").append( result );

                //recalculate equalizer
                new Foundation.Equalizer(  $(".posts-wrap") ).applyHeight();

                //remove fade
                if ( $("#load-more").hasClass("faded") ) {
                    $("#load-more").removeClass("faded");
                }

                //hide button
                if ( currentPage == maxPage ) {
                    $("#load-more").remove();
                }

            }
        })

    });

})(jQuery);

