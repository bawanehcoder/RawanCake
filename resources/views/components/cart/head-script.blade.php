<script>
  function  offcanvasCart(){
    alert('offcanvas');
      $.ajax({
          url: '{{route('cart.view_cart')}}',
          type: "get",
          beforeSend: function () {
              $('#cart_content').css({'opacity': 0.5});
          },
          success: function (data, textStatus, jqXHR) {
              $('#cart_content').html(data);
              $("html, body").animate({scrollTop: 0}, "slow");
          },
          error: function (XHR, textStatus, errorThrown) {

          },
          statusCode: {},
          complete: function (xhr, status) {
              $('#cart_content').css({'opacity': 1});
          },
      });
    }
</script>
