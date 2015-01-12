			
showAllPassages = function() {
	$(".profrow_hidden").css("display","block");
	$("#show_or_hide").attr("src",root + "images/collapse.png");
	$("#show_or_hide").attr("title","collapse list");
	$("#show_or_hide_a").attr("href","javascript:hideAllPassages()");
	if ($(window).width() >= 992)
	{
		$("#map").css("display","none");
		$("#donate").css("display","none");
		$("#reclame").css("display","none");
	}
}

hideAllPassages = function() {
	$("#map").css("display","block");
	$("#donate").css("display","block");
	$("#reclame").css("display","block");
	$(".profrow_hidden").css("display","none");
	$("#show_or_hide").attr("src",root + "images/expand.png");
	$("#show_or_hide").attr("title","expand list");
	$("#show_or_hide_a").attr("href","javascript:showAllPassages()");
}
	
getPassages = function(colid) {
	$.ajax({
		url : root + "ajax/getpassages.php?colid=" + colid,
		//url : "{{ URL::asset('ajax/')}}/getpassages.php?colid=" + colid,
		data : "",
		dataType : 'json',
		success : function(data) {
			if (data.length > 0) {
			
				for(var i = 0; i < data.length; i++) {	
					var	race = ""; 
					var race_short = "";
				
					switch(parseInt(data[i].EventID)) {
						case 1: race = "Tour de France"; race_short = "Tour"; break;
						case 2: race = "Giro d'Italia"; race_short = "Giro"; break;
						case 3: race = "Vuelta a España"; race_short = "Vuelta"; break;
					}
					
					var person = data[i].Person;
					var person_class = "rider";
					var flag = true;
					if (data[i].Neutralized == "1") {person = "-neutralized-"; flag = false;}
					else if (data[i].Cancelled == "1") {person = "-cancelled-"; flag = false;}
					else if (data[i].NatioAbbr == "") {person = "-cancelled-"; flag = false;}
					
					if (person == null) {person = ""; flag = false;}
					
					var hidden = "profrow_hidden";
					if (i < 5) {hidden = "";}
					
					var html = '<div class="profrow ' + hidden + ' clearfix">';
					html += '<div class="year">' + data[i].Edition + '</div>';
					html += '<div class="race"><i>' + race + '</i></div>'; 
					html += '<div class="race_short" title="' + race + '"><i>' + race_short + '</i></div>'; 
					html += '<div class="rider">' + person + '</div>';
					if (flag == true) {
						html += "<div class='profcountry'><img src='" + root + "images/flags/small/" + data[i].NatioAbbr + ".gif' title='" + data[i].Natio + "'/></div>";
					}
					html += '</div>'; 
					
					$("#profrows").append(html);
				}
					
				if (data.length <= 5) {
					$("#show_or_hide_a").hide();
				}
				$("#profs").show();
			}
		}
	})
}
	
getColsNearby = function(colid) {
	$.ajax({
		//url : "{{ URL::asset('ajax/')}}/getcolsnearby.php?colid=" + colid,
		url : root + "ajax/getcolsnearby.php?colid=" + colid,
		data : "",
		dataType : 'json',
		success : function(data) {
			for(var i = 0; i < data.length; i++) {	
				var dis = parseInt(Math.round(parseFloat(data[i].Distance/1000)));
				var int_dir = parseInt(data[i].Direction); 
				var dir;
				
				if (int_dir <= 22) { dir = "South"; }
				else if (int_dir <= 67) { dir = "South-West"; }
				else if (int_dir <= 112) { dir = "West"; }
				else if (int_dir <= 157) { dir = "North-West"; }
				else if (int_dir <= 202) { dir = "North"; }
				else if (int_dir <= 247) { dir = "North-East"; }
				else if (int_dir <= 292) { dir = "East"; }
				else if (int_dir <= 337) { dir = "South-East"; }
				else { dir = "South"; }
			
				var html = '<div class="colsnearbyrow">';
				html += '<div class="colnearby_col"><a href="' + data[i].ColIDString + '">' + data[i].Col + '</a></div>';
				html += '<div class="colnearby_distance">' + dis + ' km</div>';				
				html += '<div class="colnearby_direction"><img src="' + root + 'images/' + dir + '.png"/></div>';				
				html += '</div>';
				
				$("#colsnearbyrows").append(html);
			}
		}
	})
}

getPrevNextCol = function(number) {
	$.ajax({
		url : root + "ajax/getprevnextcol.php?number=" + number,
		data : "",
		dataType : 'json',
		success : function(data) {
			var prevIDString;
			var prevCol;
			var nextIDString;
			var nextCol;
			for(var i = 0; i < data.length; i++) {	
				if (data[i].Number == number - 1) {
					prevIDString = data[i].ColIDString;
					prevCol = data[i].Col;
				}
				else if (data[i].Number == number + 1) {
					nextIDString = data[i].ColIDString;
					nextCol = data[i].Col;
				}
			}
			
			if (prevIDString) {
				$(".prevbutton").click(function() { location.href = prevIDString;} );
				$(".prevbutton").append(prevCol);
				$(".prevbutton").attr("title","Go to previous col (alphabetical): " + prevCol);
				$(".prevbutton").show();
			}
			
			if (nextIDString) {
				$(".nextbutton").click(function() { location.href = nextIDString;} );
				$(".nextbutton").append(nextCol);
				$(".nextbutton").attr("title","Go to next col (alphabetical): " + nextCol);
				$(".nextbutton").show();
			}
		}
	})
}

getTopStats = function(colid) {
	$.ajax({
		url : root + "ajax/gettopstats.php?colid=" + colid,
		data : "",
		dataType : 'json',
		success : function(data) {
			var statid = 0;
		
			for(var i = 0; i < data.length; i++) {
				if (statid != data[i].StatID) {
					var rankAdd = 'th';
					if (data[i].Rank == 1) rankAdd = 'st';
					if (data[i].Rank == 2) rankAdd = 'nd';
					if (data[i].Rank == 3) rankAdd = 'rd';
					var html = '<span class="glyphicon glyphicon-flash" aria-hidden="true"></span>' + data[i].Rank + rankAdd + ' of Europe';
					var el = $("#profile" + data[i].ProfileID).find(".stat_top_" + data[i].StatID);
					$(el).html(html);
					if (data[i].Rank <= 10) $(el).addClass("stat_top_bold");
					$(el).show();
				
					statid = data[i].StatID;
				}
			}
		}
	})
}