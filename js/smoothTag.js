$(function() {
    var config = {}; // create config object to pass json results to
    $.ajax({
        dataType: "json", //return this ajax call as json object
        url: "/package/smoothtag/controller/config",
        success: function(result) {
            $.each(result, function(key,value) {
                config[key] = value; 
            });
            initiateSmoothTag();
        }
    });

    function initiateSmoothTag() {
        var smoothTagInclude = config['include'].replace(/\s\s+/g, ' ').replace(/[ ,]+/g, ","); //get list of classes and make sure string uses only one space for dilemeter, then convert space to comma to pass as parents to selector
        if (smoothTagInclude.length < 1 || !smoothTagInclude.replace(/\s/g, '').length) { // if include selectors is empty, set include to entire body
            smoothTagInclude = 'body';
        }
        var smoothTagExclude = config['exclude'].replace(/\s\s+/g, ' ').replace(/[ ,]+/g, ",").replace(/[.]+/g, "");

        // console.log(`include selectors are ${smoothTagInclude}`);
        // console.log(`exclude is ${smoothTagExclude}`);

        // extend jquery to pass multiple classes like with hasClass stackoverflow.com/a/16609223
        $.fn.extend({
            hasClasses: function( selector ) {
                var classNamesRegex = new RegExp("( " + selector.replace(/ +/g,"").replace(/,/g, " | ") + " )"),
                    rclass = /[\n\t\r]/g,
                    i = 0,
                    l = this.length;
                for ( ; i < l; i++ ) {
                    if ( this[i].nodeType === 1 && classNamesRegex.test((" " + this[i].className + " ").replace(rclass, " "))) {
                        return true;
                    }
                }
                return false;
            }
        });

        $(smoothTagInclude).find('a[href*=#]:not([href=#])').click(function() { // find anchor links within include selectors
            if ($(this).parents().hasClasses(smoothTagExclude)) { // traverse anchor links parent checking if its within an excluded class
                // this anchor link is within an excluded class
            } else {
                // this anchor link is not contained within an excluded class
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                    console.log("animate");
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                    var ww = window.innerWidth
                        || document.documentElement.clientWidth
                        || document.body.clientWidth;
                    if (target.length && ww >= 960) {
                        $('html,body').animate({
                            scrollTop: target.offset().top
                        }, 1000);
                        return false;
                    }
                }
            }
        });
    }
});
