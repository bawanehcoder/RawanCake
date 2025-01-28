<label class="card">
    <input class="card__input" type="radio" _href="{{ route('payment.show_payment_form', $info) }}" name="address_id"
        value="{{ $info->id }}">
    {{-- <div class="card-body card__body">
        <h6 class="card-title">@langucw('title') : <span style="word-break: break-all;"
                id="title_{{ $info->id }}">{{ $info->title }}</span></h6>
        <h6 class="card-subtitle mb-2 text-muted">{{ trans('general.name') }} :<span style="word-break: break-all;"
                id="name_{{ $info->id }}">{{ $info->name }}</span>
        </h6>
        <h6 class="card-subtitle mb-2 text-muted">@langucw('the region') :<span id="zone_{{ $info->id }}"
                att="{{ $info->zone_id }}">{{ $info->zone['Addres' . getLang()] }}</span>
        </h6>
        <h6 class="card-subtitle mb-2 text-muted">@langucw('number') :<span
                id="phone_{{ $info->id }}">{{ $info->phone }}</span></h6>
        <h6 class="card-subtitle mb-2 text-muted">@langucw('address') :<span style="word-break: break-all;"
                id="shipping_info_text_{{ $info->id }}">{{ $info->address }}</span></h6>
        
    </div> --}}

    <table id="table " class=" card__body">
        {{-- <thead>
           
        </thead> --}}
        <tbody>
            <tr class="no-bor-top">
                <td scope="col" style="text-align:left"><strong style="min-width:100px;display:inline-block">@langucw('title')</strong> : {{ $info->title }}</td>

            </tr>
            <tr class="no-bor-top">
                <td scope="col" style="text-align:left"><strong style="min-width:100px;display:inline-block">{{ trans('general.name') }}</strong> : {{ $info->name }}</td>
            </tr>

            <tr class="no-bor-top">
                <td scope="col" style="text-align:left"><strong style="min-width:100px;display:inline-block">@langucw('the region') </strong> : {{ $info->zone['Addres' . getLang()] }} </td>
            </tr>

            <tr class="no-bor-top">
                <td scope="col" style="text-align:left"><strong style="min-width:100px;display:inline-block">@langucw('number')</strong> : {{ $info->phone }}</td>
            </tr>
            <tr>
                <td scope="col" style="text-align:left"><strong style="min-width:100px;display:inline-block">@langucw('address')</strong> : {{ $info->address }}</td>

            </tr>

            <tr class="no-bor-top" style="height: 0px !important;    display: block;">
                <td scope="col" style="text-align:left">
                    <a  onclick="update({{ $info->id }})" class="card-link edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a onclick="deleteItem('{{ route('shipping_info.delete', $info) }}')"
                        class="card-link delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                </td>
            </tr>
            


        </tbody>
    </table>
</label>
