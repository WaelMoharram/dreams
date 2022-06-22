@if($errors->any() && (env('APP_DEBUG') == 'true'))
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif

@if(isset($provider->image))
    <div class="col-md-12">
        <img id="image" src="{{url($provider->image)}}" style="width: 100px;border-radius: 50px;">
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

<div class="form-group py-1 col-md-12">
    <label for="name"> {{__('Name')}}</label>
    {!! Form::text('name',null,['id'=>'name','class'=>'form-control col','placeholder'=>__("Name"),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="city_id"> {{__('Type')}} </label>
    {{Form::select('account_type',[\App\Models\User::TYPE_INDIVIDUAL=>__('Individual'),\App\Models\User::TYPE_COMPANY=>__('Company')] ,null,['placeholder'=>__('Select type'),'class'=>'form-control mb-2','id'=>'city_id',disable_on_show()])}}
    {{input_error($errors,'account_type')}}
</div>


@if(isset($provider->id_image))
    <div class="col-md-12">
        <img id="id_image" src="{{url($provider->id_image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@else
    <div class="col-md-12">
        <img id="id_image" style="width: 100px;border-radius: 50px;">
    </div>
@endif

<div class="form-group py-1 col-md-12">
    <label for="id_image_input"> {{__('ID Image')}}</label>
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


<div class="form-group py-1 col-md-12">
    <label for="bank_name"> {{__('Bank name')}}</label>
    {!! Form::text('bank_name',null,['id'=>'bank_name','class'=>'form-control col','placeholder'=>__("Bank name"),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'bank_name')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="bank_account_number"> {{__('Bank account number')}}</label>
    {!! Form::text('bank_account_number',null,['id'=>'bank_account_number','class'=>'form-control col','placeholder'=>__("Bank account number"),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'bank_account_number')}}
</div>

<div class="form-group py-1 col-md-12">
    <label for="bank_iban"> {{__('Bank IBAN')}}</label>
    {!! Form::text('bank_iban',null,['id'=>'bank_iban','class'=>'form-control col','placeholder'=>__("Bank IBAN"),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'bank_iban')}}
</div>

<div class="form-group py-1 col-md-3">
    <label for="transportation_services"> {{__('Has transportation services ?')}} </label>
    {{Form::select('transportation_services',[1=>__('Yes'),0=>__('No')] ,null,['class'=>'form-control mb-2','id'=>'transportation_services',disable_on_show()])}}
    {{input_error($errors,'transportation_services')}}
</div>

<div class="form-group py-1 col-md-3">
    <label for="rent_services"> {{__('Has Rent services ?')}} </label>
    {{Form::select('rent_services',[1=>__('Yes'),0=>__('No')] ,null,['class'=>'form-control mb-2','id'=>'rent_services',disable_on_show()])}}
    {{input_error($errors,'rent_services')}}
</div>

<div class="form-group py-1 col-md-3">
    <label for="sell_services"> {{__('Has Sell services ?')}} </label>
    {{Form::select('sell_services',[1=>__('Yes'),0=>__('No')] ,null,['class'=>'form-control mb-2','id'=>'sell_services',disable_on_show()])}}
    {{input_error($errors,'sell_services')}}
</div>


@if(isset($provider->driving_license_image))
    <div class="col-md-12">
        <img id="driving_license_image" src="{{url($provider->driving_license_image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@else
    <div class="col-md-12">
        <img id="driving_license_image" style="width: 100px;border-radius: 50px;">
    </div>
@endif

<div class="form-group py-1 col-md-12">
    <label for="driving_license_image_input"> {{__('Driving license Image')}}</label>
    <br>
    {!! Form::file('driving_license_image',['id'=>'driving_license_image_input','class'=>'form-control col','placeholder'=>__("Image"),'onchange'=>"loadDrivingImage(event)"]) !!}
    {{input_error($errors,'driving_license_image')}}
</div>




@if(isset($provider->working_license_image))
    <div class="col-md-12">
        <img id="working_license_image" src="{{url($provider->working_license_image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@else
    <div class="col-md-12">
        <img id="working_license_image" style="width: 100px;border-radius: 50px;">
    </div>
@endif

<div class="form-group py-1 col-md-12">
    <label for="working_license_image_input"> {{__('Working license Image')}}</label>
    <br>
    {!! Form::file('working_license_image',['id'=>'working_license_image_input','class'=>'form-control col','placeholder'=>__("Image"),'onchange'=>"loadWorkingImage(event)"]) !!}
    {{input_error($errors,'working_license_image')}}
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

        var loadDrivingImage = function(event) {
            console.log('driving_license_image')

            var output = document.getElementById('driving_license_image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        var loadWorkingImage = function(event) {
            console.log('working_license_image')

            var output = document.getElementById('working_license_image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    </script>
@endsection
