<table class="table table-striped {{--dataex-html5-selectors--}}">
    <thead>
    <tr>
        <th scope="col">{{__('#') }}</th>
        <th scope="col">{{__('Image')}}</th>
        <th scope="col">{{__('Name in Arabic')}}</th>
        <th scope="col">{{__('Name in English')}}</th>
        <th scope="col">{{__('Type')}}</th>
        <th scope="col ">{{__('Options')}}</th>
    </thead>
    <tbody>
    @foreach($categories as $category)
        @include('dashboard.categories.partials._table_raw')
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th scope="col">{{__('#') }}</th>
        <th scope="col">{{__('Image')}}</th>
        <th scope="col">{{__('Name in Arabic')}}</th>
        <th scope="col">{{__('Name in English')}}</th>
        <th scope="col">{{__('Type')}}</th>

        <th scope="col">{{__('Options')}}</th>
    </tr>
    </tfoot>
</table>
{{ $categories->links() }}

