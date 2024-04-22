<div class="sidebar-wrapper " data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{URL::to('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Camp</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @can('dashboard')
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @endcan
        @can('team')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Teams</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.team') }}"><i class='bx bx-radio-circle'></i>All Team</a>
                </li>
                <li> <a href="{{ route('add.team') }}"><i class='bx bx-radio-circle'></i>Add Team</a>
                </li>
            </ul>
        </li>
        @endcan
        @can('bookarea')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i></div>
                <div class="menu-title">Manage Book Area</div>
            </a>
            <ul>
                <li> <a href="{{ route('book.area') }}"><i class='bx bx-radio-circle'></i>Update BookArea</a></li>
            </ul>
        </li>
        @endcan

        @can('huts')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i></div>
                <div class="menu-title">Manage Hut Type</div>
            </a>
            <ul>
                <li> <a href="{{ route('hut.type.list') }}"><i class='bx bx-radio-circle'></i>Hut Type List</a></li>
                <li> <a href="{{ route('add.hut.type') }}"><i class='bx bx-radio-circle'></i>Add Hut Type</a></li>
            </ul>
        </li>
        @endcan

        @can('booking')
        <li class="menu-label">Booking Manage</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i></div>
                <div class="menu-title">Booking</div>
            </a>
            <ul>
                <li> <a href="{{ route('booking.list') }}"><i class='bx bx-radio-circle'></i>Booking List </a></li>
                <li> <a href="{{ route('add.hut.list') }}"><i class='bx bx-radio-circle'></i>Add Booking </a></li>
            </ul>
        </li>
        @endcan

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i></div>
                <div class="menu-title">Users Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('users.list') }}"><i class='bx bx-radio-circle'></i>Users List </a></li>
                <li> <a href="{{ route('add.hut.list') }}"><i class='bx bx-radio-circle'></i>Add User </a></li>
            </ul>
        </li>

        @can('hutlist')
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage HutList</div>
            </a>
            <ul>
                <li> <a href="{{ route('view.hut.list') }}"><i class='bx bx-radio-circle'></i>Hut List</a>

                </li>
            </ul>
        </li>
        @endcan
        @can('setting')
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Setting</div>
            </a>
            <ul>
                <li> <a href="{{ route('smtp.setting') }}"><i class='bx bx-radio-circle'></i>SMTP Setting</a>
                </li>
                <li> <a href="{{ route('site.setting') }}"><i class='bx bx-radio-circle'></i>Site Setting</a>
                </li>
            </ul>
        </li>
        @endcan
        @can('tesimonial')
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Tesimonial</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.testimonial') }}"><i class='bx bx-radio-circle'></i>All Testimonial</a>
                </li>

                <li> <a href="{{ route('add.testimonial') }}"><i class='bx bx-radio-circle'></i>Add Testimonial</a>
                </li>


            </ul>
        </li>
        @endcan
        @can('report')
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Booking Report </div>
            </a>
            <ul>
                <li> <a href="{{ route('booking.report') }}"><i class='bx bx-radio-circle'></i>Booking Report </a>
                </li>

            </ul>
        </li>
        @endcan
        @can('gallery')
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Hotel Gallery </div>
            </a>
            <ul>
                <li> <a href="{{ route('all.gallery') }}"><i class='bx bx-radio-circle'></i>All Gallery </a>
                </li>

            </ul>
        </li>
        @endcan
        @can('contact')
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Contact Message </div>
            </a>
            <ul>
                <li> <a href="{{ route('contact.message') }}"><i class='bx bx-radio-circle'></i>Contact Message </a>
                </li>

            </ul>
        </li>
        @endcan
        @can('roles')
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Roles And Permissions </div>
            </a>
            <ul>
                <li> <a href="{{ route('roles.index') }}"><i class='bx bx-radio-circle'></i>Roles With Permissions </a>
                </li>
                <li> <a href="{{ route('roles.create') }}"><i class='bx bx-radio-circle'></i>Add Role </a>
                </li>

            </ul>
        </li>
        @endcan
    </ul>
    <!--end navigation-->
</div>