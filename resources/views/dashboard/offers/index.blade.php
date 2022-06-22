@extends('dashboard.layouts.app')
@section('title'){!! __('Offers') !!}@endsection
@section('header')@endsection

@section('breadcrumb')
    @include('dashboard.layouts.partials._breadcrumb',[
    'route'=>route('dashboard.offers.index'),
    'level'=>'Offers'
    ])
@endsection
{{--@section('btn')--}}
{{--        @include('dashboard.layouts.partials._add_icon',['route'=>'sliders','name'=>__('Add new slider')])--}}
{{--@endsection--}}
@section('content')
    <section id="column-selectors">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@yield('title')</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                @include('dashboard.offers.partials._table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

