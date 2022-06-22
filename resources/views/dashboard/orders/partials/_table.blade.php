<table class="table table-striped {{--dataex-html5-selectors--}}">
    <thead>
    <tr>
        <th scope="col">{{__('#') }}</th>
        <th scope="col">{{__('Client')}}</th>
        <th scope="col">{{__('Provider')}}</th>
        <th scope="col">{{__('Item')}}</th>
        <th scope="col">{{__('Total price')}}</th>
        <th scope="col">{{__('Status')}}</th>
        <th scope="col">{{__('Payment method')}}</th>
    </thead>
    <tbody>
    @foreach($orders as $order)
        @include('dashboard.orders.partials._table_raw')
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th scope="col">{{__('#') }}</th>
        <th scope="col">{{__('Client')}}</th>
        <th scope="col">{{__('Provider')}}</th>
        <th scope="col">{{__('Item')}}</th>
        <th scope="col">{{__('Total price')}}</th>
        <th scope="col">{{__('Status')}}</th>
        <th scope="col">{{__('Payment method')}}</th>
    </
    </tr>
    </tfoot>
</table>

