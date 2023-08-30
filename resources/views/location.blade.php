@extends('layouts.app')

@section('content')

<section class="product_table_wrapper project_list_table_wrapper dashboard_card">
<div class="header_area d-flex-between g-sm">
  <h2 class="page_title">Location of Drivers</h2>
  <form action="" class="search_form_area">
    <div class="search_input_area">
      <input type="text" placeholder="Search....." />
    </div>
    <div class="search_icon">
      <button type="submit">
        <img
          src="{{ asset('assets/images/icon/search_black_icon.svg')}}"
          alt="search bar"
        />
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
            <h4>Description</h4>
          </td>
          <td>
            <h4>Date</h4>
          </td>
          <td>
            <h4>Amount</h4>
          </td>
          <td>
            <h4>Status</h4>
          </td>

          <td>
            <h4>Actions</h4>
          </td>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>
            <div class="user_info_grid">
              <div class="user_img_area">
                <img
                  src="{{ asset('assets/images/others/transication_user_img_1.png')}}"
                  alt="user img"
                  class="user_img"
                />
              </div>
              <div>
                <h4>Admin UI Design</h4>
                <h5>
                  It will be a very simple project. Just the frontend
                  design, no backend necessary as of now
                </h5>
              </div>
            </div>
          </td>
          <td>
            <div>
              <h4>29 Jan 2022</h4>
            </div>
          </td>
          <td>
            <div>
              <h4>$811.45</h4>
            </div>
          </td>
          <td>
            <div>
              <h5 class="status progress_status">On Going</h5>
            </div>
          </td>
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
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 1</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 2</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 3</a
                  >
                </li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="user_info_grid">
              <div class="user_img_area">
                <img
                  src="{{ asset('assets/images/others/transication_user_img_2.png')}}"
                  alt="user img"
                  class="user_img"
                />
              </div>
              <div>
                <div>
                  <h4>Admin UI Design</h4>
                  <h5>
                    It will be a very simple project. Just the frontend
                    design, no backend necessary as of now
                  </h5>
                </div>
              </div>
            </div>
          </td>
          <td>
            <div>
              <h4>29 Jan 2022</h4>
            </div>
          </td>
          <td>
            <div>
              <h4>$811.45</h4>
            </div>
          </td>
          <td>
            <div>
              <h5 class="status complete_status">Completed</h5>
            </div>
          </td>
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
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 1</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 2</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 3</a
                  >
                </li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="user_info_grid">
              <div class="user_img_area">
                <img
                  src="{{ asset('assets/images/others/transication_user_img_3.png')}}"
                  alt="user img"
                  class="user_img"
                />
              </div>
              <div>
                <h4>Admin UI Design</h4>
                <h5>
                  It will be a very simple project. Just the frontend
                  design, no backend necessary as of now
                </h5>
              </div>
            </div>
          </td>
          <td>
            <div>
              <h4>29 Jan 2022</h4>
            </div>
          </td>
          <td>
            <div>
              <h4>$811.45</h4>
            </div>
          </td>
          <td>
            <div>
              <h5 class="status failed_status">Failed</h5>
            </div>
          </td>
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
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 1</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 2</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 3</a
                  >
                </li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="user_info_grid">
              <div class="user_img_area">
                <img
                  src="{{ asset('assets/images/others/transication_user_img_1.png')}}"
                  alt="user img"
                  class="user_img"
                />
              </div>
              <div>
                <h4>Admin UI Design</h4>
                <h5>
                  It will be a very simple project. Just the frontend
                  design, no backend necessary as of now
                </h5>
              </div>
            </div>
          </td>
          <td>
            <div>
              <h4>29 Jan 2022</h4>
            </div>
          </td>
          <td>
            <div>
              <h4>$811.45</h4>
            </div>
          </td>
          <td>
            <div>
              <h5 class="status progress_status">On Going</h5>
            </div>
          </td>
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
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 1</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 2</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 3</a
                  >
                </li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="user_info_grid">
              <div class="user_img_area">
                <img
                  src="{{ asset('assets/images/others/transication_user_img_2.png')}}"
                  alt="user img"
                  class="user_img"
                />
              </div>
              <div>
                <div>
                  <h4>Admin UI Design</h4>
                  <h5>
                    It will be a very simple project. Just the frontend
                    design, no backend necessary as of now
                  </h5>
                </div>
              </div>
            </div>
          </td>
          <td>
            <div>
              <h4>29 Jan 2022</h4>
            </div>
          </td>
          <td>
            <div>
              <h4>$811.45</h4>
            </div>
          </td>
          <td>
            <div>
              <h5 class="status complete_status">Completed</h5>
            </div>
          </td>
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
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 1</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 2</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 3</a
                  >
                </li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="user_info_grid">
              <div class="user_img_area">
                <img
                  src="{{ asset('assets/images/others/transication_user_img_3.png')}}"
                  alt="user img"
                  class="user_img"
                />
              </div>
              <div>
                <h4>Admin UI Design</h4>
                <h5>
                  It will be a very simple project. Just the frontend
                  design, no backend necessary as of now
                </h5>
              </div>
            </div>
          </td>
          <td>
            <div>
              <h4>29 Jan 2022</h4>
            </div>
          </td>
          <td>
            <div>
              <h4>$811.45</h4>
            </div>
          </td>
          <td>
            <div>
              <h5 class="status failed_status">Failed</h5>
            </div>
          </td>
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
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 1</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 2</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 3</a
                  >
                </li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="user_info_grid">
              <div class="user_img_area">
                <img
                  src="{{ asset('assets/images/others/transication_user_img_1.png')}}"
                  alt="user img"
                  class="user_img"
                />
              </div>
              <div>
                <h4>Admin UI Design</h4>
                <h5>
                  It will be a very simple project. Just the frontend
                  design, no backend necessary as of now
                </h5>
              </div>
            </div>
          </td>
          <td>
            <div>
              <h4>29 Jan 2022</h4>
            </div>
          </td>
          <td>
            <div>
              <h4>$811.45</h4>
            </div>
          </td>
          <td>
            <div>
              <h5 class="status progress_status">On Going</h5>
            </div>
          </td>
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
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 1</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 2</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 3</a
                  >
                </li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="user_info_grid">
              <div class="user_img_area">
                <img
                  src="{{ asset('assets/images/others/transication_user_img_2.png')}}"
                  alt="user img"
                  class="user_img"
                />
              </div>
              <div>
                <div>
                  <h4>Admin UI Design</h4>
                  <h5>
                    It will be a very simple project. Just the frontend
                    design, no backend necessary as of now
                  </h5>
                </div>
              </div>
            </div>
          </td>
          <td>
            <div>
              <h4>29 Jan 2022</h4>
            </div>
          </td>
          <td>
            <div>
              <h4>$811.45</h4>
            </div>
          </td>
          <td>
            <div>
              <h5 class="status complete_status">Completed</h5>
            </div>
          </td>
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
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 1</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 2</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 3</a
                  >
                </li>
              </ul>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="user_info_grid">
              <div class="user_img_area">
                <img
                  src="{{ asset('assets/images/others/transication_user_img_3.png')}}"
                  alt="user img"
                  class="user_img"
                />
              </div>
              <div>
                <h4>Admin UI Design</h4>
                <h5>
                  It will be a very simple project. Just the frontend
                  design, no backend necessary as of now
                </h5>
              </div>
            </div>
          </td>
          <td>
            <div>
              <h4>29 Jan 2022</h4>
            </div>
          </td>
          <td>
            <div>
              <h4>$811.45</h4>
            </div>
          </td>
          <td>
            <div>
              <h5 class="status failed_status">Failed</h5>
            </div>
          </td>
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
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 1</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 2</a
                  >
                </li>
                <li>
                  <a class="dropdown-item" href="#"
                    >Dropdown Option 3</a
                  >
                </li>
              </ul>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="pagination">
  <ul>
    <li>
      <button type="button">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          aria-hidden="true"
          role="img"
          width="1.2em"
          height="1.5em"
          preserveAspectRatio="xMidYMid meet"
          viewBox="0 0 24 24"
        >
          <path
            fill="currentColor"
            d="M10 6L8.59 7.41L13.17 12l-4.58 4.59L10 18l6-6z"
          />
        </svg>
      </button>
    </li>
    <li class="active"><a href="">1</a></li>
    <li><a href="">2</a></li>
    <li>
      <button type="button">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          aria-hidden="true"
          role="img"
          width="1.2em"
          height="1.5em"
          preserveAspectRatio="xMidYMid meet"
          viewBox="0 0 24 24"
        >
          <path
            fill="currentColor"
            d="M10 6L8.59 7.41L13.17 12l-4.58 4.59L10 18l6-6z"
          />
        </svg>
      </button>
    </li>
  </ul>
</div>
</section>
@endsection
