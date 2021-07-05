@extends('layouts.employee')
@section('content')
  <div class="main-content">
	<div class="section__content section__content--p30">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-8 col-md-6 col-sm-12">
			<div class="card">
			  <div class="card-header">
				<strong>{{Auth::user()->name}}'s</strong>
				<small> Information </small>
			  </div>
			  <form method="post" action="{{route('employee.updateProfile')}}" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="card-body card-block">
				  <div class="form-group">
					<label for="company" class=" form-control-label">Name</label>
					<input type="text" placeholder="Your Name" class="form-control" name="name"
						   id="name"
						   value="{{ auth()->user()->name  ? auth()->user()->name  : old('name')}}">
					@error('name')
					<small class="text text-danger" role="alert">
					  <strong>{{ $message }}</strong>
					</small>
					@enderror
				  </div>
				  <div class="form-group">
					<label for="vat" class=" form-control-label">Email</label>
					<input type="text" placeholder="@mail.com" class="form-control" name="email"
						   id="email"
						   value="{{ auth()->user()->email  ? auth()->user()->email  : old('email')}}">
					@error('email')
					<small class="text text-danger" role="alert">
					  <strong>{{ $message }}</strong>
					</small>
					@enderror
				  </div>
				  <div class="form-group">
					<label for="street" class=" form-control-label">Mobile No.</label>
					<input type="text" placeholder="Mobile No." class="form-control"
						   name="mobile_no" id="mobile_no"
						   value="{{auth()->user()->userInfo->mobile_no ? auth()->user()->userInfo->mobile_no : old('mobile_no')}}">
					@error('mobile_no')
					<small class="text text-danger" role="alert">
					  <strong>{{ $message }}</strong>
					</small>
					@enderror
				  </div>
				  <div class="form-group">
					<label for="street" class=" form-control-label">NID No.</label>
					<input type="text" placeholder="NID No." class="form-control" name="nid_no"
						   id="nid_no"
						   value="{{ auth()->user()->userInfo->nid_no  ? auth()->user()->userInfo->nid_no  : old('nid_no')}} ">
					@error('nid_no')
					<small class="text text-danger" role="alert">
					  <strong>{{ $message }}</strong>
					</small>
					@enderror
				  </div>
				  <div class="row form-group">
					<div class="col-6">
					  <div class="form-group">
						<label for="city" class=" form-control-label">Area</label>
						<input type="text" placeholder="Your Area" class="form-control"
							   name="area" id="area"
							   value="{{ auth()->user()->userInfo->area  ? auth()->user()->userInfo->area  : old('area')}}">
						@error('area')
						<small class="text text-danger" role="alert">
						  <strong>{{ $message }}</strong>
						</small>
						@enderror
					  </div>
					</div>
					<div class="col-6">
					  <div class="form-group">
						<label for="postal-code" class=" form-control-label">Thana</label>
						<input type="text" placeholder="Nearby Thana" class="form-control"
							   name="thana" id="thana"
							   value="{{ auth()->user()->userInfo->thana ? auth()->user()->userInfo->thana : old('thana') }}">
						@error('thana')
						<small class="text text-danger" role="alert">
						  <strong>{{ $message }}</strong>
						</small>
						@enderror
					  </div>
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-12">
					  <div class="form-group">
						<label for="postal-code" class=" form-control-label">Thana</label>
						<textarea type="text" placeholder="address" class="form-control"
								  name="address"
								  id="address">{{auth()->user()->userInfo->address ? auth()->user()->userInfo->address : old('address')}}</textarea>
					  </div>
					</div>
				  </div>
				  <div class="col-6">
					<div class="form-group">
					  <label for="postal-code" class=" form-control-label">Profile Image</label><br>
					  <input type="file" id="image" name="image" accept=".png, .jpg, .jpeg" onchange="readURL(this)">
					  <span class="custom-file-control"></span>
					  <img src="#" id="one" alt="">
					</div>
				  </div>
				</div>
				<div class="card-footer">
				  <button type="submit" class="btn btn-primary btn-sm">
					<i class="fa fa-dot-circle-o"></i> Submit
				  </button>
				</div>
			  </form>
			</div>
		  </div>

		  {{--                     View Card--}}
		  <div class="col-lg-4 col-md-6 col-sm-12">
			<div class="card">
			  <div class="card-body">
				<div class="mx-auto d-block">
				  <img class="rounded-circle mx-auto d-block"
					   src="{{Auth::user()->image_url ? asset('user_img/'.Auth::user()->image_url):asset('images/avatar/icon/avatar-02.jpg') }}" alt="Card image cap">
				  <h5 class="text-sm-center mt-2 mb-1">{{Auth::user()->name}}</h5>
				  <div class="location text-sm-center">
					<i
						class="fas fa-map-marker-alt pr-1"></i> {{Auth::user()->userInfo->address ?  Auth::user()->userInfo->address : ' --- ' }}
				  </div>
				</div>
				<hr>
				<div class="card-text text-sm-center">
				  <a href="#">
					<i class="fab fa-facebook-f pr-1"></i>
				  </a>
				  <a href="#">
					<i class="fab fa-twitter pr-1"></i>
				  </a>
				  <a href="#">
					<i class="fab fa-linkedin pr-1"></i>
				  </a>
				  <a href="#">
					<i class="fab fa-pinterest pr-1"></i>
				  </a>
				</div>
			  </div>
			  <div class="card-footer  text-center"></div>
			  <div class="card-body text-center ">
				<p class="card-text"><b>Email: </b>{{Auth::user()->email}}</p>
				<p class="card-text"><b>Mobile
					No: </b> {{Auth::user()->userInfo->mobile_no ?  Auth::user()->userInfo->mobile_no : ' --- ' }}
				</p>
				<p class="card-text"><b>Nid
					No: </b> {{Auth::user()->userInfo->nid_no ?  Auth::user()->userInfo->nid_no : ' --- ' }}
				</p>
				<p class="card-text"><b>Area
					Zone: </b> {{Auth::user()->userInfo->area ?  Auth::user()->userInfo->area : ' --- ' }}
				</p>
				<p class="card-text"><b>Nearby Police
					Station: </b> {{Auth::user()->userInfo->thana ?  Auth::user()->userInfo->thana : ' --- ' }}
				</p>

			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>

@endsection
@section('script')
  <script type="text/javascript">
      function readURL(input){
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                  $('#one')
                      .attr('src', e.target.result)
                      .width(80)
                      .height(80);
              };
              reader.readAsDataURL(input.files[0]);
          }
      }
  </script>
@endsection
