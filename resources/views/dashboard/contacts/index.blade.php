@extends('dashboard.layouts.app')
@section('title'){!! __('Contacts sections') !!}@endsection
@section('header')@endsection
@section('breadcrumb')
        @include('dashboard.layouts.partials._breadcrumb',['level'=>'contacts'])
@endsection
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
                                @include('dashboard.contacts.partials._table')
                                {{$contacts->links()}}

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

@endsection

