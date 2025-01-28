@extends('admin.layout.master')
@section('title')
    {{trans('general.sub_categories')}}
@endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.generalInfo.edit')}}">{{trans('general.products')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.generalInfo.update')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="generalInfo">
            <div class=" card table-list-card">


                <div class="container p-2">



                    <div class="row mt-4">
                        <div class=" col-6 ">
                            <label for="EMail">@langucw('EMail')</label>
                            <input type="email" name="EMail" id="EMail" value="{{old('EMail')??$entity->EMail??''}}" class="form-control">
                        </div>
                        <div class=" col-6 ">
                            <label for="Facebook">@langucw('Facebook')</label>
                            <input type="text" name="Facebook" id="Facebook" value="{{old('Facebook')??$entity->Facebook??''}}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class=" col-6 ">
                            <label for="Twitter">@langucw('Twitter')</label>
                            <input type="text" name="Twitter" id="Twitter" value="{{old('Twitter')??$entity->Twitter??''}}" class="form-control">
                        </div>
                        <div class=" col-6 ">
                            <label for="LinkedIn">@langucw('LinkedIn')</label>
                            <input type="text" name="LinkedIn" id="LinkedIn" value="{{old('LinkedIn')??$entity->LinkedIn??''}}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class=" col-6 ">
                            <label for="Instagram">@langucw('Instagram')</label>
                            <input type="text" name="Instagram" id="Instagram" value="{{old('Instagram')??$entity->Instagram??''}}" class="form-control">
                        </div>
                        <div class=" col-6 ">
                            <label for="YouTube">@langucw('YouTube')</label>
                            <input type="text" name="YouTube" id="YouTube" value="{{old('YouTube')??$entity->YouTube??''}}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class=" col-6 ">
                            <label for="Pinterest">@langucw('Pinterest')</label>
                            <input type="text" name="Pinterest" id="Pinterest" value="{{old('Pinterest')??$entity->Pinterest??''}}" class="form-control">
                        </div>
                        <div class=" col-6 ">
                            <label for="FourSquare">@langucw('FourSquare')</label>
                            <input type="text" name="FourSquare" id="FourSquare" value="{{old('FourSquare')??$entity->FourSquare??''}}" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class=" col-6 ">
                            <label for="Tumblr">@langucw('Tumblr')</label>
                            <input type="text" name="Tumblr" id="Tumblr" value="{{old('Tumblr')??$entity->Tumblr??''}}" class="form-control">
                        </div>

                    </div>



                    <div class=" mt-4">
                        <button type="submit" class="btn btn-danger">{{trans('general.update')}}</button>
                    </div>


                </div>


            </div>

        </form>
    </section>

@endsection
@section('scripts')
    <script>

    </script>

@endsection
