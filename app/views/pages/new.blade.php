@extends('layouts.master')

@section('content')
<div id="new-canvas" clas="col-md-12">
    <div class="header">
        <h1>New at CyclingCols</h1>
	</div>
	
	
	<div class="content">
		<div class="new_header">New profiles:</div>
		<div class="new_table">
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
				<div class="new_table_wrapper col-md-6">
				<table>
					<tbody>		
		<?php
		}
		?>
					<tr><td class="new_date" colspan="6">{{$newitem->Date}}</td></tr>		
		<?php	
		$datesort = $newitem->DateSort;
		$datecount++;
	}
?>
					<tr id="{{$newitem->ColIDString}}#profile{{$newitem->ProfileID}}" class="new_row">
						<td class="new_col">{{$newitem->Col}}</td>
						<td class="new_country">
							<img src="{{ URL::asset('images/flags/' . $newitem->Country1 . '.gif') }}" title="{{$newitem->Country1}}" />
@if ($newitem->Country2)
							<img src="{{ URL::asset('images/flags/' . $newitem->Country2 . '.gif') }}" title="{{$newitem->Country2}}" />
@endif
						</td>
						<td class="new_height">{{$newitem->Height}}m</td>
						
@if ($newitem->SideID > 0)
						<td class="new_side">
							<img src="{{URL::asset('images/')}}/{{$newitem->Side}}.png")}}' title='{{$newitem->Side}}'/>
							<span>{{$newitem->Side}}</span>
						</td>
@else
						<td>&nbsp;</td>	
@endif
						<td class="new_category category c{{$newitem->Category}}" title="category {{$newitem->Category}}">{{$newitem->Category}}</td>
@if ($newitem->IsRevised)
						<td class="new_revised">revised</td>
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
