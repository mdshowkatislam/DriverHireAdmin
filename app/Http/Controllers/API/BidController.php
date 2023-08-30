<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBidRequest;
use App\Http\Requests\DeleteBidRequest;
use App\Http\Requests\UpdteBidRequest;
use App\Models\Bid;
use App\Models\HireRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BidController extends Controller
{
    public function store(CreateBidRequest $createBidRequest)
    {
        try {
            // add status to request
            $createBidRequest->merge([
                'status' => 1,
                'bid_id' => 'BID' . time(),
            ]);

            $bid = Bid::create($createBidRequest->all());
            return sendResponse(
                'Bid created successfully',
                [
                    'bid' => $bid
                ],
               Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return sendError(
                'Error creating bid',
                [
                    'error' => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );

        }
    }


    public function index()
    {
        $bidExists = Bid::where('driver_id', Auth::guard('api')->id())->orderBy('id', 'DESC')->first();

        if ($bidExists) {
            $hireRequest = HireRequest::where('accepted_bid_id', $bidExists->id)
                ->where('hire_status', 'ride_started')
                ->orderBy('id', 'DESC')
                ->first();

            if ($hireRequest) {
                return sendResponse(
                    'Bid fetch successfully',
                    [
                        'bids' => []
                    ]
                );
            }
        }

        try {
            $bids = Bid::orderBy('created_at', 'DESC')->get();
            return sendResponse(
                'Data fetched successfully',
                [
                    'bids' => $bids
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return sendError(
                'Error fetching bids',
                [
                    'error' => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function show($id)
    {
        try {
            $bid = Bid::find($id);
            return sendResponse(
                'Data fetched successfully',
                [
                    'bid' => $bid
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return sendError(
                'Error fetching bid',
                [
                    'error' => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function userBid()
    {
        try {
            $bids = Bid::where('driver_id', Auth::guard('api')->id())->orderBy('id', 'DESC')->get();
            return sendResponse(
                'Data fetched successfully',
                [
                    'bids' => $bids
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return sendError(
                'Error fetching bids',
                [
                    'error' => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function delete(DeleteBidRequest $deleteBidRequest)
    {
        try {
            Bid::where('id', $deleteBidRequest->input('id'))->delete();
            return sendResponse('Bid deleted successfully');
        } catch (\Exception $e) {
            return sendError(
                'Error deleting bid',
                [
                    'error' => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    // update bid
    public function update(UpdteBidRequest $updteBidRequest, $id)
    {
        try {
            $bid = Bid::findOrFail($id);
            $bid->update($updteBidRequest->all());
            return sendResponse(
                'Bid updated successfully',
                [
                    'bid' => $bid
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return sendError(
                'Error updating bid',
                [
                    'error' => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function bidsByHireRequest($hireRequestId)
    {
        try {
            $bids = Bid::where('hire_request_id', $hireRequestId)->orderBy('id', 'DESC')->get();
            return sendResponse(
                'Data fetched successfully',
                [
                    'bids' => $bids
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return sendError(
                'Error fetching bids',
                [
                    'error' => $e->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
