<tr>
    <td>{!! $loop->index +1 !!}</td>
    <td><img src="{!! url('/').'/'.$category->image !!}" style="width: 300px; "></td>

    <td>{{$category->getTranslation('name', 'ar')}}</td>
        <td>{{$category->getTranslation('name', 'en')}}</td>
    <td>
        @if($category->is_sell == 1)
            <span class="badge badge-light-primary">{{__('Sell')}}</span>
        @endif
        @if($category->is_rent == 1)
            <span class="badge badge-light-success">{{__('Rent')}}</span>
        @endif
        @if($category->is_transportation == 1)
            <span class="badge badge-light-info">{{__('Transportation')}}</span>
        @endif

    </td>
    <td>

        <div class="btn-group" role="group" aria-label="Vertical button group">

{{--            <div class="btn-group" role="group">--}}
{{--                @component('dashboard.layouts.partials.buttons._show_button',[--}}
{{--                        'route' => route('dashboard.categories.show',$category->id),--}}
{{--                        'tooltip' => __('Show '.$category['name']),--}}
{{--                         ])--}}
{{--                @endcomponent--}}
{{--            </div>--}}

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._edit_button',[
                        'route' => route('dashboard.sub-categories.edit',$category->id),
                        'tooltip' => __('Edit category'),
                         ])
                @endcomponent
            </div>

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._delete_button',[
                        'route' => route('dashboard.sub-categories.destroy',$category->id),
                        'tooltip' => __('Delete category'),
                        'id'=>$category->id
                         ])
                @endcomponent
            </div>

        </div>

    </td>
</tr>

