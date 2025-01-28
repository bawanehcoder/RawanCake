@extends('site.layout.master',['show_slider'=>false,'title'=>'','color'=>'purple'])
@section('title') {{trans('general.products')}} @endsection
@section('css') @endsection
@section('breadcrumb')
@endsection
@section('content')

    <div class="pad-top-150"></div>

    <div class="row pad-md-100" style="background-color: white" >
        <div class="col">
            <div class="card " >
                <div class="card-header">
                     <div class="col"><label>@langucw('occasions')</label></div>
                    <a class="btn btn-pink-cake mar-right-10" href="{{route('user_occasions.create')}}">{{trans('general.create')}}</a>

                </div>
                <div class="card-body">
                    <table class=" table-bordered table-hover hidden-xs " style="background-color: white">
                        <thead>
                        <tr>
                            <th class="chart-center">#</th>
                            <th class="chart-center">@langucw('icon')</th>
                            <th class="chart-center">{{trans('general.name')}}</th>
                            <th class="chart-center">@langucw('date')</th>
                            <th class="chart-center">{{trans('general.action')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                    @if(isLogged())
                        @foreach($occasions??[] as $index=>$item)

                            <tr>
                                <td class="chart-center">{{$index}}</td>
                                <td class="chart-center"><div class="form-group col-md-6">



                                        <img src="{{\App\Services\UserOccasionService::getImage($item)??''}}" class="img-thumbnail">
                                    </div></td>
                                <td class="chart-center">{{$item->title}}</td>
                                <td class="chart-center">{{$item->date}}</td>

                                <td class="chart-center">
                                    <a class="btn btn-pink-cake mar-right-10" href="{{route('user_occasions.edit',$item)}}">@langucw('edit')</a>
                                    <button onclick="deleteItem('{{route('user_occasions.delete',$item)}}')"  class="btn btn-pink-cake mar-right-10">@langucw('delete')</button>


                                </td>

                            </tr>
                    @endforeach
                      @endif

                        </tbody>
                    </table>
                </div>
                </div>
                </div>
                </div>








@endsection
@section('scripts')

@endsection
