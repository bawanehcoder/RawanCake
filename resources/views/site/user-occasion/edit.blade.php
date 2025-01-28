@extends('site.layout.master')
@section('title')
    @langucw('my account')
@endsection
@section('css') @endsection
@section('breadcrumb')
    <li><a href="{{route('home')}}">@langucw('home')</a></li>
    <li><a href="{{route('myprofile.index')}}">@langucw('my account')</a></li>
    <li>@langucw('user occasion')</li>
    <li>@langucw('edit')</li>
@endsection
@section('content')

    <div class="row pad-md-100">
        <div class="col">
            <div class="card ">

                <div class="card-body">
                    @include('components.messagesAndErrors')
                    <table class="">
                        <thead>
                        <tr>
                            <th>@langucw('category')</th>
                            <th>@langucw('another image')</th>
                            <th>{{trans('general.name')}}</th>
                            <th>@langucw('date')</th>
                            <th>{{trans('general.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isLogged())
                            <form action="{{route('user_occasions.update',$entity)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <tr>
                                    <td>
                                        <div class="select-wrapper">
                                            <select name="category" autocomplete="off" id="category"
                                                    class="form-field category">
                                                @foreach($categories??[] as $category)
                                                    <option
                                                        {{$category->id==$entity->Cat_id?'selected':''}} value="{{$category->id}}">{{$category['name_'.strtolower(getLang())]}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="row">
                                                <div class="col-6">

                                                        <label  for="category_image"><i class="lastudioicon-e-add"></i></label>
                                                        <input   type="file" name="category_image" id="category_image" >


                                                </div>
                                                <div class="col-6">

                                                <img  src="{{\App\Services\UserOccasionService::getImage($entity)??''}}" class="img-thumbnail">

                                            </div>
                                            </div>

                                        </div>

                                    </td>
                                    <td><input class="form-field" type="text" name="title" value="{{$entity->title}}">
                                    </td>
                                    <td>
                                        <x-flatpickr class="form-field" value="{{old('date')??$entity->date}}"
                                                     name="date"/>
                                    </td>

                                    <td>
                                        <input class="btn btn-outline-dark btn-primary-hover rounded-0" type="submit"
                                               value="{{trans('general.save')}}"/>
                                        <a class="btn btn-outline-dark btn-primary-hover rounded-0"
                                           href="{{route('myprofile.index')}}">{{trans('general.back')}}</a>
                                    </td>
                                </tr>
                            </form>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
<style>
    [type=file] {
        height: 0;
        overflow: hidden;
        width: 0;
    }

    label {
        background: #f15d22;
        border: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-family: "Rubik", sans-serif;
        font-size: inherit;
        font-weight: 500;
        margin-bottom: 1rem;
        outline: none;
        padding: 1rem 50px;
        position: relative;
        transition: all 0.3s;
        vertical-align: middle;
    }
    [type=file] + label:hover {
        background-color: #d3460d;
    }
    [type=file] + label.btn-1 {
        background-color: #f79159;
        box-shadow: 0 6px #f57128;
        transition: none;
    }
    [type=file] + label.btn-1:hover {
        box-shadow: 0 4px #f57128;
        top: 2px;
    }






</style>
@section('scripts')

@endsection
