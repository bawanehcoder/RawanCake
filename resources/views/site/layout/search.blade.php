<!-- Search Start  -->
<div class="search-popup position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center p-6 bg-black bg-opacity-75">
    <div class="search-popup__form position-relative">
       @php

       if(isset($sub_category)){
           $sub_category=$sub_category->id;
       }else{
    $sub_category='';
       }
       @endphp
        <input type="hidden" id="sub_category" class="sub_category" name="sub_category" value="{{$sub_category}}">
        <input type="hidden" id="main_category" class="main_category" name="main_category" value="{{$main_category->id??null}}">
        <form action="{{route('products.index',[$main_category->id??'',$sub_category])}}" >
            <input type="hidden" id="page" name="page" value="{{$page??0}}">
            <input name="search" value="{{$search??''}}" id="search_filter" class="search-popup__field border-0 border-bottom bg-transparent text-white w-100 tra py-3" type="text" placeholder="Search…">
            <button apply-filter main_category="{{$main_category->id??null}}" sub_category="{{$sub_category}}" class="search-popup__icon text-white border-0 bg-transparent position-absolute top-50 start-0 translate-middle-y"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>

    </div>
    <button class="search-popup__close position-absolute top-0 end-0 m-8 p-3 lh-1 border-0 text-white fs-4"><i class="lastudioicon-e-remove"></i></button>
</div>
<!-- Search End -->
