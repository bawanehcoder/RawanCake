@extends('admin.layout.master')
@section('title') @endsection
@section('css') @endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.sub-categories.index')}}">{{trans('general.products_categories')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.sub-categories.update',$entity)}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="id" id="id" value="{{$entity->id}}" >

            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="sub-categories" >
            <div class=" card table-list-card>
                <div class=" card table-list-card-header"></div>

            <div class="form-row p-1">
                <div class="form-group col-md-6 p-1">
                    <label for="short_title_en">{{trans('general.categories')}}</label>
                    <select name="CatID" autocomplete="off" class="select2 w-100 ">
                        @foreach($main_categories ??[] as $category)
                            <option  {{$category->id==$entity->CatID? 'selected' :''}}  value="{{$category->id}}">{{$category->Name}}  | {{$category->NameEN}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="section_image">@langucw('category image')</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="category_image" id="category_image" >
                        <label class="custom-file-label" for="section_image">@langucw('choose file')</label>
                    </div>
                </div>
                <div class="form-group col-md-1">
                    <img src="{{$entity->getFirstMediaUrl('categories','small')??''}}" class="img-thumbnail">
                </div>
            </div>


                <div class="form-row p-1">
                    <div class="form-group col-md-6">
                        <!-- Default input -->
                        <label for="section_title_ar">@langucw('section title ar')</label>
                        <input type="text" name="section_title_ar" id="section_title_ar" value="{{$entity->Name??''}}" class="form-control">
                    </div>
                    <div class="form-group col-md-6 p-1">
                        <!-- Default input -->
                        <label for="section_title_en">@langucw('section title en')</label>
                        <input type="text" name="section_title_en" value="{{$entity->NameEN??''}}" id="section_title_en" class="form-control">
                    </div>
                </div>

                <div class="form-row p-1">
                    <div class="form-group col-md-6">
                        <!-- Default input -->
                        <label for="short_title_ar">@langucw('short title ar')</label>
                        <input type="text" name="ShortcutName" value="{{$entity->ShortcutName??''}}" id="short_title_ar" class="form-control">
                    </div>
                    <div class="form-group col-md-6 p-1">
                        <!-- Default input -->
                        <label for="short_title_en">@langucw('short title en')</label>
                        <input type="text" name="ShortcutNameEN" value="{{$entity->ShortcutNameEN??''}}" id="short_title_en" class="form-control">
                    </div>
                </div>

                <div class="form-row p-1">
                    <div class="form-group col-md-6">
                        <!-- Default input -->
                        <label for="short_title_ar">@langucw('sortindex')</label>
                        <input type="text" name="SortIndex" value="{{$entity->SortIndex??0}}" id="sortindex" class="form-control">
                    </div>
                    <div class="form-group col-md-6 p-1">
                        <!-- Default input -->
                        <label for="short_title_en">{{trans('general.available')}}</label>
                        <select name="Visible" autocomplete="off" class="custom-select">
                            <option  {{$entity->Visible==0? 'selected' :''}}  value="0">{{trans('general.available')}}</option>
                            <option {{$entity->Visible==1? 'selected' :''}} value="1">@langucw('unavailable')</option>
                        </select>
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
