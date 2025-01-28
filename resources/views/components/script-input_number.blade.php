<script>
    $('.input_number').change(function () {

        var id = $(this).attr('att');
        var quy = $("#input_number-" + id).val();
        console.log(quy)
        var price = $(".price-" + id).attr('price');
        $(".price-" + id).attr('quantity',quy);
        $(".total_" + id).html(parseFloat((quy * price)).toFixed(2));
        $("#subtotal").html(getSubtotal());
        var ZonePrice=$("#ZonePrice").attr('att')
        $("#Discount").html(getDiscount());
        var discount=$("#Discount").html();
        var total= getSubtotal()-discount+parseFloat(ZonePrice)
        $("#Total").html(parseFloat(total).toFixed(2))
    });
</script>
