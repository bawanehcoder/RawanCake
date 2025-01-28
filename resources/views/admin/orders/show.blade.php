@extends('admin.layout.master')
@section('title'){{ trans('general.request')}} # {{$entity->id}} @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{route('dashboard.product-options.index')}}">{{trans('general.requests')}}</a></li>
    <li class="breadcrumb-item active">{{ trans('general.request')}} # {{$entity->id}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="orders">
            <div class=" card table-list-card">
                <div class=" card table-list-card-header">
                    <a href="{{route('dashboard.orders.export-pdf',$entity)}}" class="btn btn-success"><i class="fas fa-download"></i> {{trans('general.pdf')}}</a>
                </div>

                <div class="row m-2">
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-12 col-form-label"><label for="first-name">{{ trans('general.order_details')}}</label>
                            </div>
                            <div class="col-sm-3"><label> {{trans('general.name')}} : {{$entity->Name}}</label></div>
                            <div class="col-sm-3"><label>@langucw('order number') : {{$entity->id}}</label></div>
                            <div class="col-sm-3"><label> @langucw('payment method')
                                    : {{$entity->PaymentMethod}}</label></div>

                            {{-- <div class="col-sm-3"><label> @langucw('address')
                                    : {{  $entity?->delivery_type  =='personal_pickup'? __('branch pickup') ." : ". $entity?->branch['Addres'.getLang()] :$entity?->zone['Addres'.getLang()] }}</label>
                            </div> --}}
                            <div class="col-sm-3"><label> @langucw('phone number') : {{$entity->Phone}}</label></div>
                            <div class="col-sm-3"><label> @langucw('delivery time')
                                    : {{__(getDayNames($entity->DeliveryTime))}}  {{$entity->DeliveryTime}} </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class=" card table-list-card">
            <div class=" card table-list-card-header">
                <div class="col"><label>{{ trans('general.order_details')}}</label></div>
            </div>
            <div class=" card-body table-list-card-body">
                <table class="table table-bordered table-hover hidden-xs " style="background-color: white">
                    <thead>
                    <tr>
                        <th class="chart-center">#</th>
                        <th class="chart-center">@langucw('product')</th>
                        <th class="chart-center">@langucw('price')</th>
                        <th class="chart-center">@langucw('quantity')</th>
                        <th class="chart-center">@langucw('total')</th>
                        <th class="chart-center">@langucw('notes')</th>
                        <th class="chart-center">{{trans('general.operator')}}</th>
                        <th class="chart-center">@langucw('special image')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $subtotal=0; @endphp

                    @foreach($entity->order_details??[] as $index=>$item)
                        <tr>
                            <td class="chart-center">{{$index}}</td>
                            <td class="chart-center" id="{{$item->item->id}}">{{$item->item->getTitle()}}
                                ({{$item->item->Price}})

                                @if($item->optionDetil())
                                    @foreach($item->optionDetil()->get()??[] as $option)
                                        <br>
                                        {{$option->subOption->getTitle()}} ({{$option->AdditionalValue}})
                                    @endforeach
                                @endif

                            <td class="chart-center">{{number_format((float)($item->Price), 2, '.', '')}} {{$currency}}</td>
                            <td class="chart-center">{{$item->Quantity}} </td>
                            @php $subtotal+=$item->Price*$item->Quantity; @endphp
                            <td class="chart-center">{{number_format((float)($item->Price*$item->Quantity), 2, '.', '')}} {{$currency}}</td>

                            <td class="chart-center">{{$item->Note}} </td>
                            <td class="chart-center">


                                @foreach($operators ??[] as $operator)
                                    @if(in_array($operator->id,$item->item->getOperator()))
                                        {{$operator->name_ar}}  | {{$operator->name_en}}
                                        <br>
                                    @endif

                                @endforeach


                            </td>
                            <td>
                                @if($item->getFirstMediaUrl('images','large'))
                                    <a target="_blank"
                                       href="{{asset($item->getFirstMediaUrl('images','large'))??''}}?v={{now()}}"><img
                                            class="thumbnail"
                                            src="{{asset($item->getFirstMediaUrl('images','small'))??''}}?v={{now()}}"></a>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    <tr>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center">@langucw('subtotal')</td>
                        <td style="border: none;" class="chart-center subtotal"><span
                                id="subtotal">{{number_format((float)$subtotal, 2, '.', '')}}</span> {{$currency}}</td>
                    </tr>
                    <tr>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center">@langucw('delivery fee')</td>
                        <td style="border: none;" class="chart-center subtotal"><span
                                id="subtotal">{{number_format((float)$entity->ZonePrice, 2, '.', '')}}</span> {{$currency}}
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center">{{trans('general.discount')}}</td>
                        <td style="border: none;" class="chart-center subtotal"><span
                                id="subtotal">{{number_format((float)$entity->Discount, 2, '.', '')}}</span> {{$currency}}
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center"></td>
                        <td style="border: none;" class="chart-center">@langucw('total amount')</td>
                        <td style="border: none;" class="chart-center subtotal"><span
                                id="subtotal">{{number_format((float)$entity->Total, 2, '.', '')}}</span> {{$currency}}
                        </td>
                    </tr>

                    </tbody>
                </table>


                <div class=" mt-4">
                    <a href="{{route('dashboard.orders.index',['action'=>"NewOrder"])}}" class="btn btn-default">{{trans('general.back')}}</a>
                </div>


            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <script>
        function divAddFun() {
            $("#div_add").show();
        }

        function divhidFun() {
            $("#div_add").hide();
        }


    </script>
@endsection
