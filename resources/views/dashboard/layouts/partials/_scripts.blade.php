
<!-- BEGIN: Vendor JS-->
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/vendors.min.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/ui/prism.min.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/dashboard/resources')}}/app-assets/js/core/app-menu.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/js/core/app.js"></script>
<script src="{{asset('assets/dashboard/resources')}}/app-assets/js/scripts/components.js"></script>

<script src="{{asset('assets/dashboard/resources')}}/app-assets/js/scripts/forms/select/form-select2.js"></script>

<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
@if(app()->getLocale() == 'ar')
<script src="{{asset('assets/dashboard/resources')}}/app-assets/js/scripts/datatables/datatable-ar.js"></script>
@else
    <script src="{{asset('assets/dashboard/resources')}}/app-assets/js/scripts/datatables/datatable.js"></script>

@endif
<script src="{{asset('assets/dashboard/resources')}}/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
<!-- END: Page JS-->

<!-- CK Editor -->




<script src="https://cdn.ckeditor.com/4.14.1/full/ckeditor.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(window).on('load',  function(){
        if (feather) {
            feather.replace({ width: 14, height: 14 });
        }
    })
</script>
{{--<script src="{{asset('backend-scripts/ajax.js')}}"></script>--}}
{{--<script src="{{asset('backend-scripts/scripts.js')}}"></script>--}}
