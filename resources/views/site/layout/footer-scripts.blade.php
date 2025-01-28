<!-- JS Vendor, Plugins & Activation Script Files -->
@php  $verastion=\Config::get('core.setting.verastion','0'); @endphp

<!-- Vendors JS -->
<script src="{{ asset('site/bakerfresh/assets/js/vendor/modernizr-3.11.7.min.js') }}"></script>
<script src="{{ asset('site/bakerfresh/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('site/bakerfresh/assets/js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>
{{-- <script src="{{ asset('site/bakerfresh/assets/js/vendor/bootstrap.bundle.min.js?v=1') }}"></script> --}}

<!-- Plugins JS -->
<script src="{{ asset('site/bakerfresh/assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('site/bakerfresh/assets/js/countdown.min.js') }}"></script>
<script src="{{ asset('site/bakerfresh/assets/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('site/bakerfresh/assets/js/lightgallery.min.js') }}"></script>
<script src="{{ asset('site/bakerfresh/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('site/bakerfresh/assets/js/ajax.js') }}?v={{ $verastion }}"></script>
<script src="{{ asset('site/bakerfresh/assets/js/jquery.validate.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

<!-- Activation JS -->
<script src="{{ asset('site/bakerfresh/assets/js/main.js') }}?v={{ $verastion }}1"></script>


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('js/subscription.js') }}?v={{ $verastion }}"></script>


<style>
    /* this will set the toastr icon */
    #toast-container>.toast-success {
        content: "\f00C";
    }

    /* this will set the toastr style */
    .toast-success {
        background-color: #533353;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #533353;
        border-color: #533353;
    }

    link:hover {
        color: #533353 !important;
        background-color: #e9ecef;
    }

    .page-link:focus,
    .page-link:hover {
        color: #533353;
        background-color: #e9ecef;
    }

    .page-link {
        position: relative;
        display: block;
        color: #533353;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #dee2e6;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }


    [dir="rtl"] .swiper-button-prev {
        right: 10px;
        left: auto;
    }

    [dir="rtl"] .swiper-button-next,
    .swiper-rtl {
        right: auto;
        left: 0;
    }

    [dir="rtl"] .slider-images-02 {
        left: 0 !important;
        right: auto;
    }

    [dir="rtl"] .slider-arrow {
        right: calc((100% - 1170px) / 2);
    }

    [dir="rtl"] .slider-arrow {

        gap: 31px;

    }

    .notifactions-list-drop {
        display: none;
    }

    li.notifactions-conatainer {
        position: relative;
    }

    .notifactions-list-drop {
        background: #fff;
        color: #333;
        position: absolute;
        right: -15px;
        top: 50px;
        min-width: 350px;
        filter: drop-shadow(0px 0px 7px rgba(0, 0, 0, 0.14));
        border-radius: 5px;
    }

    [dir="rtl"] .notifactions-list-drop {
        right: auto;
        left: -15px
    }

    span.wrapper-arrow {
        position: absolute;
        /*display: block;*/
        top: -16px;
        right: 15px;
        border: 8px solid transparent;
        border-bottom-color: #fff;
    }

    [dir="rtl"] span.wrapper-arrow {
        right: auto;
        left: 15px;
    }

    .wrapper-body {
        padding: 7px;
    }

    .note-item {
        background: #e9e9e9;
        padding: 10px;
        margin-bottom: 5px;
        margin-right: 5px;
    }

    [dir="rtl"] .note-item {
        margin-left: 5px;
    }

    .note-item p {
        font-size: 13px;
        text-align: left;
    }

    [dir="rtl"] .note-item p {
        font-size: 13px;
        text-align: right;
    }

    .col-3.note-name {
        font-weight: bold;
        font-size: 14px;
    }

    .col-9.note-time {
        font-size: 12px;
        text-align: right;
        margin: 0 0 4px 0;
        color: #949494;
    }

    [dir="rtl"] .col-9.note-time {
        text-align: left
    }

    .col-9.note-time i {
        margin: 0 5px;
    }

    a.border-btn {
        font-size: 14px;
        border: 2px solid #ddd;
        padding: 3px 5px;
        float: right;
        margin: 10px 10px 0;
    }

    [dir="rtl"] a.border-btn {
        float: left
    }

    .col-6.drop-title {
        font-weight: bold;
        text-align: left;
        padding: 10px 0 0 30px;
        font-size: 16px;
    }

    [dir="rtl"] .col-6.drop-title {
        text-align: right;
        padding: 10px 30px 0 0;

    }

    a.border-btn-wide {
        background: #efefef;
        width: 100%;
        border: 1px solid #ddd;
        font-size: 14px;
        padding: 5px;
        color: #533353;
    }

    .wrapper-footer {
        padding: 0 5px 5px;
    }

    .note-lis {
        max-height: 300px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .note-lis.allow {
        max-height: 100% !important;
        overflow: visible
    }

    ul.sidebars_widget__post.ddd {
        background: #e9e9e9;
    }

    .container.note-box {
        background: #fff;
        margin: 30px auto;
        border-radius: 8px;
        border: 1px solid #dee0e1;
        padding: 30px;
    }

    .sidebars_widget.ddd {
        margin-bottom: 0
    }

    .category-box.container .section.section-margin-top.section-padding-03 {
        padding: 0;
        text-align: center;
    }

    .category-box.container .single-product-vertical-tab {
        width: 100% !important;
        margin: 0 auto;
        overflow: visible;
        /* border-radius: 25px; */
        /* overflow: hidden; */
    }

    .category-box.container .product-details-img.d-flex.overflow-hidden.flex-row {
        text-align: center;
        overflow: hidden !important;
        border-radius: 25px;
    }

    .category-box.container {
        padding: 30px 15px;
        overflow: hidden;
        margin-top: 15px;
    }

    .category-box.container .product-thumb-vertical.overflow-hidden.swiper-container.order-1.swiper-initialized.swiper-vertical.swiper-pointer-events.swiper-free-mode.swiper-backface-hidden.swiper-thumbs {
        height: auto;
    }

    .category-box.container .single-product-vertical-tab img {
        height: 200px;
    }

    .single-countdown {
        display: inline-block;
        float: left;
        width: auto;
        font-size: 13px;
        margin: 0;
        padding: 3px
    }

    p.time span {
        width: auto;
        display: inline-block;
        margin-left: 0px;
    }

    p.time {
        display: flex;
        align-items: center;
    }

    .product-item-style-01 .product-item__badge2 {
        transform: rotate(-47deg);
        background: #533353;
        text-align: center;
        position: absolute;
        left: -34px;
        top: 28px;
        width: 150px;
        color: #fff;
    }


    [dir="rtl"] .product-list-item__info {
        padding-left: auto;
        padding-right: 30px;
    }

    [dir="rtl"] .product-list__title::before {
        left: auto;
        right: 0
    }

    .condition-item {
        background: url({{ config('app.url') }}/site/bakerfresh/assets/images/slider/slider-4-01.jpg?v=0.021);
        background-repeat: no-repeat;
        background-size: 100% 73%;
        padding: 90px;
        border-radius: 71px;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }

    .condition-item h3 {
        margin-bottom: 100px;
        font-weight: bold;
        color: #fff;
    }

    p.time {
        /* width: auto; */
    }

    .mu-c {
        display: flex;
        align-items: center;
        justify-content: center;
        /* font-size: 14px; */
        position: absolute;
        top: 69px;
        z-index: 9999999;
        background: #fff;
        left: 90px;
        padding: 15px 28px;
        border-radius: 20px;
    }

    p.time>span {
        padding-right: 25px;
    }

    .mu-c * {
        font-size: 19px;
        font-weight: bold;
        color: #533353;
    }

    .condition-item {
        position: relative;
    }

    .container.items-custom h2 {
        text-align: center;
        margin: 90px 0 -54px;
        font-weight: bold;
        color: #ffffff;
        position: relative;
        z-index: 99999;
        text-shadow: 1px 1px 1px #000;
    }

    .product-list-item.col-md-4 {
        margin: 0 !important;
    }

    .zonez label {
        border: 1px solid #ddd;
        margin: 5px 0 43px 10px;
        padding: 7px 15px;
        border-radius: 15px;
    }

    .featured-product-item__image.v-c {
        margin-top: 0;
        padding: 0 59px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
</style>





@yield('style')
@stack('scripts')
@include('components.filter-logic-script')
<script>
    $("img").one("load", function() {
        // do stuff
    }).each(function() {
        if (this.complete) {

            $(this).removeClass('d-none')
            $(this).load(); // For jQuery < 3.0

        }
    });
</script>

<script type="text/javascript">
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    function deleteItem($url) {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        var confirmButtonText = "@langucw('delete')";
        swalWithBootstrapButtons.fire({
            title: "@langucw('Are you sure?')",
            text: "@langucw('You won`t be able to revert this')",
            icon: 'warning',
            position: 'center',
            showCancelButton: true,
            cancelButtonText: "@langucw('cancel')",
            confirmButtonText: confirmButtonText,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form').attr('action', $url);
                $('#delete-form').submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {

            }
        })
    }

    $(".search-open").click(function(){
        $(".search-popup").addClass('open');
    });

    $("#show_more").click(function(){
        $(".hoder").toggle();
    });

    $(".search-popup__close").click(function(){
        $(".search-popup").removeClass('open');
    });

    //timer logic:
    function renderCountdowns() {
        $('[data-countdown]').each(function() {
            var $this = $(this),
                finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%D:%H:%M:%S'));
            });
        });
    }
    $(function() {
        renderCountdowns();
    });
</script>

{{-- notifications js --}}
@if (isLogged())
    <script type="text/javascript">
        $receivedIds = [];
        $notificationPeriod = 30000;
        $windowFocused = true;
        $notificationTimer = null;

        $notificationTimer = window.setInterval(function() {
            if ($windowFocused) {
                getLatestNotifications();
            }
        }, $notificationPeriod);


        $('#getNotifications').click(function() {
            getLatestNotifications();

        })

        {{-- check if user window focused or not --}}
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                $windowFocused = false;
            } else {
                getLatestNotifications();
                $windowFocused = true;
            }
        }, false);

        function getLatestNotifications() {

            $.ajax({
                url: '/notifications/get-latest-unread-interval',
                type: "get",

                data: {
                    after_date: '{{ now()->format('Y-m-d H:i:s') }}',
                    exclude_ids: $receivedIds,
                },
                success: function(response, textStatus, jqXHR) {
                    console.log(response.ids)

                    if (!!response.ids) {
                        $receivedIds = $receivedIds.concat(response.ids);
                    }




                    //update unread count

                    if (parseInt($('#unread_notifications_count').attr('count')) < response.unread_count) {
                        $('#unread_notifications_count').show();
                        $('#unread_notifications_count').html(response.unread_count);
                        $('#unread_notifications_count').attr('count', response.unread_count);
                        $('#notifications-bar-container').prepend(response.notifications);
                        //run alert
                        var audio = new Audio('notification/audio/notification1.mp3');
                        audio.play();
                        clearInterval($notificationTimer);
                        $notificationTimer = window.setInterval(function() {
                            getLatestNotifications();
                        }, 10000);


                    }


                },
                error: function(XHR, textStatus, errorThrown) {
                    console.log(XHR);
                },
                complete: function(xhr, status) {},
            });
        }
    </script>

    {{-- <script type="text/javascript">
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "76f6ac51-279f-4930-b368-ebea5ac7f5ee";
        (function() {
            d = document;
            s = d.createElement("script");
            s.src = "https://client.crisp.chat/l.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script> --}}

    <script>
        $('.notifactions-list-drop').hide()
        $('.show-note').on('click', function() {
            console.log('work')
            $('.notifactions-list-drop').toggle()

        });
        $('.sidebar-item-title2 > a').on('click', function(event) {
            $('.sidebar-item-title2 > a').removeClass('active');
            $(this).addClass('active')

        });


        // Counter To Count Number Visit
        
    </script>
@endif

@yield('footer')
