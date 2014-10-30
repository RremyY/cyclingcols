<?php

class Passage extends Eloquent
{
    protected $fillable = array(
		'ColID','ProfileID','SideID','Side','SideAbbr',
		'EventID','EditionID','Edition',
		'PersonID','Person',
		'NatioID','Natio','NatioAbbr',
		'Cancelled','Neutralized'
	);
}