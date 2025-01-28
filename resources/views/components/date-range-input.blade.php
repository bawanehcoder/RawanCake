
{{-- input_name --}}

{{--        <x-flatpickr  id="dateRangePicker" placeholder="YYYY-MM-DD to YYYY-MM-DD" value="" range/>--}}
        <input type="text" id="dateRangePicker" class="form-control" range placeholder="YYYY-MM-DD to YYYY-MM-DD" />


<input type="hidden" id='from_date_input' name="from_date" value="{{ request()->from_date }}">
<input type="hidden" id='to_date_input' name="to_date" value="{{ request()->to_date }}">


@push('scripts')
    <script type="text/javascript">

        $fp=flatpickr("#dateRangePicker", {
            mode: 'range',
            dateFormat: "Y-m-d",
            defaultDate: ["{{ $fromDate ?? \Request()->input('from_date') }}", "{{ $toDate ?? \Request()->input('to_date') }}"],
            onChange: function(dates) {

                if (dates.length == 2) {

                    var start = new Date(dates[0]);
                    var end = new Date(dates[1]);
                    $start =$fp.formatDate(dates[0], 'Y-m-d');//start.getFullYear()+'-'+start.getMonth()+'-'+start.getDate();// $fp.formatDate(dates[0], 'Y-m-d');

                    $end =$fp.formatDate(dates[1], 'Y-m-d');//end.getFullYear()+'-'+end.getMonth()+'-'+end.getDate();

                    $('#from_date_input').val($start);
                    $('#to_date_input').val($end);

                    //auto submit if no form exists
                    if($("#dateRangePicker").closest('form').length == 0){
                        var url = new URL(window.location.href);


                        url.searchParams.delete("from_date");
                        url.searchParams.delete("to_date");

                        url.searchParams.append('from_date', $start);
                        url.searchParams.append('to_date', $end);
                        window.location.href = url;
                    }

                }


            }
        })





    </script>
@endpush
