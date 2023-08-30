<?php

namespace App\Http\Controllers;

use Toastr;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateVehicleRequest;

class VehicleController extends Controller
{
    public function index()
    {
        $datas = Vehicle::with('user');

        $search = request()->query('search');

        if ($search) {
            $datas = $datas->where('v_name', 'like', "%{$search}%")
                ->orWhere('v_model', 'like', "%{$search}%")
                ->orWhere('v_type', 'like', "%{$search}%")
                ->orWhere('v_engine', 'like', "%{$search}%")
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('full_name', 'like', "%{$search}%");
                });
        }

        $datas = $datas->orderBy('id', 'DESC')->Paginate(15);

        return view('vehicle.vehicle', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = Vehicle::with('user')->get();
        $allOwners = User::where('role_id', 1)->where('status', 1)->select('id', 'full_name')->get();

        return view('vehicle.add-vehicle', compact('datas', 'allOwners'));
    }
    public function store(CreateVehicleRequest $request)
    {

        $request->validated();

        DB::table('vehicles')->insert([
            'user_id' => $request->user_id,
            'v_name' => $request->v_name,
            'v_type' => $request->v_type,
            'v_year' => Carbon::parse($request->v_year)->format('Y-m-d'),
            'v_model' => $request->v_model,
            'v_chassis' => $request->v_chassis,
            'v_engine' => $request->v_engine,
            'v_color' => $request->v_color,
            'v_insurance' => $request->v_insurance,
            'v_photo' => ( $request->hasFile('v_photo') ) ? uploadImage($request->file('v_photo'), 'carImage') : null,
            'v_tax_token' => ( $request->hasFile('v_tax_token') ) ? uploadImage($request->file('v_tax_token'), 'taxImages') : null,
            'v_fitness_certificate' => ($request->hasFile('v_fitness_certificate')) ? uploadImage($request->file('v_fitness_certificate'), 'fitnessImages') :null,
            'v_root_permit' => ( $request->hasFile('v_root_permit') ) ? uploadImage($request->file('v_root_permit'), 'rootImages') : null,
            'v_number_plate' => ( $request->hasFile('v_number_plate') ) ? uploadImage($request->file('v_number_plate'), 'numberImages') : null,
            'created_at' => Carbon::now()->toDateTimeString(),
            'status' => 1,
        ]);

        Toastr::success('Vehicle Added Successfully', 'Success');

        return redirect(route('vehicles'));


    }
    public function show($id)
    {
        // dd($id, "show");
        $data = Vehicle::with('user')->find($id);

        return view('vehicle.vehicle-details', compact('data'));
    }


    public function edit($id)
    {

        $data = Vehicle::with('user')->find($id);
        $allOwners = User::where('role_id', 1)->where('status', 1)->select('id', 'full_name')->get();

        return view('vehicle.vehicle-edit', compact('data', 'allOwners'));
    }


    public function update(Request $request, $id)
    {

        $allData = [
            'user_id' => $request->user_id,
            'v_name' => $request->v_name,
            'v_type' => $request->v_type,
            'v_year' => Carbon::parse($request->v_year)->format('Y-m-d'),
            'v_model' => $request->v_model,
            'v_chassis' => $request->v_chassis,
            'v_engine' => $request->v_engine,
            'v_color' => $request->v_color,
            'v_insurance' => $request->v_insurance,
            'created_at' => Carbon::now()->toDateTimeString()
        ];

        if ($request->hasFile('v_photo')) {
            $allData['v_photo'] = uploadImage($request->file('v_photo'), 'carImage');
        }
        if ($request->hasFile('v_tax_token')) {
            $allData['v_tax_token'] = uploadImage($request->file('v_tax_token'), 'taxImages');
        }
        if ($request->hasFile('v_fitness_certificate')) {
            $allData['v_fitness_certificate'] = uploadImage($request->file('v_fitness_certificate'), 'fitnessImages');
        }
        if ($request->hasFile('v_root_permit')) {
            $allData['v_root_permit'] = uploadImage($request->file('v_root_permit'), 'rootImages');
        }
        if ($request->hasFile('v_number_plate')) {
            $allData['v_number_plate'] = uploadImage($request->file('v_number_plate'), 'numberImages');
        }

        DB::table('vehicles')->where('id', $id)->update($allData);
        Toastr::info('Vehicle Updated Successfully');
        return redirect(route('vehicles'));
    }


    public function destroy($id)
    {

        DB::table('vehicles')->where('id', $id)->delete();
        Toastr::warning('Vehicle deleted Successfully');

        return redirect()->back();
    }
}
