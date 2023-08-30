@extends('layouts.app')

@section('content')

    <section class="company_table_wrapper mb-4">
        <div class="table_header_area d-flex-between g-sm">

            <div class="d-flex justify-content-end flex-wrap g-sm">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="default_btn_border">
                    <div>
                        <svg
                            width="12"
                            height="11"
                            viewBox="0 0 12 11"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M6 10.36C5.70667 10.36 5.48 10.28 5.32 10.12C5.16 9.94667 5.08 9.71333 5.08 9.42V6.14H1.86C1.58 6.14 1.36 6.06667 1.2 5.92C1.04 5.76 0.96 5.54 0.96 5.26C0.96 4.98 1.04 4.76667 1.2 4.62C1.36 4.46 1.58 4.38 1.86 4.38H5.08V1.2C5.08 0.906666 5.16 0.679999 5.32 0.519999C5.48 0.359999 5.71333 0.28 6.02 0.28C6.31333 0.28 6.53333 0.359999 6.68 0.519999C6.84 0.679999 6.92 0.906666 6.92 1.2V4.38H10.14C10.4333 4.38 10.6533 4.46 10.8 4.62C10.96 4.76667 11.04 4.98 11.04 5.26C11.04 5.54 10.96 5.76 10.8 5.92C10.6533 6.06667 10.4333 6.14 10.14 6.14H6.92V9.42C6.92 9.71333 6.84 9.94667 6.68 10.12C6.53333 10.28 6.30667 10.36 6 10.36Z"
                                fill="#3f80ea"
                            />
                        </svg>
                    </div>
                    <span>Add Template</span>
                </button>
            </div>
        </div>
    </section>




    <section class="product_table_wrapper project_list_table_wrapper dashboard_card">
        <div class="header_area d-flex-between g-sm">
            <h2 class="page_title">Notification Template</h2>

            {!! searchForm('notification.index') !!}

        </div>
        <div class="product_table_area transition_table_area mt-0">
            <div class="list_inner_table_area">
                <table class="table">
                    <thead>
                    <tr>
                        <td>
                            <h4>Template For</h4>
                        </td>
                        <td>
                            <h4>Template Body</h4>
                        </td>
                        <td>
                            <h4>Created</h4>
                        </td>

                        <td>
                            <h4>Actions</h4>
                        </td>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($notifications as $notification)
                            <tr>
                                <td>
                                    {{ $notification->template_subject ?? '' }}
                                </td>
                                <td> {{ $notification->template_body ?? '' }} </td>
                                <td> {{ formatDate($notification->created_at) }} </td>
                                <td>
                                    <div class="dropdown dot_dropdown_area">
                                        <button
                                            class="dropdown-toggle"
                                            type="button"
                                            id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >
                                            <img
                                                src="{{ asset('assets/images/icon/three_dot.svg')}}"
                                                alt="three dot"
                                            />
                                        </button>
                                        <ul
                                            class="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton1"
                                        >
                                            <li>
                                                <button type="button" data-id="{{ $notification->id }}" onclick="openEditModal({{ $notification->id }})" class="dropdown-item text-warning text-center">Edit</button>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger text-center " onclick="return confirm('You sure you want to delete ?')" href="{{ route('notification.delete', $notification->id) }}">Delete</a>
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
            @if ($notifications->hasPages())
                {{ $notifications->onEachSide(2)->links() }}

            @endif
            @if ($notifications->hasPages())
                <div class="pagination">
                    Showing {{ $notifications->firstItem() }} to {{ $notifications->lastItem() }} of {{ $notifications->total() }}
                    entries
                </div>
            @endif
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notification Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('notification.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Template For</label>
                            <input type="text" name="template_subject" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="">Template Body</label>
                            <textarea name="template_body" id="" class="form-control" required  cols="30" rows="10"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Notification Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div id="edit-body"></div>

            </div>
        </div>
    </div>

@endsection

@push('subjs')
    <script>
        function openEditModal(id){
            $.ajax({
                url: "{{ route('notification.edit', ':id') }}".replace(':id', id),
                type: "GET",
                success: function (data) {
                    if (data.success == true){
                        console.log(data);
                        $('#edit-body').html(data.data.view);
                        $('#editModal').modal('show');
                    }
                },
                error: function (data) {
                    createToast('error', 'Something went wrong');
                }
            });
        }
    </script>
@endpush

