@extends('layout')

@include('instance.header')

@section('content')

<div class="span9">
	<h2>{{$gallery->title}}</h2>
</div>

<div class="row">
	<div class="span8">
		<div id="myCarousel" class="carousel slide">
			<div class="carousel-inner">
				@foreach($gallery->images as $key => $image)
				@if (! $key)
				<div class="item active offset1">
				@else
				<div class="item offset1">
				@endif
					<img class="avatar img-polaroid" src="/{{ $image->getSize('medium')->getPathname() }}" alt="">
				</div>
				@endforeach
			</div>
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
		</div>
	</div>
</div>

@stop