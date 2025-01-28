@extends('admin.layout.master')
@section('title'){{trans('general.sub_categories')}} @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.point-settings.index')}}">@langucw('point settings')</a></li>
    <li class="breadcrumb-item active">{{trans('general.update')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.point-settings.update',$entity)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="offers" >
            <div class=" card table-list-card>
                <div class=" card table-list-card-header"></div>


                <div class="form-row ">
                    <div class="form-group col-md-2 m-2">

                        <label  for="fixed_discount">{{trans('general.name')}}</label>
                        <input disabled type="text"  name=""  value="{{$entity->name}}"  class="form-control">
                    </div>
                    <div class="form-group col-md-2 m-2">
                        <div class="form-check">
                            <label  for="relative_discount">@langucw('points')</label>
                            <input type="number"  min="0" max="100" name="point" placeholder="@langucw('points')"  value="{{old('point')??$entity->point}}"  class="form-control">
                        </div>
                    </div>
                </div>






                <div class="form-group col-md-3 p-1">
                    <button type="submit" class="btn btn-danger">{{trans('general.save')}}</button>
                    <a href="{{route('dashboard.point-settings.index')}}"  class="btn btn-default">{{trans('general.back')}}</a>
                </div>


            </div>




        </form>
    </section>

@endsection
@section('scripts')
    <script>

    </script>


@endsection
