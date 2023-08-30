<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 12/1/2022
 */

?>

<form action="{{ route($route) }}" method="GET" class="search_form_area">
    <div class="search_input_area">
        <input type="text" value="{{ request()->query('search') }}" name="search" placeholder="Search any....." />
    </div>
    <div class="search_icon">
        <button type="submit">
            <img src="{{ asset('assets/images/icon/search_black_icon.svg')}}" alt="search bar" />
        </button>
    </div>
</form>
