@extends('layouts.master')

@section('content')




    <div class="col-md-12 randomcol">
            @foreach ($imagelocations as $imagelocation)
                <div class='item'>
                    <a href="{{ URL::asset('col/chasseral')}}">
                        <img class="lazy" src="{{ URL::asset('images/dummy.gif') }}" data-src="{{ URL::asset('images/slideshow') }}/{{$imagelocation}}" alt="" />
                        <p>imagecaption</p>
                    </a>
                </div>
            @endforeach
    </div>

<script src="{{ URL::asset('js/jail.js') }}"></script>
<script>

        $(function(){
            $('img.lazy').jail({
                effect: 'fadeIn'
            });
        });
        
        
</script>

@stop
