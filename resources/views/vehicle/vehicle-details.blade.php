@extends('layouts.app')

@section('content')
<section class="company_table_wrapper mt-60 container">

    <div class="dashboard_card mt-30 row ">

        <div class="table_top_area">
            <h3 class="page_title">Vehicle Details</h3>
        </div>
        <div class="col-md-6">

            <div class="company_detials_item">
                <h4 id="sideshow">Vehicle ID:</h4>
                <h5 id="sideshow">{{ $data->id }}</h5>
            </div>
            <div class="company_detials_item">
                <h4>Vehicle Image:</h4>
                <h5>
                    <div class="user_img_area">

                        <img src="{{ assetHelper($data->v_photo) }}" alt="Image not found" class="user_img"
                            width="180px" height="100px" />
                    </div>
                </h5>
            </div>
            <div class="company_detials_item">
                <h4 id="sideshow">Owner Name:</h4>
                <h5 id="sideshow">{{ $data->user->full_name }}</h5>
            </div>
            <div class="company_detials_item">
                <h4>Owner Image:</h4>
                <h5>
                    <div class="user_img_area">

                        <img src="{{ assetHelper($data->user->profile_photo_path) }}" alt="Image not found"
                            class="user_img" width="180px" height="100px" />
                    </div>
                </h5>
            </div>
            <div class="company_detials_item">
                <h4 id="sideshow">Vehicle Type:</h4>
                <h5 id="sideshow">{{ $data->v_type }}</h5>
            </div>
            <div class="company_detials_item">
                <h4 id="sideshow">Vehicle Year:</h4>
                <h5 id="sideshow">{{ $data->v_year }}</h5>
            </div>
            <div class="company_detials_item">
                <h4 id="sideshow">Vehicle Model:</h4>
                <h5 id="sideshow">{{ $data->v_model }}</h5>
            </div>


            <div class="company_detials_item">
                <h4 id="sideshow">Vehicle Chassis:</h4>
                <h5 id="sideshow">{{ $data->v_chassis }}</h5>
            </div>
            <div class="company_detials_item">
                <h4 id="sideshow">Vehicle engine:</h4>
                <h5 id="sideshow">{{ $data->v_engine }}</h5>
            </div>



            <div class="company_detials_item">
                <h4>Vehicle Tax Token Image:</h4>
                <h5>
                    <div class="user_img_area">

                        <img src="{{ assetHelper($data->v_tax_token) }}" alt="Image not found" class="user_img"
                            width="180px" height="100px" />
                    </div>
                </h5>
            </div>

        </div>
        <div class="col-md-6">
            <div class="company_detials_item">
                <h4>Vehicle fitness Certificate:</h4>
                <h5>
                    <div class="user_img_area">

                        <img src="{{ assetHelper($data->v_fitness_certificate) }}" alt="Image not found"
                            class="user_img" width="180px" height="100px" />
                    </div>
                </h5>
            </div>
            <div class="company_detials_item">
                <h4>Vehicle Root Permit:</h4>
                <h5>
                    <div class="user_img_area">

                        <img src="{{ assetHelper($data->v_root_permit) }}" alt="Image not found" class="user_img"
                            width="180px" height="100px" />
                    </div>
                </h5>
            </div>
            <div class="company_detials_item">
                <h4>Vehicle Number Plate</h4>
                <h5>
                    <div class="user_img_area">

                        <img src="{{ assetHelper($data->v_number_plate) }}" alt="Image not found"
                            class="user_img" width="180px" height="100px" />
                    </div>
                </h5>
            </div>


            <div class="company_detials_item">
                <h4 id="sideshow">Vehicle Color:</h4>
                <h5 id="sideshow">{{ $data->v_color }}</h5>
            </div>
            <div class="company_detials_item">
                <h4 id="sideshow">Vehicle Insurance:</h4>
                <h5 id="sideshow">{{ $data->v_insurance }}</h5>
            </div>

        </div>

    </div>

</section>
@endsection
