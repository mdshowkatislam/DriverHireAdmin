<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateDriverInfoRequest;
use Illuminate\Support\Facades\Hash;
use Toastr;
use Carbon\Carbon;
use App\Models\DriverDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $datas = DriverDetail::with('user');

        $search = request()->query('search');

        if ($search) {
            $datas = $datas->whereHas('user', function ($query) use ($search) {

                    $query->where('full_name', 'like', "%{$search}%")
                          ->orWhere('phone', 'like', "%{$search}%");
                })
                ->orWhere('licence_no', 'like', "%{$search}%")
                ->orWhere('present_address', 'like', "%{$search}%")
                ->orWhere('permanent_address', 'like', "%{$search}%")
                ->orWhere('nid', 'like', "%{$search}%")
                ->orWhere('dob', 'like', "%{$search}%");
        }

        $datas = $datas->orderBy('id', 'DESC')->Paginate(10);

        return view('user.Driver.driver', compact('datas'));
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DriverDetail::with('user')->find($id);
        //    dd($data);
        return view('user.Driver.driver-details', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DriverDetail::with('user')->find($id);

        return view('user.Driver.driver-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(UpdateDriverInfoRequest $request, $id)
    {
        $request->validated();

        $commonData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'full_name' => $request->first_name . ' ' . $request->last_name,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ];

        if ($request->hasFile('user-photo')) {
            $commonData['profile_photo_path'] = uploadImage(
                $request->file('user-photo'),
                'usersImages'
            );
        }

        if ($request->has('password')) {
            $commonData['password'] = Hash::make($request->password);
        }

        // dd($request->dirver_id);
        DB::table('users')
            ->where('id', $request->driver_id)
            ->update($commonData);

        $driverInfo = [
            'nid' => $request->nid,
            'licence_no' => $request->licence_number,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'dob' => $request->dob,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ];

        if ($request->hasFile('lcf')) {
            $driverInfo['licence_copy_front'] = uploadImage(
                $request->file('lcf'),
                'driver-licence-images'
            );
        }

        if ($request->hasFile('lcb')) {
            $driverInfo['licence_copy_back'] = uploadImage(
                $request->file('lcb'),
                'driver-licence-images'
            );
        }

        DB::table('driver_details')
            ->where('id', $id)
            ->update($driverInfo);

        Toastr::info('Driver Info Updated Successfully');

        return redirect(route('driver'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        DB::table('driver_details')
            ->where('id', $id)
            ->delete();

        Toastr::warning('Driver Info Deleted Successfully');

        return redirect(route('driver'));
    }

    public function changeDriverStatus(Request $request, $id)
    {
        try {
            $key = $request->key;
            $value = $request->value;

            DB::table('driver_details')
                ->where('id', $id)
                ->update([$key => $value, 'updated_at' => date('Y-m-d H:i:s')]);

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Status changed successfully',
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Something went wrong',
                ],
                500
            );
        }
    }
}
