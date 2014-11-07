<?php

class Image extends Eloquent
{
    protected $fillable = array(
		'ImageID',
		'ColID','ProfileID',
		'Description','Number',
		'URL',
		'Source','SourceURL'
	);
}