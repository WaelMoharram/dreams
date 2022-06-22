@if($errors->any() && (env('APP_DEBUG') == 'true'))
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif

<div class="form-group py-1 col-md-12">
    <label for="name"> {{__('Name')}}</label>
    {!! Form::text('name',null,['id'=>'name','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="email"> {{__('Email')}}</label>
    {!! Form::text('email',null,['id'=>'email','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'email')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="mobile"> {{__('Mobile')}}</label>
    {!! Form::text('mobile',null,['id'=>'mobile','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'mobile')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="message"> {{__('Message')}}</label>
    {!! Form::textarea('message',null,['id'=>'message','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'message')}}
</div>

