@extends('layouts.app')

@section('content')

    <section class="product_table_wrapper project_list_table_wrapper dashboard_card">
        <div class="header_area d-flex-between g-sm">
            <h2 class="page_title">Drivers List</h2>

            {!! searchForm('driver.log.index') !!}

        </div>
        <div class="product_table_area transition_table_area mt-0">
            <div class="list_inner_table_area">
                <table class="table">
                    <thead>
                    <tr>
                        <td>
                            <h4>Driver</h4>
                        </td>

                        <td>
                            <h4>Online Status</h4>
                        </td>

                        <td>
                            <h4>Date</h4>
                        </td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>
                                <div class="user_info_grid">
                                    <div class="user_img_area">
                                        @if( $log->driverInfo )
                                            <img src="{{ assetHelper($log->driverInfo->profile_photo_path)}}"
                                                 alt="{{ userFullName($log->driverInfo) }}"
                                                 class="user_img" />
                                        @endif
                                    </div>
                                    <div class="mt-2">
                                        <p>{{ userFullName($log->driverInfo) }}</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div>
                                    <h4>{!! driverOnlineOfflineStatusBadge($log->status) !!}</h4>
                                </div>
                            </td>

                            <td>
                                <div>
                                    <h4>{{ formatDate($log->date_time) }}</h4>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <?php renderPagination($logs); ?>
        </div>
    </section>
@endsection
