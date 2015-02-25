
//var homedir = "http://cyclingcols.rmjg.nl/"; 
//var homedir = "http://localhost:8000/"; 
//var homedir = "http://localhost/laravel/public/";
var homedir = "http://" + document.location.host + "/";

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

/*sets the height of the stats page wrapper so that it always fills the screen height*/
function calculatestatsheight() {
    if ($('body').hasClass('statstemplate')) {
		var height = $(window).height() - $('.footer').height() - $('#stats-canvas').offset().top;
	
		if ($('#stats-canvas').height() < height)
		{
			$('#stats-canvas').height(height);
		}
    }
}

function calculateprofilemaxwidth() {
    if ($('body').hasClass('coltemplate')) {
		$(".profileimage").each(function(){
			$(this).css('max-width',$(this).parent().parent().width() - 135);
			$(this).find("img").css('max-width',$(this).parent().parent().width() - 135);
		});
    }
}

$(window).resize(function() {
	//calculatephotogridheight();
	calculatemapheight();
	calculatenewheight();
	calculatestatsheight();
	calculateprofilemaxwidth();
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
	calculatestatsheight();
	calculateprofilemaxwidth();
	
	setTimeout(function(){
		$(".reclame_close").on("click",function(){
			$(this).prev().remove();
			$(this).remove();
		});
		
		$(".reclame_close").css("opacity","1.0");
	},5000);
	
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
    /*$('#bloodhound .search').click(function(event) {
        event.preventDefault();
        var colstringid = $("#colid").val();
        if (colstringid !== "") {
            window.location.replace(homedir + "col/" + colstringid);
        }
    });*/

    /*select menu headeritem*/
    $(".menuitem").removeClass("selectedtab"); //remove     
    $('.home #menuleft a:nth-child(2) .menuitem').addClass("selectedtab");
	$('.newtemplate #menuleft a:nth-child(3) .menuitem').addClass("selectedtab");
    $('.statstemplate #menuleft a:nth-child(4) .menuitem').addClass("selectedtab");
    $('.helptemplate #menuleft a:nth-child(5) .menuitem').addClass("selectedtab");
    $('.abouttemplate #menuleft a:nth-child(6) .menuitem').addClass("selectedtab");

	//autocomplete
	$(function() {
		var accentMap = {
			"Š": "S",
			"Œ": "OE",
			"Ž": "Z",
			"š": "s",
			"œ": "oe",
			"ž": "z",
			"Ÿ": "Y",
			"Š": "S",
			"À": "A","Á": "A","Â": "A","Ã": "A","Ä": "A","Å": "A",
			"Æ": "AE",
			"Ç": "C",
			"È": "E","É": "E","Ê": "E","Ë": "E",
			"Ì": "I","Í": "I","Î": "I","Ï": "I",
			"Ð": "D",
			"Ñ": "N",
			"Ò": "O","Ó": "O","Ô": "O","Õ": "O","Ö": "O","Ø": "O",
			"Ù": "U","Ú": "U","Û": "U","Ü": "U",
			"Ý": "Y",
			"Þ": "p",
			"ß": "ss",
			"à": "a","á": "a","â": "a","ã": "a","ä": "a","å": "a",
			"æ": "ae",
			"ç": "c",
			"è": "e","é": "e","ê": "e","ë": "e",
			"ì": "i","í": "i","î": "i","ï": "i",
			"ð": "d",
			"ñ": "n",
			"ò": "o","ó": "o","ô": "o","õ": "o","ö": "o","ø": "o",
			"ù": "u","ú": "u","û": "u","ü": "u",
			"ý": "y",
			"-": " ",
			" ": "-"			
		};
		
		var searchCount;
	  
		var normalize = function( term ) {
			var ret = "";
			for ( var i = 0; i < term.length; i++ ) {
				ret += accentMap[ term.charAt(i) ] || term.charAt(i);
			}
			return ret;
		};
		
		$.getJSON( homedir + "ajax/getcolsforsearch.php", function( data ) {
			
			$( "#searchbox" ).autocomplete({
				minLength: 2,
				delay: 300,
				source: function( request, response ) {
					var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
					var res = $.grep( data, function( value ) {
						value = value.label || value.value || value;
						return matcher.test( value ) || matcher.test( normalize( value ) );
					})
					
					searchCount = res.length;
					
					response(res.slice(0,10));
				},
				select: function( event, ui ) {		
					$("#searchstatus").hide();
					$( "#searchbox" ).val( ui.item.label );
					window.location.replace(homedir + "col/" + ui.item.ColIDString);
		 
					return false;
				},
				response: function(event, ui) {
					$("#searchstatus").hide();
					
					if (ui.content.length === 0) {
						$("#searchstatus").text("No cols found.");
					} else {
						$("#searchstatus").text(searchCount + " cols found" + (searchCount > 10 ? ", showing first 10" : "") + ".");
						$("#searchstatus").show();
					}
					$("#searchstatus").show();
					
					//ui.content = ui.content.slice(0,10);
				},
				open: function() {
					$(".ui-autocomplete").css("top","+=26");
				},
				close: function(){
					if ($("#searchbox").val().length <= 2) {
						$("#searchstatus").hide();
					}
				}
			})
			.autocomplete( "instance" )._renderItem = function( ul, item ) {
				var html = "<a><img class=\"searchitemflag\" src=\"/images/flags/" + item.Country1 + ".gif\"/>";
				if (item.Country2){
					html += "<img class=\"searchitemflag\" src=\"/images/flags/" + item.Country2 + ".gif\"/>";
				}
				html += item.label + "<span class=\"searchitemheight\">" + item.Height + "m</span></a>";
				return $( "<li>" )
					.append(html)
					.appendTo( ul );
			};
		});
	});

// constructs the suggestion engine
    /*var countries = new Bloodhound({
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
    });*/

});

/*help page*/
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
	window.location.href = homedir + "col/" + id;
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
	 
	$(document).on("focusout","#searchbox",function(){
		$("#searchstatus").hide();
	});
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