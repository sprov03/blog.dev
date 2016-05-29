@extends('layouts.master')

@section('top-script')
	<style>
		#geo_code{
			position: relative;
			top: 1px;
		}
		h1{
			font-size: 20px;
			margin-top: 100px;
		}
		#your_map{
			box-sizing: border-box;
			border-radius: 5px;
			height: 60vw;
		    margin: 0 15px 10px;
		    padding: 0;
		}
		#hue{
			width: 100%; 
			height: 35px;
			border-radius:3px;
		}
		#controls{
			text-align: center;
		    margin: 0 15px 5px;
		     padding: 0; 
		}
		.canvas{
			/*position: static !important;*/
		}
		select, input, button{
			margin: 0 0 5px 0;
		}
		#preview_game{
			position: relative;
			top:-50px;
		}
	</style>
@stop



@section('content')
	<h1>Customize your map!</h1>
	<div class="row">
		

		<div id="preview_game"></div>
		<div id="your_map" class="col-md-7"></div>
		
		<div id="controls" class="col-md-5 canvas" >
			<select class="form-control">
				<option>Address</option>
				<option>Hue</option>
				<option>Lightness</option>
				<option>Saturation</option>
				<option>Invert Lightness</option>
				<option>Visibility</option>
				<option>Color</option>
				<option>Weight</option>
			</select>
			<input id="geo_address" class="form-control" placeholder="new address"></input>
			<canvas id="hue" width="100" height="100"></canvas>
			<input id="lightness" class="form-control" type="number" placeholder="-100 to 100"></input>
			<input id="saturation" class="form-control" type="number" placeholder="-100 to 100"></input>
			<input id="gamma" class="form-control" type="number" placeholder=".01 t0 10"></input>
			<input id="invert_lightness" class="form-control" type="number" placeholder="true or false"></input>
			<input id="visibility" class="form-control" type="number" placeholder="(on, off, or simplified)"></input>
			<input id="color" class="form-control" type="number" placeholder="(an RGB hex string)"></input>
			<input id="weight" class="form-control" type="number" placeholder="(an integer value, greater than or equal to zero)"></input>
			<button id="redraw" class="btn btn-default">redraw</button>
		</div>

	</div> 
@stop



@section('bottom-script')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe8A2JoXvvmNYaxz8Cs3eTJlzoQ12Kv7Q"></script>
	<script>
		// Create a map object, and include the MapTypeId to add to the map type control.
		var geocoder = new google.maps.Geocoder();
		var mapCenter = { lat:  32.782182, lng: -96.797600 };
		var mapOptions = {
			zoom: 18,
			center: mapCenter,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
			},
			scrollwheel: false,
		    mapTypeControl: false,
		    streetViewControl: false
		};

		// Create an array of styles.
		var styles = [
		{
			stylers: [
				{ hue: "#d4e9ff" },
				{ saturation: 99 }
			]
		},{
			featureType: "road",
			elementType: "geometry",
				stylers: [
					{ lightness: 100 },
					{ visibility: "simplified" }
				]
			}
		];

		function drawMap(){

			// Create a new StyledMapType object, passing it the array of styles,
			// as well as the name to be displayed on the map type control.
			var styledMap = new google.maps.StyledMapType(styles, {name: "Your Custom Map!!"});

			// Render the map
			var map = new google.maps.Map(document.getElementById("your_map"), mapOptions);

			map.mapTypes.set('map_style', styledMap); 	// Creates the id for styledMap
			map.setMapTypeId('map_style');  			// Set the Map to be displayed
			// Add the marker to our existing map
			var marker = new google.maps.Marker({
				position: mapCenter,
				map: map,
				title: "GDD Interactive",
				icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
			});
		}

		   // Geocode our address
		    $('#geo_address').blur( function(){
		    	geocoder.geocode({ "address": document.getElementById('geo_address').value }, function(results, status) {
		           if (status == google.maps.GeocoderStatus.OK) {
		               // map.setCenter(results[0].geometry.location);
		               mapOptions.center.lat = results[0].geometry.location.lat();
		               mapOptions.center.lng = results[0].geometry.location.lng();
		               // drawMap();
		               for( var i=0; i<results.length; i++){
		               }
		           } else {
		               alert("Geocoding was not successful - STATUS: " + status);
		           }
		        });
		    } );

		// User Interactions
			drawMap();
		    var buttons = document.getElementsByTagName('a');
		    for(var i = 0; i < buttons.length;i+=1){
		        buttons[i].addEventListener('click',function () {
		            sorter(this.getAttribute('data-func'));
		        },false);
		    }
		    $('#redraw').click(function(){
		    	drawMap();
		    });
		    $('#saturation').change(function(){
		    	var val = $(this).val();
		    	if ( val > 100 ){
		    		$(this).val(100);
		    	}else if ( val < -100 ){
		    		$(this).val(-100);
		    	}else{
		    		styles[0].stylers[0].hue = $(this).val();
		    	}
		    });

	</script>


<script type="text/javascript">
	var canvas = document.getElementById('hue').getContext('2d');

	// create an image object and get it’s source
	var img = new Image();
	img.src = '/img/color-picker.png';

	// copy the image to the canvas
	$(img).load(function(){
	  var sx = 0;
	  var sy = 100;
	  var sw = 250;
	  var sh = 20;
	  var cx = 0;
	  var cy = 0;
	  var cw = 100;
	  var ch = 100;
	  canvas.drawImage(img,sx,sy,sw,sh,cx,cy,cw,ch);
	});

	// http://www.javascripter.net/faq/rgbtohex.htm
	function rgbToHex(R,G,B) {return toHex(R)+toHex(G)+toHex(B)}
	function toHex(n) {
	  n = parseInt(n,10);
	  if (isNaN(n)) return "00";
	  n = Math.max(0,Math.min(n,255));
	  return "0123456789ABCDEF".charAt((n-n%16)/16)  + "0123456789ABCDEF".charAt(n%16);
	}

	$('#hue').click(function(event){
	  // getting user coordinates
	  var x = (event.pageX - this.offsetLeft) / $('#hue').width() * 100;
	  var y = (event.pageY - 	$(this).offset.top) / $('#hue').width() * 100;

	  // getting image data and RGB values
	  var img_data = canvas.getImageData(x, 20, 1, 1).data;
	  var R = img_data[0];
	  var G = img_data[1];
	  var B = img_data[2];  
	  var rgb = R + ',' + G + ',' + B;
	  // convert RGB to HEX
	  var hex = rgbToHex(R,G,B);
	  // making the color the value of the input
	  $('#rgb input').val(rgb);
	  $('#hex input').val('#' + hex);

	  styles[0].stylers[0].hue = '#' + hex;
	  drawMap();
	});
</script>






@stop