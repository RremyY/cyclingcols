<?php

class Region extends Eloquent
{
    protected $fillable = array(
		'RegionID','RegionIDString','CountryID',
		'Region','RegionSort','RegionAbbr',
		'NrSubRegions','NrCols','NrProfiles',
		'Latitude','Longitude'	
	);
}