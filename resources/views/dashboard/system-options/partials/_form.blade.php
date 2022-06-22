@if($errors->any() && (env('APP_DEBUG') == 'true'))
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif

<input type="hidden" name="key" value="{{$option->key}}">

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> {{__($option->key)}} </label>
    {!! Form::text('value',null,['class'=>'form-control col']) !!}
    {{input_error($errors,'value')}}
</div>
