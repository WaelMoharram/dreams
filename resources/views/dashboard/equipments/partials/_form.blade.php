@if($errors->any() && (env('APP_DEBUG') == 'true'))
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif


<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> {{__('Equipment name in English')}}</label>
    <br>
    {!! Form::text('name[en]',($equipment ? $equipment->getTranslation('name', 'en') : null),['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'name.en')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> {{__('Equipment name in Arabic')}}</label>
    <br>
    {!! Form::text('name[ar]',($equipment ? $equipment->getTranslation('name', 'ar') : null),['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'name.ar')}}
</div>


<div class="form-group py-1 col-md-12">
    <label for="category_id"> {{__('Category')}} </label>
    {{Form::select('category_id', \App\Models\Category::whereDoesntHave('subs')->get()->pluck('name','id'),null,['class'=>'form-control mb-2','id'=>'category_id',disable_on_show()])}}
    {{input_error($errors,'category_id')}}
</div>
