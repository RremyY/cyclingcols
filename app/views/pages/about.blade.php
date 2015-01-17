@extends('layouts.master')

@section('title')
CyclingCols - About
@stop

@section('content')
<div clas="col-md-12">
    <div class="header">
        <h1>
            About CyclingCols
        </h1>
	</div>
	<div class="content">

		<p>This website is a collection of unique and accurate information about cols in Europe, maintained by myself, Michiel van Lonkhuyzen (1977). </p>
        <p>
			Since the late 90s I have been cycling through the mountaineous regions of Europe, measuring and recording the altitudes of roads. 
            While cycling uphill and downhill I make pictures to capture the atmosphere of every col. 
        </p>
		<p>
        <img id="imgMichiel" src="{{ URL::asset('images/Michiel.jpg') }}"/>	
		</p>
		<p>
			CyclingCols was first released at February 26th 2001, just built in Notepad and Paint. 
			Because the number of cols on the site was growing fast, I decided to rebuild the site in 2004 using ASP pages and SQL Server.
			This version existed for more than 10 years until the current MySQL/PHP driven version was unveiled in the beginning of 2015.
		</p>
    </div>
</div>
@stop
