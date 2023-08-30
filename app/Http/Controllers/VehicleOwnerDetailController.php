<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOwnerInfoRequest;
use Illuminate\Support\Facades\Hash;
use Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\VehicleOwnerDetail;
use Illuminate\Support\Facades\DB;

class VehicleOwnerDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *1w`
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $datas = VehicleOwnerDetail::with('owner');

        $search = request()->query('search');

        if ($search) {
            $datas = $datas->whereHas('owner', function ($query) use ($search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })->orWhere('present_address', 'like', "%{$search}%")
                ->orWhere('permanent_address', 'like', "%{$search}%")
                ->orWhere('dob', 'like', "%{$search}%");
        }

        $datas = $datas->orderBy('id', 'DESC')->Paginate(15);

        return view('user.Owner.owner', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }


    public function show($id)
    {
        $data = VehicleOwnerDetail::with('owner')->find($id);
        return view('user.Owner.owner-details', compact('data'));
    }


    public function edit($id)
    {
        $data = VehicleOwnerDetail::with('owner')->find($id);
        // dd($data);
        return view('user.Owner.owner-edit', compact('data'));
    }


    public function update(UpdateOwnerInfoRequest $request, $id)
    {
        $request->validated();
        $commonData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'full_name' => $request->first_name . ' ' . $request->last_name,
            'updated_at' => Carbon::now()->toDateTimeString()
        ];

        if ($request->hasFile('user-photo')) {
            $commonData['profile_photo_path'] = uploadImage($request->file('user-photo'), 'usersImages');
        }

        if ( $request->has('password') )
        {
            $commonData['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $request->v_owner_id)->update($commonData);
        DB::table('vehicle_owner_details')->where('id', $id)->update([
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'dob' => Carbon::parse($request->dob)->format('Y-m-d'),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        Toastr::info('Owner Info Updated Successfully', 'Success');
        return redirect(route('owner'));
    }


    public function destroy($id)
    {
        DB::table('vehicle_owner_details')->where('id', $id)->delete();

        Toastr::warning('Data Delete Successfully');

        return redirect()->back();
    }
}
