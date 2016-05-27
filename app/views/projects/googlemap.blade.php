@extends('layouts.master')

@section('top-script')
	<style type="text/css">
		#main{
			width: 100%;
		}
		h1{
			font-size: 20px;
		}
		#your_map{
			margin: 0;
			padding: 0;
			width: 60vw;
			height: 60vw;
		}

		#demo{
			/*height: 50px;*/
			/*width: 50px;*/
		}

	</style>
@stop



@section('content')
<div id="demo"></div>

<h1>Customize your map!</h1>
<div class="left-row">
	<div id="your_map" class="col"></div>
	<div class="col">
		<input id="geo_address" placeholder="newadress"></input>
		<button id="geo_code">geo</button>
	</div>
</div>




@stop

@section('bottom-script')
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
				{ saturation: 60 }
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
		    document.getElementById('geo_code').addEventListener('click', function(){
		    	geocoder.geocode({ "address": document.getElementById('geo_address').value }, function(results, status) {
		           if (status == google.maps.GeocoderStatus.OK) {
		               // map.setCenter(results[0].geometry.location);
		               mapOptions.center.lat = results[0].geometry.location.lat();
		               mapOptions.center.lng = results[0].geometry.location.lng();
		               drawMap();
		               for( var i=0; i<results.length; i++){
		               	console.log( results[i].geometry.location.lat() );
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

	</script>

	<script>
var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude; 
}
getLocation(); 
</script>

@stop