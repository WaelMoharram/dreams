<tr>
    <td>{!! $loop->index +1 !!}</td>

    <td>{{$equipment->getTranslation('name', 'ar')}}</td>
        <td>{{$equipment->getTranslation('name', 'en')}}</td>

    <td>

        <div class="btn-group" role="group" aria-label="Vertical button group">

{{--            <div class="btn-group" role="group">--}}
{{--                @component('dashboard.layouts.partials.buttons._show_button',[--}}
{{--                        'route' => route('dashboard.equipments.show',$equipment->id),--}}
{{--                        'tooltip' => __('Show '.$equipment['name']),--}}
{{--                         ])--}}
{{--                @endcomponent--}}
{{--            </div>--}}

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._edit_button',[
                        'route' => route('dashboard.equipments.edit',$equipment->id),
                        'tooltip' => __('Edit equipment'),
                         ])
                @endcomponent
            </div>

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._delete_button',[
                        'route' => route('dashboard.equipments.destroy',$equipment->id),
                        'tooltip' => __('Delete equipment'),
                        'id'=>$equipment->id
                         ])
                @endcomponent
            </div>

        </div>

    </td>
</tr>

