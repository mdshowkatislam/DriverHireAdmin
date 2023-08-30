<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 12/1/2022
 */

?>


@extends('layouts.app')

@section('content')


    <section class="product_table_wrapper project_list_table_wrapper dashboard_card">
        <div class="header_area d-flex-between g-sm">
            <h2 class="page_title">Notifications</h2>
        </div>
        <div class="product_table_area transition_table_area mt-0">
            <div class="list_inner_table_area">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>
                            <h4>UUID</h4>
                        </td>
                        <td>
                            <h4>Type</h4>
                        </td>
                        <td>
                            <h4>Notification For</h4>
                        </td>

                        <td>
                            <h4>Data</h4>
                        </td>

                        <td>
                            <h4>Is Read</h4>
                        </td>

                        <td>
                            <h4>Action</h4>
                        </td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($notifications as $notification)
                        <tr>
                            <td>
                                {{ $notification->id ?? '' }}
                            </td>
                            <td> {{ subString($notification->type, "\\") }} </td>
                            <td> {{ subString($notification->notifiable_type , '\\' ) }} </td>
                            <td> {!! arrayToTable( stringToJson($notification->data) ) !!} </td>
                            <td> {!! isRead($notification) !!} </td>
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
                                            <a class="dropdown-item text-danger text-center " onclick="return confirm('You sure you want to delete ?')" href="{{ route('notification.list.delete', $notification->id) }}">Delete</a>
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


@endsection
