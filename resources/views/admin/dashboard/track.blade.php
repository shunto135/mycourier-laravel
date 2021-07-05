{{--@php--}}
{{--	use App\Http\Controllers\UserController as service;--}}

{{--@endphp--}}
@inject('service', 'App\Http\Controllers\AdminController')
@extends('layouts.admin')
@section('content')
  <div class="container">
	<div class="row">
	  <div class="col-md-12">
		<!-- DATA TABLE --><br>
		<h3 class="title-5 m-b-35">Order List</h3>
		<div class="table-data__tool">
		  <div class="table-data__tool-left">
			<div class="rs-select2--light rs-select2--md">
			  <select class="js-select2" name="property">
				<option selected="selected">All Properties</option>
				<option value="">Option 1</option>
				<option value="">Option 2</option>
			  </select>
			  <div class="dropDownSelect2"></div>
			</div>
			<div class="rs-select2--light rs-select2--sm">
			  <select class="js-select2" name="time">
				<option selected="selected">Today</option>
				<option value="">3 Days</option>
				<option value="">1 Week</option>
			  </select>
			  <div class="dropDownSelect2"></div>
			</div>
			<button class="au-btn-filter">
			  <i class="zmdi zmdi-filter-list"></i>filters
			</button>
		  </div>
		  <div class="table-data__tool-right">
			<a class="au-btn au-btn-icon au-btn--green au-btn--small" href="{{route('user.order')}}">
			  <i class="zmdi zmdi-plus"></i>Request Order
			</a>
			<div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
			  <select class="js-select2" name="type">
				<option selected="selected">Export</option>
				<option value="">Option 1</option>
				<option value="">Option 2</option>
			  </select>
			  <div class="dropDownSelect2"></div>
			</div>
		  </div>
		</div>
		<div class="table-responsive table-responsive-data2">
		  <table class="table table-data2">
			<thead>
			<tr>
			  {{--			  <th>--}}
			  {{--				<label class="au-checkbox">--}}
			  {{--				  <input type="checkbox">--}}
			  {{--				  <span class="au-checkmark"></span>--}}
			  {{--				</label>--}}
			  {{--			  </th>--}}
			  <th>#Sl</th>
			  <th>Order No</th>
			  <th>Product Name</th>
			  <th>Size</th>
			  <th>Measurment</th>
			  <th>Status</th>
			  <th>Qty</th>
			</tr>
			</thead>
			<tbody>
			@foreach($orders as $index=>$order)
			  <tr class="tr-shadow">
				{{--					<td>--}}
				{{--					  <label class="au-checkbox">--}}
				{{--						<input type="checkbox">--}}
				{{--						<span class="au-checkmark"></span>--}}
				{{--					  </label>--}}
				{{--					</td>--}}
				<td>{{$index+1}}</td>
				<td>{{$order->order_no}}</td>
				<td class="desc">{{$order->name}}</td>
				<td>
				  {{$order->size}}
				</td>
				<td>
				  <div style="display: flex; flex-direction: column">
					<div>{{$order->height}} {{$service::getHeightUnitName($order->height_unit_id)}}</div>
					<div>{{$order->weight}} {{$service::getWeightUnitName($order->weight_unit_id)}}</div>
				  </div>
				</td>
				<td>
				  @if($order->order_status == 1) <strong class="text text-primary">[ {{$service::getOrderStatus($order->order_status)}} ]</strong>@endif
				  @if($order->order_status == 2)<strong class="text text-info">[ {{$service::getOrderStatus($order->order_status)}} ]</strong>@endif
				  @if($order->order_status == 3)<strong class="text text-success">[ {{$service::getOrderStatus($order->order_status)}} ]</strong>@endif
				  @if($order->order_status == 4)<strong class="text text-danger">[ {{$service::getOrderStatus($order->order_status)}} ]</strong>@endif
				</td>
				<td>{{$order->qty}}</td>
				<td>
				  <div class="table-data-feature">
					<button class="item" data-toggle="tooltip" data-placement="top" title="Send">
					  <i class="zmdi zmdi-mail-send"></i>
					</button>
					<a href="{{route('admin.order.edit',$order->orderId)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
					  <i class="zmdi zmdi-edit"></i>
					</a>
					<button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
					  <i class="zmdi zmdi-delete"></i>
					</button>
					<button class="item" data-toggle="tooltip" data-placement="top" title="More">
					  <i class="zmdi zmdi-more"></i>
					</button>
				  </div>
				</td>
			  </tr>
			@endforeach
			{{--			<tr class="spacer"></tr>--}}

			</tbody>
		  </table>
		</div>
		<!-- END DATA TABLE -->
	  </div>
	</div>
  </div>
@endsection
@section('script')
@endsection