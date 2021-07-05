<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Shared\GlobalService as utility;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('role:admin');
	}

	//
	public function index()
	{
		# code...
		return view('admin.dashboard.index');
	}

	public function profile()
	{
		return view('admin.dashboard.profile');
	}

	public function updateProfile(Request $request)
	{
		$user = auth()->user();
		$userInfo = UserInfo::findOrFail($user->id);
		$validateData = $request->validate([
			'name' => 'required',
			'email' => ['required', 'email', 'unique:users,email,' . $user->id],
			'mobile_no' => ['required', 'max:11'],
			'nid_no' => ['required', 'min:10', 'max:13']
		]);

		DB::beginTransaction();      // Creating A Transaction
		try {
			$user->name = $request->name;
			$user->email = $request->email;

			$userInfo->mobile_no = $request->mobile_no;
			$userInfo->nid_no = $request->nid_no;
			$userInfo->area = $request->area;
			$userInfo->thana = $request->thana;
			$userInfo->address = $request->address;
			$image = $request->image;
			if ($image) {
				$imagePath = public_path('user_img/');

				$imageName = $userInfo->mobile_no . '_img.' . $image->getClientOriginalExtension();
				Image::make($image)->resize(300, 300)->save($imagePath . $imageName);
				$user->image_url = $imageName;
			}

			$user->update();
			$userInfo->update();
			DB::commit();
			$notification = array(
				'message' => 'Profile has been updated',
				'alert-type' => 'success'
			);
		} catch (\Exception $exception) {
			DB::rollback();
			return response()->json(['error' => $exception->getMessage()], 500);
		}

		return redirect()->back()->with($notification);
	}

	public function orderHistory()
	{
		$orders = Order::join('products', 'product_id', '=', 'products.id')
			->select(['orders.id as orderId',
				'orders.order_no as orderNo',
				'orders.order_status as order_status',
				'products.*'])
			->get();
		return view('admin.dashboard.track', compact('orders'));
	}

	public function editOrder(Order $order)
	{
		/**
		 * Joining always return a collection
		 **/
		$data = Order::join('products', 'product_id', '=', 'products.id')
			->select(['orders.id as orderId',
				'orders.order_no as orderNo',
				'orders.order_status as order_status',
				'products.*'])
			->where('orders.id', $order->id)
			->get();
		//dd($orderStatus);

		//dd($data);
		return view('admin.dashboard.order', compact('order', 'data'));
	}

	public function updateOrderStatus(Order $order, Request $request)
	{
		$model = Order::findOrFail($order->id);
		DB::beginTransaction();
		try {
			$model->order_status = $request->status_id;
			$model->save();
			DB::commit();
			$notification = array(
				'message' => 'Status updated successfully',
				'alert-type' => 'success'
			);
		} catch (\Exception $exception) {
			DB::rollback();
//		return response()->json(['error' => $exception->getMessage()], 500);
			$notification = array(
				'message' => $exception->getMessage(),
				'alert-type' => 'error'
			);
		}
		return redirect()->back()->with($notification);
	}

	public static function getHeightUnitName($id)
	{
		$heightUnits = utility::getHeightUnit();
		foreach ($heightUnits as $unit) {
			if ($unit['id'] == $id) echo $unit['unitName'];
		}
	}

	public static function getWeightUnitName($id)
	{
		$weightUnits = utility::getWeightUnit();
		foreach ($weightUnits as $unit) {
			if ($unit['id'] == $id) echo $unit['unitName'];
		}
	}

	public static function getDeliveryZone($id)
	{
		$zoneList = utility::getZoneList();
		foreach ($zoneList as $key => $value) {
			if ($key == $id) echo $value;
		}
	}

	public static function getOrderStatus($id)
	{
		$orderList = utility::getStatusList();
		foreach ($orderList as $order) {
			if ($order['id'] == $id) echo $order['statusName'];
		}
	}

	public static function getStatusColor($id)
	{
		$orderList = utility::getStatusList();
		foreach ($orderList as $order) {
			if ($order['id'] == $id) echo $order['color'];
		}
	}
}
