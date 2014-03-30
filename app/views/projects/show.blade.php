@extends('layout')

@include('instance.header')

<div class="headerimage">
	<h1>{{$project->name}}</h1>
</div>


@section('content')
<div class="projects exclusive">


	<div class="single">
		<h1><a href="/projects/{{$project->id}}">{{$project->name}}</a></h1>

		<div class="img" style="background-image: url({{ asset(''.$project->image->getSize('thumb')->getPathname().'') }})"></div>

		<div class="capital"><h3>{{$project->capital}} START CAPITAL</h3></div>
		<div class="expiredate"><h3>Expires {{date('d F Y', strtotime($project->expire_date))}}</h3></div>
		<div class="progress-bar {{$project->id}}">
			<span></span>
		</div>
		<br />
		<br />
				<button class="btn" data-toggle="modal" data-target="#myModal">
		  			Fund This project!
				</button>
	</div>
</div>
<div>
	<div>


		

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			  <div class="modal-content">
			    <div class="modal-header">
			      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			      <h4 class="modal-title" id="myModalLabel">Yaay!!!!</h4>
			    </div>
			    <div class="modal-body">
					{{Form::open(array('action'=>'FundController@postFund', 'method'=>'post','id' => 'place-fund-form', 'class' => 'form-horizontal'))}}
					{{Form::hidden('project_id',$project->id)}}
					{{Form::label('value','Value to fund')}}
					{{Form::text('value')}}
					<input type="hidden" id="projectid" class="projectid" name="projectid" value="{{$project->id}}">


					
					
			    </div>
			    <div class="modal-footer">
					<button class="btn" data-dismiss="modal">Cancel</button>
					<input class="btn btn-primary" type="submit" value="Place your sparks!!">
			    </div>
				</form>
			  </div>
			</div>
		</div>
		

	<div class="textProject">
		<h2>{{$project->address}}, {{$project->zipcode}} - {{$project->town}}, {{$project->country}}</h2>
		<p>{{$project->description}}</p>
		<h3>{{$fund_total}} sparkcoins</h3>
		<h3>{{$project->views}} views</h3>
	</div>
		<ul class="unstyled">
									@foreach($project->documents as $document)
										
											
												
											
											<li><a href="{{$document->path}}/{{$document->name}}">{{$document->title}}</a></li>
										
									@endforeach
								</ul>
	</div>
	@if($project->imageable_id != 0)
	<div class="row">
					<div class="span8">
						<div id="myCarousel" class="carousel slide">
							<div class="carousel-inner">
								@foreach($project->imageable->images as $key => $image)
									@if (! $key)
										<div class="item active offset1">
									@else
										<div class="item offset1">
									@endif
									<img class="avatar img-polaroid" src="/{{ $image->getSize('medium')->getPathname() }}" alt="">
									</div>
								@endforeach
							</div>
							<a class="left carousel-control" href="#myCarousel" data-slide="prev" class="pull-left">‹</a>
							<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
						</div>
					</div>
				</div>
	<div>
	@endif
	<div class="comments">
		<h2><?php echo count($project->comments) ?> Comments</h2>
		<img/>
		@foreach($project->comments as $comment)
			<div><img src="/{{$comment->profile->image->getSize('thumb')->getPathname()}}"/></div>
			<div>{{User::find($comment->user_id)->firstname}} {{User::find($comment->user_id)->lastname}}</div>
			<div>{{$comment->body}}</div>
		@endforeach
		<h3>Add comment</h3>
		<div>	
			<ul>
		        @foreach($errors->all() as $error)
		            <li>{{ $error }}</li>
		        @endforeach
		    </ul>
		</div>
		{{Form::open(array('action'=>'CommentController@store', 'method'=>'post'))}}
		<div>
			{{Form::hidden('project_id',$project->id)}}
			{{Form::textarea('body')}}
		</div>
		<div>
			{{Form::submit('Post comment')}}
		</div>
		{{Form::close()}}

	</div>
</div>
</div>
@stop

@section('scripts')
	@parent

 // Ajax file upload for the file upload modal.
 var project_id = {{$project->id}};
$("#place-fund-form").ajaxForm({
	data: { 'ajax': 'true', 'project_id' : project_id },
	dataType: 'json',
	success: function(data) {
		
		

		console.log(data);

		$("#place-fund-form").modal('hide');
	}
});

@stop