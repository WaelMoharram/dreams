<tr>
    <td>{!! $loop->index +1 !!}</td>
    <td>{!! $offer->title !!}</td>
    <td>{!! optional($offer->user)->name !!}</td>
    <td>{!! optional($offer->city)->name !!}</td>

    <td>
        <div class="btn-group" role="group" aria-label="Vertical button group">

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._show_button',[
                        'route' => route('dashboard.offers.show',$offer->id),
                        'tooltip' => __('Show offer'),
                         ])
                @endcomponent
            </div>
        </div>



    </td>
</tr>

