<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Homepage */
Route::get('/', function()
{
	//$countries = Country::orderBy('CountrySort', 'ASC')->get();
	
	return View::make('pages.mainsearch')
	//->with('countries',$countries)
	->with('pagetype','home');
});

/* New page*/
Route::get('new', function()
{
	$newitems = NewItem::orderBy('DateSort','DESC')->get();
	
	return View::make('pages.new')
		->with('newitems',$newitems)
		->with('pagetype','newtemplate');
});

/* Stats page*/
Route::get('stats', function()
{
	return View::make('pages.stats', array('pagetype'=>'statstemplate'));
});

/* About page*/
Route::get('about', function()
{
	return View::make('pages.about', array('pagetype'=>'abouttemplate'));
});

/* Help page */
Route::get('help', function()
{
    return View::make('pages.help', array('pagetype'=>'helptemplate'));
});


/*Col page*/
Route::get('col/{colIDString}', function($colIDString)
{
	$col = Col::where('ColIDString',$colIDString)->first();
	//$col_prev = Col::where('Number',$col->Number - 1)->first();
	//$col_next = Col::where('Number',$col->Number + 1)->first();
	
	if (is_null($col))
	{
		return "Col does not exist.";
	}

	$profiles = Profile::where('ColID',$col->ColID)->get();
	
	return View::make('pages.col')
		->with('col',$col)
		->with('profiles',$profiles)
		//->with('col_prev',$col_prev)
		//->with('col_next',$col_next)
		->with('pagetype','coltemplate');
});



/*Slideshow page*/
Route::get('slideshow/{colIDString}', function($colIDString)
{
	$col = Col::where('ColIDString',$colIDString)->first();
	
	if (is_null($col))
	{
		return "Col does not exist.";
	}

	$images = Image::where('ColID',$col->ColID)->get();
	
	return View::make('pages.slideshow')
		->with('col',$col)
		->with('images',$images)
		->with('pagetype','slideshowpage');
});

/* googlemaps pages*/
Route::get('map', function()
{   
	return View::make('pages.map')
		->with('pagetype','mappage');
});

Route::get('map/country/{country}', function($country)
{   
	$country = Country::where('CountryIDString',$country)->first();
	
	if (is_null($country))
	{
		return "Page does not exist.";
	}
	
    return View::make('pages.map')
		->with('country',$country)
		->with('pagetype','mappage');
});

Route::get('map/col/{col}', function($col)
{   
	$col = Col::where('ColIDString',$col)->first();
	
	if (is_null($col))
	{
		return "Page does not exist.";
	}
	
    return View::make('pages.map')
		->with('col',$col)
		->with('pagetype','mappage');
});

/*random cols*/
Route::get('random', function()
{
    $images = array('imagelocations' => array(
        'Italy/P6170155.JPG',
        'Italy/P6170170.JPG', 
        'Italy/P6170180.JPG',
        'France/Tourmalet1.jpg',
        'France/Tourmalet2.JPG',
        'France/Tourmalet3.jpg',
        'Spain/P3020093.JPG',
        'Spain/P3020096.JPG',
        'Spain/P3020102.JPG',
        'Switzerland/P1010002.JPG',
        'Switzerland/P1010004.JPG',
        'Switzerland/P1010006.JPG'
        ));
  return View::make('pages.randomcol', $images, array('pagetype'=>'randomtemplate'));
});