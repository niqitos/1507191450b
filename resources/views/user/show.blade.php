@extends('layouts.app')

@section('title', 'address ::: user office ::: foodclub')

@section('content')
	<div class="center_box cb">
		<div class="uo_tabs cf">
			<a href="#"><span>profile</a>
			<a href="#"><span>Reviews</span></a>
			<a href="#"><span>orders</span></a>
			<a href="#" class="active"><span>My Address</span></a>
			<a href="#"><span>Settings</span></a>
		</div>
		<div class="page_content bg_gray">
			<div class="uo_header">
				<div class="wrapper cf">
					<div class="wbox ava">
						<figure><img src="{{ asset('imgc/user_ava_1_140.jpg') }}" alt="Helena Afrassiabi" /></figure>
					</div>
					<div class="main_info">
						<h1>{{ $user->name }}</h1>
						<div class="midbox">
							<h4>560 points</h4>
							<div class="info_nav">
								<a href="#">Get Free Points</a>
								<span class="sepor"></span>
								<a href="#">Win iPad</a>
							</div>
						</div>
						<div class="stat">
							<div class="item">
								<div class="num">30</div>
								<div class="title">total orders</div>
							</div>
							<div class="item">
								<div class="num">14</div>
								<div class="title">total reviews</div>
							</div>
							<div class="item">
								<div class="num">0</div>
								<div class="title">total gifts</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="uo_body">
				<div class="wrapper">
					<div class="uofb cf">
						<div class="l_col adrs">
							<h2>Add New Address</h2>

							@if ($errors->any())
								<div class="alert alert-danger">
									<ul>
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							@endif
							
							<form action="{{ route('user.address.store', auth()->id()) }}" method="POST">
								@csrf

								<div class="field">
									<label>Name *</label>
									<input type="text" name="name" value="" palceholder="" class="vl_empty" />
								</div>
								<div class="field">
									<label>Your city *</label>
									<select name="city_id" class="vl_empty">
										<option class="plh"></option>
										@foreach ($cities as $key => $city)
											<option value="{{ $key }}">{{ $city }}</option>
										@endforeach
									</select>
								</div>
								<div class="field">
									<label>Your area *</label>
									<select name="area_id">
										<option class="plh"></option>
										@foreach ($areas as $key => $area)
											<option value="{{ $key }}">{{ $area }}</option>
										@endforeach
									</select>
								</div>
								
								<div class="field">
									<label>Street</label>
									<input type="text" name="street" value="" palceholder="" class="vl_empty" />
								</div>
								<div class="field">
									<label>House # </label>
									<input type="text" name="house" value="" palceholder="House Name / Number" />
								</div>
								
								<div class="field">
									<label class="pos_top">Additional information</label>
									<textarea name="additional_info"></textarea>
								</div>
								
								<div class="field">
									<input type="submit" value="add address" class="green_btn" />
								</div>
							</form>
						</div>
						
						<div class="r_col">
							<h2>My Addresses</h2>									
							
							<div class="uo_adr_list">
								@forelse ($user->addresses as $address)
									<div class="item">
										<h3>{{ $address->name }}</h3>
										<p>
											{{ $address->city->name . ', ' . $address->area->name . ', ' . $address->street . ', ' . $address->house }}<br>
											{{ $address->additional_info }}
										</p>
										<div class="actbox">
											<a href="#" class="bcross"></a>
										</div>
										<div id="map"></div>
									</div>
								@empty
									<p>No addresses yet</p>
								@endforelse										
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script>
		function initialize() {
		var address = 'Zurich, Ch';

		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			'address': address
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			var Lat = results[0].geometry.location.lat();
			var Lng = results[0].geometry.location.lng();
			var myOptions = {
				zoom: 11,
				center: new google.maps.LatLng(Lat, Lng)
			};
			var map = new google.maps.Map(
				document.getElementById("map_canvas"), myOptions);
			} else {
			alert("Something got wrong " + status);
			}
		});
		}
		google.maps.event.addDomListener(window, "load", initialize);
	</script>
	<!--Load the API from the specified URL
	* The async attribute allows the browser to render the page while the API loads
	* The key parameter will contain your own API key (which is not needed for this tutorial)
	* The callback parameter executes the initMap() function
	-->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googleApiKey') }}&callback=initMap">
</script>
@endsection