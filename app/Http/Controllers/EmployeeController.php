<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
	public function __construct()
	{
		$this->middleware('role:employee');
	}

	//
	public function index()
	{
		# code...
		return view('employee.dashboard.index');
	}

	public function profile()
	{
		return view('employee.dashboard.profile');
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
}
