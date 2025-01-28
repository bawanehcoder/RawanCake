@if ($items)
    <div class="list-group w-100" style="max-height:200px;">

        @foreach ($items as $item)
            <a target="_blank" href="{{route('products.index',$item)}}"
               class="list-group-item list-group-item-action d-flex">{{$item->Name}}</a>
        @endforeach
    </div>
@endif
