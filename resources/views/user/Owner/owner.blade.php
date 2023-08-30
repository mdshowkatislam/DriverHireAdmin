@extends('layouts.app')

@section('content')

<section class="product_table_wrapper project_list_table_wrapper dashboard_card">

  <div class="header_area d-flex-between g-sm">
    <h2 class="page_title">Owner List</h2>

    {!! searchForm('owner') !!}

  </div>
  <div class="product_table_area transition_table_area mt-0">
    <div class="list_inner_table_area">
      <table class="table">
        <thead>
          <tr>
            <td>
              <h4>Name</h4>
            </td>
            <td>
              <h4>Photo</h4>
            </td>
            <td>
              <h4>Phone Number</h4>
            </td>
            <td>
              <h4>Present address</h4>
            </td>
            <td>
              <h4>Permanent address</h4>
            </td>
            <td>
              <h4>Date of birth</h4>
            </td>

            <td>
              <h4>Created at</h4>
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
              {{ $data->owner->full_name ?? '-' }}
            </td>
            <td>
              @if($data->owner)
              <img src="{{ assetHelper($data->owner->profile_photo_path) }}" alt="Image not found" style="width:100px" class="img-thumbnail" />
              @else
              <h2>--</h2>
              @endif
            </td>

            <td>
              {{ $data->owner->phone ?? '-' }}
            </td>
            <td>
              {{ $data->present_address ?? '-' }}
            </td>
            <td>
              {{ $data->permanent_address ?? '-' }}
            </td>
            <td>
              {{ formatDate($data->dob, 'F j, Y') }}
            </td>

            <td>
              {{ $data->created_at ?? '-' }}
            </td>
            <td>
              <div class="dropdown dot_dropdown_area">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                  aria-expanded="true">
                  <img src="{{ asset('assets/images/icon/three_dot.svg')}}" alt="three dot" />
                </button>

                <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <a class="dropdown-item" href="{{ route('owner.show', $data->id) }}">View
                      Details</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('owner.edit',$data->id) }}">Edit
                      Owner</a>
                  </li>
                  <li>
                    <a class="dropdown-item" onclick="return confirm('You sure deleting this record?') " href="{{ route('owner.delete',$data->id) }}">Delete Owner</a>
                  </li>
                </ul>
              </div>

            </td>

          </tr>
          @endforeach
        </tbody>

      </table>
      {{ $datas->onEachSide(2)->links() }}
    </div>
  </div>
</section>
@endsection
