<?php

class NewItem extends Eloquent
{
	public $table = 'newitems';
	
    protected $fillable = array(
		'DateSort','Date',
		'ColID','ColIDString','Col',
		'Country1ID','Country1',
		'Country2ID','Country2',
		'Region1ID','Region1',
		'Region2ID','Region2',
		'SubRegion1ID','SubRegion1',
		'SubRegion2ID','SubRegion2',
		'Height',
		'ProfileID',
		'SideID','Side',
		'FileName','Category',
		'HTML',
		'IsRevised'
	);
}