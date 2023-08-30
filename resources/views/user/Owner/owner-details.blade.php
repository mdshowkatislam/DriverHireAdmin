@extends('layouts.app')

@section('content')
<section class="company_table_wrapper mt-60 container" >

    <div class="dashboard_card mt-30 row " >

      <div class="table_top_area" >
        <h3 class="page_title">Vehicle Owner Details</h3>
      </div>

      <div class="company_details_area">
          <div class="company_detials_item">
          <h4 id="sideshow">Owner ID:</h4>
          <h5 id="sideshow">{{ $data->v_owner_id }}</h5>
          </div>
             <div class="company_detials_item">
              <h4 id="sideshow">Name:</h4>
              <h5 id="sideshow">{{ $data->owner->full_name }}</h5>
            </div>
         <div class="company_detials_item">
            <h4>Vehicle Owner Image:</h4>
            <h5>
                <div class="user_img_area w-25">

                    @if($data->owner)
                    <img
                    src="{{ assetHelper($data->owner->profile_photo_path) }}"
                    alt="Image not found"
                    class="user_img img-thumbnail"
                  />
                  @else
                   <h2>--</h2>
                  @endif
                </div>
            </h5>
          </div>
          <div class="company_detials_item">
            <h4 id="sideshow">Contact Number:</h4>
            <h5 id="sideshow"><a href="tel:".{{ $data->owner->phone }}>{{ $data->owner->phone }}</a></h5>
          </div>
          <div class="company_detials_item">
            <h4 id="sideshow">Date of birth:</h4>
            <h5 id="sideshow">
                {{ $data->dob }}
            </h5>
          </div>

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
