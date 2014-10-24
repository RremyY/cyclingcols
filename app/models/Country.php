<?php

class Country extends Eloquent
{
    protected $fillable = array(
		'CountryID','CountryIDString',
		'Country','CountrySort','CountryAbbr',
		'NrRegions','NrCols','NrProfiles',
		'Latitude','Longitude'	
	);
}