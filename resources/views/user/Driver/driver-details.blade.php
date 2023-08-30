@extends('layouts.app')

@section('content')
<section class="company_table_wrapper mt-60 container">

    <div class="dashboard_card mt-30 row ">

        <div class="table_top_area">
            <h3 class="page_title">Driver Details</h3>
        </div>
        <div class="col-md-6">
            <div class="company_details_area">
                <div class="company_detials_item">
                    <h4 id="sideshow">Driver ID:</h4>
                    <h5 id="sideshow">{{ $data->driver_id }}</h5>
                </div>
                <div class="company_detials_item">
                    <h4 id="sideshow">Name:</h4>
                    <h5 id="sideshow">{{ $data->user->full_name }}</h5>
                </div>
                <div class="company_detials_item">
                    <h4>Driver Image:</h4>
                    <h5>
                        <div class="user_img_area">

                            <img src="{{ assetHelper($data->user->profile_photo_path) }}" alt="Image not found"
                                class="user_img" width="180px" height="170px" />
                        </div>
                    </h5>
                </div>
                <div class="company_detials_item">
                    <h4 id="sideshow">Contact Number:</h4>
                    <h5 id="sideshow"><a href="tel:+880123456789123">{{ $data->user->phone }}</a></h5>
                </div>
                <div class="company_detials_item">
                    <h4 id="sideshow">Date of birth;</h4>
                    <h5 id="sideshow">
                        {{ $data->dob }}
                    </h5>
                </div>
                <div class="company_detials_item">
                    <h4 id="sideshow">NID Number:</h4>
                    <h5 id="sideshow">{{ $data->nid }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="company_detials_item">
                <h4 id="sideshow">Licence Number:</h4>
                <h5 id="sideshow">{{ $data->licence_no }}</h5>
            </div>
            <div class="company_detials_item">
                <h4>Licence copy front:</h4>
                <h5>
                    <div class="user_img_area">
                        <img src="{{ assetHelper($data->licence_copy_front) }}" alt="Driver Licence copy front image"
                            class="user_img" width="180px" height="114px" />
                    </div>
                </h5>
            </div>
            <div class="company_detials_item">
                <h4>Licence copy back:</h4>
                <h5>
                    <div class="user_img_area">
                        <img src="{{ assetHelper($data->licence_copy_back) }}" alt="Driver Licence copy back image"
                            class="user_img" width="180px" height="114px" />
                    </div>
                </h5>
            </div>
            <div class="company_detials_item">
                <h4 id="sideshow">Present Address:</h4>
                <h5 id="sideshow">{{ $data->present_address }}</h5>
            </div>
            <div class="company_detials_item">
                <h4 id="sideshow">Permanent Address:</h4>
                <h5 id="sideshow">{{ $data->permanent_address }}</h5>
            </div>
        </div>

    </div>
    </div>
</section>
@endsection
