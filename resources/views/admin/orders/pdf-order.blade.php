<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة - Rawan Cake</title>
    <style>
        @media print {
            body {
                margin: 0;
                /* Sets the margin for printing */
            }
        }

        body {
            font-family: "Tahoma", sans-serif;
            font-size: 0.8rem;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .invoice-container {

            padding: 20px;
            background-color: #fff;

        }

        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 2px solid #e0d4f5;
            padding-bottom: 15px;
        }

        .header img {
            width: 150px;
            height: auto;
        }

        .header .company-info {
            text-align: right;
        }

        .header .company-info h1 {
            color: #6a1b9a;
            margin: 0;
        }

        .details,
        .order-details {
            margin-top: 20px;
        }

        .details table,
        .order-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details th,
        .details td,
        .order-details th,
        .order-details td {
            text-align: center;
            padding: 10px;
            border: 1px solid #e0d4f5;
        }

        .details th {
            background-color: #f3e5f5;
            color: #6a1b9a;
        }

        .order-details th {
            background-color: #f3e5f5;
            color: #6a1b9a;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="header">
            <div class="company-info">
                <center>
                    <h1>
                        Rawan Cake
                    </h1>
                </center>
                <h3>
                    {{ $entity->delivery_type == 'personal_pickup' ? __('استلام من الفرع')  : __('توصيل')  }}

                </h3>
                <p>
                    اسم الموظف
                    {{ auth()->user()->name }}
                </p>
                

            </div>
        </div>

        <div class="details">
            <table>
                <tr style="font-size: 1rem;">
                    <th>العنوان</th>

                    <td>{{ $entity->delivery_type == 'personal_pickup' ? __('استلام من الفرع') . ' : ' . $entity->branch->AddresAr : __('توصيل') ." ". $entity->zone->AddresAr }}
                    </td>
                </tr>
                <tr>
                    <th>رقم الطلب</th>

                    <td>{{ $entity->id }}</td>
                </tr>
              
                <tr>
                    <th>اسم العميل</th>
                    <td>{{ $entity->user_name }}</td>
                </tr>
                <tr>
                    <th>رقم الهاتف</th>

                    <td>{{ $entity->Phone }}</td>
                </tr>
                <tr>
                    <th>طريقة الدفع</th>

                    <td>{{ $entity->PaymentMethod == "pay by credit card" ? "مدفوع بالبطاقه الائتمانيه" :"الدفع عند الاستلام" }}</td>
                </tr>
                <tr>
                    <th>تاريخ التسليم</th>

                    <td>{{ $entity->OrderDate }}</td>
                </tr>
                <tr>
                    <th>وقت التسليم</th>

                    <td>{{ $entity->DeliveryTime }}</td>
                </tr>
   

                <tr>
                    <td>الملاحظات</td>
                    <td colspan="8">{{ $entity->Note }}</td>

                </tr>
                <tr>
                    <td colspan="8">{{ $entity->user->email }}</td>

                </tr>
            </table>
        </div>


        <div class="order-details">
            <table>
                <tr>
                    <th>#</th>
                    <th>الصورة</th>
                    <th>المنتج</th>
                    <th>السعر</th>
                    <th>الكمية</th>
                    <th>المجموع</th>
                    <th>ملاحظات</th>
                </tr>
                @php $subtotal = 0; @endphp
                @foreach ($entity->order_details ?? [] as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img style="width: 50px"
                                src="{{ asset($item->item->getFirstMediaUrl('products', 'small')) ?? '' }}"
                                title="{{ $item->item->getTitle() }}" alt="{{ $item->item->getTitle() }}">
                        </td>
                        <td>{{ $item->item->Name }}
                            @php
                                $index = 0;
                            @endphp
                            {{-- @php
                            dd($item->optionDetil()->get());
                        @endphp --}}
                            @if ($item->optionDetil())
                                @foreach ($item->optionDetil()->get() ?? [] as $option)
                                    <br>
                                    @if ($item->item->Special)
                                        @if ($index == 0)
                                            {{ $option->subOption->Name }}
                                        @else
                                            ({{ $option->option->Name }})
                                            {{ $option->subOption->Name }}
                                        @endif
                                    @else
                                        ( {{ $option->option->Name }} )
                                        {{ $option->subOption->Name }} ({{ $option->AdditionalValue }})
                                    @endif

                                    {{-- @if ($item->item) --}}
                                    @php
                                        $index++;
                                    @endphp
                                @endforeach
                            @endif
                        </td>
                        <td>{{ number_format($item->Price, 2, '.', '') }} JOD</td>
                        <td>{{ $item->Quantity }}</td>
                        <td>{{ number_format($item->Price * (int) $item->Quantity, 2, '.', '') }} JOD</td>
                        <td>{{ $item->Note }}</td>
                    </tr>
                    @php $subtotal += $item->Price * $item->Quantity ; @endphp
                @endforeach
                <tr>
                    <td colspan="4" style="text-align: right;">التوصيل</td>
                    <td colspan="3">{{ $entity->ZonePrice }} JOD</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;">الإجمالي الفرعي</td>
                    <td colspan="3">{{ number_format($subtotal, 2, '.', '') }} JOD</td>
                </tr>
                @php $total = $subtotal  +$entity->ZonePrice; @endphp

                <tr>
                    <td colspan="4" style="text-align: right;">الإجمالي الكلي</td>
                    <td colspan="3">{{ number_format($total, 2, '.', '') }} JOD</td>
                </tr>


                <tr>
                    <td colspan="4" style="text-align: right;">المبلغ المدفوع</td>
                    <td colspan="3">
                        @php
                            $paid = 0;
                        @endphp
                        @if ($entity->PaymentMethod == 'pay by credit card')
                            @php
                                $paid = $entity->before_amount;

                            @endphp
                        @endif

                        {{ number_format($paid, 2, '.', '') }} JOD

                    </td>
                </tr>




                <tr>
                    <td colspan="4" style="text-align: right;">المبلغ المتبقي</td>
                    <td colspan="3">
                        @php
                            $paid = $total == $entity->before_amount ? 0 : $entity->Total;
                        @endphp
                        @if ($entity->PaymentMethod == 'pay by credit card')
                            @php
                                $paid = $total == $entity->before_amount ? 0 : $entity->add_value;

                            @endphp
                        @endif

                        {{ number_format($paid, 2, '.', '') }} JOD

                    </td>
                </tr>
            </table>
        </div>



        <div class="footer">
            <p>شكرًا لتسوقك معنا في Rawan Cake</p>
        </div>
    </div>
</body>
<script>
    window
        .print(); // Automatically print the invoice when the page loads. Replace this line with your desired print logic.
    window.onafterprint = () => window.close(); // Close the tab after printing
</script>

</html>
