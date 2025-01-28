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
        <form class="form form-horizontal" action="{{route('dashboard.products.update',$entity)}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="id" id="id" value="{{$entity->id}}" >
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="products" >
            <div class=" card table-list-card>
                <div class=" card table-list-card-header"></div>

            <div class="form-row p-1">
                <div class="form-group col-md-6 p-1">
                    <label for="short_title_en">@langucw('section')</label>
                    <select name="CatID" autocomplete="off" class="custom-select select2">
                        @foreach($sub_categories ??[] as $category)
                            <option  {{$category->id==$entity->CatID? 'selected' :''}}  value="{{$category->id}}">{{$category->Name}}  | {{$category->NameEN}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="section_image">@langucw('product image')</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="main_product" id="main_product" >
                        <label class="custom-file-label" for="main_product">@langucw('choose file')</label>
                    </div>
                    <div class="form-group ">

                        <img src="{{asset($entity->getFirstMediaUrl('products','small'))??''}}?v={{now()}}" class="img-thumbnail">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="attached_image">@langucw('the attached image')</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="attached_product[]" id="attached_product" multiple >
                        <label class="custom-file-label" for="attached_product[]">@langucw('choose file')</label>
                    </div>

                    <div class="form-group ">
                        @if( $entity->getMedia('attached_products') )
                            @foreach (!empty('attached_products') ? $entity->getMedia('attached_products') : $entity->media ?? [] as $media)

                                <img src="{{$media->getUrl('small')??''}}?v={{now()}}" class="img-thumbnail">
                            @endforeach
                        @endif

                    </div>
                </div>


            </div>


                <div class="form-row p-1">
                    <div class="form-group col-md-6">
                        <!-- Default input -->
                        <label for="section_title_ar">@langucw('product title ar')</label>
                        <input type="text" name="product_ar" id="product_ar" value="{{$entity->Name??''}}" class="form-control">
                    </div>
                    <div class="form-group col-md-6 p-1">
                        <!-- Default input -->
                        <label for="product_en">@langucw('product title en')</label>
                        <input type="text" name="product_en" value="{{$entity->NameEN??''}}" id="product_en" class="form-control">
                    </div>
                </div>

                <div class="form-row p-1">
                    <div class="form-group col-md-6">
                        <!-- Default input -->
                        <label for="description_ar">@langucw('description ar')</label>
                        <textarea type="text" name="description_ar"  id="description_ar" class="form-control">{{$entity->Description??''}}</textarea>
                    </div>
                    <div class="form-group col-md-6 p-1">
                        <!-- Default input -->
                        <label for="description_en">@langucw('description en')</label>
                        <textarea type="text" name="description_en"  id="description_en" class="form-control">{{old('description_en')??$entity->DescriptionEN}}</textarea>
                    </div>
                </div>

                <div class="form-row p-1">
                    <div class="form-group col-md-3">
                        <!-- Default input -->
                        <label for="description_ar">@langucw('price')</label>
                        <input type="number" step="any" min="0" max="1000" name="price"  value="{{old('price')??$entity->Price}}" id="price" class="form-control">
                    </div>
{{--                    <div class="form-group col-md-3">--}}
{{--                        <!-- Default input -->--}}
{{--                        <label for="description_ar">@langucw('new price')</label>--}}
{{--                        <input type="number" step="any" min="0" max="1000" name="new_price"  value="{{old('new_price')??$entity->NewPrice}}" id="new_price" class="form-control">--}}
{{--                    </div>--}}
                    <div class="form-group col-md-3 p-1">
                        <!-- Default input -->
                        <label for="short_title_en">{{trans('general.available')}}</label>
                        <select name="Available" autocomplete="off" class="custom-select">
                            <option  {{$entity->Available==0? 'selected' :''}}  value="0">{{trans('general.available')}}</option>
                            <option {{$entity->Available==1? 'selected' :''}} value="1">@langucw('unavailable')</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3 p-1">
                        <div class="form-check">

                            <label class="form-check-label" for="exampleCheck1">@langucw('special requests')</label>
                            <input type="checkbox" {{$entity->Special==1? 'checked' :''}} style="width:20%;" class="form-control " name="special_requests" id="special_requests">
                        </div>
                    </div>


                    <div class="form-row p-1">
                        <div class="form-group col p-1">
                            <label for="short_title_en">{{trans('general.operator')}}</label>
                            <select name="operator[]" autocomplete="off" multiple  class="custom-select select2">
                                @foreach($operators ??[] as $operator)
                                    <option  {{in_array($operator->id,$entity->getOperator())? 'selected' :''}}  value="{{$operator->id}}">{{$operator->name_ar}}  | {{$operator->name_en}} </option>
                                @endforeach
                            </select>
                        </div>
                        </div>

                    <div class="form-group col-md-3 p-1">

                        <label for="stock">@langucw('stock')</label>
                        <input type="number"  min="0" max="1000" name="stock"  value="{{old('stock')??$entity->stock}}" id="stock" class="form-control">
                    </div>
                </div>




                <div class="form-group col-md-3 p-1">
                    <button type="submit" class="btn btn-danger">{{trans('general.update')}}</button>
                </div>


            </div>

            </div>





        </form>
    </section>

@endsection
@section('scripts') @endsection
