<tr>
    <td>{!! $loop->index +1 !!}</td>
        <td>{{$city->getTranslation('name', 'ar')}}</td>
        <td>{{$city->getTranslation('name', 'en')}}</td>

    <td>

        <div class="btn-group" role="group" aria-label="Vertical button group">

{{--            <div class="btn-group" role="group">--}}
{{--                @component('dashboard.layouts.partials.buttons._show_button',[--}}
{{--                        'route' => route('dashboard.cities.show',$city->id),--}}
{{--                        'tooltip' => __('Show '.$city['name']),--}}
{{--                         ])--}}
{{--                @endcomponent--}}
{{--            </div>--}}

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._edit_button',[
                        'route' => route('dashboard.cities.edit',$city->id),
                        'tooltip' => __('Edit city'),
                         ])
                @endcomponent
            </div>

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._delete_button',[
                        'route' => route('dashboard.cities.destroy',$city->id),
                        'tooltip' => __('Delete city'),
                        'id'=>$city->id
                         ])
                @endcomponent
            </div>

        </div>

    </td>
</tr>

