<?php

class SubRegion extends Eloquent
{
    protected $fillable = array(
		'SubRegionID','SubRegionIDString','CountryID','RegionID',
		'SubRegion','SubRegionSort','SubRegionAbbr',
		'NrCols','NrProfiles',
		'Latitude','Longitude'	
	);
}