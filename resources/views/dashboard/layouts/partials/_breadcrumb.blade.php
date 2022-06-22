
<h2 class="content-header-title float-left mb-0">@yield('title')</h2>
<div class="breadcrumb-wrapper col-12">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('Home')}}</a>
        </li>
        <li class="breadcrumb-item"><a href="{!!$route ?? '#' !!}">{{__(ucfirst($level))}}</a>
        </li>
{{--        <li class="breadcrumb-item active">@yield('title')--}}
{{--        </li>--}}
    </ol>
</div>
