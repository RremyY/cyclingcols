
//var homedir = "http://localhost:8000/"; 
var homedir = "http://localhost/laravel/public/";

//country selection was removed
/*function countryclick(country) {
    windowwidth = $(document).width();
    if (windowwidth < 992) {
        $('#thecountries').removeClass('activecountries').hide(500);
    }
    $('#searchbox').attr("placeholder", "Search a col in " + country + "...").focus();

    //todo: change dataset for in slideshow.
    return false;
}*/

/*sets the height of the map-canvas so that it always fills the screen height*/
function calculatemapheight() {
    if ($('body').hasClass('mappage')) {
        $('#map-canvas').height(($('.footer').offset().top) - ($('#map-canvas').offset().top));
    }
}

/*
$(function() {
    $('#countrytab').on('click', function(e) {
        $("li").removeClass("selectedtab");
        $(this).parent().addClass("selectedtab");
        $('#thecountries').show(0).addClass('activecountries');
        return false;//Returning false prevents the event from continuing up the chain
    });


    $(window).load(function() {
        
    });
});
*/

$(window).resize(function() {
    calculatemapheight();
    windowwidth = $(document).width();
    if (windowwidth > 992) {
        $('#thecountries').hide(0).removeClass('activecountries').show(0);
    }
    else {
        $('#thecountries').hide(0);
    }
});


$(window).scroll(function() {
    var s = $(".rightinfo");
    //fixing the googlemaps column on the col page
    /*if (($('body').hasClass('coltemplate')) && ($(document).width() > 992)) {
        var windowpos = $(window).scrollTop();

        if (windowpos >= $(".rightposition").offset().top) {
            s.addClass("fixed");
        } else {
            s.removeClass("fixed");
        }
    }
    else if (($('body').hasClass('coltemplate')) && ($(document).width() < 992)) {
        s.removeClass("fixed");
    }*/
});

$(document).ready(function() {
    
    calculatemapheight();    
    
    /*on keyboard enter press*/
    $(document).keypress(function(e) {
        if(e.which === 13) {
            var colstringid = $("#colid").val();
            if(colstringid !== ""){
                e.preventDefault();
                window.location.replace(homedir + "col/" + colstringid);
            }
        }
    });
    
    /*on search button click event*/
    $('#bloodhound .search').click(function(event) {
        event.preventDefault();
        var colstringid = $("#colid").val();
        if(colstringid !== ""){
            window.location.replace(homedir + "col/" + colstringid);
        }
    });
    
    /*select menu headeritem*/
    $(".tabrow li").removeClass("selectedtab"); //remove     
    $('.home .homemenu .tabrow a:nth-child(1) li').addClass("selectedtab");
    $('.randomtemplate .tabrow a:nth-child(2) li').addClass("selectedtab");
    $('.helptemplate .tabrow a:nth-child(3) li').addClass("selectedtab");
    $('.abouttemplate .tabrow a:nth-child(4) li').addClass("selectedtab");

// constructs the suggestion engine
var countries = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('colname'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  // `states` is an array of state names defined in "The Basics"
  //local: $.map(states, function(state) { return { value: state }; })
  limit:10,
  prefetch: {
      url: homedir +'ajax/getcolsforsearch.php'
    // the json file contains an array of strings, but the Bloodhound
    // suggestion engine expects JavaScript objects so this converts all of
    // those strings
      /*filter: function(list) {
        return $.map(list, function(country) {
            //country = country.replace('-', ' ');
            return { name: country }; 
        });
    }*/
  }
});
 
// kicks off the loading/processing of `local` and `prefetch`
countries.initialize();

 // passing in `null` for the `options` arguments will result in the default
// options being used
$('#bloodhound .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
  },
  {
  name: 'countries',
  displayKey: 'colname',
  // `ttAdapter` wraps the suggestion engine in an adapter that
  // is compatible with the typeahead jQuery plugin
  source: countries.ttAdapter()
}).bind("typeahead:selected", function(obj, datum, name) {
    $("#colid").val(datum.colidstring);
    //console.log(datum);
});

});