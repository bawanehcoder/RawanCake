{{--    <div class="left-label">Quantity</div>--}}
<div class="row" style="max-width: 100px;    max-width: 100px;
    background: #fff;
    border-radius: 5px;
    overflow: hidden;">
    <div att="{{$id}}" class="btn-number minus col-4" style="cursor: pointer;" disabled="disabled" data-type="minus"
         data-field="quant[{{$id}}]">-
    </div>
    <div class="col-4">
        <input att="{{$id}}" id="input-number-{{$id}}" autocomplete="off" type="text"
               name="quant[{{$id}}]" class="input-number border-0 " value="{{$quantity}}" min="{{$min??1}}"
               max="{{$max??1000}}">
    </div>
    <div att="{{$id}}" class="plus btn-number col-4" style="cursor: pointer;" data-type="plus"
         data-field="quant[{{$id}}]">+
    </div>

</div>




