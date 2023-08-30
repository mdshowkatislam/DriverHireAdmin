<?php

namespace App\Http\Controllers;

use App\Models\DriverOnlineLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverOnlineLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $logs = DriverOnlineLog::with('driverInfo');

        $search = request()->query('search');

        if ( $search ){
            $logs = $logs->whereHas('driverInfo', function ($query) use ($search) {
                $query->where(DB::raw('TRIM( CONCAT(TRIM(users.first_name), \' \', TRIM(users.last_name) ) )'), 'like', "%{$search}%");
            })
                ->orWhere('status', 'like', "%{$search}%")
                ->orWhere('date_time', 'like', "%{$search}%");
        }

        $logs = $logs->paginate(15);

        return view('driver_online_log', compact('logs'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
