<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Shared\GlobalService as utility;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
	//
	public function __construct()
	{
		$this->middleware('role:customer');
	}

	public function index()
	{
		# code...
		return view('user.dashboard.index');
	}

	public function profile()
	{
		return view('user.dashboard.profile');
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

	public function order()
	{
		$zoneList = utility::getZoneList();
		return view('user.dashboard.order', compact('zoneList'));
	}

	public function requestOrder(Request $request)
	{
		$uow = null;
		$user = auth()->user();
		$userInfo = UserInfo::findOrFail($user->id);
		$validateData = $request->validate([
			'name' => 'required',
			'category_Id' => 'required',
			'size' => 'required',
			'height' => 'required',
			'height_unit_id' => 'required',
			'weight' => 'required',
			'weight_unit_id' => 'required',
			'qty' => 'required',
			'delivery_zone' => 'required',
			'delivery_address' => 'required',
			'description' => 'max:500'
		]);

		if ($validateData) {
			DB::beginTransaction();
			try {
				$latestIndex = utility::getLatestId('orders');
				$product = new Product();
				$product->name = $request->name;
				$product->category_Id = $request->category_Id;
				$product->size = $request->size;
				$product->height = $request->height;
				$product->height_unit_id = $request->height_unit_id;
				$product->weight = $request->weight;
				$product->weight_unit_id = $request->weight_unit_id;
				$product->qty = $request->qty;
				$product->delivery_zone = $request->delivery_zone;
				$product->delivery_address = $request->delivery_address;
				$product->description = $request->description;
				$product->order_status = 1;
				$product->save();
				$order = new Order();
				$order->order_no = '#MCO' . str_pad($latestIndex, 4, "0", STR_PAD_LEFT);
				$order->product_id = $product->id;
				$order->user_id = $user->id;
				$order->employee_id = 3;
				$order->is_requested = 1;
				$order->save();
				//dd($product . '' . $order);
				DB::commit();
				$notification = array(
					'message' => 'Order Requested has been updated',
					'alert-type' => 'success'
				);

			} catch (\Exception $exception) {
				DB::rollback();
//				return response()->json(['error' => $exception->getMessage()], 500);
				$notification = array(
					'message' => $exception->getMessage(),
					'alert-type' => 'error'
				);
			}
		}
		return redirect()->back()->with($notification);
	}

	public function trackOrder()
	{
		$user = auth()->user();
		$orders = Order::join('products', 'product_id', '=', 'products.id')
			->select(['orders.id as orderId','orders.order_no','orders.order_status', 'products.*'])
			->where('user_id', '=', $user->id)
			->get();
		//die($orders);
		return view('user.dashboard.track', compact('orders'));
	}

	public function viewOrder($id)
	{
		/**
		 * Joining always return a collection
		 **/
		//dd((int)$id);
		$order = Order::findOrFail($id);


		$data = Order::join('products', 'product_id', '=', 'products.id')
			->select(['orders.id as orderId',
				'orders.order_no as orderNo',
				'orders.order_status as order_status',
				'products.*'])
			->where('orders.id', $id)
			->get();
//		dd($data);
//
//		dd($data);
		return view('user.dashboard.orderView',compact('data','order'));
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


}
