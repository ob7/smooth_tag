$(function() {
    $('.selector').find('a[href*=#]:not([href=#])').click(function() {
        console.log("has length is " + this.hash.length);
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname && this.hash.length > 1 ) {
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
