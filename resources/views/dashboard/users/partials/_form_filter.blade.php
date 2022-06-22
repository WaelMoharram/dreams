<div class="form-group py-1 col-md-4">
    <label for="name"> {{__('Name')}} </label>
    {!! Form::text('name',request()->name ??null,['id'=>'name','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'name')}}
</div>


<div class="form-group py-1 col-md-4">
    <label for="email"> {{__('Email')}} </label>
    {!! Form::text('email',request()->email ??null,['id'=>'email','class'=>'form-control col',disable_on_show()]) !!}
    {{input_error($errors,'email')}}
</div>


<div class="form-group py-1 col-md-4">
    <label for="status"> {{__('Status')}} </label>
    {{Form::select('status',[\App\Models\User::STATUS_ACTIVE=>__('Active'),\App\Models\User::STATUS_SUSPEND=>__('Suspend')] ,request()->status ?? null,['placeholder'=>__('All'),'class'=>'form-control mb-2','id'=>'status',disable_on_show()])}}
    {{input_error($errors,'status')}}
</div>
