<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة - Rawan Cake</title>
    <style>
        body {
            font-family: "Tahoma", sans-serif;
            margin: 0;
            font-size: .6rem;
            padding: 0;
            background-color: #f9f9f9;
        }

        .invoice-container {
            padding: 20px;
           
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
        {{-- <div class="header">
            <div class="company-info">
                <center>
                    <h1>
                        Rawan Cake
                    </h1>
                </center>
                @if ($entity->callc)
                    <p>
                        اسم الموظف
                        {{ $entity->user->name }}
                    </p>
                @endif

            </div>
        </div> --}}
        @php
            $orders = explode('-', $order);
            $orders = \App\Models\Order::find($orders);
            // dd($orders);
        @endphp
        <div class="details">
            <table>
                <tr>
                    <th>اسم العميل</th>
                    <th>تاريخ الانشاء</th>
                    <th>رقم الهاتف</th>
                    <th>رقم الطلب</th>
                    <th>طريقة الدفع</th>
                    <th>العنوان</th>
                    <th>البريد </th>
                    <th>المجموع </th>
                    <th>تاريخ التسليم</th>
                </tr>
        @foreach ($orders as $entity)
            
                   
                    <tr>
                        <td>{{ $entity->user_name }}</td>
                        <td>{{ $entity->created_at }}</td>
                        <td>{{ $entity->Phone }}</td>
                        <td>{{ $entity->id }}</td>
                        <td>{{ $entity->PaymentMethod }}</td>
                        <td>{{ $entity->delivery_type == 'personal_pickup' ? __('branch pickup') . ' : ' . $entity->branch['Addres' . getLang()] : $entity->zone['Addres' . getLang()] }}
                        </td>
                        <td>{{ $entity->user->email }}</td>
                        <td>{{ $entity->Total }}</td>
                        <td>{{ $entity->OrderDate }}</td>
                    </tr>

                    {{-- <tr>
                        <td colspan="8">{{ $entity->Note }}</td>

                    </tr>
                    <tr>
                        <td colspan="8">{{ $entity->user->email }}</td>

                    </tr> --}}
               
        @endforeach
    </table>
</div>


        {{-- <div class="order-details">
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
                            <img class="w-100"
                                src="{{ asset($item->item->getFirstMediaUrl('products', 'small')) ?? '' }}"
                                title="{{ $item->item->getTitle() }}" alt="{{ $item->item->getTitle() }}">
                        </td>
                        <td>{{ $item->item->Name }}
                            @if ($item->optionDetil())
                                @foreach ($item->optionDetil()->get() ?? [] as $option)
                                    <br>
                                    ({{ $option->option->Name }})
                                    {{ $option->subOption->getTitle() }} ({{ $option->AdditionalValue }})
                                @endforeach
                            @endif
                        </td>
                        <td>{{ number_format($item->Price, 2, '.', '') }} JOD</td>
                        <td>{{ $item->Quantity }}</td>
                        <td>{{ number_format($item->Price, 2, '.', '') }} JOD</td>
                        <td>{{ $item->Note }}</td>
                    </tr>
                    @php $subtotal += $item->Price ; @endphp
                @endforeach
                <tr>
                    <td colspan="4" style="text-align: right;">التوصيل</td>
                    <td colspan="2">{{ $entity->ZonePrice }} JOD</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;">الإجمالي الفرعي</td>
                    <td colspan="2">{{ number_format($subtotal, 2, '.', '') }} JOD</td>
                </tr>
                @php $total = $subtotal  +$entity->ZonePrice; @endphp

                <tr>
                    <td colspan="4" style="text-align: right;">الإجمالي الكلي</td>
                    <td colspan="2">{{ number_format($total, 2, '.', '') }} JOD</td>
                </tr>


                <tr>
                    <td colspan="4" style="text-align: right;">المبلغ المدفوع</td>
                    <td colspan="2">
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
                    <td colspan="2">
                        @php
                            $paid = $entity->Total;
                        @endphp
                        @if ($entity->PaymentMethod == 'pay by credit card')
                            @php
                                $paid = $entity->add_value;

                            @endphp
                        @endif

                        {{ number_format($paid, 2, '.', '') }} JOD

                    </td>
                </tr>
            </table>
        </div> --}}



        
    </div>
</body>
<script>
    window
        .print(); // Automatically print the invoice when the page loads. Replace this line with your desired print logic.
    window.onafterprint = () => window.close(); // Close the tab after printing
</script>

</html>
