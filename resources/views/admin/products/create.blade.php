@extends('admin.layout.master')
@section('title'){{trans('general.sub_categories')}} @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.products.index')}}">{{trans('general.products')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="products" >
            <div class=" card table-list-card>
                <div class=" card table-list-card-header"></div>
            <div class="form-row p-1">
                <div class="form-group col-md-6 p-1">

                    <label for="short_title_en">@langucw('section')</label>
                    <select name="CatID" id="CatID" autocomplete="off" class="select2">
                        @foreach($sub_categories ??[] as $category)
                            <option    value="{{$category->id}}">{{$category->Name}}  | {{$category->NameEN}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="main_image">@langucw('product image')</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="main_product" id="main_product" >
                        <label class="custom-file-label" for="main_image">@langucw('choose file')</label>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="attached_image">@langucw('the attached image')</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="attached_product[]" id="attached_product" multiple >
                        <label class="custom-file-label" for="attached_product">@langucw('choose file')</label>
                    </div>
                </div>
            </div>
{{--                product--}}
                <div class="form-row p-1">
                    <div class="form-group col-md-6">
                        <label for="section_title_ar">@langucw('product title ar')</label>
                        <input type="text" name="product_ar" value="{{old('product_ar')}}" id="section_title_ar" class="form-control">
                    </div>
                    <div class="form-group col-md-6 p-1">
                        <label for="section_title_en">@langucw('product title en')</label>
                        <input type="text" name="product_en" value="{{old('product_en')}}" id="section_title_en" class="form-control">
                    </div>
                </div>
{{--                description--}}
                <div class="form-row p-1">
                    <div class="form-group col-md-6">

                        <label for="description_ar">@langucw('description ar')</label>
                        <textarea type="text" name="description_ar"  id="description_ar" class="form-control">{{old('description_ar')}}</textarea>
                    </div>
                    <div class="form-group col-md-6 p-1">
                        <label for="description_en">@langucw('description en')</label>
                        <textarea type="text" name="description_en" id="description_en" class="form-control">{{old('description_en')}}</textarea>
                    </div>
                </div>
{{--                price & special requests--}}
                <div class="form-row p-1">
                    <div class="form-group col-md-1">

                        <label for="description_ar">@langucw('price')</label>
                        <input type="number" step="any" min="0" max="1000" name="price"  value="{{old('price')}}" id="price" class="form-control">
                    </div>
                    <div class="form-group col-md-3 p-1">
                        <div class="form-check">
                            <label class="form-check-label" for="exampleCheck1">@langucw('special requests')</label>
                            <input type="checkbox" style="width:20%;" class="form-control " name="special_requests" id="special_requests">
                        </div>
                    </div>
                    <div class="form-row p-1">
                        <div class="form-group col p-1">
                            <label for="short_title_en">{{trans('general.operator')}}</label>
                            <select name="operator[]" autocomplete="off" multiple  class="custom-select select2">
                                @foreach($operators ??[] as $operator)
                                    <option    value="{{$operator->id}}">{{$operator->name_ar}}  | {{$operator->name_en}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-3 p-1">

                        <label for="stock">@langucw('stock')</label>
                        <input type="number"  min="0" max="1000" name="stock"  value="{{old('stock')??0}}" id="stock" class="form-control">
                    </div>
                </div>






                <div class="form-group col-md-3 p-1">
                <button type="submit" class="btn btn-danger">{{trans('general.save')}}</button>
                </div>


            </div>




        </form>
    </section>

@endsection
@section('scripts')
<script>
    var select_box_element = document.querySelector('#CatID');

    dselect(select_box_element, {
        search: true
    });
</script>


@endsection
