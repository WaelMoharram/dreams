@if($errors->any() && (env('APP_DEBUG') == 'true'))
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif
@if(isset($category->image))
    <div class="col-md-12">
        <img id="image" src="{{url($category->image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@else
    <div class="col-md-12">
        <img id="image" style="width: 100px;border-radius: 50px;">
    </div>
@endif

<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> {{__('Image')}}</label>
    <br>
    {!! Form::file('image',['class'=>'form-control col','placeholder'=>__("Slider image"),'onchange'=>"loadImage(event)"]) !!}
    {{input_error($errors,'image')}}
</div>

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

<div class="form-group py-1 col-md-4">
    <label for="status"> {{__('Is sales')}} </label>
    {{Form::select('is_sell',[0=>__('No'),1=>__('Yes')] ,null,['class'=>'form-control mb-2','id'=>'is_sell',disable_on_show()])}}
    {{input_error($errors,'is_sell')}}
</div>

<div class="form-group py-1 col-md-4">
    <label for="status"> {{__('Is rent')}} </label>
    {{Form::select('is_rent',[0=>__('No'),1=>__('Yes')] ,null,['class'=>'form-control mb-2','id'=>'is_rent',disable_on_show()])}}
    {{input_error($errors,'is_rent')}}
</div>

<div class="form-group py-1 col-md-4">
    <label for="status"> {{__('Is transportation')}} </label>
    {{Form::select('is_transportation',[0=>__('No'),1=>__('Yes')] ,null,['class'=>'form-control mb-2','id'=>'is_transportation',disable_on_show()])}}
    {{input_error($errors,'is_transportation')}}
</div>



@section('footer')
    {{--    <script>--}}
    {{--        CKEDITOR.replace( 'content' );--}}
    {{--    </script>--}}

    <script>
        console.log('out')



        var loadImage = function(event) {
            console.log('image')

            var output = document.getElementById('image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    </script>
@endsection
