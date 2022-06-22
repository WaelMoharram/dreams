<tr>
    <td>{!! $loop->index +1 !!}</td>
        <td>{{__($page->title)}}</td>

    <td>
                @component('dashboard.layouts.partials.buttons._edit_button',[
                        'route' => route('dashboard.pages.edit',$page->id),
                        'tooltip' => __('Edit Page'),
                         ])
                @endcomponent
    </td>
</tr>

