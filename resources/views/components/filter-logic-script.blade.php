<script>

    $filters = {!! json_encode($filters ?? []) !!};

    $lastAppliedFilter = '';
    $originalBaseUrl = '{{ route('products.index') }}';
    // , ['main' => $categorySlug ?? null, 'sub' => $subcategorySlug ?? null]
    $baseUrl = '{{ route('products.index') }}';


    pageLinkEvent();

    function pageLinkEvent() {
        $('.page-link').click(function (e) {
            e.preventDefault();
            $main_category = $(".main_category").val();
            $sub_category = $(".sub_category").val();
            $filters.page = $(this).html();
            if($('#search_filter').val()!=''){
                $filters.search =$('.sidebars_search__input').val();;
            }else{
                 $filters.search =$('.sidebars_search__input').val()
            }



            $lastAppliedFilter = 'pagination';
            var selectPage=$(e.target).parents('.paginations').attr('id');

            switch (selectPage){
                case 'favorite':
                   getFavorite($filters.page)
                    break
                default:

                    applyFilters();
                    break
            }
        })
    }
    function getFavorite(page){
        var baseUrl = '{{ route('favorites.index') }}';
        window.history.replaceState({}, "", baseUrl + "?page="+page);

        $.ajax({
            url: baseUrl  + "?page="+page,
            type: "get",
            beforeSend: function () {
                $('#data-container').css({'opacity': 0.5});
            },
            success: function (data, textStatus, jqXHR) {
                console.log(data)
                $('#data-container').html(data);
                $("html, body").animate({scrollTop: 0}, "slow");
                $('#current_page').html($("#page_show").html())
                pageLinkEvent();
            },
            error: function (XHR, textStatus, errorThrown) {

            },
            statusCode: {},
            complete: function (xhr, status) {
                $('#data-container').css({'opacity': 1});

            },

        });




    }


    $('.apply-filter').click(function (e) {
        e.preventDefault();
        $main_category = $(".main_category").val();
        $sub_category = $(".sub_category").val();
        $filters.search = $('#search_filter').val();
        $('.sidebars_search__input').val($('#search_filter').val());
        delete $filters.page;

        applyFilters()
    });
 $('.sidebars_search__btn').on('click', function (e) {
     e.preventDefault();

     $main_category = $(e.target).attr('main_category');
     $sub_category = $(e.target).attr('sub_category');
     delete $filters.page;
     $(".main_category").val($main_category);
     $(".sub_category").val($sub_category);
     $filters.search = $('.sidebars_search__input').val();
     $lastAppliedFilter = 'search';

     applyFilters();

 });
    $('.filter-form').on('click', function (e) {
        e.preventDefault();
        $main_category = $(e.target).attr('main_category');
        $sub_category = $(e.target).attr('sub_category');

        delete $filters.page;
        $(".main_category").val($main_category);
        $(".sub_category").val($sub_category);
        // $filters.search = $('#search_filter').val();
        $filters.search = '';
         $('.sidebars_search__input').val('');
        $lastAppliedFilter = 'search';
        applyFilters();
        window.location.reload();
    })

    function applyFilters() {
        if ($lastAppliedFilter != 'pagination') {
            $filters.page = 1;
        }

        var isPageProducts=window.location.href.split("/products/index");

        if(isPageProducts.length==1){
            window.location.href='{{ route('products.index') }}?search=' +  $('#search_filter').val()+"&page="+$filters.page
            return
        }



        $params = objToUrl($filters);



        var url=$baseUrl + `?${$params}`
        window.history.replaceState({}, "", $baseUrl +  `?${$params}`);
        if(($main_category!=''&&$main_category!=undefined) && ($sub_category==''|| $sub_category==undefined)){
            var url=$baseUrl +'/'+$main_category+ `?${$params}`
            window.history.replaceState({}, "", $baseUrl+'/'+$main_category +  `?${$params}`);
        }else if(($main_category!=''&&$main_category!=undefined) && $sub_category!='' &&$sub_category!=undefined){
            var url=$baseUrl +'/'+$main_category+'/'+$sub_category+ `?${$params}`
            window.history.replaceState({}, "", $baseUrl+'/'+$main_category+'/'+$sub_category +  `?${$params}`);
        }

        $.ajax({
            url:url ,
            type: "get",
            beforeSend: function () {
                $('#data-container').css({'opacity': 0.5});
            },
            success: function (data, textStatus, jqXHR) {


                $(".main_category").val($main_category);
                $(".sub_category").val($sub_category);
                $('.sidebars_search__input').val($filters.search)
                $('#search_filter').val($filters.search)

                $('#data-container').html(data);
                $('#current_page').html($("#page_show").html())
                // renderCarousel();
                pageLinkEvent();
                $("html, body").animate({scrollTop: 0}, "slow");

            },
            error: function (XHR, textStatus, errorThrown) {

            },
            statusCode: {},
            complete: function (xhr, status) {
                $('#data-container').css({'opacity': 1});
                renderCountdowns();
                pageLinkEvent();
            },

        });
    }

    function objToUrl(obj) {

        var str = "";
        for (var key in obj) {
            if (str != "") {
                str += "&";
            }
            str += key + "=" + obj[key];
        }
        return str;
    }

    function renderCarousel() {
        $('.serv-slider').owlCarousel({
            loop: true,
            margin: 0,
            autoplay: true,
            nav: false,
            dots: true,
            rtl: pageDir,
            autoplayTimeout: 6000,
            smartSpeed: 1500,
            dragEndSpeed: 1500,
            slidSpeed: 5000,
            items: 1,
        });
        //    services main slider
        $('.more-services-slider').owlCarousel({
            loop: false,
            margin: 30,
            autoplay: false,
            nav: true,
            dots: false,
            rtl: pageDir,
            autoplayTimeout: 6000,
            smartSpeed: 1500,
            dragEndSpeed: 1500,
            slidSpeed: 5000,
            navText: [
                '<i class="fas fa-chevron-right"></i>',
                '<i class="fas fa-chevron-left"></i>',
            ],
            responsive: {
                // breakpoint from 0 up
                0: {
                    items: 1,
                },
                // breakpoint from 480 up
                576: {
                    items: 2,
                },
                1000: {
                    items: 3,
                },
                // breakpoint from 768 up
                1200: {
                    items: 4,
                }
            }
        });
        //    services main slider
        $('.competition-slider').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: false,
            nav: true,
            dots: false,
            rtl: pageDir,
            autoplayTimeout: 6000,
            smartSpeed: 1500,
            dragEndSpeed: 1500,
            slidSpeed: 5000,
            navText: [
                '<i class="fas fa-chevron-right"></i>',
                '<i class="fas fa-chevron-left"></i>',
            ],
            responsive: {
                // breakpoint from 0 up
                0: {
                    items: 2,
                },
                // breakpoint from 480 up
                576: {
                    items: 3,
                },
                1000: {
                    items: 4,
                },
                // breakpoint from 768 up
                1200: {
                    items: 5,
                }
            }
        });
        //    services inner slider
        $('.service-inner-slider').owlCarousel({
            loop: true,
            margin: 0,
            autoplay: true,
            nav: true,
            dots: true,
            rtl: pageDir,
            autoplayTimeout: 6000,
            smartSpeed: 1500,
            dragEndSpeed: 1500,
            slidSpeed: 5000,
            items: 1,
            navText: [
                '<i class="fas fa-chevron-right"></i>',
                '<i class="fas fa-chevron-left"></i>',
            ],
        });
        $('.home-slide').owlCarousel({
            loop: true,
            margin: 0,
            autoplay: true,
            nav: false,
            dots: true,
            rtl: pageDir,
            autoplayTimeout: 6000,
            smartSpeed: 450,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            items: 1,
            touchDrag: false,
            mouseDrag: false,
        });
    }

function quickview(entity){

    $.ajax({
        url:'/products/quick-show/'+`${entity}` ,
        type: "get",
        beforeSend: function () {
            $('#modal_product').html('')
        },
        success: function (data, textStatus, jqXHR) {

            $('#modal_product').html(data)
            $('#exampleProductModal').modal('show');

        },
        error: function (XHR, textStatus, errorThrown) {

        },
        statusCode: {},
        complete: function (xhr, status) {

        },

    });




}
</script>
