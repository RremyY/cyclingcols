<?php

class Col extends Eloquent
{
    protected $fillable = array(
		'ColID','ColIDString',
		'Country1ID','Country1','Country2ID','Country2',
		'Region1ID','Region1','Region2ID','Region2',
		'SubRegion1ID','SubRegion1','SubRegion2ID','SubRegion2',
		'Col','ColSort','ColAbbr',
		'ColTypeID','ColType',
		'Height',
		'Latitude','Longitude',
		'CoverPhoto','CoverPhotoPosition',
		'Panel','PanelSource','PanelSourceURL',
		'URL','Number','Aliases',
		'HasImages'
	);
}