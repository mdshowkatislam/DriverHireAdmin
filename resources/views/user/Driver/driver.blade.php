@extends('layouts.app')

@section('content')

<section class="product_table_wrapper project_list_table_wrapper dashboard_card">

    <div class="header_area d-flex-between g-sm">
        <h2 class="page_title">Drivers List</h2>

        {!! searchForm('driver') !!}

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
                            <h4>Image</h4>
                        </td>
                        <td>
                            <h4>Phone</h4>
                        </td>
                        <td>
                            <h4>Nid</h4>
                        </td>

                        <td>
                            <h4>Licence no</h4>
                        </td>
                        <td>
                            <h4>Licence copy front</h4>
                        </td>
                        <td>
                            <h4>Licence copy back</h4>
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
                            {{ $data->user->full_name ?? '-' }}
                        </td>
                        <td>
                            @if($data->user)
                            <img src="{{ assetHelper($data->user->profile_photo_path) }}" alt="Image not found"
                                style="width: 50px" />
                            @else
                            <h2>--</h2>
                            @endif
                        </td>
                        <td>
                            {{ $data->user->phone ?? '-' }}
                        </td>

                        <td>
                            {{ $data->nid ?? '-' }}
                        </td>
                        <td>
                            {{ $data->licence_no ?? '-' }}
                        </td>
                        <td>
                            <img src="{{ assetHelper($data->licence_copy_front) }}" alt="Image not found"
                                style="width: 50px" />
                        </td>
                        <td>
                            <img src="{{ assetHelper($data->licence_copy_back) }}" alt="Image not found"
                                style="width: 50px" />
                        </td>

                        <td>
                            {{ $data->present_address ?? '-' }}
                        </td>
                        <td>
                            {{ $data->permanent_address ?? '-' }}
                        </td>
                        <td>
                            {{ $data->dob ?? '-' }}
                        </td>

                        <td>
                            {{ $data->created_at ?? '-' }}
                        </td>
                        <td>
                            <div class="dropdown dot_dropdown_area">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="true">
                                    <img src="{{ asset('assets/images/icon/three_dot.svg')}}" alt="three dot" />
                                </button>

                                <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('driver.show', $data->id) }}">View
                                            Details</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('driver.edit',$data->id) }}">Edit
                                            Driver</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            onclick="return confirm('You sure deleting this record?') "
                                            href="{{ route('driver.delete',$data->id) }}">Delete Driver</a>
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
