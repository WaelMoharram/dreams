<!-- BEGIN: Header-->
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                    </ul>
{{--                    <ul class="nav navbar-nav bookmark-icons">--}}
{{--                        <li class="nav-item d-none d-lg-block"><a class="nav-link" href="sk-layout-2-columns.html" data-toggle="tooltip" data-placement="top" title="2-Columns"><i class="ficon feather icon-sidebar"></i></a></li>--}}
{{--                    </ul>--}}
{{--                    <ul class="nav navbar-nav">--}}
{{--                        <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon feather icon-star warning"></i></a>--}}
{{--                            <div class="bookmark-input search-input">--}}
{{--                                <div class="bookmark-input-icon"><i class="feather icon-search primary"></i></div>--}}
{{--                                <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="0" data-search="starter-list">--}}
{{--                                <ul class="search-list"></ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
                </div>
                <ul class="nav navbar-nav float-right">
                    <li  class="nav-item d-none d-lg-block"><a href="{{route('dashboard.switch-theme')}}" class="nav-link nav-link-style"><i data-feather="{{auth()->user()->theme_switch_icon}}"></i></a></li>
                    <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon
                        @if(App::isLocale('ar')) flag-icon-sa @else flag-icon-us @endif"></i><span class="selected-language">@if(App::isLocale('ar')) عربى @else English @endif</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            <a class="dropdown-item" href="{{route('dashboard.lang-en')}}" data-language="en">
                                <i class="flag-icon flag-icon-us"></i> English
                            </a>
                            <a class="dropdown-item" href="{{route('dashboard.lang-ar')}}" data-language="ar">
                                <i class="flag-icon flag-icon-sa"></i> عربى
                            </a>

                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
{{--                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon feather icon-search"></i></a>--}}
{{--                        <div class="search-input">--}}
{{--                            <div class="search-input-icon"><i class="feather icon-search primary"></i></div>--}}
{{--                            <input class="input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="starter-list">--}}
{{--                            <div class="search-input-close"><i class="feather icon-x"></i></div>--}}
{{--                            <ul class="search-list"></ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{auth()->user()->username}}</span>{{--<span class="user-status">Available</span>--}}</div><span><img class="round"
                 @if(auth()->user()->image != null)
                     src = "{{url(auth()->user()->image)}}"
                 @else
                 src="{{asset('assets/dashboard/resources')}}/app-assets/images/portrait/small/avatar-s-11.jpg"
                @endif                                                                                    alt="avatar" height="40" width="40"></span>

                        </a>
                        <div class="dropdown-menu dropdown-menu-right" style="width:150px;">

                            <a class="dropdown-item" href="{{route('dashboard.home.edit')}}">
                                <i class="feather icon-user"></i> {{__('Profile')}}
                            </a>
{{--                            <a class="dropdown-item" href="{{route('dashboard.switch-theme')}}">--}}
{{--                                <i class="feather icon-eye-off"></i> {{__('Switch theme')}}--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-divider"></div>--}}

                            <form method="post" action="{{route('logout')}}">
                                {{ csrf_field() }}
                            <button type=submit class="dropdown-item" style="width: 100%"><i
                                    class="feather icon-power"></i>
                                {!! __('Log out') !!}
                            </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->
