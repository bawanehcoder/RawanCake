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
            padding: 0;
            background-color: #f9f9f9;
        }

        .invoice-container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 2px solid #e0d4f5;
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
@if ( $entity->callc)
<p>
    اسم الموظف
    {{ $entity->user->name }}
</p>
@endif
               
            </div>
        </div>

        <div class="details">
            <table>
                <tr>
                    <th>اسم العميل</th>
                    <th>رقم الهاتف</th>
                    <th>رقم الطلب</th>
                    <th>طريقة الدفع</th>
                    <th>العنوان</th>
                    <th>وقت التسليم</th>
                </tr>
                <tr>
                    <td>{{ $entity->Name }}</td>
                    <td>{{ $entity->Phone }}</td>
                    <td>{{ $entity->id }}</td>
                    <td>{{ $entity->PaymentMethod }}</td>
                    <td>{{ $entity->delivery_type == 'personal_pickup' ? __('branch pickup') . ' : ' . $entity->branch['Addres' . getLang()] : $entity->zone['Addres' . getLang()] }}
                    </td>
                    <td>{{ $entity->DeliveryTime }}</td>
                </tr>
            </table>
        </div>

        <div class="order-details">
            <table>
                <tr>
                    <th>#</th>
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
                        <td>{{ $item->item->getTitle() }}
                            @if ($item->optionDetil())
                                @foreach ($item->optionDetil()->get() ?? [] as $option)
                                    <br>
                                    ( {{ $option->option->Name }} ) {{ $option->subOption->getTitle() }} ({{ $option->AdditionalValue }})
                                @endforeach
                            @endif
                        </td>
                        <td>{{ number_format($item->Price, 2, '.', '') }} JOD</td>
                        <td>{{ $item->Quantity }}</td>
                        <td>{{ number_format($item->Price , 2, '.', '') }} JOD</td>
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
