<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\HireRequest;
use Illuminate\Http\Request;

class HireRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $hireRequest = HireRequest::with(['vehicleOwner', 'bidWinner']);

        if (request()->query('search')) {
            $search = request()->query('search');
            $hireRequest = $hireRequest->where('from_location', 'like', '%' . $search . '%')
                ->orWhere('to_location', 'like', '%' . $search . '%')
                ->orWhere('return_location', 'like', '%' . $search . '%')
                ->orWhere('note', 'like', '%' . $search . '%')
                ->orWhere('hire_status', 'like', '%' . $search . '%')
                ->orWhereHas('vehicleOwner', function ($query) use ($search) {
                    $query->where('full_name', 'like', '%' . $search . '%');
                })->orWhereHas('bidWinner', function ($query) use ($search) {
                $query->where('full_name', 'like', '%' . $search . '%');
            });
        }

        $data = [
            'hire_requests' => $hireRequest->paginate(15)
        ];
        return view('hire-request', $data);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $bids = Bid::where('hire_request_id', $id)->get();

        $winner = HireRequest::where('id', $id)->first()->bid_winner_id;

        return sendResponse(
            'Bid List',
            [
                'view' => view('bids', compact('bids', 'winner'))->render()
            ]
        );
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
