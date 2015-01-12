@extends('layouts.master')

@include('includes.functions')

@section('content')
<div id="new-canvas" class="col-xs-12">
    <div class="header">
        <h1>CyclingCols Stats</h1>
	</div>
	
	
	<div class="content">
		<!--<div class="table_header">Stat:</div>-->
		<div class="table_header"></div>
		<div class="table_table">
<?php		
$statid = 0;
$statcount = 0;
$rowcount = $stats->count();

foreach($stats as $stat) {

	if ($singlestat) {
		if ($statcount == 0) {
			?>			
				<div class="table_table_wrapper col-xs-12 col-sm-12 col-md-6">
					<table>
						<tbody>		
						<tr><td class="table_subheader" colspan="5"><a href="{{ URL::asset('/') . 'stats/' . $stat->StatID}}">
							<img class="stat_icon" src="{{URL::asset('images/' . statNameShort($stat->StatID) . '.png')}}" />
							Largest {{statName($stat->StatID)}}
						</a></td></tr>	
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
	else if ($stat->StatID != $statid) {
		if ($statcount > 2 || $statid == 0) {
			$statcount = 0;
			if ($statid != 0) {
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
					<tr><td class="table_subheader" colspan="5"><a href="{{ URL::asset('/') . 'stats/' . $stat->StatID}}">
						<img class="stat_icon" src="{{URL::asset('images/' . statNameShort($stat->StatID) . '.png')}}" />
						Largest {{statName($stat->StatID)}}
					</a></td></tr>		
		<?php	
		$statid = $stat->StatID;
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
