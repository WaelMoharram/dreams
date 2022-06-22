@if(\Illuminate\Support\Facades\App::isLocale('ar'))

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/vendors/css/vendors-rtl.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/vendors/css/charts/apexcharts.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/vendors/css/extensions/tether-theme-arrows.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/vendors/css/extensions/tether.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/vendors/css/extensions/shepherd-theme-default.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/bootstrap.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/colors.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/components.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/themes/semi-dark-layout.css">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/pages/dashboard-analytics.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/pages/card-analytics.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/plugins/tour/tour.css">
<!-- END: Page CSS-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css-rtl/custom-rtl.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/assets/css/style-rtl.css">
<!-- END: Custom CSS-->

@else

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/vendors/css/ui/prism.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/vendors/css/pickers/pickadate/pickadate.css">

<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/vendors/css/forms/select/select2.min.css">

<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css/bootstrap-extended.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css/colors.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css/components.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css/themes/dark-layout.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css/themes/semi-dark-layout.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css/pages/dashboard-analytics.css">

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
<!-- END: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/app-assets/css/pages/ui-feather.min.css">


<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/resources')}}/assets/css/style.css">
{{--<link rel="stylesheet" type="text/css" media="screen" href="{!! asset('css') !!}/custom-style.css"/>--}}

<!-- END: Custom CSS-->
@endif

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet"/>
