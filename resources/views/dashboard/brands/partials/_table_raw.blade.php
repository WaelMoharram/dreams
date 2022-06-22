<tr>
    <td>{!! $loop->index +1 !!}</td>

    <td>{{$brand->getTranslation('name', 'ar')}}</td>
        <td>{{$brand->getTranslation('name', 'en')}}</td>

    <td>

        <div class="btn-group" role="group" aria-label="Vertical button group">

{{--            <div class="btn-group" role="group">--}}
{{--                @component('dashboard.layouts.partials.buttons._show_button',[--}}
{{--                        'route' => route('dashboard.brands.show',$brand->id),--}}
{{--                        'tooltip' => __('Show '.$brand['name']),--}}
{{--                         ])--}}
{{--                @endcomponent--}}
{{--            </div>--}}

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._edit_button',[
                        'route' => route('dashboard.brands.edit',$brand->id),
                        'tooltip' => __('Edit brand'),
                         ])
                @endcomponent
            </div>

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._delete_button',[
                        'route' => route('dashboard.brands.destroy',$brand->id),
                        'tooltip' => __('Delete brand'),
                        'id'=>$brand->id
                         ])
                @endcomponent
            </div>

        </div>

    </td>
</tr>

