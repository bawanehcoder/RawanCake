<div class="{{$show??''===true?'':'d-none'}}" id="page_show">
    <p>@langucw('showing') <span >{{\Request()->input('page')??0}}</span> - {{count($products->items())}} of {{$products->total()}}  @langucw('result')</p>
</div>
