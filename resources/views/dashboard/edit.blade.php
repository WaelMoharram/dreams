@extends('dashboard.layouts.app')
@section('title'){!! __('Edit profile') !!}@endsection
@section('header')@endsection
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
                            {!! Form::model($administrator,['files'=>'true','method'=>'put','route'=>['dashboard.home.update',$administrator->id],'class'=>'form']  ) !!}
                            @csrf()
                            <div class="row">


                                <div class="form-group py-1 col-md-6">
                                    <label for="formInputRole"> {{__('Full name')}}</label>
                                    {!! Form::text('name',null,['class'=>'form-control col','placeholder'=>__("Full name"),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
                                    {{input_error($errors,'name')}}
                                </div>

                                <div class="form-group py-1 col-md-6">
                                    <label for="formInputRole"> {{__('Email')}} </label>
                                    {!! Form::email('email',null,['class'=>'form-control col',disable_on_show()]) !!}
                                    {{input_error($errors,'email')}}
                                </div>
                                <div class="form-group py-1 col-md-6 {{hidden_on_show()}}">
                                    <label for="formInputRole"> {{__('Password')}} </label>
                                    {!! Form::password('password',['class'=>'form-control col',]) !!}
                                    {{input_error($errors,'password')}}
                                </div>

                                <div class="form-group py-1 col-md-6 {{hidden_on_show()}}">
                                    <label for="formInputRole"> {{__('Confirm password')}} </label>
                                    {!! Form::password('password_confirmation',['class'=>'form-control col',hidden_on_show()]) !!}
                                    {{input_error($errors,'password_confirmation')}}
                                </div>



                            @component('dashboard.layouts.partials.buttons._save_button',[])
                                @endcomponent
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

