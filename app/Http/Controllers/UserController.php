<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidateAddUserRequest;

class UserController extends Controller
{
  public function index()
  {
    return view('user.manage-user');
  }
  public function create()
  {

    $datas = DB::table('roles')->where('status', 1)->get();

    return view('user.add-user', compact('datas'));
  }
  public function store(ValidateAddUserRequest $request)
  {
    $request->validated();
    $roleId = roleIdByRoleName($request->type_id);

    $commonData = [
      'role_id' => $roleId,
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'phone' => $request->phone,
      'password' => Hash::make($request->password),
      'profile_photo_path' => uploadImage($request->file('user-photo'), 'usersImages'),
      'full_name' => $request->first_name . ' ' . $request->last_name,
      'created_at' => Carbon::now()->toDateTimeString()
    ];
    if ($request->type_id != 'driver') {
      $user_id = DB::table('users')->insertGetId($commonData);
      DB::table('vehicle_owner_details')->insert([
        'v_owner_id' => $user_id,
        'present_address' => $request->present_address,
        'permanent_address' => $request->permanent_address,
        'dob' => Carbon::parse($request->dob)->format('Y-m-d'),
        'created_at' => Carbon::now()->toDateTimeString()

      ]);

      Toastr::success('User Added Successfully');

      return redirect(route('owner'));
    } else {
      $user_id = DB::table('users')->insertGetId($commonData);
      DB::table('driver_details')->insert([
        'driver_id' => $user_id,
        'nid' => $request->nid,
        'licence_no' => $request->licence_number,
        'licence_copy_front' => uploadImage($request->file('lcf'), 'driver-licence-images'),
        'licence_copy_back' => uploadImage($request->file('lcb'), 'driver-licence-images'),
        'present_address' => $request->present_address,
        'permanent_address' => $request->permanent_address,
        'dob' => Carbon::parse($request->dob)->format('Y-m-d'),
        'created_at' => Carbon::now()->toDateTimeString()
      ]);

    Toastr::success('Driver Added Successfully');

      return redirect(route('driver'));
    }

  }
  public function changeDriverStatus(Request $request, $id)
  {

    try {
      $key = $request->key;
      $value = $request->value;
      $table = $request->table;

      DB::table($table)->where('id', $id)->update([$key => $value, 'updated_at' => date('Y-m-d H:i:s')]);

      return response()->json([
        'status' => 'success',
        'message' => 'Status changed successfully'
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong'
      ], 500);
    }
  }

}
