@extends('dashboard.layouts.app')
@section('title'){!! __('Home') !!}@endsection
@section('header')
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/css/pages/dashboard-ecommerce.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/css/plugins/charts/chart-apex.min.css">
    <link rel="stylesheet" type="text/css" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/css/plugins/extensions/ext-component-toastr.min.css">@endsection

@section('content')
    <section id="column-selectors">
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h4>{{__('Search task by date')}}</h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-content">--}}
{{--                        <div class="card-body card-dashboard">--}}
{{--                            {!! Form::open(['method'=>'get','class'=>'form']) !!}--}}
{{--                            <div class="row">--}}
{{--                                @if($errors->any())--}}
{{--                                    {!! implode('', $errors->all('<div>:message</div>')) !!}--}}
{{--                                @endif--}}
{{--                                <div class="form-group py-1 col-md-6">--}}
{{--                                    <label for="from_date"> {{__('From date')}}</label>--}}
{{--                                    {!! Form::text('from',request()->from ??null,['class'=>'form-control col datepicker','id'=>'from_date']) !!}--}}
{{--                                </div>--}}

{{--                                <div class="form-group py-1 col-md-6">--}}
{{--                                    <label for="to_date"> {{__('To date')}} </label>--}}
{{--                                    {!! Form::text('to',request()->to??null,['class'=>'form-control col datepicker','id'=>'to_date']) !!}--}}
{{--                                </div>--}}
{{--                                    @if (auth()->user()->can_manage_tasks_for_users == 1)--}}
{{--                                    <div class="form-group py-1 col-md-12">--}}
{{--                                        <label for="user_id"> {{__('User')}} </label>--}}
{{--                                        {{Form::select('user_id',\App\User::get()->pluck('name','id') ,request()->user_id??null,['placeholder'=>__('Select User '),'class'=>'form-control mb-2','id'=>'user_id',disable_on_show()])}}--}}
{{--                                        {{input_error($errors,'user_id')}}--}}
{{--                                    </div>--}}
{{--@endif--}}
{{--                                <div class="col-12">--}}
{{--                                    <button type="submit" class="btn col-12 btn-primary mr-1 mb-1 waves-effect waves-light">{{__('Search')}} <i class="fa fa-search"></i></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            {!! Form::close() !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h4 class="card-title">@yield('title')</h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-content">--}}
{{--                        <div class="card-body card-dashboard">--}}
{{--                            <div class="table-responsive">--}}
{{--                                @include('dashboard.tasks.partials._table')--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

<!-- Statistics Card -->
{{--    <div class="col-xl-12 col-md-12 col-12">--}}
{{--        <div class="card card-statistics">--}}
{{--            <div class="card-header">--}}
{{--                <h4 class="card-title">Statistics</h4>--}}
{{--                <div class="d-flex align-items-center">--}}
{{--                    <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card-body statistics-body">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">--}}
{{--                        <div class="d-flex flex-row">--}}
{{--                            <div class="avatar bg-light-primary me-2">--}}
{{--                                <div class="avatar-content">--}}
{{--                                    <i data-feather="trending-up" class="avatar-icon"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="my-auto">--}}
{{--                                <h4 class="fw-bolder mb-0">230k</h4>--}}
{{--                                <p class="card-text font-small-3 mb-0">Sales</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">--}}
{{--                        <div class="d-flex flex-row">--}}
{{--                            <div class="avatar bg-light-info me-2">--}}
{{--                                <div class="avatar-content">--}}
{{--                                    <i data-feather="user" class="avatar-icon"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="my-auto">--}}
{{--                                <h4 class="fw-bolder mb-0">8.549k</h4>--}}
{{--                                <p class="card-text font-small-3 mb-0">Customers</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">--}}
{{--                        <div class="d-flex flex-row">--}}
{{--                            <div class="avatar bg-light-danger me-2">--}}
{{--                                <div class="avatar-content">--}}
{{--                                    <i data-feather="box" class="avatar-icon"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="my-auto">--}}
{{--                                <h4 class="fw-bolder mb-0">1.423k</h4>--}}
{{--                                <p class="card-text font-small-3 mb-0">Products</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-3 col-sm-6 col-12">--}}
{{--                        <div class="d-flex flex-row">--}}
{{--                            <div class="avatar bg-light-success me-2">--}}
{{--                                <div class="avatar-content">--}}
{{--                                    <i data-feather="dollar-sign" class="avatar-icon"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="my-auto">--}}
{{--                                <h4 class="fw-bolder mb-0">$9745</h4>--}}
{{--                                <p class="card-text font-small-3 mb-0">Revenue</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!--/ Statistics Card -->
    <div class="col-lg-8 col-12">
        <div class="card card-statistics">
            <div class="card-header">
                <h4 class="card-title">{{__('Statistics')}}</h4>
{{--                <div class="d-flex align-items-center">--}}
{{--                    <p class="card-text mr-25 mb-0">Updated 1 month ago</p>--}}
{{--                </div>--}}
            </div>
            <div class="card-body statistics-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                        <div class="media">
                            <div class="avatar bg-light-badge bg-primary mr-2">
                                <div class="avatar-content">
                                    <i data-feather="trending-up" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0">15</h4>
                                <p class="card-text font-small-3 mb-0">{{__('Offers')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                        <div class="media">
                            <div class="avatar bg-light-badge bg-info mr-2">
                                <div class="avatar-content">
                                    <i data-feather="trending-up" class="avatar-icon"></i>
                                </div>
                            </div>
                            <div class="media-body my-auto">
                                <h4 class="font-weight-bolder mb-0">5</h4>
                                <p class="card-text font-small-3 mb-0">{{__('Active offers')}}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    </section>

@endsection

