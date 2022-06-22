<table class="table table-striped {{--dataex-html5-selectors--}}">
    <thead>
    <tr>
        <th scope="col">{{__('#') }}</th>
        <th scope="col">{{__('Title')}}</th>
        <th scope="col">{{__('Provider')}}</th>
        <th scope="col">{{__('City')}}</th>
        <th scope="col">{{__('Options')}}</th>
    </thead>
    <tbody>
    @foreach($offers as $offer)
        @include('dashboard.offers.partials._table_raw')
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th scope="col">{{__('#') }}</th>
        <th scope="col">{{__('Title')}}</th>
        <th scope="col">{{__('Provider')}}</th>
        <th scope="col">{{__('City')}}</th>
        <th scope="col">{{__('Options')}}</th>
    </tr>
    </tfoot>
</table>

