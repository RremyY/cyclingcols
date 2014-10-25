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
	$countries = Country::orderBy('CountrySort', 'ASC')->get();
	
	return View::make('pages.mainsearch')
	->with('countries',$countries)
	->with('pagetype','home');
});

/* About page*/
Route::get('about', function()
{
	$count = Col::where('ColID', '>', 0)->count();
	return View::make('pages.about', array('pagetype'=>'abouttemplate'))->with('number_of_cols', $count);
});

/* Help page */
Route::get('help', function()
{
    return View::make('pages.help', array('pagetype'=>'helptemplate'));
});


/*Col pages*/
Route::get('col/{colName}', function($colName)
{
  return View::make('pages.col', array('colname'=>$colName), array('pagetype'=>'coltemplate'));
});

Route::get('pages.col/{colName}/slideshow', function($colName)
{
  return "Photo's from {$colName}";
});

/* Country googlemaps pages*/
Route::get('country/{country}', function($country)
{   
	$country = Country::where('CountryIDString',$country)->first();
	
    return View::make('pages.country')
		//->with('latitude',$country->Latitude/1000000)
		//->with('longitude',$country->Longitude/1000000)
		->with('selectedcountry',$country)
		->with('pagetype','countrypage');
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