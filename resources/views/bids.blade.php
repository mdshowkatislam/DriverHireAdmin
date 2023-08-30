<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 12/7/2022
 */
?>

<div class="row">
    @foreach($bids as $bid)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex-between">
                    <p>Bid ID: {{ $bid->bid_id }} </p>
                    @if( $winner == $bid->driver_id )
                        <p><button type="button" class="btn btn-warning">
                                Bid  Winner
                            </button>
                        </p>
                    @endif
                </div>
                <h5 class="card-title">
                    <a href="{{ route('driver.show', $bid->driver_id) }}" target="_blank" >
                    <span class="badge bg-primary">
                    {{ $bid->driver_info->full_name ?? '' }}
                    </span>
                    </a>
                </h5>
                <p class="card-text"> Amount: BDT {{ $bid->bid_amount }} </p>
                <p class="card-text">{{ $bid->note }}</p>
            </div>
        </div>
    @endforeach
</div>
