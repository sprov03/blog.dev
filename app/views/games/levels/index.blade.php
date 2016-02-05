@extends('layouts.master')

@section('top-script')
<style type="text/css">

.show_level{
	background:gray;
	border-radius: 15px;
	margin:30px;
}
.show_level:hover{
	background:#999;
}
.right{
	margin-right:20px;
}
.id{
	margin-left:25px;
	font-size: 2.2em;
}
.level_name{
	margin-left: 25px;
	margin-top: 30px;
	font-size: 1.6em;
}
.created{
	margin-top: 30px;
	font-size: 1em;
}
.btn{
	margin-left:25px;
}


</style>

@stop


@section('content')

	{{-- @include('/bread-crumbs.home') --}}
	<a href="{{{ action( 'HomeController@showHome' ) }}}">Home</a>

	<h1>Levels</h1>

	@foreach( $levels as $level)


	<a href="{{{ action('GamesController@show', $level->id) }}}">
		<div class="row show_level">

			<div class="row">
				<h6 class="id">{{{ $level->id }}}</h6>
			</div>

			<div class="row">
				<p class="level_name">{{{ $level->level_name }}}</p>
			</div>
			@if( Auth::check() )
				<div class="row">
					{{ Form::open(['action'=>['LevelsController@destroy',$level->id], 'method'=>'DELETE']) }}
						{{ Form::submit('Delete',['class'=>'btn btn-xs btn-danger'])}}
					{{ Form::close()}}
				</div>
			@endif
			<div class="row right">
				<span class="created">Created on {{{$level->created_at}}}</span>
			</div>

		</div>
	</a>

	@endforeach

	{{ $levels->links() }}




@stop

@section('bottom-script')

@stop
