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
			/*box-sizing: border-box;
			border-radius: 5px;
			height: 60vw;
		    margin: 0 15px 10px;
		    padding: 0;*/
		}
		#color_picker{
			width: 100%; 
			height: 35px;
			border-radius:3px;
		}
		#controls{
			/*text-align: center;
		    margin: 0 15px 5px;
		     padding: 0; */
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
		#your_map{
			height: 50vw;
			/*height: 100%;*/
			/*background-color: pink;*/

		}
		#controls{
			/*height: 50vw;*/
			/*background-color: pink;*/

		}
	</style>
@stop



@section('content')
	<h1>Customize your map!</h1>
	<div class="row">
		

		<div id="preview_game"></div>
		<div id="your_map" class="col-sm-6"></div>
		<div id="controls" class="col-sm-6">
			<label for="geo_address">Address</label>
			<input id="geo_address" class="form-control" placeholder="new address"></input>
			
			<?php
				$mapFeatures = ['all','administrative','administrative.country','administrative.land_parcel','administrative.locality','administrative.neighborhood','administrative.province','landscape','landscape.man_made','landscape.natural','landscape.natural.landcover','landscape.natural.terrain','poi','poi.attraction','poi.business','poi.government','poi.medical','poi.park','poi.place_of_worship','poi.school','poi.sports_complex','road','road.arterial','road.highway','road.highway.controlled_access','road.local','transit','transit.line','transit.station','transit.station.airport','transit.station.bus','transit.station.rail','water'];
				$mapElements = ['geometry','geometry.fill','geometry.stroke','labelslabels.icon','labels.text','labels.text.fill','labels.text.stroke'];
			?>
			
			<label for-"map_feature">Map Feature</label>
			<select id="map_feature" class="form-control">
				<?php foreach( $mapFeatures as $each ): ?>
					<option><?php echo $each; ?></option>
				<?php endforeach; ?>
			</select>
			
			<label for="map_element">Map Element</label>
			<select id="map_element" class="form-control">
				<?php foreach( $mapElements as $each ): ?>
					<option><?php echo $each; ?></option>
				<?php endforeach; ?>
			</select>
			
			<canvas id="color_picker" width="100" height="100" class="hidden color_picker_canvas"></canvas>
			
			<label for="color">Color</label>
			<input id="color" class="form-control color_picker" type="text" placeholder="(an RGB hex string)"></input>
			
			<label for="hue" id="hue_label">Hue</label>
			<input id="hue" class="form-control color_picker" type="text" placeholder="(an RGB hex string)"></input>
			{{-- <canvas id="hue_picker" width="100" height="100" class="hidden color_picker_canvas"></canvas> --}}
			
			<label for="lightness">Lighness</label>
			<input id="lightness" class="form-control" type="number" placeholder="-100 to 100"></input>
			
			<label for="saturation">Saturation</label>
			<input id="saturation" class="form-control" type="number" placeholder="-100 to 100"></input>
			
			<label for="gamma">Gamma</label>
			<input id="gamma" class="form-control" type="number" placeholder=".01 to 10"></input>
			
			<label for="invert_lightness">Invert_lightness</label>
			<select id="invert_lightness" class="form-control">
				<option>false</option>
				<option>true</option>
			</select>
			
			<label for="visibility">Visibility</label>
			<select id="visibility" class="form-control">
				<option>on</option>
				<option>off</option>
				<option>simplified</option>				
			</select>
			
			<label for="weight">Weight</label>
			<input id="weight" class="form-control" type="number" placeholder="(an integer value, greater than or equal to zero)"></input>
			
			<button id="redraw" class="btn btn-default">redraw</button>
			<button id="add_style" class="btn btn-default">Add Style</button>
			<button id="copy_to_clipboard" class="btn btn-default">Console Log the Code</button>
		</div>

	</div> 
@stop



@section('bottom-script')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDe8A2JoXvvmNYaxz8Cs3eTJlzoQ12Kv7Q"></script>
	<script>

		var color_picker_target = $('#hue');

		// Helper Funtions
			function getOffsetLeftDom( elem ){
				var offsetLeft = 0;
				do {
					if ( !isNaN( elem.offsetLeft ) ){
						offsetLeft += elem.offsetLeft;
					}
				} while( elem = elem.offsetParent );
				return offsetLeft;
			}
			function getOffsetTopDom( elem ){
				var offsetTop = 0;
				do{
					if ( !isNaN( elem.offsetTop ) ){
						offsetTop += elem.offsetTop;
					}
				} while( elem = elem.offsetParent );
				return offsetTop;
			}

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

		// Draw Map Function 
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
					icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'// This is a link to an image, can be on any server 
				});
			}

		// http://www.javascripter.net/faq/rgbtohex.htm
			function rgbToHex(R,G,B) {return toHex(R)+toHex(G)+toHex(B)}
			function toHex(n) {
			  n = parseInt(n,10);
			  if (isNaN(n)) return "00";
			  n = Math.max(0,Math.min(n,255));
			  return "0123456789ABCDEF".charAt((n-n%16)/16)  + "0123456789ABCDEF".charAt(n%16);
			}

	    // Geocode our address
		    $('#geo_address').blur( function(){
		    	geocoder.geocode({ "address": document.getElementById('geo_address').value }, function(results, status) {
		           if (status == google.maps.GeocoderStatus.OK) {
		               // map.setCenter(results[0].geometry.location);
		               mapOptions.center.lat = results[0].geometry.location.lat();
		               mapOptions.center.lng = results[0].geometry.location.lng();
		               drawMap();
		               for( var i=0; i<results.length; i++){
		               }
		           } else {
		               alert("Geocoding was not successful - STATUS: " + status);
		           }
		        });
		    } );

		// Hue color selector
			var canvas = document.getElementById('color_picker').getContext('2d');

			//create an image object and get it’s source
			var img = new Image();
			img.src = '/img/color-picker.png';

			//copy the image to the canvas
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

		// User Interactions

		    $('#redraw').click(drawMap);

		    $('#add_style').click(function(){
		    	var newStyle = {};

		    	newStyle.featureType = $('#map_feature').val();
		    	newStyle.elementType = $('#map_element').val();
		    	newStyle.stylers = [];
		    	if ( $('#hue').val() ) newStyle.stylers.push({hue: $('#hue').val() });
		    	if ( $('#lightness').val() ) newStyle.stylers.push({lightness: $('#lightness').val() });
		    	if ( $('#saturation').val() ) newStyle.stylers.push({saturation: $('#saturation').val() });
		    	if ( $('#gamma').val() ) newStyle.stylers.push({gamma: $('#gamma').val() });
		    	if ( $('#invert_lightness').val() ) newStyle.stylers.push({invert_lightness: $('#invert_lightness').val() });
		    	if ( $('#visibility').val() ) newStyle.stylers.push({visibility: $('#visibility').val() });
		    	if ( $('#color').val() ) newStyle.stylers.push({color: $('#color').val() });
		    	if ( $('#weight').val() ) newStyle.stylers.push({weight: $('#weight').val() });

		    	var overwrite = false;
		    	var len = styles.length;
		    	for (var i=0; i<len; i++){
		    		if ( styles[i].featureType === $('#map_feature').val() && styles[i].elementType === $('#map_element').val() ){
		    			styles[i] = newStyle;
		    			overwrite = true;
		    		}
		    	}
		    	if ( !overwrite ){
			    	styles.push(newStyle);
		    	}

		    	drawMap();
		    });

			$('.color_picker').click(function(){
				$('#color_picker').removeClass('hidden');
				color_picker_target = $(this);
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

		    $('.color_picker_canvas').click(function(event){
				// getting user coordinates
				var x = (event.pageX - getOffsetLeftDom( event.target ))/ $(this).width() * 100;
				var y = (event.pageY - getOffsetTopDom( event.target)) / $(this).width() * 100;

				// getting image data and RGB values
				var img_data = canvas.getImageData(x, y, 1, 1).data;
				var R = img_data[0];
				var G = img_data[1];
				var B = img_data[2];  
				var rgb = R + ',' + G + ',' + B;
				// convert RGB to HEX
				var hex = rgbToHex(R,G,B);
				// making the color the value of the input
				$('#rgb input').val(rgb);
				$('#hex input').val('#' + hex);

				// styles[0].stylers[0].hue = '#' + hex;
				color_picker_target.val('#' + hex);
				$(this).addClass('hidden');
				// drawMap();
			});

			$('#map_feature').change(function(event){
				if ($(this).val() != 'all'){
					$('#hue').addClass('hidden').val('');
					$('#hue_label').addClass('hidden');
				} else{
					$('#hue, #hue_label').removeClass('hidden');
				}
			});

			$('#copy_to_clipboard').click(function(){
				//  This intire Function is a template that is being logged to the console.
				var code = `
					<!-- Add script tags with the link to the google maps api with your api key here -->
					<canvas id="map-canvas" width="500" height="500"></canvas>

					var geocoder = new google.maps.Geocoder();
					var mapCenter = {  lat: ` + mapOptions.center.lat + `, lng: ` + mapOptions.center.lng + ` };
					var mapOptions = {
						zoom: 18,				//Still need to figure out how to pull this in dynamicly
						center: mapCenter,
						mapTypeControlOptions: {
							mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
						},
						scrollwheel: false,
					    mapTypeControl: false,
					    streetViewControl: false
					};

					var styles = ` + JSON.stringify( styles, null, 4 ) + `;


					function drawMap(){

						// Create a new StyledMapType object, passing it the array of styles,
						// as well as the name to be displayed on the map type control.
						var styledMap = new google.maps.StyledMapType(styles, {name: "Your Custom Map!!"});

						// Render the map
						var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);  // Change this to match your canvas id

						map.mapTypes.set('map_style', styledMap); 	// Creates the id for styledMap
						map.setMapTypeId('map_style');  			// Set the Map to be displayed
						// Add the marker to our existing map
						var marker = new google.maps.Marker({
							position: mapCenter,
							map: map,
							title: "",
							icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'// This is a link to an image, can be on any server 
						});
					}

					drawMap();
				`;

				console.log( code );
			});

		drawMap();

</script>






@stop