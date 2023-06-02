<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ url('index') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo/logokotak.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo/logo.png') }}" alt="" height="20">
            </span>
        </a>

        <a href="{{ url('index') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('/assets/images/logo/logokotak.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('/assets/images/logo/log.png') }}" alt="" height="20">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                <li>
                    {{-- <a href="{{url('index')}}"> --}}
                    <a href="dashboard">
                        <i class="uil-home-alt"></i>
                        <span>@lang('translation.Dashboard')</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-database-alt"></i>
                        <span>@lang('translation.Master')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href={{ url('master-jenis') }}>@lang('translation.Jenis')</a></li>
                        <li><a href={{ url('master-golongan') }}>@lang('translation.Golongan')</a></li>
                        <li><a href={{ url('master-barang') }}>@lang('translation.Barang')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-vertical-distribution-top"></i>
                        <span>@lang('Transaksi')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href={{ url('barang-masuk') }}>@lang('Masuk')</a></li>
                        <li><a href={{ url('barang-keluar') }}>@lang('Keluar')</a></li>
                    </ul>
                </li>

                {{-- <li class="menu-title">@lang('Setting')</li>
                <li>
                    <a href="{{ url('admin/websetup') }}">
                        <i class="uil-analytics"></i>
                        <span>@lang('Setup Web')</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-database"></i>
                        <span>@lang('Sync Database')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="#">@lang('Sync Products')</a></li>
                        <li><a href="#">@lang('Sync Orders')</a></li> --}}

                {{-- <li><a href="sync">@lang('Sync Vend')</a></li>
                        <li><a href="sync">@lang('Sync Email Vend')</a></li> --}}
                {{-- </ul>
                </li> --}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
