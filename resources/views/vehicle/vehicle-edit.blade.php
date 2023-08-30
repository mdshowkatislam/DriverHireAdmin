@extends('layouts.app')


@section('content')

<section class="add_product_wrapper">
    {{-- @php
    dd(if($data->user_id)
    @endphp --}}

    <form action="{{ route('vehicle.update',$data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="product_outer_grid13 d-flex justify-content-center">

            <div class="product_outer_left_wrapper w-50">

                <div class="form-group ">
                    <label>Select Vehicle Owner Name: <span class="text-danger"> </span>
                    </label>
                    <select class="form-control select2 @error('user_id') is-invalid @enderror" name="user_id"
                        style="width: 100%;">
                        <option selected="selected" value="" disabled>Select Owner<span class="text-danger"></span>
                        </option>

                        @foreach ($allOwners as $allOwner)
                        <option @if ($data->user_id==$allOwner->id) selected @endif
                            value="{{ $allOwner->id }}">{{ $allOwner->full_name }}
                        </option>
                        @endforeach
                    </select>

                    @error('user_id')
                    <span class="error invalid-feedback" style="display: block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Vehicle Name </label>
                    <input type="text" value="{{ $data->v_name }}"
                        class="form-control @error('v_name') is-invalid @enderror" id="v_name"
                        placeholder="Enter Vehicle Name" name="v_name">

                    @error('v_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Vehicle Type </label>
                    <input type="text" value="{{ $data->v_type}}"
                        class="form-control @error('v_type') is-invalid @enderror" id="v_type"
                        placeholder="Enter Vehicle Type" name="v_type">

                    @error('v_type')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Vehicle Year</label>
                    <input type="text" id="datepicker" class="form-control" value="{{  $data->v_year }}"
                        placeholder="Enter Vehicle Year" name="v_year">

                    @error('v_year')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div><br />



                <div class="form-group">
                    <label>Vehicle Model</label>
                    <input type="text" value="{{$data->v_model }}"
                        class="form-control @error('v_model') is-invalid @enderror" id="v_model"
                        placeholder="Enter Vehicle Model" name="v_model">

                    @error('v_model')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div><br />
                <div class="form-group">
                    <label>Vehicle Chassis</label>
                    <input type="text" value="{{ $data->v_chassis }}"
                        class="form-control @error('v_chassis') is-invalid @enderror" id="v_chassis"
                        placeholder="Enter Vehicle Chassis" name="v_chassis">

                    @error('v_chassis')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div><br />
                <div class="form-group">
                    <label>Vehicle Engine</label>
                    <input type="text" value="{{ $data->v_engine }}"
                        class="form-control @error('v_engine') is-invalid @enderror" id="v_engine"
                        placeholder="Enter Vehicle Engine" name="v_engine">

                    @error('v_engine')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div><br />
                <div class="form-group">
                    <label>Vehicle color</label>
                    <input type="text" value="{{ $data->v_color }}"
                        class="form-control @error('v_color') is-invalid @enderror" id="v_color"
                        placeholder="Enter Vehicle color" name="v_color">

                    @error('v_color')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div><br />
                <div class="form-group">
                    <label>Vehicle Insurance</label>
                    <input type="text" value="{{ $data->v_insurance }}"
                        class="form-control @error('v_insurance') is-invalid @enderror" id="v_insurance"
                        placeholder="Enter Vehicle Insurance" name="v_insurance">

                    @error('v_insurance')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div><br />
                <div class="form-group add_title_area dashboard_card">
                    <label>Vehicle Photo</label>
                    <div class="input_row">
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" name="v_photo"
                                id="exampleInputFile outputimg1" onchange="showimg1(event)">

                        </div>
                        <div>
                            <img src="{{ assetHelper($data->v_photo) }}" alt="" id="output1" width="100px">
                        </div>


                    </div>

                    @error('v_photo')
                    <span class="error invalid-feedback" style="display: block">{{ $message }}
                    </span>
                    @enderror
                </div> <br />

                <br>


                <div class="form-group add_title_area dashboard_card">
                    <label>Vehicle tax Token</label>
                    <div class="input_row">
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" name="v_tax_token"
                                id="exampleInputFile outputimg2" onchange="showimg2(event)">

                        </div>
                        <div>
                            <img src="{{ assetHelper($data->v_tax_token) }}" alt="" id="output2" width="100px">
                        </div>


                    </div>

                    @error('v_tax_token')
                    <span class="error invalid-feedback" style="display: block">{{ $message }}
                    </span>
                    @enderror
                </div> <br />

                <div class="form-group add_title_area dashboard_card">
                    <label>Vehicle Fitness Certificate</label>
                    <div class="input_row">
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" name="v_fitness_certificate"
                                id="exampleInputFile outputimg3" onchange="showimg3(event)">

                        </div>
                        <div>
                            <img src="{{ assetHelper($data->v_fitness_certificate) }}" alt="" id="output3" width="100px">
                        </div>


                    </div>

                    @error('v_fitness_certificate')
                    <span class="error invalid-feedback" style="display: block">{{ $message }}
                    </span>
                    @enderror
                </div> <br />

                <div class="form-group add_title_area dashboard_card">
                    <label>Vehicle Root Permit</label>
                    <div class="input_row">
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" name="v_root_permit"
                                id="exampleInputFile outputimg4" onchange="showimg4(event)">

                        </div>
                        <div>
                            <img src="{{ assetHelper($data->v_root_permit) }}" alt="" id="output4" width="100px">
                        </div>


                    </div>

                    @error('v_root_permit')
                    <span class="error invalid-feedback" style="display: block">{{ $message }}
                    </span>
                    @enderror
                </div> <br />

                <div class="form-group add_title_area dashboard_card">
                    <label>Vehicle Number Plate</label>
                    <div class="input_row">
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" name="v_number_plate"
                                id="exampleInputFile outputimg5" onchange="showimg5(event)">

                        </div>
                        <div>
                            <img src="{{ assetHelper($data->v_number_plate) }}" alt="" id="output5" width="100px">
                        </div>


                    </div>

                    @error('v_number_plate')
                    <span class="error invalid-feedback" style="display: block">{{ $message }}
                    </span>
                    @enderror
                </div> <br />



                <div class="col-md-2">
                    <button class="btn btn-sm btn-primary" type="submit">Update</button>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection
@push('subjs')
<script>
    var showimg1 = function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output1 = document.getElementById('output1');
                    output1.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };
</script>
<script>
    var showimg2 = function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output2 = document.getElementById('output2');
                    output2.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };
</script>
<script>
    var showimg3 = function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output3 = document.getElementById('output3');
                    output3.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };
</script>
<script>
    var showimg4 = function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output4 = document.getElementById('output4');
                    output4.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };
</script>
<script>
    var showimg5 = function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output5 = document.getElementById('output5');
                    output5.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };
</script>
<script>
    // Data Picker Initialization
            $('#datepicker').datepicker();
</script>

<script>
    let type_id = $('#type_id');
        let driver_items = $('#driveritem');
                driver_items.hide();
        type_id.on('change', function(e) {
            let val = $(this).val();

            if (parseInt(val) === 1) {

                driver_items.hide();
            } else {

                driver_items.show();

            }
        });
</script>
<script>
    $('div.alert').delay(1000).slideUp(300);
</script>


@endpush
