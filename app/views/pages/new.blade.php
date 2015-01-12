@extends('layouts.master')

@section('content')
<div id="new-canvas" class="col-xs-12">
    <div class="header">
        <h1>New at CyclingCols</h1>
	</div>
	
	
	<div class="content">
		<div class="table_header">New profiles:</div>
		<div class="table_table">
<?php
$datesort = 0;
$datecount = 0;

foreach($newitems as $newitem) {
	if ($newitem->DateSort != $datesort) {
		if ($datecount > 1 || $datesort == 0) {
			$datecount = 0;
			if ($datesort != 0) {
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
					<tr><td class="table_subheader" colspan="6">{{$newitem->Date}}</td></tr>		
		<?php	
		$datesort = $newitem->DateSort;
		$datecount++;
	}
?>
					<tr id="{{$newitem->ColIDString}}#profile{{$newitem->ProfileID}}" class="table_row">
						<td class="table_col">{{$newitem->Col}}</td>
						<td class="table_country">
							<img src="{{ URL::asset('images/flags/' . $newitem->Country1 . '.gif') }}" title="{{$newitem->Country1}}" />
@if ($newitem->Country2)
							<img src="{{ URL::asset('images/flags/' . $newitem->Country2 . '.gif') }}" title="{{$newitem->Country2}}" />
@endif
						</td>
						<td class="table_value">{{$newitem->Height}}m</td>
						
@if ($newitem->SideID > 0)
						<td class="table_side">
							<img src="{{URL::asset('images/')}}/{{$newitem->Side}}.png")}}' title='{{$newitem->Side}}'/>
							<span>{{$newitem->Side}}</span>
						</td>
@else
						<td>&nbsp;</td>	
@endif
						<td class="table_category category c{{$newitem->Category}}" title="Category {{$newitem->Category}}">{{$newitem->Category}}</td>
@if ($newitem->IsRevised)
						<td class="table_revised">revised</td>
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
