@extends('layouts.master')

@section('top-script')
<style>
	.hidden{
		display:none;
	}
</style>

@stop


@section('content')

	<h1 id="testing">About Me </h1>

	<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>

        <form>
            <input type="text" name="editor1" id="data" rows="10" cols="80" placeholder=" This is my input to be replaced with CKEditor.">
            </input>
            <input type="text" id="editor1"class="hidden"></input>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                var input = document.getElementById('data');
                // setTimeout(function(){
                // },3000);

                var clicked = document.getElementById('testing');
                clicked.addEventListener('click', function(){
	                CKEDITOR.replace( 'editor1' );
	                setTimeout(function(){
	                	var data = CKEDITOR.instances.editor1.getData();
	                	console.log( data );
	                });
                	input.className += ' hidden';
                	console.log( input.value );
                });
            </script>
        </form>


@stop
