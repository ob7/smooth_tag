$(function() {
    console.log("SMOOTH TAG LOADED");
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname && this.hash.length > 2 ) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            var ww = window.innerWidth
                || document.documentElement.clientWidth
                || document.body.clientWidth;
            var windowLocation = this.hostname;
            var pageName = this.pathname;
            var targetHash = $(this).attr("href");
            var fullURL = ('http://' + windowLocation + pageName + targetHash);
            if (target.length && ww >= 960) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});
