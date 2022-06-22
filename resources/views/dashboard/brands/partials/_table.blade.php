<table class="table table-striped {{--dataex-html5-selectors--}}">
    <thead>
    <tr>
        <th scope="col">{{__('#') }}</th>
        <th scope="col">{{__('Name in Arabic')}}</th>
        <th scope="col">{{__('Name in English')}}</th>
        <th scope="col ">{{__('Options')}}</th>
    </thead>
    <tbody>
    @foreach($brands as $brand)
        @include('dashboard.brands.partials._table_raw')
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th scope="col">{{__('#') }}</th>
        <th scope="col">{{__('Name in Arabic')}}</th>
        <th scope="col">{{__('Name in English')}}</th>

        <th scope="col">{{__('Options')}}</th>
    </tr>
    </tfoot>
</table>
{{ $brands->links() }}

