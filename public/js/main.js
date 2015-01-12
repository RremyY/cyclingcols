
//var homedir = "http://cyclingcols.rmjg.nl/"; 
var homedir = "http://localhost:8000/"; 
//var homedir = "http://localhost/laravel/public/";

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

/*sets the height of the new page wrapper so that it always fills the screen height*/
function calculatenewheight() {
    if ($('body').hasClass('newtemplate')) {
		var height = $(window).height() - $('.footer').height() - $('#new-canvas').offset().top;
	
		if ($('#new-canvas').height() < height)
		{
			$('#new-canvas').height(height);
		}
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
	calculatenewheight();

		/*if (windowwidth > 992) {
			$('#thecountries').hide(0).removeClass('activecountries').show(0);
		}
		else {
			$('#thecountries').hide(0);
		}*/
	
});


/*$(window).scroll(function() {
    var s = $(".rightinfo");
    //fixing the googlemaps column on the col page
    if (($('body').hasClass('coltemplate')) && ($(document).width() > 992)) {
     var windowpos = $(window).scrollTop();
     
     if (windowpos >= $(".rightposition").offset().top) {
     s.addClass("fixed");
     } else {
     s.removeClass("fixed");
     }
     }
     else if (($('body').hasClass('coltemplate')) && ($(document).width() < 992)) {
     s.removeClass("fixed");
     }
});*/

$(document).ready(function() {

    calculatemapheight();
	calculatenewheight();

    /*on keyboard enter press*/
    $(document).keypress(function(e) {
        if (e.which === 13) {
            var colstringid = $("#colid").val();
            if (colstringid !== "") {
                e.preventDefault();
                window.location.replace(homedir + "col/" + colstringid);
            }
        }
    });

    /*on search button click event*/
    $('#bloodhound .search').click(function(event) {
        event.preventDefault();
        var colstringid = $("#colid").val();
        if (colstringid !== "") {
            window.location.replace(homedir + "col/" + colstringid);
        }
    });

    /*select menu headeritem*/
    $(".tabrow li").removeClass("selectedtab"); //remove     
    $('.home .homemenu .tabrow a:nth-child(1) li').addClass("selectedtab");
    $('.newtemplate .tabrow a:nth-child(2) li').addClass("selectedtab");
    $('.statstemplate .tabrow a:nth-child(3) li').addClass("selectedtab");
    $('.helptemplate .tabrow a:nth-child(4) li').addClass("selectedtab");
    $('.abouttemplate .tabrow a:nth-child(5) li').addClass("selectedtab");

// constructs the suggestion engine
    var countries = new Bloodhound({
        datumTokenizer: function(d) {
            var test = Bloodhound.tokenizers.whitespace(d.colname);
            //alert(1);
            $.each(test, function(k, v) {
                i = 0;
                while ((i + 1) < v.length) {
                    test.push(v.substr(i, v.length));
                    i++;
                }
            });
            return test;
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 10,
        prefetch: {
            ttl: 1,
            url: homedir + 'ajax/getcolsforsearch.php'
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
        window.location.replace(homedir + "col/" + datum.colidstring);
    });

});

showInfo = function () {
    var id = "#div_" + $(this).find(".infotype").attr("id");
    $(id).css("opacity", "0.5");
    $(id).css("background", "green");

}

hideInfo = function () {
    var id = "#div_" + $(this).find(".infotype").attr("id");
    $(id).css("opacity", "1");
    $(id).css("background", "transparent");

}

showInfoType = function () {
    var id = "#" + $(this).attr("id").replace("div_", "");
    $(id).parent().css("color", "red");
    $(this).css("opacity", "0.5");
    $(this).css("background", "green");

}

hideInfoType = function () {
    var id = "#" + $(this).attr("id").replace("div_", "");;
    $(id).parent().css("color", "");
    $(this).css("opacity", "1");
    $(this).css("background", "transparent");
}

showTableProfile = function() {
	var id = $(this).attr("id");
	window.location.href = "../col/" + id;
}

$(document).ready(function () {
    $(".infotype_row").hover(showInfo, hideInfo);
    $(".info").hover(showInfoType, hideInfoType);
	$(".table_row").click(showTableProfile);
	$("#twitter").click(function() {window.location.href = "https://twitter.com/cyclingcols"; } );
	$(".profile_print").click(function() { 
		var title = $(this).parent().attr("id");
		printContent($(this).parent().parent(), title); 
	} );
})

printContent = function (el, title){
	var divContents = $(el).html();
	var printWindow = window.open('', '', 'height=400,width=800');
	printWindow.document.write('<html><head><title>' + title + '</title>');
	printWindow.document.write('<link rel="stylesheet" href="http://localhost:8000/css/bootstrap.min.css" type="text/css">');
	printWindow.document.write('<link rel="stylesheet" href="http://localhost:8000/css/main.css" type="text/css">');
	printWindow.document.write('</head><body>');
	//printWindow.document.write('<div>');
	printWindow.document.write(divContents);
	//printWindow.document.write('</div>');
	printWindow.document.write('</body></html>');
	//printWindow.document.write('<script>');
	//printWindow.document.write('$(document).ready(function() { window.print(); });');
	//printWindow.document.write('</script>');
	printWindow.document.close();
	printWindow.focus();
	
	setTimeout(function() { 
		printWindow.print(); 
		printWindow.close();
	}, 300)
}