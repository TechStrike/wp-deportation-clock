(function($) {

// DeportationClock.js
// updated 2013Jan17
// Mike Vattuone, Josh Levinger, Citizen Engagement Lab

//globals
var avgDeportationsPerYear = 395089;
//source http://www.dhs.gov/sites/default/files/publications/immigration-statistics/enforcement_ar_2011.pdf
//table 5, avg of 2011, 2010, 2009 totals
var rateOfDeportation = avgDeportationsPerYear/(365*24*60*60*1000); //number of deportations per millisecond
var pulse = ['.',''];
var pulse_count = 0;

function currentDeportations() {
    var now = new Date();
    var startObamaAdmin = new Date('Sun Jan 18 2009 12:00:00 GMT-0500 (EST)');
    var elapsedTime = now - startObamaAdmin; //in MS
    return Math.floor(elapsedTime * rateOfDeportation);
}

function updateCounter() {
    var counterVal = $("#flipcounter").flipCounter('getNumber');
    var currentVal = currentDeportations();
    //var currentVal = counterVal + 1; //testing
    if (counterVal !== currentVal) {
        $("#flipcounter").flipCounter('setNumber',currentVal);
    }
    //pulse the dot at the end of the sentence
    $('#pulse span').html(pulse[pulse_count%pulse.length]);
    pulse_count++;
}

function setupFlipCounter(value) {
    var flip = $("#flipcounter");

    flip.flipCounter({
        imagePath: flip.attr("data-flipcounterimgpath"), //WP2.9 uses jQuery-1.3.2, no $.data()
        digitHeight: 40,
        digitWidth: 30, 
        numFractionalDigits:0, // number of places right of the decimal point to maintain
        easing: jQuery.easing.easeOutQuint, //so it slows way down at the end
        formatNumberOptions:{format:"##,###,###.",locale:"us"},
        onAnimationStopped: function() {
            //fade in
            $('#counter div.fade-in').fadeIn();
            $('#counter #pulse').delay(1500).fadeIn(); //jQuery 1.3.2, no delay()
            setInterval(updateCounter, 1000);
        }
    });
    $("#flipcounter").flipCounter(
        'startAnimation', {
            number: 1000000,
            end_number:value,
            duration:10000
    });

}

//init
setupFlipCounter(currentDeportations());

//log the ask
console.log('{"FTW" : "git@github.com:TechStrike"}');

})(jQuery);






