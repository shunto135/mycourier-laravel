@extends('layouts.user')
@section('content')
  <div class="container"><br>
	<div class="row">
	  <div class="col-lg-8">
		<div class="card">
		  <div class="card-header">
			<strong>Request </strong> For Delivery
		  </div>
		  <form action="{{route('user.requestOrder')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
			@csrf
			@method('PUT')
			<div class="card-body card-block">

			  <div class="row form-group">
				<div class="col col-md-3">
				  <label for="name" class=" form-control-label">Product Name</label>
				</div>
				<div class="col-12 col-md-9">
				  <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="Product name" class="form-control">
				  @error('name')
				  <small class="text text-danger" role="alert">
					<strong>{{ $message }}</strong>
				  </small>
				  @enderror
				</div>
			  </div>
			  <div class="row form-group">
				<div class="col col-md-3">
				  <label for="categoryId" class=" form-control-label">Product Category</label>
				</div>
				<div class="col-12 col-md-9">
				  <select name="category_Id" id="category_Id" class="form-control">
					<option value="">Please select</option>
					<option value="1">Soft</option>
					<option value="2">Hard</option>
					<option value="3">Fragile</option>
				  </select>
				  @error('categoryId')
				  <small class="text text-danger" role="alert">
					<strong>{{ $message }}</strong>
				  </small>
				  @enderror
				</div>
			  </div>
			  <div class="row form-group">
				<div class="col col-md-3">
				  <label for="size" class=" form-control-label">Product Size</label>
				</div>
				<div class="col-12 col-md-9">
				  <select name="size" id="size" class="form-control">
					<option value="">Please select</option>
					<option value="xs">Extra Small</option>
					<option value="s">Small</option>
					<option value="m">Medium</option>
					<option value="l">Large</option>
					<option value="xl">Extra Large</option>
				  </select>
				  @error('size')
				  <small class="text text-danger" role="alert">
					<strong>{{ $message }}</strong>
				  </small>
				  @enderror
				</div>
			  </div>
			  <div class="row form-group">
				<div class="col col-md-3">
				  <label for="height_unit_id" class=" form-control-label">Height</label>
				</div>
				<div class="col-12 col-md-9">
				  <div class="row">
					<div class="col-6">
					  <select name="height_unit_id" id="height_unit_id" class="form-control">
						<option value="">Please select Unit</option>
						<option value="1">Inch</option>
						<option value="2">Centimeter</option>
						<option value="3">Meter</option>
						<option value="4">Feet</option>
					  </select>
					  @error('height_unit_id')
					  <small class="text text-danger" role="alert">
						<strong>{{ $message }}</strong>
					  </small>
					  @enderror
					</div>
					<div class="col-6">
					  <input  type="number" min="0" id="height" name="height" value="{{old('height')}}" placeholder="Height" class="form-control">
					  @error('height')
					  <small class="text text-danger" role="alert">
						<strong>{{ $message }}</strong>
					  </small>
					  @enderror
					</div>
				  </div>
				</div>
			  </div>
			  <div class="row form-group">
				<div class="col col-md-3">
				  <label for="weight_unit_id" class=" form-control-label">Weight</label>
				</div>
				<div class="col-12 col-md-9">
				  <div class="row">
					<div class="col-6">
					  <select name="weight_unit_id" id="weight_unit_id" class="form-control">
						<option value="">Please select Unit</option>
						<option value="1">Gram</option>
						<option value="2">Kilogram</option>
						<option value="3">Pound</option>
						<option value="4">Ton</option>
					  </select>
					  @error('weight_unit_id')
					  <small class="text text-danger" role="alert">
						<strong>{{ $message }}</strong>
					  </small>
					  @enderror
					</div>
					<div class="col-6">
					  <input  type="number" min="0" id="weight" name="weight" value="{{old('weight')}}" placeholder="Weight" class="form-control">
					  @error('weight')
					  <small class="text text-danger" role="alert">
						<strong>{{ $message }}</strong>
					  </small>
					  @enderror
					</div>
				  </div>
				</div>
			  </div>

			  <div class="row form-group">
				<div class="col col-md-3">
				  <label for="qty" class=" form-control-label">Quantity</label>
				</div>
				<div class="col-12 col-md-9">
				  <input id="qty" type="number" min="1" name="qty" value="{{old('qty')}}" placeholder="Select amount" class="form-control">
				  @error('qty')
				  <small class="text text-danger" role="alert">
					<strong>{{ $message }}</strong>
				  </small>
				  @enderror
				</div>
			  </div>
			  <div class="row form-group">
				<div class="col col-md-3">
				  <label for="delivery_zone" class=" form-control-label">Delivery Zone</label>
				</div>
				<div class="col-12 col-md-9">
				  <select name="delivery_zone" id="delivery_zone" class="form-control">
					<option value="">Please select</option>
					@foreach($zoneList as $key=>$value){
					<option value="{{$key}}">{{$value}}</option>
					}
					@endforeach
				  </select>
				  @error('delivery_zone')
				  <small class="text text-danger" role="alert">
					<strong>{{ $message }}</strong>
				  </small>
				  @enderror
				</div>
			  </div>
			  <div class="row form-group">
				<div class="col col-md-3">
				  <label for="delivery_address" class=" form-control-label">Address</label>
				</div>
				<div class="col-12 col-md-9">
				  <textarea name="delivery_address" id="delivery_address" rows="2"	placeholder="Enter Delivery Address..." class="form-control">{{old('delivery_address')}}</textarea>
				  @error('delivery_address')
				  <small class="text text-danger" role="alert">
					<strong>{{ $message }}</strong>
				  </small>
				  @enderror
				</div>
			  </div>
			  <div class="row form-group">
				<div class="col col-md-3">
				  <label for="description" class=" form-control-label">Product Description</label>
				</div>
				<div class="col-12 col-md-9">
				  <textarea name="description" id="description" rows="4"  placeholder="Product Description ..."	class="form-control">{{ old('description') }}</textarea>
				  @error('description')
				  <small class="text text-danger" role="alert">
					<strong>{{ $message }}</strong>
				  </small>
				  @enderror
				</div>
			  </div>
			</div>
			<div class="card-footer">
			 	<div class="float-right" style="padding-bottom: 10px">
				  <button type="submit" class="btn btn-primary btn-sm">
					<i class="fa fa-dot-circle-o"></i> Request
				  </button>
				  <button type="reset" class="btn btn-danger btn-sm" onclick="resetForm()">
					<i class="fa fa-ban"></i> Reset
				  </button>
				</div>
			</div>
		  </form>
		</div>
	  </div>
	  <!---- Order Information Show ---->
	  <div class="col-lg-4">
		<div class="card">
		  <div class="card-header">
			<strong>Order</strong> Information
		  </div>
		  <div class="card-body card-block">
            <div class="row form-group">
              <div class="col col-md-3">
                <label class=" form-control-label">Name</label>
              </div>
              <div class="col-12 col-md-9">
                <p class="form-control-static" id="p_name"></p>
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-3">
                <label class=" form-control-label">Category</label>
              </div>
              <div class="col-12 col-md-9">
                <p class="form-control-static" id="p_category_Id"></p>
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-3">
                <label class=" form-control-label">Size</label>
              </div>
              <div class="col-12 col-md-9">
                <p class="form-control-static" id="p_size"></p>
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-3">
                <label class=" form-control-label">Height</label>
              </div>
              <div class="col-12 col-md-9" style="display: flex">
                <p class="form-control-static" style="padding-right: 5px" id="p_height"></p>
                <p class="form-control-static" id="p_height_id"></p>
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-3">
                <label class=" form-control-label">Weight</label>
              </div>
              <div class="col-12 col-md-9" style="display: flex">
                <p class="form-control-static" style="padding-right: 5px" id="p_weight"></p>
                <p class="form-control-static" id="p_weight_id"></p>
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-3">
                <label class=" form-control-label">Quantity</label>
              </div>
              <div class="col-12 col-md-9">
                <p class="form-control-static" id="p_qty"></p>
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-3">
                <label class=" form-control-label">Zone</label>
              </div>
              <div class="col-12 col-md-9">
                <p class="form-control-static" id="p_delivery_zone"></p>
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-3">
                <label class=" form-control-label">Address</label>
              </div>
              <div class="col-12 col-md-9">
                <p class="form-control-static" id="p_delivery_address"></p>
              </div>
            </div>
          </div>
		  <div class="card-footer">
				<strong>N:B: </strong>Order should be delivered within 1-2 working days
		  </div>
		</div>
	  </div>
	</div>
  </div>
@endsection
@section('script')
  <script>
	let name= document.getElementById('name');
	name.onkeyup = function (){
	    document.getElementById('p_name').innerHTML = name.value;
	}
	let category = document.getElementById('category_Id');
	category.onchange = function (){
        document.getElementById('p_category_Id').innerHTML =  category.options[category.selectedIndex].text;
    }

    let size= document.getElementById('size');
    size.onchange = function (){
        document.getElementById('p_size').innerHTML =  size.options[size.selectedIndex].text;
    }

    let height_unit = document.getElementById('height_unit_id');
    let height = document.getElementById('height');
    height_unit.onchange = function (){
        document.getElementById('p_height_id').innerHTML  =  height_unit.options[height_unit.selectedIndex].text;
    }
    height.onkeyup = function (){
        document.getElementById('p_height').innerHTML = height.value ;
	}


    let weight_unit = document.getElementById('weight_unit_id');
    let weight = document.getElementById('weight');

    weight_unit.onchange = function (){
        document.getElementById('p_weight_id').innerHTML =  weight_unit.options[weight_unit.selectedIndex].text;
    }
    weight.onkeyup = function (){
        document.getElementById('p_weight').innerHTML = weight.value ;
    }

    let qty= document.getElementById('qty');
    qty.onkeyup = function (){
        document.getElementById('p_qty').innerHTML = qty.value;
    }

    let deliveryZone = document.getElementById('delivery_zone');
    deliveryZone.onchange = function (){
        document.getElementById('p_delivery_zone').innerHTML =  deliveryZone.options[deliveryZone.selectedIndex].text;
    }

    let deliveryAddress= document.getElementById('delivery_address');
    deliveryAddress.onkeyup = function (){
        document.getElementById('p_delivery_address').innerHTML = deliveryAddress.value;
    }

	function resetForm(){
        document.getElementById('name').value=null;
        document.getElementById('categoryId').value = '';
        document.getElementById('size').value=null;
        document.getElementById('height_unit_id').value = '';
        document.getElementById('height').value=null;
        document.getElementById('weight_unit_id').value = '';
        document.getElementById('weight').value=null;
        document.getElementById('qty').value=null;
        document.getElementById('delivery_zone').value = '';
        document.getElementById('delivery_address').innerHTML=null;
        document.getElementById('description').innerHTML=null;

        document.getElementById('p_name').innerHTML = null;
        document.getElementById('p_category_Id').innerHTML = null;
        document.getElementById('p_size').innerHTML = null;
        document.getElementById('p_height_id').innerHTML = null;
        document.getElementById('p_height').innerHTML = null;
        document.getElementById('p_weight_id').innerHTML = null;
        document.getElementById('p_weight').innerHTML = null;
        document.getElementById('p_qty').innerHTML = null;
        document.getElementById('p_delivery_zone').innerHTML = null;
        document.getElementById('p_delivery_address').innerHTML = null;
	}
  </script>
@endsection