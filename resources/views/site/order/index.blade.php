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

                     <div class="col"><label>@langucw('my orders')</label></div>



                </div>
                <div class="card-body">
                    <table class=" table-bordered table-hover hidden-xs " style="background-color: white">
                        <thead>
                        <tr>
                            <th class="chart-center">#</th>
                            <th class="chart-center">{{trans('general.name')}}</th>
                            <th class="chart-center">@langucw('total')</th>
                            <th class="chart-center">@langucw('delivery time')</th>
                            <th class="chart-center">@langucw('status')</th>
                            <th class="chart-center">@langucw('payment method')</th>
                            <th class="chart-center">@langucw('show')</th>
                        </tr>
                        </thead>
                        <tbody>
                    @if(isLogged())
                        @foreach(getLogged()->order??[] as $index=>$item)

                            <tr>

                                <td class="chart-center">{{$index}}</td>
                                <td class="chart-center">{{$item->Name}}</td>
                                <td class="chart-center">{{$item->Total}}</td>
                                <td class="chart-center">{{$item->DeliveryTime}} {{getDayNames($item->DeliveryTime)}}</td>
                                <td class="chart-center">{{$item->status}}</td>
                                <td class="chart-center">{{$item->PaymentMethod}}</td>
                                <td class="chart-center"><a href="{{route('order.show',$item)}}"><b>@langucw('show')</b></a></td>

                            </tr>
                    @endforeach
                      @endif

                        </tbody>
                    </table>
                </div>
                </div>
                </div>
                </div>


    <div class="pad-top-150"></div>





@endsection
@section('scripts')

@endsection
