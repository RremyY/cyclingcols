
//
function countryclick(country) {
    windowwidth = $(document).width();
    if (windowwidth < 992) {
        $('#thecountries').removeClass('activecountries').hide(500);
    }
    $('#searchbox').attr("placeholder", "Search a col in " + country + "..").focus();

    //todo: change dataset for in slideshow.
    return false;
}



$(function() {
    $('#countrytab').on('click', function(e) {
        $("li").removeClass("selectedtab");
        $(this).parent().addClass("selectedtab");
        $('#thecountries').show(0).addClass('activecountries');
        return false;//Returning false prevents the event from continuing up the chain
    });


    $(window).load(function() {
        $(".footermenu li").removeClass("selectedtab");
        $('.home .footermenu li:nth-child(1)').addClass("selectedtab");
        $('.randomtemplate .footermenu li:nth-child(2)').addClass("selectedtab");
        $('.helptemplate .footermenu li:nth-child(3)').addClass("selectedtab");
        $('.abouttemplate .footermenu li:nth-child(4)').addClass("selectedtab");

        $(".smallfooter li").removeClass("selectedtab");
        $('.home .smallfooter li:nth-child(1)').addClass("selectedtab");
        $('.helptemplate .smallfooter li:nth-child(3)').addClass("selectedtab");
        $('.abouttemplate .smallfooter li:nth-child(4)').addClass("selectedtab");
    });
});

$(window).resize(function() {
    windowwidth = $(document).width();
    if (windowwidth > 992) {
        $('#thecountries').hide(0).removeClass('activecountries').show(500);
    }
    else {
        $('#thecountries').hide(0);
    }
});

$(document).ready(function() {

    //fixing the googlemaps column on the 
    if (($('body').hasClass('coltemplate')) && ($(document).width() > 992)) {
        var s = $(".rightinfo");
        var pos = s.offset();
        console.log(pos);
        $(window).scroll(function() {
            var windowpos = $(window).scrollTop();

            if (windowpos >= pos.top) {
                s.addClass("fixed");
            } else {
                s.removeClass("fixed");
            }
        });
    }
    
    //searchsuggestion home only.
    if ( $('body').hasClass('home')) {
        
    
    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substrRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    // the typeahead jQuery plugin expects suggestions to a
                    // JavaScript object, refer to typeahead docs for more info
                    matches.push({value: str});
                }
            });

            cb(matches);
        };
    };

    var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
        'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
        'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
        'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
        'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
        'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
        'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
        'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
        'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
    ];

    $('.typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'states',
        displayKey: 'value',
        source: substringMatcher(states)
    });
    }
});