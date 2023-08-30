<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReviewRequest;
use App\Http\Requests\DeleteRevireRequest;
use App\Http\Requests\UpdateRevireRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    public function index()
    {
        return sendResponse(
            'Data fetch successfully',
            [
                'reviews' => Review::all()
            ]
        );
    }


    public function store(CreateReviewRequest $createReviewRequest)
    {
        try {
            $review = Review::create($createReviewRequest->validated());

            return sendResponse(
                'Review created successfully',
                [
                    'review' => $review
                ]
            );
        } catch (\Exception $exception) {
            return sendError(
                'Something went wrong',
                [
                    'error' => $exception->getMessage()
                ]
            );
        }
    }


    public function show($id)
    {
        return sendResponse(
            'Data fetch successfully',
            [
                'review' => Review::find($id)
            ]
        );
    }


    public function update(UpdateRevireRequest $updateRevireRequest, $id)
    {
        try {
            $review = Review::find($id);
            $review->update($updateRevireRequest->all());

            return sendResponse(
                'Review updated successfully',
                [
                    'review' => $review
                ]
            );
        } catch (\Exception $exception) {
            return sendError(
                'Something went wrong',
                [
                    'error' => $exception->getMessage()
                ]
            );
        }
    }


    public function delete(DeleteRevireRequest $deleteRevireRequest)
    {
        try {
            Review::where('id', $deleteRevireRequest->id)->delete();

            return sendResponse('Review deleted successfully');
        } catch (\Exception $exception) {
            return sendError(
                'Something went wrong',
                [
                    'error' => $exception->getMessage()
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function userReview()
    {
        return sendResponse(
            'Data fetch successfully',
            [
                'reviews' => Review::where('rate_to', Auth::guard('api')->id())->get()
            ]
        );
    }
}
