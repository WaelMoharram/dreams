<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{route('dashboard.home')}}">
                    <div>
<img src="{{asset('assets')}}/dashboard/resources/app-assets/images/logo.png" style="
    width: 30px;
    margin-bottom: 7px;"></div>
                    <h2 class="brand-text mb-0">{{__(env('APP_NAME'))}}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item @if(Request::is('dashboard/home')) active open  @endif">
                <a href="{{route('dashboard.home')}}">
                    <i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">{{__('Home')}}</span>
                </a>
            </li>

            <li class=" nav-item @if(Request::is('dashboard/users')) active open  @endif">
                <a href="{{route('dashboard.users.index')}}">
                    <i class="feather icon-users"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Users')}}</span>
                </a>
            </li>

{{--            <li class=" nav-item @if(Request::is('dashboard/archive-users')) active open  @endif">--}}
{{--                <a href="{{route('dashboard.archive-users')}}">--}}
{{--                    <i class="feather icon-users"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Archived criours')}}</span>--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class=" nav-item @if(Request::is('dashboard/clients')) active open  @endif">
                <a href="{{route('dashboard.clients.index')}}">
                    <i class="feather icon-users"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Clients')}}</span>
                </a>
            </li>

            <li class=" nav-item @if(Request::is('dashboard/archive-clients')) active open  @endif">
                <a href="{{route('dashboard.archive-clients')}}">
                    <i class="feather icon-users"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Archived clients')}}</span>
                </a>
            </li>

            <li class=" nav-item @if(Request::is('dashboard/providers')) active open  @endif">
                <a href="{{route('dashboard.providers.index')}}">
                    <i class="feather icon-users"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Providers')}}</span>
                </a>
            </li>

            <li class=" nav-item @if(Request::is('dashboard/archive-providers')) active open  @endif">
                <a href="{{route('dashboard.archive-providers')}}">
                    <i class="feather icon-users"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Archived providers')}}</span>
                </a>
            </li>




            <li class=" nav-item @if(Request::is('dashboard/categories')) active open  @endif">
                <a href="{{route('dashboard.categories.index')}}">
                    <i class="feather icon-folder"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Categories')}}</span>
                </a>
            </li>

            <li class=" nav-item @if(Request::is('dashboard/brands')) active open  @endif">
                <a href="{{route('dashboard.brands.index')}}">
                    <i class="feather icon-gift"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Brands')}}</span>
                </a>
            </li>

            <li class=" nav-item @if(Request::is('dashboard/equipments')) active open  @endif">
                <a href="{{route('dashboard.equipments.index')}}">
                    <i class="feather icon-settings"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Equipments')}}</span>
                </a>
            </li>
            <li class=" nav-item @if(Request::is('dashboard/offers')) active open  @endif">
                <a href="{{route('dashboard.offers.index')}}">
                    <i class="feather icon-image"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Offers')}}</span>
                </a>
            </li>
            <li class=" nav-item @if(Request::is('dashboard/orders')) active open  @endif">
                <a href="{{route('dashboard.orders.index')}}">
                    <i class="feather icon-image"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Orders')}}</span>
                </a>
            </li>


            <li class=" nav-item @if(Request::is('dashboard/sliders')) active open  @endif">
                <a href="{{route('dashboard.sliders.index')}}">
                    <i class="feather icon-image"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Sliders')}}</span>
                </a>
            </li>





            <li class=" nav-item @if(Request::is('dashboard/contacts')) active open  @endif">
                <a href="{{route('dashboard.contacts.index')}}">
                    <i class="feather icon-users"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Contact')}}</span>
                </a>
            </li>


            <li class=" nav-item @if(Request::is('dashboard/cities')) active open  @endif">
                <a href="{{route('dashboard.cities.index')}}">
                    <i class="feather icon-home"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('Cities')}}</span>
                </a>
            </li>


            <li class=" nav-item @if(Request::is('dashboard/system-options')) active open  @endif">
                <a href="{{route('dashboard.system-options.index')}}">
                    <i class="feather icon-settings"></i><span class="menu-item" data-i18n="Fixed navbar">{{__('System options')}}</span>
                </a>
            </li>


        </ul>
    </div>
</div>
<!-- END: Main Menu-->
