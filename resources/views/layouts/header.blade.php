<header class="header_wrapper">
    <div class="header_area d-flex align-items-center justify-content-between flex-wrap g-sm">
        <div class="logo_search_grid">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/log_icon/carlogo-removebg.png')}}" alt="logo" />
                    <span class="logo_text">Driver Hiring App</span>
                </a>
            </div>

        </div>
        <div class="header_right_area">
            <ul class="user_info_list d-flex align-items-center flex-wrap">

                <li>
                    <button type="button" class="header_user_area" id="userDropdownBtn">
                        <div class="user_img_area">
                            <img width="40px" height="25px"
                                src="{{ assetHelper(\Illuminate\Support\Facades\Auth::guard('web')->user()->profile_photo_path)}}"
                                alt="user image">
                        </div>
                        <div class="user_name">{{ \Illuminate\Support\Facades\Auth::guard('web')->user()->first_name ??
                            'User' }}</div>
                        <div class="arrow_icon">
                            <img src="{{ asset('assets/images/icon/bottom_arrow.svg')}}" alt="arrow icon" />
                        </div>
                    </button>
                    <div class="dropdown_area user_dropdown_area" id="userDropdownArea">
                        <ul>
                            <li>
                                <button type="button">
                                    <div class="profile_icon">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                    </div>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">LogOut</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="overlay" id="userOverlay"></div>
                </li>

            </ul>
        </div>
    </div>
</header>
