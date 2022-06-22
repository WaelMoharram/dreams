@if($errors->any() && (env('APP_DEBUG') == 'true'))
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif
@if(isset($client->image))
    <div class="col-md-12">
        <img id="image" src="{{url($client->image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@else
    <div class="col-md-12">
        <img id="image" style="width: 100px;border-radius: 50px;">
    </div>
@endif

<div class="form-group py-1 col-md-12">
    <label for="image_input"> {{__('Image')}}</label>
    <br>
    {!! Form::file('image',['id'=>'image_input','class'=>'form-control col','placeholder'=>__("Image"),'onchange'=>"loadImage(event)"]) !!}
    {{input_error($errors,'image')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="name"> {{__('Name')}} {!! label_required() !!}</label>
    {!! Form::text('name',null,['id'=>'name','class'=>'form-control col','placeholder'=>__("Name"),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="city_id"> {{__('Type')}} </label>
    {{Form::select('account_type',[\App\Models\User::TYPE_INDIVIDUAL=>__('Individual'),\App\Models\User::TYPE_COMPANY=>__('Company')] ,null,['placeholder'=>__('Select type'),'class'=>'form-control mb-2','id'=>'city_id',disable_on_show()])}}
    {{input_error($errors,'account_type')}}
</div>


@if(isset($client->id_image))
    <div class="col-md-12">
        <img id="id_image" src="{{url($client->id_image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@else
    <div class="col-md-12">
        <img id="id_image" style="width: 100px;border-radius: 50px;">
    </div>
@endif

<div class="form-group py-1 col-md-12">
    <label for="id_image_input"> {{__('ID Image - Commercial record image
')}}</label>
    <br>
    {!! Form::file('id_image',['id'=>'id_image_input','class'=>'form-control col','placeholder'=>__("Image"),'onchange'=>"loadNationalImage(event)"]) !!}
    {{input_error($errors,'id_image')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="formInputRole"> {{__('Email')}} </label>
    {!! Form::email('email',null,['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'email')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="formInputRole"> {{__('Mobile')}}  {!! label_required() !!}</label>
    {!! Form::text('mobile',null,['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'mobile')}}
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


<div class="form-group py-1 col-md-6">
    <label for="city_id"> {{__('City')}}  {!! label_required() !!}</label>
    {{Form::select('city_id',\App\Models\City::all()->pluck('name','id') ,null,['placeholder'=>__('Select city'),'class'=>'form-control mb-2','id'=>'city_id',disable_on_show()])}}
    {{input_error($errors,'city_id')}}
</div>





@section('footer')

    <script>
        var loadImage = function(event) {
            console.log('image')

            var output = document.getElementById('image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        var loadNationalImage = function(event) {
            console.log('id_image')

            var output = document.getElementById('id_image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    </script>
@endsection
