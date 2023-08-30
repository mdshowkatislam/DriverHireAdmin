@extends('layouts.app')

@section('content')

<section class="product_table_wrapper project_list_table_wrapper dashboard_card">
  <div class="header_area d-flex-between g-sm">
    <h2 class="page_title">Drivers List</h2>

      {!! searchForm('hire.request') !!}

  </div>
  <div class="product_table_area transition_table_area mt-0">
    <div class="list_inner_table_area">
      <table class="table">
        <thead>
          <tr>

              <td>
                  <h4>ID</h4>
              </td>

            <td>
              <h4>Description</h4>
            </td>

            <td>
              <h4>Bid Winner</h4>
            </td>

            <td>
              <h4>Request Date</h4>
            </td>
            <td>
              <h4>From Location</h4>
            </td>

            <td>
              <h4>To Location</h4>
            </td>

            <td>
              <h4>Return Location</h4>
            </td>

            <td>
              <h4>Ride Start Date</h4>
            </td>

            <td>
              <h4>Ride Start Date</h4>
            </td>

            <td>
              <h4>Status</h4>
            </td>

            <td>
              <h4>Actions</h4>
            </td>
          </tr>
        </thead>

        <tbody>
          @foreach($hire_requests as $hireRequest)
          <tr>
              <td>
                  <div>
                      <h4>{{ $hireRequest->hire_id }}</h4>
                  </div>
              </td>
            <td>
              <div class="user_info_grid">
                <div class="user_img_area">
                  @if( $hireRequest->vehicleOwner )
                  <img src="{{ assetHelper($hireRequest->vehicleOwner->profile_photo_path)}}"
                    alt="{{ $hireRequest->vehicleOwner->first_name . ' ' . $hireRequest->vehicleOwner->last_name }}"
                    class="user_img" />
                  @endif
                </div>
                <div>
                  <h4>{{ ($hireRequest->vehicleOwner->first_name ?? '') . ' ' . ($hireRequest->vehicleOwner->last_name ?? '') }}</h4>
                  <h5>{{ \Illuminate\Support\Str::limit($hireRequest->note, 70) }}</h5>
                </div>
              </div>
            </td>

            <td>
              @if( $hireRequest->bidWinner )
              <div>
                <a href="{{ route('driver.show', $hireRequest->bidWinner->id) }}" target="_blank" >
                    <span class="badge bg-primary">
                        {{ $hireRequest->bidWinner->full_name }}
                    </span>
                </a>
              </div>
              @endif
            </td>

            <td>
              <div>
                <h4>{{ formatDate($hireRequest->created_at) }}</h4>
              </div>
            </td>

            <td>
              <div>
                <h4>{{ $hireRequest->from_location }}</h4>
              </div>
            </td>

            <td>
              <div>
                <h4>{{ $hireRequest->to_location }}</h4>
              </div>
            </td>

            <td>
              <div>
                <h4>{{ $hireRequest->return_location }}</h4>
              </div>
            </td>

            <td>
              <div>
                <h4>{{ formatDate($hireRequest->trip_date_time, 'Y-m-d H:i A') }}</h4>
              </div>
            </td>

            <td>
              <div>
                <h4>{{ formatDate($hireRequest->trip_end_date_time, 'Y-m-d H:i A') }}</h4>
              </div>
            </td>

            <td>
              <div>
                <h5 class="status progress_status">{{ \Illuminate\Support\Str::title(str_replace('_', ' ',
                  $hireRequest->hire_status)) }}</h5>
              </div>
            </td>
            <td>
              <div class="dropdown dot_dropdown_area">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('assets/images/icon/three_dot.svg')}}" alt="three dot" />
                </button>
                <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <button data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="dropdown-item" type="button" onclick="openBidsModal({{$hireRequest->id}})" >All Bid</button>
                  </li>
                </ul>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

    <div class="modal fade mt-5" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">All Bids</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        {!! renderPagination($hire_requests) !!}
    </div>

</section>
@endsection

@push('subjs')
    <script>
        function openBidsModal(id) {
            let url = "{{ route('hire.show', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#staticBackdrop .modal-body').html(response.data.view);
                },
                error: function (error) {
                    createToast('error', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
