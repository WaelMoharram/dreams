@if($errors->any() && (env('APP_DEBUG') == 'true'))
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif

@if(isset($user->image))
    <div class="col-md-12">
        <img id="image" src="{{url($user->image)}}" style="width: 100px;border-radius: 50px;">
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

<div class="form-group py-1 col-md-4">
    <label for="first_name"> {{__('First name')}}</label>
    {!! Form::text('first_name',null,['id'=>'first_name','class'=>'form-control col','placeholder'=>__("First name"),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'first_name')}}
</div>


<div class="form-group py-1 col-md-4">
    <label for="middle_name"> {{__('Middle name')}}</label>
    {!! Form::text('middle_name',null,['id'=>'middle_name','class'=>'form-control col','placeholder'=>__("Middle name"),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'middle_name')}}
</div>



<div class="form-group py-1 col-md-4">
    <label for="last_name"> {{__('Last name')}}</label>
    {!! Form::text('last_name',null,['id'=>'last_name','class'=>'form-control col','placeholder'=>__("Last name"),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
    {{input_error($errors,'last_name')}}
</div>
<div class="form-group py-1 col-md-12">
    <label for="formInputRole"> {{__('National ID')}} </label>
    {!! Form::text('national_id',null,['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'national_id')}}
</div>
@if(isset($user->national_id_image))
    <div class="col-md-12">
        <img id="national_id_image" src="{{url($user->national_id_image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@else
    <div class="col-md-12">
        <img id="national_id_image" style="width: 100px;border-radius: 50px;">
    </div>
@endif

<div class="form-group py-1 col-md-12">
    <label for="national_id_image_input"> {{__('National ID Image')}}</label>
    <br>
    {!! Form::file('national_id_image',['id'=>'national_id_image_input','class'=>'form-control col','placeholder'=>__("Image"),'onchange'=>"loadNationalImage(event)"]) !!}
    {{input_error($errors,'national_id_image')}}
</div>

<div class="form-group py-1 col-md-4">
    <label for="formInputRole"> {{__('Email')}} </label>
    {!! Form::email('email',null,['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'email')}}
</div>

<div class="form-group py-1 col-md-4">
    <label for="formInputRole"> {{__('Mobile')}} </label>
    {!! Form::text('mobile',null,['class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'mobile')}}
</div>

<div class="form-group py-1 col-md-4">
    <label for="formInputRole"> {{__('Birthdate')}} </label>
    {!! Form::text('birthdate',null,['class'=>'datepicker form-control col',disable_on_show()]) !!}
    {{input_error($errors,'birthdate')}}
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
    <label for="city_id"> {{__('City')}} </label>
    {{Form::select('city_id',\App\Models\City::all()->pluck('name','id') ,null,['placeholder'=>__('Select city'),'class'=>'form-control mb-2','id'=>'city_id',disable_on_show()])}}
    {{input_error($errors,'city_id')}}
</div>


<div class="form-group py-1 col-md-6">
    <label for="nationality_id"> {{__('Nationality')}} </label>
    {{Form::select('nationality_id',\App\Models\Nationality::all()->pluck('name','id') ,null,['placeholder'=>__('Select nationality'),'class'=>'form-control mb-2','id'=>'nationality_id',disable_on_show()])}}
    {{input_error($errors,'nationality_id')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="car_brand"> {{__('Car brand')}} </label>
    {!! Form::text('car_brand',null,['id'=>'car_brand','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'car_brand')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="car_model"> {{__('Car model')}} </label>
    {!! Form::text('car_model',null,['id'=>'car_model','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'car_model')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="car_year"> {{__('Car year')}} </label>
    {!! Form::number('car_year',null,['id'=>'car_year','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'car_year')}}
</div>



<div class="form-group py-1 col-md-6">
    <label for="car_plate_number"> {{__('Car plate number')}} </label>
    {!! Form::text('car_plate_number',null,['id'=>'car_plate_number','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'car_plate_number')}}
</div>

@if(isset($user->car_license_image))
    <div class="col-md-12">
        <img id="car_license_image" src="{{url($user->car_license_image)}}" style="width: 100px;border-radius: 50px;">
    </div>
@else
    <div class="col-md-12">
        <img id="car_license_image" style="width: 100px;border-radius: 50px;">
    </div>
@endif

<div class="form-group py-1 col-md-12">
    <label for="car_license_image_input"> {{__('Car license image')}}</label>
    <br>
    {!! Form::file('car_license_image',['id'=>'car_license_image_input','class'=>'form-control col','placeholder'=>__("Image"),'onchange'=>"loadLicenseImage(event)"]) !!}
    {{input_error($errors,'car_license_image')}}
</div>


<div class="form-group py-1 col-md-6">
    <label for="bank_id"> {{__('Bank')}} </label>
    {{Form::select('bank_id',\App\Models\Bank::all()->pluck('name','id') ,null,['placeholder'=>__('Select nationality'),'class'=>'form-control mb-2','id'=>'bank_id',disable_on_show()])}}
    {{input_error($errors,'bank_id')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="bank_account_owner"> {{__('Bank account owner')}} </label>
    {!! Form::text('bank_account_owner',null,['id'=>'bank_account_owner','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'bank_account_owner')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="	bank_iban"> {{__('Bank IBAN')}} </label>
    {!! Form::text('bank_iban',null,['id'=>'bank_iban','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'bank_iban')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="bank_account_number"> {{__('Bank account number')}} </label>
    {!! Form::text('bank_account_number',null,['id'=>'bank_account_number','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'bank_account_number')}}
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
            console.log('national_id_image')

            var output = document.getElementById('national_id_image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var loadLicenseImage = function(event) {
            console.log('car_license_image')

            var output = document.getElementById('car_license_image');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection
