@if($errors->any() && (env('APP_DEBUG') == 'true'))
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif
<div class="form-group py-1 col-md-6">
    <label for="content-ar"> {{__('Content in Arabic')}}</label>
    {!! Form::textarea('content[ar]',($page ? $page->getTranslation('content', 'ar') : null),['id'=>'content-ar','class'=>'form-control col','placeholder'=>__("Content in Arabic"),disable_on_show()]) !!}
    {{input_error($errors,'content[ar]')}}
</div>

<div class="form-group py-1 col-md-6">
    <label for="content-en"> {{__('Content in English')}}</label>
    {!! Form::textarea('content[en]',($page ? $page->getTranslation('content', 'en') : null),['id'=>'content-en','class'=>'form-control col','placeholder'=>__("Content in English"),disable_on_show()]) !!}
    {{input_error($errors,'content[en]')}}
</div>
@section('footer')
    <script>
        CKEDITOR.replace( 'content[ar]' );
        CKEDITOR.replace( 'content[en]' );
    </script>

<script>


</script>
@endsection
