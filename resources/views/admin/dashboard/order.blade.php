@php
  $status = array(
	  1=> 'Requested',
	  2=> 'On Delivery',
	  3=>'Delivered',
	  4=>'Canceled'
  );
@endphp
@inject('service', 'App\Http\Controllers\AdminController')
@extends('layouts.admin')
@section('content')
  <div class="main-content">
	<div class="section__content section__content--p30">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
			<div class="card">
			  <div class="card-header d-flex justify-content-between">
				<div>
				  Order Information
				  @if($data[0]->order_status == 1) <strong
					  class="text text-primary">[ {{$service::getOrderStatus($data[0]->order_status)}} ]</strong>@endif
				  @if($data[0]->order_status == 2)<strong
					  class="text text-info">[ {{$service::getOrderStatus($data[0]->order_status)}} ]</strong>@endif
				  @if($data[0]->order_status == 3)<strong
					  class="text text-success">[ {{$service::getOrderStatus($data[0]->order_status)}} ]</strong>@endif
				  @if($data[0]->order_status == 4)<strong
					  class="text text-danger">[ {{$service::getOrderStatus($data[0]->order_status)}} ]</strong>@endif
				</div>
				<div class="row d-flex justify-content-end">
				  <form action="{{route('admin.order.update',$order)}}" method="post" enctype="multipart/form-data"
						class="form-horizontal">
					@csrf
					@method('PUT')
					<div class="d-flex justify-content-between">
					  <select class="form-control ml-1 mr-1" id="status_id" name="status_id">
						<option>Status</option>
						@foreach($status as $key=>$value)
						  <option value="{{$key}}">{{$value}}</option>
						@endforeach
					  </select>
					  <button class="btn btn-outline-success ml-1 mr-1" type="submit">Update</button>
					</div>
				  </form>
				</div>
			  </div>
			  <div class="card-body card-block">
				<div class="row form-group">
				  <div class="col col-md-3">
					<label class=" form-control-label">Order No : </label>
				  </div>
				  <div class="col-12 col-md-9">
					<p class="form-control-static" id="p_name">{{$data[0]->orderNo}}</p>
				  </div>
				</div>

				<div class="row form-group">
				  <div class="col col-md-3">
					<label class=" form-control-label">Size:</label>
				  </div>
				  <div class="col-12 col-md-9">
					<p class="form-control-static" id="p_size">{{$data[0]->size}}</p>
				  </div>
				</div>
				<div class="row form-group">
				  <div class="col col-md-3">
					<label class=" form-control-label">Height</label>
				  </div>
				  <div class="col-12 col-md-9" style="display: flex">
					<p class="form-control-static" style="padding-right: 5px" id="p_height">{{$data[0]->height}}</p>
					<p class="form-control-static"
					   id="p_height_id">{{$service::getHeightUnitName($data[0]->height_unit_id)}}</p>
				  </div>
				</div>
				<div class="row form-group">
				  <div class="col col-md-3">
					<label class=" form-control-label">Weight</label>
				  </div>
				  <div class="col-12 col-md-9" style="display: flex">
					<p class="form-control-static" style="padding-right: 5px" id="p_weight">{{$data[0]->weight}}</p>
					<p class="form-control-static"
					   id="p_weight_id">{{$service::getHeightUnitName($data[0]->weight_unit_id)}}</p>
				  </div>
				</div>
				<div class="row form-group">
				  <div class="col col-md-3">
					<label class=" form-control-label">Quantity</label>
				  </div>
				  <div class="col-12 col-md-9">
					<p class="form-control-static" id="p_qty">{{$data[0]->qty}}</p>
				  </div>
				</div>
				<div class="row form-group">
				  <div class="col col-md-3">
					<label class=" form-control-label">Zone</label>
				  </div>
				  <div class="col-12 col-md-9">
					<p class="form-control-static"
					   id="p_delivery_zone">{{$service::getDeliveryZone($data[0]->delivery_zone)}}</p>
				  </div>
				</div>
				<div class="row form-group">
				  <div class="col col-md-3">
					<label class=" form-control-label">Address</label>
				  </div>
				  <div class="col-12 col-md-9">
					<p class="form-control-static" id="p_delivery_address">{{$data[0]->delivery_address}}</p>
				  </div>
				</div>
				<div class="row form-group">
				  <div class="col col-md-3">
					<label class=" form-control-label">Description:</label>
				  </div>
				  <div class="col-12 col-md-9">
					<p class="form-control-static" id="p_delivery_address">{{$data[0]->description}}</p>
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
	</div>
  </div>
@endsection
@section('script')

@endsection