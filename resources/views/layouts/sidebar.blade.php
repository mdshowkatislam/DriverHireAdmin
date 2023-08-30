<section class="sidebar_wrapper">
    <div class="accordion" id="accordionMenu">
        <div class="accordion-item">
            <h2>
                <a href="{{ route('home') }}" @if( checkCurrentRouteNameExist(['home']) ) class="sidebar_active_menu" @endif>
                    <div class="dashboard_icon">
                        <svg
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M20.42 10.1799L12.71 2.29995C12.617 2.20622 12.5064 2.13183 12.3846 2.08106C12.2627 2.03029 12.132 2.00415 12 2.00415C11.868 2.00415 11.7373 2.03029 11.6154 2.08106C11.4936 2.13183 11.383 2.20622 11.29 2.29995L3.57999 10.1899C3.39343 10.378 3.24609 10.6013 3.14652 10.8468C3.04695 11.0922 2.99715 11.3551 2.99999 11.6199V19.9999C2.99922 20.5119 3.19477 21.0046 3.54637 21.3766C3.89797 21.7487 4.37885 21.9718 4.88999 21.9999H19.11C19.6211 21.9718 20.102 21.7487 20.4536 21.3766C20.8052 21.0046 21.0008 20.5119 21 19.9999V11.6199C21.0008 11.0829 20.7928 10.5665 20.42 10.1799ZM9.99999 19.9999V13.9999H14V19.9999H9.99999ZM19 19.9999H16V12.9999C16 12.7347 15.8946 12.4804 15.7071 12.2928C15.5196 12.1053 15.2652 11.9999 15 11.9999H8.99999C8.73478 11.9999 8.48042 12.1053 8.29289 12.2928C8.10535 12.4804 7.99999 12.7347 7.99999 12.9999V19.9999H4.99999V11.5799L12 4.42995L19 11.6199V19.9999Z"
                                fill="#333333"
                            />
                        </svg>
                    </div>
                    <span class="label_text">Home</span>
                </a>
            </h2>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headerDropdown1">
                <button
                    class="accordion-button
                     @if( ! checkCurrentRouteNameExist([
                        'add.user', 'store.user', 'driver', 'driver.show', 'driver.edit', 'driver.update', 'owner',
                        'owner.show', 'owner.edit', 'owner.update', 'admin.user', 'admin.show', 'admin.edit', 'admin.update',
                        'add.admin', 'store.admin'
                        ]) )
                     collapsed
                     @endif

                     "
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOne"
                    @if( ! checkCurrentRouteNameExist([
                        'add.user', 'store.user', 'driver', 'driver.show', 'driver.edit', 'driver.update', 'owner',
                        'owner.show', 'owner.edit', 'owner.update', 'admin.user', 'admin.show', 'admin.edit', 'admin.update',
                        'add.admin', 'store.admin'
                    ]) )
                        aria-expanded="false"
                    @else
                        aria-expanded="true"
                    @endif
                    aria-controls="collapseOne"
                >
                    <div class="dashboard_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                    </svg>
                    </div>
                    <span class="label_text">Users</span>
                </button>
            </h2>
            <div
                id="collapseOne"
                class="accordion-collapse collapse @if( checkCurrentRouteNameExist([
                        'add.user', 'store.user', 'driver', 'driver.show', 'driver.edit', 'driver.update', 'owner',
                        'owner.show', 'owner.edit', 'owner.update', 'admin.user', 'admin.show', 'admin.edit', 'admin.update',
                        'add.admin', 'store.admin'
                    ]) ) show @endif"
                aria-labelledby="headerDropdown1"
                data-bs-parent="#accordionMenu"
            >
                <div class="accordion-body">
                    <ul class="dropdown_menu_area">
                        <li>
                            <a @if( checkCurrentRouteNameExist(['add.user']) ) class="sidebar_inner_active" @endif href="{{ route('add.user') }}">Add User</a>
                        </li>
                        <li>
                            <a @if( checkCurrentRouteNameExist(['driver']) ) class="sidebar_inner_active" @endif href="{{ route('driver') }}">Drivers</a>
                        </li>
                        <li>
                            <a @if( checkCurrentRouteNameExist(['owner']) ) class="sidebar_inner_active" @endif href="{{ route('owner') }}">Owners</a>
                        </li>

                        <li>
                            <a @if( checkCurrentRouteNameExist(['admin.user']) ) class="sidebar_inner_active" @endif href="{{ route('admin.user') }}">Admin</a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2>
                <a href="{{ route('hire.request') }}" @if( checkCurrentRouteNameExist(['hire.request']) ) class="sidebar_active_menu" @endif >

                    <div class="dashboard_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plane-tilt" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14.5 6.5l3 -2.9a2.05 2.05 0 0 1 2.9 2.9l-2.9 3l2.5 7.5l-2.5 2.55l-3.5 -6.55l-3 3v3l-2 2l-1.5 -4.5l-4.5 -1.5l2 -2h3l3 -3l-6.5 -3.5l2.5 -2.5l7.5 2.5z"></path>
                         </svg>

                    </div>
                    <span class="label_text">Hire Request</span>
                </a>
            </h2>
        </div>


        <div class="accordion-item">
            <h2>
                <a href="{{ route('vehicles') }}" @if( checkCurrentRouteNameExist(['vehicles']) ) class="sidebar_active_menu" @endif >
                    <div class="dashboard_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ambulance"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="7" cy="17" r="2"></circle>
                        <circle cx="17" cy="17" r="2"></circle>
                        <path d="M5 17h-2v-11a1 1 0 0 1 1 -1h9v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                        <path d="M6 10h4m-2 -2v4"></path>
                    </svg>
                    </div>
                    <span class="label_text">Vehicle</span>
                </a>
            </h2>
        </div>


        <div class="accordion-item">
            <h2 class="accordion-header" id="headerDropdown1">
                <button
                    class="accordion-button @if( ! checkCurrentRouteNameExist(['notification.index', 'notification.list']) ) collapsed @endif"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseEight"
                    @if( ! checkCurrentRouteNameExist(['notification.index', 'notification.list']) )
                        aria-expanded="false"
                    @else
                        aria-expanded="true"
                    @endif
                    aria-controls="collapseEight"
                >
                    <div class="dashboard_icon">
                        <svg
                            stroke="#333333"
                            fill="#333333"
                            stroke-width="0"
                            viewBox="0 0 24 24"
                            height="20"
                            width="20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                            ></path>
                        </svg>
                    </div>
                    <span class="label_text">Notification</span>
                </button>
            </h2>
            <div
                id="collapseEight"
                class="accordion-collapse collapse  @if( checkCurrentRouteNameExist(['notification.index', 'notification.list']) ) show @endif"
                aria-labelledby="headerDropdown1"
                data-bs-parent="#accordionMenu"
            >
                <div class="accordion-body">
                    <ul class="dropdown_menu_area">
                        <li>
                            <a @if( checkCurrentRouteNameExist(['notification.index']) ) class="sidebar_inner_active" @endif href="{{ route('notification.index') }}">Templates</a>
                        </li>
                        <li>
                            <a @if( checkCurrentRouteNameExist(['notification.list']) ) class="sidebar_inner_active" @endif href="{{ route('notification.list') }}">Notification</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <h2>
                <a href="{{ route('driver.log.index') }}" @if( checkCurrentRouteNameExist(['driver.log.index']) ) class="sidebar_active_menu" @endif >
                    <div class="dashboard_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="11" r="3"></circle>
                            <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                        </svg>


                    </div>
                    <span class="label_text">Driver on/offline logs</span>
                </a>
            </h2>
        </div>


    </div>
</section>
<div class="overlay sidebar_overlay" id="sidebarOverlay"></div>



