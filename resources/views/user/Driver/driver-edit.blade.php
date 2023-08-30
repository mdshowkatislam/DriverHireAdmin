@extends('layouts.app')


@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<section class="add_product_wrapper">

    <!-- ! back button -->

    <div class="back_button">
        <a href="{{ route('driver') }}" class="btn btn-primary">Back</a>
    </div>

    <form action="{{ route('driver.update',$data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type_id" value="{{ $data->user->role_id }}">
        <input type="hidden" name="driver_id" value="{{ $data->driver_id }}">

        <div class="product_outer_grid13 d-flex justify-content-center">
            <div class="product_outer_left_wrapper w-50">
                @php $type = old('type_id') @endphp

                <div class="form-group mb-3">
                    <label>First Name</label>
                    <input type="text" value="{{ $data->user->first_name }}"
                        class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                        placeholder="Enter First name"  name="first_name" required>

                    @error('first_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Last Name</label>
                    <input type="text" value="{{ $data->user->last_name }}"
                        class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                        placeholder="Enter last name" name="last_name" required>

                    @error('last_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Phone Number</label>
                    <input type="text" value="{{ $data->user->phone }}"
                        class="form-control @error('phone') is-invalid @enderror" id="phone"
                        placeholder="Enter Phone number" name="phone" required>

                    @error('phone')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Password</label>
                    <input type="password" value=""
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" name="password" required>

                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Present Address</label>
                    <input type="text" value="{{ $data->present_address }}"
                        class="form-control @error('present_address') is-invalid @enderror" id="present_address"
                        placeholder="Enter Present Address" name="present_address" required>

                    @error('present_address')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Permanent Address</label>
                    <input type="text" value="{{ $data->permanent_address }}"
                        class="form-control @error('permanent_address') is-invalid @enderror" id="permanent_address"
                        placeholder="Enter Permanent Address" name="permanent_address" required>

                    @error('permanent_address')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div><br>


                <div id="date-picker-example" class="md-form md-outline input-with-post-icon " >
                    <label for="example">Select your date of birth</label>
                    <input placeholder="Select date" type="text" id="datepicker" value="{{$data->dob}}" class="form-control datepicker" name="dob">
                </div><br>
                <div class="form-group add_title_area dashboard_card mt-20">
                    <label>Photo</label>
                    <div class="input_row">
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" name="user-photo"
                                id="exampleInputFile outputimg1" onchange="showimg1(event)">

                        </div>
                        <div>
                            <img src="{{ assetHelper($data->user->profile_photo_path) }}" alt="" id="output1" width="100px">

                        </div>


                    </div>

                    @error('user-photo')
                    <span class="error invalid-feedback" style="display: block">{{ $message }}
                    </span>
                    @enderror
                </div>

                <br>

                <div id="driveritem">
                    <div class="form-group mb-3">
                        <label>NID </label>
                        <input type="text" value="{{ $data->nid }}"
                            class="form-control @error('nid') is-invalid @enderror" id="nid"
                            placeholder="Add your National id Number" name="nid">

                        @error('phone')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label>Licence Number </label>
                        <input type="text" value="{{ $data->licence_no }}"
                            class="form-control @error('licence_number') is-invalid @enderror" id="licence_number"
                            placeholder="Enter Your Licence Number " name="licence_number">

                        @error('licence_number')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 add_title_area dashboard_card mt-20">
                        <label>Licence Copy Front</label>
                        <div class="input_row">
                            <div class="custom-file">
                                <input type="file" accept="image/*" class="custom-file-input" name="lcf"
                                    id="exampleInputFile outputimg2" onchange="showimg2(event)">

                            </div>
                            <div>
                                <img src="{{ assetHelper($data->licence_copy_front) }}" alt="" id="output2" width="100px">

                            </div>

                        </div>

                        @error('lcf')
                        <span class="error invalid-feedback" style="display: block">{{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3 add_title_area dashboard_card mt-20">
                        <label>Licence Copy Back</label>
                        <div class="input_row">
                            <div class="custom-file">
                                <input type="file" accept="image/*" class="custom-file-input" name="lcb"
                                    id="exampleInputFile outputimg3" onchange="showimg3(event)">

                            </div>
                            <div>
                                <img src="{{ assetHelper($data->licence_copy_back) }}" alt="" id="output3" width="100px">
                            </div>
                        </div>
                        @error('lcb')
                        <span class="error invalid-feedback" style="display: block">{{ $message }}
                        </span>
                        @enderror
                    </div>
                </div><br>

                <div class="col-md-2">
                    <button class="btn btn-sm btn-primary" type="submit">Update</button>
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
    $('div.alert').delay(1000).slideUp(300);
</script>


@endpush
