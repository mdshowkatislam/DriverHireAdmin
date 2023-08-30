@extends('layouts.app')

@section('content')
<section class="company_table_wrapper mt-60 container d-flex justify-content-center">

    <div class="dashboard_card mt-30 row col-md-6 ">

        <div class="table_top_area">
            <h3 class="page_title">Admin Details</h3>
        </div>

        <div class="company_details_area">
            <div class="company_detials_item">
                <h4 id="sideshow">Admin ID:</h4>
                <h5 id="sideshow">{{ $data->id}}</h5>
            </div>
            <div class="company_detials_item">
                <h4 id="sideshow">First Name:</h4>
                <h5 id="sideshow">{{ $data->first_name }}</h5>
            </div>

            <div class="company_detials_item">
                <h4 id="sideshow">Admin Type:</h4>
                <h5 id="sideshow">{{ \Illuminate\Support\Str::title($data->type) }}</h5>
            </div>

            <div class="company_detials_item">
                <h4 id="sideshow">last Name:</h4>
                <h5 id="sideshow">{{ $data->last_name }}</h5>
            </div>

            <div class="company_detials_item">
                <h4>Admin Image:</h4>
                <h5>
                    <div class="user_img_area w-25">

                        @if($data->profile_photo_path)
                        <img src="{{ assetHelper($data->profile_photo_path) }}" alt="Image not found"
                            class="user_img" />
                        @else
                        <h2>--</h2>
                        @endif
                    </div>
                </h5>
            </div>
            <div class="company_detials_item">
                <h4 id="sideshow">Contact Number:</h4>
                <h5 id="sideshow"><a href="tel:"{{ $data->phone }}>{{ $data->phone }}</a></h5>
            </div>
        </div>
        <div class="company_detials_item">
            <h4 id="sideshow">Created At:</h4>
            <h5 id="sideshow">{{ $data->created_at }}</h5>
        </div>

    </div>

    </div>
    </div>
</section>
@endsection
