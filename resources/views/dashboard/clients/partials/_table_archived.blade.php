<table class="table table-striped {{--dataex-html5-selectors--}}">
    <thead>
    <tr>
        <th scope="col">{{__('#') }}</th>
        <th scope="col">{{__('Name')}}</th>
        <th scope="col">{{__('Email')}}</th>
        <th scope="col">{{__('Mobile')}}</th>
        <th scope="col">{{__('City')}}</th>
        <th scope="col">{{__('Options')}}</th>
    </thead>
    <tbody>
    @foreach($clients as $client)
        @include('dashboard.clients.partials._table_raw_archived')
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th scope="col">{{__('#') }}</th>
        <th scope="col">{{__('Name')}}</th>
        <th scope="col">{{__('Email')}}</th>
        <th scope="col">{{__('Mobile')}}</th>
        <th scope="col">{{__('City')}}</th>
        <th scope="col">{{__('Options')}}</th>
    </tr>
    </tfoot>
</table>

{{$clients->appends(request()->except('page'))->links()}}
