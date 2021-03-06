@extends('layouts.master')

@section('title')
CyclingCols - Stats
@stop

@include('includes.functions')

@section('content')
<script type="text/javascript">	
	$(document).ready(function() {
		$(".stat_icon_header").removeClass("stat_icon_selected");
		$("#stat{{$statid}}").addClass("stat_icon_selected");
		
		$(".flag_header").removeClass("flag_selected");
		$("#flag{{$geoid}}").addClass("flag_selected");
	});

</script>

<?php
	
?>
<div id="stats-canvas" class="canvas col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="header">
        <h1>CyclingCols Stats</h1>
	</div>
	
	<div class="content">
		<!--<div class="table_header">Stat:</div>-->
		<div class="table_header clearfix">
			<div>
			Select Stat
			<a href="{{ URL::asset('/') . 'stats/0/'. $geoid}}"><img id="stat0" class="stat_icon_header" src="{{URL::asset('images/stat_all.png')}}" title="Summary of all stats" /></a>
			<a href="{{ URL::asset('/') . 'stats/1/'. $geoid}}"><img id="stat1" class="stat_icon_header" src="{{URL::asset('images/' . statNameShort(1) . '.png')}}" title="{{statName(1)}}" /></a>
			<a href="{{ URL::asset('/') . 'stats/2/'. $geoid}}"><img id="stat2" class="stat_icon_header" src="{{URL::asset('images/' . statNameShort(2) . '.png')}}" title="{{statName(2)}}" /></a>
			<a href="{{ URL::asset('/') . 'stats/3/'. $geoid}}"><img id="stat3" class="stat_icon_header" src="{{URL::asset('images/' . statNameShort(3) . '.png')}}" title="{{statName(3)}}" /></a>
			<a href="{{ URL::asset('/') . 'stats/4/'. $geoid}}"><img id="stat4" class="stat_icon_header" src="{{URL::asset('images/' . statNameShort(4) . '.png')}}" title="{{statName(4)}}" /></a>
			<a href="{{ URL::asset('/') . 'stats/5/'. $geoid}}"><img id="stat5" class="stat_icon_header" src="{{URL::asset('images/' . statNameShort(5) . '.png')}}" title="{{statName(5)}}" /></a>
			</div>
			<div>
			Select Country
			<a href="{{ URL::asset('/') . 'stats/' . $statid .'/0'}}"><img id="flag0" class="flag_header" src="{{URL::asset('images/flags/Europe.gif')}}" title="Europe" /></a>
			<a href="{{ URL::asset('/') . 'stats/' . $statid .'/2'}}"><img id="flag2" class="flag_header" src="{{URL::asset('images/flags/Andorra.gif')}}" title="Andorra" /></a>
			<a href="{{ URL::asset('/') . 'stats/' . $statid .'/3'}}"><img id="flag3" class="flag_header" src="{{URL::asset('images/flags/Austria.gif')}}" title="Austria" /></a>
			<a href="{{ URL::asset('/') . 'stats/' . $statid .'/4'}}"><img id="flag4" class="flag_header" src="{{URL::asset('images/flags/France.gif')}}" title="France" /></a>
			<a href="{{ URL::asset('/') . 'stats/' . $statid .'/5'}}"><img id="flag5" class="flag_header" src="{{URL::asset('images/flags/Italy.gif')}}" title="Italy" /></a>
			<a href="{{ URL::asset('/') . 'stats/' . $statid .'/6383'}}"><img id="flag6383" class="flag_header" src="{{URL::asset('images/flags/Norway.gif')}}" title="Norway" /></a>
			<a href="{{ URL::asset('/') . 'stats/' . $statid .'/6'}}"><img id="flag6" class="flag_header" src="{{URL::asset('images/flags/Slovenia.gif')}}" title="Slovenia" /></a>
			<a href="{{ URL::asset('/') . 'stats/' . $statid .'/7'}}"><img id="flag7" class="flag_header" src="{{URL::asset('images/flags/Spain.gif')}}" title="Spain" /></a>
			<a href="{{ URL::asset('/') . 'stats/' . $statid .'/8'}}"><img id="flag8" class="flag_header" src="{{URL::asset('images/flags/Switzerland.gif')}}" title="Switzerland" /></a>
			</div>
		</div>
		<div class="table_table clearfix">
<?php		
$statid_ = 0;
$statcount = 0;
$rowcount = $stats->count();

foreach($stats as $stat) {

	if ($statid > 0) {
		if ($statcount == 0) {
			?>			
				<div class="table_table_wrapper col-xs-12 col-sm-12 col-md-6">
					<table>
						<tbody>		
						<tr><td class="table_subheader" colspan="5">
							<a href="{{ URL::asset('/') . 'stats/' . $stat->StatID . '/' . $geoid}}">
							<img class="stat_icon" src="{{URL::asset('images/' . statNameShort($stat->StatID) . '.png')}}" />
							Largest {{statName($stat->StatID)}}
							</a>
						</td></tr>	
			<?php	
		}
		
		if ($statcount >= $rowcount / 2) {
			$statcount = 0;
			?>	
					</tbody>
				</table>
				</div>
				<div class="table_table_wrapper col-xs-12 col-sm-12 col-md-6">
				<table>
					<tbody>		
					<tr><td class="table_subheader hidden-xs hidden-sm" colspan="5">&nbsp;</td></tr>	
		<?php
		}
			
		$statcount++;
	}
	else if ($stat->StatID != $statid_) {
		if ($statcount > 2 || $statid_ == 0) {
			$statcount = 0;
			if ($statid_ != 0) {
			?>	
					</tbody>
				</table>
				</div>
			<?php	
			}
			?>			
				<div class="table_table_wrapper col-xs-12 col-sm-12 col-md-6">
				<table>
					<tbody>		
		<?php
		}
		?>
					<tr><td class="table_subheader" colspan="5">
						<a href="{{ URL::asset('/') . 'stats/' . $stat->StatID . '/' . $geoid}}">
						<img class="stat_icon" src="{{URL::asset('images/' . statNameShort($stat->StatID) . '.png')}}" />
						Largest {{statName($stat->StatID)}}
						</a>
					</td></tr>		
		<?php	
		$statid_ = $stat->StatID;
		$statcount++;
	}
?>
					<tr id="{{$stat->ColIDString}}#profile{{$stat->ProfileID}}" class="table_row">
						<td class="table_rank">{{$stat->Rank}}</td>
						<td class="table_col">{{$stat->Col}}</td>
						<td class="table_country">
							<img src="{{ URL::asset('images/flags/' . $stat->Country1 . '.gif') }}" title="{{$stat->Country1}}" />
@if ($stat->Country2)
							<img src="{{ URL::asset('images/flags/' . $stat->Country2 . '.gif') }}" title="{{$stat->Country2}}" />
@endif
						</td>
						<td class="table_value">{{formatStat($stat->StatID,$stat->Value)}}</td>
						
@if ($stat->SideID > 0)
						<td class="table_side">
							<img src="{{URL::asset('images/')}}/{{$stat->Side}}.png")}}' title='{{$stat->Side}}'/>
							<span>{{$stat->Side}}</span>
						</td>
@else
						<td>&nbsp;</td>	
@endif				
					</tr>
<?php		
		}		
?>
				</tbody>
			</table>
			</div>
		</div>
    </div>
</div>
@stop
