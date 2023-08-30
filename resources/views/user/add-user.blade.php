@extends('layouts.app')


@section('content')

<section class="add_product_wrapper">

    <form action="{{ route('store.user') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="product_outer_grid13 d-flex justify-content-center">

            <div class="product_outer_left_wrapper w-50">
                <div class="form-group mb-3">
                    <label>Select User Type <span class="text-danger">*</span> </label>
                    <select class="form-control  @error('type_id') is-invalid @enderror" id="type_id"
                        name="type_id"  required>
                        <option selected="selected" value="" disabled>Select Type
                        </option>
                        @foreach ($datas as $data)
                        <option @if (old('type_id')==$data->name) selected @endif
                            value="{{ $data->name }}">{{ $data->name }}</option>
                        @endforeach
                    </select>

                    @error('type_id')
                    <span class="error invalid-feedback" style="display: block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>First Name <span class="text-danger">*</span> </label>
                    <input type="text" value="{{ old('first_name') }}"
                        class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                        placeholder="Enter First name" name="first_name" required>

                    @error('first_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Last Name <span class="text-danger">*</span> </label>
                    <input type="text" value="{{ old('last_name') }}"
                        class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                        placeholder="Enter last name" name="last_name" required>

                    @error('last_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">`
                    <label>Phone Number <span class="text-danger">*</span> </label>
                    <input type="text" value="{{ old('phone') }}"
                        class="form-control @error('phone') is-invalid @enderror" id="phone"
                        placeholder="Enter Phone number" name="phone" required>

                    @error('phone')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">`
                    <label>Password <span class="text-danger">*</span> </label>
                    <input type="password" value=""
                           class="form-control @error('password') is-invalid @enderror" id="phone"
                           placeholder="Password" name="password" required>

                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group mb-3">
                    <label>Present Address <span class="text-danger">*</span></label>
                    <input type="text" value="{{ old('present_address') }}"
                        class="form-control @error('present_address') is-invalid @enderror" id="present_address"
                        placeholder="Enter Present Address" name="present_address" required>

                    @error('present_address')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Permanent Address <span class="text-danger">*</span></label>
                    <input type="text" value="{{ old('permanent_address') }}"
                        class="form-control @error('permanent_address') is-invalid @enderror" id="permanent_address"
                        placeholder="Enter Permanent Address" name="permanent_address" required>

                    @error('permanent_address')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div id="date-picker-example" class="md-form md-outline input-with-post-icon  mb-4">
                    <label for="example">Select your date of birth <span class="text-danger">*</span> </label>
                    <input placeholder="Select date" type="text" id="datepicker" class="form-control datepicker @error('dob') is-invalid @enderror " name="dob">

                    @error('dob')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group mb-3 add_title_area dashboard_card">
                    <label>Photo <span class="text-danger"> *</span> </label>
                    <div class="input_row">
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" name="user-photo"
                                id="exampleInputFile outputimg1" onchange="showimg1(event)">

                        </div>
                        <div>
                            <img src="" alt="" id="output1" width="100px">

                        </div>


                    </div>

                    @error('user-photo')
                    <span class="error invalid-feedback" style="display: block">{{ $message }}
                    </span>
                    @enderror
                </div>

                <br>
                {{-- ------------start of field for driver section----------- --}}
                <div id="driveritem">
                    <div class="form-group mb-3">
                        <label>NID <span class="text-danger">*</span> </label>
                        <input type="text" value="{{ old('nid') }}"
                            class="form-control @error('nid') is-invalid @enderror" id="nid"
                            placeholder="Add your National id Number" name="nid">

                        @error('phone')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div><br />
                    <div class="form-group mb-3">
                        <label>Licence Number <span class="text-danger">*</span> </label>
                        <input type="text" value="{{ old('licence_number') }}"
                            class="form-control @error('licence_number') is-invalid @enderror" id="licence_number"
                            placeholder="Enter Your Licence Number " name="licence_number">

                        @error('licence_number')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div><br />

                    <div class="form-group mb-3 add_title_area dashboard_card mb-5">
                        <label>Licence Copy Front <span class="text-danger"> *</span> </label>
                        <div class="input_row">
                            <div class="custom-file">
                                <input type="file" accept="image/*" class="custom-file-input" name="lcf"
                                    id="exampleInputFile outputimg2" onchange="showimg2(event)">
                                {{-- <label class="custom-file-label" for="exampleInputFile">Choose
                                    file</label> --}}
                            </div>
                            <div>
                                <img src="" alt="" id="output2" width="100px">

                            </div>

                        </div>

                        @error('lcf')
                        <span class="error invalid-feedback" style="display: block">{{ $message }}
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3 add_title_area dashboard_card ">
                        <label>Licence Copy Back <span class="text-danger"> *</span> </label>
                        <div class="input_row">
                            <div class="custom-file">
                                <input type="file" accept="image/*" class="custom-file-input" name="lcb"
                                    id="exampleInputFile outputimg3" onchange="showimg3(event)">

                            </div>
                            <div>
                                <img src="" alt="" id="output3" width="100px">

                            </div>


                        </div>


                        @error('lcb')
                        <span class="error invalid-feedback" style="display: block">{{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>
                {{-- ------------end of field for driver section----------- --}}



                <div class="col-md-2">
                    <button class="btn btn-sm btn-primary" type="submit">Save</button>
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
    let type_id = $('#type_id');
        let driver_items = $('#driveritem');

        @if( old('type_id') !== 'driver' )
            driver_items.hide();
        @endif

        type_id.on('change', function(e) {
            let val = $(this).val();

            if (val != 'driver') {
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
