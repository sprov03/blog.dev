@extends('layouts.master')

@section('top-script')
	<style type="text/css">
	.inlineSelect{
		margin:20px;
	}
	canvas{
		margin: 20px;
		background: white;
	}

	</style>
@stop


@section('content')

	@include('bread-crumbs.home')

	<h1>Create Level</h1>

	<div class="row form-inline inlineSelect center">
		<select class="form-control">
		  <option value="First version">Version 1</option>
{{-- 		  <option value="">Version 2</option>
		  <option value="">Version 3</option>
		  <option value="">Version 4</option>
		  <option value="">Version 5</option> --}}
		</select>

		<select class="form-control">
		  <option value="First game">Mario</option>
{{-- 		  <option value="">Tetris</option>
		  <option value="">Luigie</option>
		  <option value="">Dirt Bike Extream</option>
		  <option value="">Awsome Dude!!</option> --}}
		</select>

		<input type='text' id="level_name_input" class="form-control" placeholder="Level Name">



{{-- 		<select id="level" class="form-control">
		  <option value="1">1</option>
		  <option value="2">2</option>
		  <option value="3">3</option>
		  <option value="4">4</option>
		  <option value="5">5</option>
		</select> --}}

{{-- 		<div class="form-group">
			<input id="canvas_width" class="form-control" type="number" placeholder="canvas width 200">
		</div> --}}
	</div>

	<div class="row center">
		<canvas id="canvas" height="300" width="2000" ></canvas>
	</div>

	<div class="form-inline center">
		<select id="type" class="form-control inlineSelect">
		  {{-- <option value="" selected="true" value="" disabled >Type Of Object</option> --}}
		  <option value="backdropObj">Backdrop, decoration</option>
		  <option value="backgroundObj">groud,walls,ect..</option>
		  {{-- <option value="player">Player</option>
		  <option value="turtle">Turtle</option> --}}
		  <option value="enemyObj">Enemy</option>
		</select>

		<select id="color" class="form-control inlineSelect">
		  {{-- <option value="" selected="true" disabled >Color</option> --}}
		  <option value="black">Black</option>
		  <option value="green">Green</option>
		  <option value="blue">Blue</option>
		  <option value="red">Red</option>
		  <option value="white">White</option>
		  <option value="pink">Pink</option>
		  <option value="yellow">Yellow</option>
		</select>

		<select id="image" class="form-control inlineSelect">
		  <option value="" selected="true" disabled >Image</option>
{{-- 		  <option>Tetris</option>
		  <option>Luigie</option>
		  <option>Dirt Bike Extream</option>
		  <option>Awsome Dude!!</option> --}}
		</select>

		<select id="ai" class="form-control">
			<option value="" selected="true" disabled>AI Options</option>
		</select>
	</div>

	<div class="row center inlineSelect">
		<div class="form-inline">
			<input id="x" name="x" type="number" class="form-control" placeholder="X Cord">

			<input id="y" name="y" type="number" class="form-control" placeholder="Y Cord">
		</div>

		<div class="form-inline inlineSelect">
			<input id="width" name="width" type="number" class="form-control" placeholder="Width">

			<input id="height" name="height" type="number" class="form-control" placeholder="Height">
		</div>
	</div>




	<form id="csvForm" action="{{{ action('GamesController@store') }}}" method='POST'>
		
		{{ Form::token() }}
		<input hidden id="level_name" name="level_name" value="">
		<input hidden id="level_id" name="level_id" value="1">

		<input id="csvString" name="csvString" value="" hidden>
		<div class="form-inline center">
			<a id="nextObj" class="btn btn-default">Next Object</a>
			<button id="submit" type="submit" class="btn btn-default">Create Level</button>
		</div>
		
	</form>




@stop

@section('bottom-script')
<script type="text/javascript">
	
	var createdArray = [];
	var cSizing = $('#canvas').height()/100;
	var mouseIsDown = false;

	var newObj = {
		type: $('#type').val(),
		x: null,
		y: null,
		width: null,
		height: null,
		color: $('#color').val(),
		image: $('#image').val(),
		ai: $('#ai').val(),

		drawSelf: function () {

			if (this.x !== null && this.y !== null && this.width !== null & this.height !== null){

                ctx.fillStyle = this.color;
                ctx.fillRect(this.x,this.y,this.width,this.height);
			}
        }
	};

	var c = document.getElementById("canvas");
    var ctx = c.getContext("2d");

    var redraw = function () {

    	ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);

    	createdArray.forEach(function(obj){

			obj.drawSelf();
		});
    };

    createdArray.push(newObj);

	$( "#canvas_width" ).change(function() {

	    $('#canvas').width( $("#canvas_width").val() * cSizing);
	    $('#canvas').height(300);

	    redraw();
	});

	$( "#canvas" ).mousedown(function(e) {

		mouseIsDown = true;

		$('#x').val(e.offsetX/cSizing);
		$('#y').val(e.offsetY/cSizing);

		newObj.x = e.offsetX;
		newObj.y = e.offsetY;
		newObj.width = null;
		newObj.height = null;

		redraw();
	});

	$( "#canvas" ).mouseup(function(e) {

		mouseIsDown = false;
		redraw();
	});

	$( "#canvas" ).mousemove(function(e) {

		if ( mouseIsDown ){

			$('#width').val(e.offsetX/cSizing - $('#x').val());
			$('#height').val(e.offsetY/cSizing - $('#y').val());

			newObj.width = e.offsetX - $('#x').val() * cSizing;
			newObj.height = e.offsetY - $('#y').val() * cSizing;
		}
		redraw();
	});

	$('#x').change(function(){
		newObj.x = $('#x').val() * cSizing;
		redraw();
	});

	$('#y').change(function(){
		newObj.y = $('#y').val() * cSizing;
		redraw();
	});

	$('#width').change(function(){
		newObj.width = $('#width').val() * cSizing;
		redraw();
	});

	$('#height').change(function(){
		newObj.height = $('#height').val() * cSizing;
		redraw();
	});	

	$('#color').change(function() {
		newObj.color = $('#color').val();
		redraw();
	});

	$('#type').change(function() {
		newObj.type = $('#type').val();
		redraw();
	});

	$('#level').change(function() {
		$('#level_id').val($("#level").val());
	});

	$( "#nextObj" ).click(function() {


		if( newObj.width < 0 ){
			newObj.x += newObj.width;
			newObj.width *= -1;
		}
		if ( newObj.height < 0 ){
			newObj.y += newObj.height;
			newObj.height *= -1;
		}

		var string = ($("#csvString").val() === '') ? '' : $("#csvString").val() + '*';
		string += newObj.type + ',';
		string += newObj.x / cSizing + ',';
		string += newObj.y / cSizing + ',';
		string += newObj.width / cSizing + ',';
		string += newObj.height / cSizing + ',';
		string += newObj.color + ',';
		string += newObj.image + ',';
		string += newObj.ai;

		$("#csvString").val(string);
		newObj = {
			type: $('#type').val(),
			x: null,
			y: null,
			width: null,
			height: null,
			color: $('#color').val(),
			image: $('#image').val(),
			ai: $('#ai').val(),

			drawSelf: function () {

				if (this.x !== null && this.y !== null && this.width !== null & this.height !== null){

	                ctx.fillStyle = this.color;
	                ctx.fillRect(this.x,this.y,this.width,this.height);
				}
            }
		};

		createdArray.push(newObj);
		redraw();
	});

	$( '#submit' ).click(function(event) {
		// event.preventDefault();
		// $('#csvString').prop("disabled", false);
		// event.submit();
	});

	$(document).keydown(function (event){
        processKeyDown(event.keyCode);
    });

    $('#level_name_input').change(function() {
    	$('#level_name').val( $('#level_name_input').val() );
    });

    function processKeyDown(event){

        if(event === 39) {}
        if(event === 37){}
        if(event === 32) {}
        if (event === 13) {



		if( newObj.width < 0 ){
			newObj.x += newObj.width;
			newObj.width *= -1;
		}
		if ( newObj.height < 0 ){
			newObj.y += newObj.height;
			newObj.height *= -1;
		}


		var string = ($("#csvString").val() === '') ? '' : $("#csvString").val() + '*';
		string += newObj.type + ',';
		string += newObj.x / cSizing + ',';
		string += newObj.y / cSizing + ',';
		string += newObj.width / cSizing + ',';
		string += newObj.height / cSizing + ',';
		string += newObj.color + ',';
		string += newObj.image + ',';
		string += newObj.ai;

		$("#csvString").val(string);
		newObj = {
			type: $('#type').val(),
			x: null,
			y: null,
			width: null,
			height: null,
			color: $('#color').val(),
			image: $('#image').val(),
			ai: $('#ai').val(),

			drawSelf: function () {

				if (this.x !== null && this.y !== null && this.width !== null & this.height !== null){

	                ctx.fillStyle = this.color;
	                ctx.fillRect(this.x,this.y,this.width,this.height);
				}
            }
        }
        createdArray.push(newObj);
		redraw();
    }
}
</script>
@stop



















