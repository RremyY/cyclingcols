@extends('layouts.master')

@section('title')
CyclingCols - Help
@stop

@section('content')
<div clas="canvas col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="header">

        <h1>CyclingCols Help</h1>
	</div>
	
	
	<div class="content">
		<div class="profileinfo_header">A CyclingCols altitude profile can contain the following information:</div>
		<div class="profileinfo col-md-6">
			<table>
				<tbody>
					<tr>
						<td class="info_header" colspan="2">Header</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_side" class="infotype" valign="top">Profile side</td>
						<td class="infoexplained">Indicative direction of the route from start to summit.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_start" class="infotype" valign="top">Start location</td>
						<td class="infoexplained">Geo location where profile route starts.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_category" class="infotype" valign="top">Category</td>
						<td class="infoexplained">All profiles have been categorized on difficulty from category 1 (easy) to category 5 (very difficult).</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_stat_d" class="infotype" valign="top">Distance statistic</td>
						<td class="infoexplained">Total distance from start to summit in kilometers.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_stat_h" class="infotype" valign="top">Altitude gain statistic</td>
						<td class="infoexplained">Total number of meters to climb from start to summit<span class="footnote">1</span>.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_stat_avg" class="infotype" valign="top">Average slope statistic</td>
						<td class="infoexplained">Average slope of the whole climb.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_stat_max" class="infotype" valign="top">Maximum slope statistic</td>
						<td class="infoexplained">Maximum slope within the whole climb for a minimum road distance of 100m.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_stat_idx" class="infotype" valign="top">Profile index statistic</td>
						<td class="infoexplained">Global index indicating the difficulty of the climb. Calculated as the summed squares of the slopes of all 1 k sections.</td>
					</tr>
					<tr>
						<td class="info_header" colspan="2">Profile</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_height" class="infotype" valign="top">Altitudes</td>
						<td class="infoexplained">Start and end heights of each section<span class="footnote">2</span> are shown.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_slope" class="infotype" valign="top">Slopes</td>
						<td class="infoexplained">Average slope for each section<span class="footnote">2</span>. The slope is indicated by the color of the underlying section.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_distance" class="infotype" valign="top">Distance towards top</td>
						<td class="infoexplained">Distance towards top in kilometers.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_geo" class="infotype" valign="top">Geo information</td>
						<td class="infoexplained">Villages, road junctions and other remarkables on the route.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_tunnel" class="infotype" valign="top">Tunnels</td>
						<td class="infoexplained">Consecutive short tunnels can be denoted by a single tunnel icon. Not all profiles have yet been provided with tunnel icons.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_hairpin" class="infotype" valign="top">Hairpin curves</td>
						<td class="infoexplained">Only some hairpin curves are depicted in the profile. Characteristic ones or just to be able to locate within sections with rare geo information.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_steep" class="infotype" valign="top">Steep sections</td>
						<td class="infoexplained">Sections of minimum 200m length which are significantly steeper than the average of their covering section.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_steepest" class="infotype" valign="top">Steepest 5k, 1k, 200m sections</td>
						<td class="infoexplained">Banners locating the steepest 5k, 1k and 200m section within the whole climb.</td>
					</tr>
					<tr class="infotype_row">
						<td id="info_summary" class="infotype" valign="top">Total distance + average slope summary</td>
						<td class="infoexplained">Summary box showing the total distance and average slope of the entire climb.</td>
					</tr>
				</tbody>	
			</table>
			<p/>
			<div id="footnotes">
				<span class="footnote">1</span> Total height difference will be bigger than height difference between start and summit in case of descends within the route.<br/>
				<span class="footnote">2</span> Most profiles have 1 k sections, some more detailed profiles have shorter sections (<a href='{{URL::asset("col/Covadonga#profile1074")}}'>500m</a> or <a href='{{URL::asset("col/Cipressa#profile4671")}}'>200m</a>).
			</div>
		</div> 
		
		<div class="profileexample col-md-6">
			<img src="{{ URL::asset('images/HelpProfile.png') }}"/>
			<div id="div_info_side" class="info"></div>
			<div id="div_info_start" class="info"></div>
			<div id="div_info_category" class="info"></div>
			<div id="div_info_stat_d" class="info"></div>
			<div id="div_info_stat_h" class="info"></div>
			<div id="div_info_stat_avg" class="info"></div>
			<div id="div_info_stat_max" class="info"></div>
			<div id="div_info_stat_idx" class="info"></div>
			<div id="div_info_height" class="info"></div>
			<div id="div_info_slope" class="info"></div>
			<div id="div_info_distance" class="info"></div>
			<div id="div_info_geo" class="info"></div>
			<div id="div_info_tunnel" class="info"></div>
			<div id="div_info_hairpin" class="info"></div>
			<div id="div_info_steep" class="info"></div>
			<div id="div_info_steepest" class="info"></div>
			<div id="div_info_summary" class="info"></div>
			
		</div> 
    </div>
</div>
@stop
