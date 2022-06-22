<tr>
    <td>{!! $loop->index +1 !!}</td>
    <td>{!! __($option->key) !!}</td>
    <td>{!! $option->value !!}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Vertical button group">

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._edit_button',[
                        'route' => route('dashboard.system-options.edit',$option->id),
                        'tooltip' => __('Edit option'),
                         ])
                @endcomponent
            </div>

        </div>



    </td>
</tr>

