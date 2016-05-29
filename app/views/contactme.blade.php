@extends('layouts.master')

@section('top-script')

	<link rel="stylesheet" type="text/css" href="/css/contactme.css">

@stop

@section('content')
		<h1>Contact Me</h1>

		<div class="col-sm-4">
			<table class="table">
				<tr>
					<th><span class="glyphicon glyphicon glyphicon-knight"></span></th>
					<th>Shawn Pivonka</th>
				</tr>
				<tr>
					<td><span class="glyphicon glyphicon glyphicon-home"></span></td>
					<td><p>9730 Morningfield, </p><p>San Antonio, TX 78250</p></td>
				</tr>
				<tr>
					<td><span class="glyphicon glyphicon glyphicon-envelope"></span></td>
					<td>sprov03@gmail.com</td>
				</tr>
				<tr>
					<td><span class="glyphicon glyphicon-phone-alt" aria-hidden:="true"></span></td>
					<td>(979) 218-6555</td>
				</tr>
			</table>
		</div>

		<form class="col-sm-8" id="contact_me_form" method="POST" action="MAILTO:sprov03@gmail.com">

		    <div class="form-group">
		        <label for="exampleInputEmail1">Email address</label>
		        <input  name="Email" type="email" class="form-control" id="exampleInputEmail1  " placeholder="Email">
		    </div>

		    <div class="form-group">
		        <label for="exampleInputPassword1">Subject</label>
		        <input name="subject" type="text" class="form-control" id="  exampleInputPassword1" placeholder="Subject">
		    </div>

		    <div class="form-group">
		        <label for="exampleInputFile">Body</label>
		        <textarea name="comment" class="form-control"id="exampleInputFile" rows="10"   placeholder="This is not set up yet, just threw the page togeather.......  sorry!!"></textarea>
		    </div>

		    <br>
		    <button type="submit" class="btn btn-primary">Submit</button>

		</form>

		<bottom id="bottom_of_the_page"></bottom>
@stop



@section('bottom-script')
@stop

