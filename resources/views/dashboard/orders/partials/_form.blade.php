@if($errors->any() && (env('APP_DEBUG') == 'true'))
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> {{__('Title')}}  </label>
    {!! Form::text('title',null,['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'title')}}
</div>
<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> {{__('Description')}}  </label>
    {!! Form::textarea('description',null,['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'description')}}
</div>
<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> {{__('Usage')}}  </label>
    {!! Form::textarea('how_to_use',null,['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'how_to_use')}}
</div>
<div class="form-group py-1 col-md-12">
    <label for="status"> {{__('City')}} </label>
    {{Form::select('city_id',\App\Models\City::all()->pluck('name','id') , null,['class'=>'form-control mb-2','id'=>'status',disable_on_show()])}}
    {{input_error($errors,'city_id')}}
</div>



