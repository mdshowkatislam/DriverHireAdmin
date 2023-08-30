@extends('layouts.app')

@section('content')

<section class="add_product_wrapper">

    <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="product_outer_grid13 d-flex justify-content-center">

            <div class="product_outer_left_wrapper w-50">

                <div class="form-group mb-3">
                    <label>First Name <span class="text-danger">*</span> </label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                        placeholder="Enter First name" name="first_name" required>

                    @error('first_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                        placeholder="Enter last name" name="last_name" required>

                    @error('last_name')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Phone Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        placeholder="Enter Phone number" name="phone" required>

                    @error('phone')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Enter Password" name="password" required>

                    @error('password')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label>Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('confirm-password') is-invalid @enderror"
                        autocomplete="off" id="confirm-password" placeholder="Enter Password Again"
                        name="password_confirmation" required>

                    @error('password_confirmation')
                    <span class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div><br />
                <div class="form-group add_title_area dashboard_card mt-20">
                    <label>Photo</label>
                    <div class="input_row">
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" name="photo"
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
    // Data Picker Initialization
            $('.datepicker').datepicker({
             inline: true
            });
</script>


<script>
    $('div.alert').delay(1000).slideUp(300);
</script>


@endpush
