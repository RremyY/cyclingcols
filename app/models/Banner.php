<?php

class Banner extends Eloquent
{
    protected $fillable = array(
		'ColID',
		'RedirectURL','BannerFileName',
		'Sort','StartDate','EndDate','Active'
	);
}