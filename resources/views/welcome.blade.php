@extends('layouts.app')

@section('content')
<!-- Overview Section  -->
<section class="overview_wrapper">

    <div class="overview_grid">
        <a href="#">
            <div class="overview_item d-flex align-items-center justify-content-between">
                <div class="image-wrapper">
                    <img src="{{asset('assets/images/icon/people.png')}}" alt="">
                </div>
                <div class="info-wrapper">
                    <h6>Users</h6>
                    <h2>{{ $total_users }}</h2>
                </div>
            </div>
        </a>
        <a href="{{ URL::to('/hire/request') }}">
            <div class="overview_item d-flex align-items-center justify-content-between">
                <div class="image-wrapper">
                    <img src="{{asset('assets/images/icon/hire.png')}}" alt="">
                </div>
                <div class="info-wrapper">
                    <h6> Hire Request</h6>
                    <h2>{{ $total_hire_request }}</h2>
                </div>
            </div>
        </a>
        <a href="{{ URL::to('/owners') }}">
            <div class="overview_item d-flex align-items-center justify-content-between">
                <div class="image-wrapper">
                    <img src="{{asset('assets/images/icon/owner.png')}}" alt="">
                </div>
                <div class="info-wrapper">
                    <h6>Owners</h6>
                    <h2>{{ $total_owners }}</h2>
                </div>
            </div>
        </a>
        <a href="{{ URL::to('/driver') }}">
            <div class="overview_item d-flex align-items-center justify-content-between">
                <div class="image-wrapper">
                    <img src="{{asset('assets/images/icon/driver.png')}}" alt="">
                </div>
                <div class="info-wrapper">
                    <h6>Drivers</h6>
                    <h2>{{ $total_drivers }}</h2>
                </div>
            </div>
        </a>

    </div>
</section>

<!-- testimonial Section  -->
<section class="testimonial_wrapper">
    <div class="testimonial_grid">
        <div class="production_chart_item dashboard_card">
            <h2 class="page_title">Summary</h2>
            <div class="product_chart_wrapper">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <canvas class="product_chart_area" id="productChart">
                </canvas>
                <div class="hide_bottom_left_logo"></div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('subjs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Chart code -->
<script>
    $('#productChart').hide();
    $.ajax({
            type:   "GET",
            url:    "{{ route('dashboardChart') }}",
            success: function (tekst) {
                if (tekst.success == true){
                    $('.spinner-border').hide();
                    $('#productChart').show();
                    const ctx = document.getElementById('productChart');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: tekst.data.data,
                        options: tekst.data.options
                    });
                }
            },
            error: function (request, error) {
                console.log ("ERROR:" + error);
            }
        });



        // const ctx = document.getElementById('productChart');
        // const data = {
        //     labels: [
        //         'Red',
        //         'Blue',
        //         'Yellow'
        //     ],
        //     datasets: [{
        //         data: [300, 50, 100],
        //         backgroundColor: [
        //             'rgb(255, 99, 132)',
        //             'rgb(54, 162, 235)',
        //             'rgb(255, 205, 86)'
        //         ],
        //         hoverOffset: 4
        //     }]
        // };
        // new Chart(ctx, {
        //     type: 'doughnut',
        //     data: data,
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });
</script>
@endpush
