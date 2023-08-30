<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAdminRequest;
use Toastr;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidateAdminRequest;

class AdminController extends Controller
{
    public function index()
    {
        $search = request()->query('search');

        if (!$search)
            $datas = Admin::orderBy('id', 'DESC')->Paginate(15);
        else {
            $datas = Admin::where('first_name', 'LIKE', "%{$search}%")
                ->orWhere('first_name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('type', 'LIKE', "%{$search}%")
                ->orderBy('id', 'DESC')
                ->Paginate(15);
        }

        return view('user.Admin.admin-user', compact('datas'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $data = Admin::find($id);

        return view('user.Admin.admin-details', compact('data'));
    }


    public function edit($id)
    {
        $data = Admin::find($id);

        return view('user.Admin.admin-edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        DB::table('admins')->where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'profile_photo_path' => ( $request->hasFile('photo') ) ? uploadImage($request->file('photo'), 'adminImages') : null,
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        Toastr::info('Admin updated successfully');

        return redirect(route('admin.user'));
    }


    public function destroy($id)
    {

        DB::table('admins')->where('id', $id)->delete();

        Toastr::warning('Admin deleted');
        return redirect()->back();
    }
    public function addAdmin()
    {
        if (Auth::guard('web')->user()->type == 'super') {
            return view('user.Admin.add-admin');
        } else {
            Toastr::info('Admin is not authenticated');
            return redirect()->back();
        }

    }
    public function storeAdmin(AddAdminRequest $request)
    {
        $request->validated();
        DB::table('admins')->insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'profile_photo_path' => ( $request->hasFile('photo')) ? uploadImage($request->file('photo'), 'adminImages') : null,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        Toastr::success('Admin added successfully');
        return redirect(route('admin.user'));
    }

}
