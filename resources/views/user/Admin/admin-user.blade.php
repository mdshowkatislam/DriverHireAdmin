@extends('layouts.app')

@section('content')
<section class="company_table_wrapper mb-4">
  <div class="table_header_area d-flex-between g-sm">

    <div class="d-flex justify-content-end flex-wrap g-sm">
      <a href="{{ route('add.admin') }}" class="default_btn_border">
        <div>
          <svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M6 10.36C5.70667 10.36 5.48 10.28 5.32 10.12C5.16 9.94667 5.08 9.71333 5.08 9.42V6.14H1.86C1.58 6.14 1.36 6.06667 1.2 5.92C1.04 5.76 0.96 5.54 0.96 5.26C0.96 4.98 1.04 4.76667 1.2 4.62C1.36 4.46 1.58 4.38 1.86 4.38H5.08V1.2C5.08 0.906666 5.16 0.679999 5.32 0.519999C5.48 0.359999 5.71333 0.28 6.02 0.28C6.31333 0.28 6.53333 0.359999 6.68 0.519999C6.84 0.679999 6.92 0.906666 6.92 1.2V4.38H10.14C10.4333 4.38 10.6533 4.46 10.8 4.62C10.96 4.76667 11.04 4.98 11.04 5.26C11.04 5.54 10.96 5.76 10.8 5.92C10.6533 6.06667 10.4333 6.14 10.14 6.14H6.92V9.42C6.92 9.71333 6.84 9.94667 6.68 10.12C6.53333 10.28 6.30667 10.36 6 10.36Z"
              fill="#3f80ea" />
          </svg>
        </div>
        <span>Add Admin</span>
      </a>
    </div>
  </div>
</section>
<section class="product_table_wrapper project_list_table_wrapper dashboard_card">


  <div class="header_area d-flex-between g-sm">
    <h2 class="page_title">Admin List</h2>
    <form action="" class="search_form_area">


      <div class="search_input_area">
        <input type="text" value="{{ request()->query('search') }}" placeholder="Search....." name="search" />
      </div>

      <div class="search_icon">
        <button type="submit">
          <img src="{{ asset('assets/images/icon/search_black_icon.svg')}}" alt="search bar" />
        </button>
      </div>
    </form>

  </div>
  <div class="product_table_area transition_table_area mt-0">
    <div class="list_inner_table_area">
      <table class="table">
        <thead>
          <tr>
            <td>
              <h4>First Name</h4>
            </td>
            <td>
              <h4>Last Name</h4>
            </td>
            <td>
              <h4>Photo</h4>
            </td>
            <td>
              <h4>Phone Number</h4>
            </td>
            <td>
              <h4>Status</h4>
            </td>

            <td>
              <h4>Type</h4>
            </td>

            <td>
              <h4>Created At</h4>
            </td>

            <td>
              <h4>Actions</h4>
            </td>
          </tr>
        </thead>

        <tbody>
          @foreach ($datas as $data )

          <tr>
            <td>
              {{ $data->first_name ?? '-' }}
            </td>
            <td>
              {{ $data->last_name ?? '-' }}
            </td>
            <td>

              <img src="{{ assetHelper($data->profile_photo_path) }}" alt="Image not found" style="100px" />

            </td>

            <td>
              {{ $data->phone ?? '-' }}
            </td>
            <td class="text-center">
              <input type="checkbox" data-id="{{ $data->id }}" name="status" @if($data->status == 1)
              checked
              @endif
              data-bootstrap-switch
              class="status">
            </td>
            <td>
              {{ $data->type }}
            </td>
            <td>
              {{ formatDate($data->created_at) }}
            </td>
            <td>
              <div class="dropdown dot_dropdown_area">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                  aria-expanded="true">
                  <img src="{{ asset('assets/images/icon/three_dot.svg')}}" alt="three dot" />
                </button>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <a class="dropdown-item" href="{{ route('admin.show', $data->id) }}">View
                      Details</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('admin.edit',$data->id) }}">Edit
                      Admin</a>
                  </li>
                  <li>
                    <a class="dropdown-item" onclick="return confirm('You sure deleting this data') " href="{{ route('admin.delete',$data->id) }}">Delete Admin</a>
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

    <div class="d-flex justify-content-between align-items-center">
        {!! renderPagination($datas) !!}
    </div>

</section>
@endsection
@push('subjs')
<script>
  let status = $('.status');

  status.bootstrapSwitch({
      onText: 'Active',
      offText: 'Inactive',
      onColor: 'success',
      offColor: 'danger',
      size: 'small',
      onSwitchChange: function(event, state) {
          let value = state ? 1 : 0;
          let id = $(this).data('id');
          let data = {
              'value': value,
              'key': 'status',
              'table': 'admins'
          };

          let url = "{{ route('change.all.status', ':id') }}".replace(':id', id);

          sendAjaxRequest(url, data, 'POST');
      }
  });



</script>
@endpush
