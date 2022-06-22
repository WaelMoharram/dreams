@if($errors->any() && (env('APP_DEBUG') == 'true'))
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> {{__('Category name in English')}}</label>
    <br>
    {!! Form::text('name[en]',($category ? $category->getTranslation('name', 'en') : null),['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'name.en')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> {{__('Category name in Arabic')}}</label>
    <br>
    {!! Form::text('name[ar]',($category ? $category->getTranslation('name', 'ar') : null),['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'name.ar')}}
</div>
<input type="hidden" name="category_id" value="{{$categpry->upper_id ?? request('id') ?? null}}">
