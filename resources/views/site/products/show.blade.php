@extends('site.layout.master')
@section('title')
    {{trans('general.products')}}
@endsection
@section('css') @endsection
@section('breadcrumb')
    <li><a href="{{route('home')}}">@langucw('home')</a></li>
    <li><a href="{{route('products.index')}}">@langucw('Product')</a></li>
    <li>@langucw('show')</li>
@endsection
@section('content')
    @php
        $options=$product->optionDetil->where('active',1)->groupBy('POptID');
    @endphp

    {{-- <div class="section section-margin-top section-padding-03">
        <div class="container">
            <div class="row">
                @include('site.products.product-image')
                @include('site.products.product-details')
            </div>
            <!-- Product Section Strat -->
            @include('site.products.related-product-widget',['product'=>$product])
            <!-- Product Section End -->
        </div>
    </div> --}}

    <div class="container mt-10 product-details">
        <div class="row mx-0">
            {{-- <div class="col-lg-6"> --}}
                @include('site.products.product-image')

            {{-- </div> --}}
            @include('site.products.product-details')
            <div class="col-lg-6">
                {{-- <div class="row mx-0">
                    <h3 class="col-lg-8 p-0">{{$product->getTitle()}}</h3>
                    <div class="col-lg-4 p-0 ">
                        <div class="total-price text-right">Total Price</div>
                        <h6 class=" text-right"> {{$product->price()}} {{$genralSetting->getCurrency()}}</h6>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex flex-row">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                </div>
                <div class="row mt-3">
                    <p>{{$product->getDescription()}}</p>
                </div>
                <div class="row mx-0">
                    <div class="col-lg-6">
                        @include('components.product-option-detil',['options'=>$options])

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group position-relative">
                            <label>Quantity</label>
                            <input type="number" class="form-control" />
                            <div class="counter position-absolute">
                                <a href="JavaScript:void(0)" onclick="decrment()">-</a>
                                <a href="JavaScript:void(0)" onclick="incement()">+</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            
        {{-- @include('components.product-special-image') --}}
                {{-- <div class="row mx-0 mt-3">
                    <div class="col-lg-6">
                        <label>Cake Type</label>
                        <select class="form-control">
                            <option>Chocolate</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group position-relative">
                            <label>Filling Type</label>
                            <select class="form-control">
                                <option>Chocolate Chip</option>
                            </select>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="row mx-0 mt-3">
                    <div class="col-lg-12">
                        <label>Do you have any notes ?</label>
                        <textarea class="form-control" placeholder="your notes here"
                            style="resize: none;"> </textarea>
                    </div>
                </div>
                <div class="row mx-0 mt-3">
                    <div class="col-lg-8 d-flex flex-row gap-2">
                        <a href="javaScript:void(0)" class="btn details-button d-flex align-items-center">
                            <svg width="36" height="27" viewBox="0 0 36 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.31802 1.31802C0.474106 2.16193 0 3.30653 0 4.5V22.5C0 23.6935 0.474106 24.8381 1.31802 25.682C2.16193 26.5259 3.30653 27 4.5 27H31.5C32.6935 27 33.8381 26.5259 34.682 25.682C35.5259 24.8381 36 23.6935 36 22.5V4.5C36 3.30653 35.5259 2.16193 34.682 1.31802C33.8381 0.474106 32.6935 0 31.5 0H4.5C3.30653 0 2.16193 0.474106 1.31802 1.31802ZM2.90901 2.90901C3.33097 2.48705 3.90326 2.25 4.5 2.25H31.5C32.0967 2.25 32.669 2.48705 33.091 2.90901C33.5129 3.33097 33.75 3.90326 33.75 4.5V6.75H2.25V4.5C2.25 3.90326 2.48705 3.33097 2.90901 2.90901ZM2.25 11.25H33.75V22.5C33.75 23.0967 33.5129 23.669 33.091 24.091C32.669 24.5129 32.0967 24.75 31.5 24.75H4.5C3.90326 24.75 3.33097 24.5129 2.90901 24.091C2.48705 23.669 2.25 23.0967 2.25 22.5V11.25ZM5.15901 16.409C4.73705 16.831 4.5 17.4033 4.5 18V20.25C4.5 20.8467 4.73705 21.419 5.15901 21.841C5.58097 22.2629 6.15326 22.5 6.75 22.5H9C9.59674 22.5 10.169 22.2629 10.591 21.841C11.0129 21.419 11.25 20.8467 11.25 20.25V18C11.25 17.4033 11.0129 16.831 10.591 16.409C10.169 15.9871 9.59674 15.75 9 15.75H6.75C6.15326 15.75 5.58097 15.9871 5.15901 16.409Z"
                                    fill="white" />
                            </svg>
                            <span class="mx-2">Buy Now</span>
                        </a>
                        <a class="btn details-button d-flex align-items-center" onclick="addToCart({{$product->id}})">
                            <svg width="29" height="29" viewBox="0 0 29 29" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.60003 0.9H4.6H1.9C1.63478 0.9 1.38043 1.00536 1.19289 1.19289C1.00536 1.38043 0.9 1.63478 0.9 1.9C0.9 2.16522 1.00536 2.41957 1.19289 2.60711C1.38043 2.79464 1.63478 2.9 1.9 2.9H3.81984L4.52026 5.71392L7.21791 20.084C7.2608 20.3132 7.38242 20.5201 7.56173 20.6691C7.74104 20.8181 7.96677 20.8998 8.19991 20.9H8.2H8.79999C8.27167 21.0812 7.78611 21.3813 7.38371 21.7837C6.68982 22.4776 6.3 23.4187 6.3 24.4C6.3 25.3813 6.68982 26.3224 7.38371 27.0163C8.07759 27.7102 9.0187 28.1 10 28.1C10.9813 28.1 11.9224 27.7102 12.6163 27.0163C13.3102 26.3224 13.7 25.3813 13.7 24.4C13.7 23.4187 13.3102 22.4776 12.6163 21.7837C12.2139 21.3813 11.7283 21.0812 11.2 20.9H21.4C20.8717 21.0812 20.3861 21.3813 19.9837 21.7837C19.2898 22.4776 18.9 23.4187 18.9 24.4C18.9 25.3813 19.2898 26.3224 19.9837 27.0163C20.6776 27.7102 21.6187 28.1 22.6 28.1C23.5813 28.1 24.5224 27.7102 25.2163 27.0163C25.9102 26.3224 26.3 25.3813 26.3 24.4C26.3 23.4187 25.9102 22.4776 25.2163 21.7837C24.8139 21.3813 24.3283 21.0812 23.8 20.9H24.4C24.6652 20.9 24.9196 20.7946 25.1071 20.6071C25.2946 20.4196 25.4 20.1652 25.4 19.9C25.4 19.6348 25.2946 19.3804 25.1071 19.1929C24.9196 19.0054 24.6652 18.9 24.4 18.9H9.02998L8.54981 16.3419L25.35 15.4981L25.35 15.4981C25.5722 15.4868 25.7842 15.4019 25.9527 15.2566C26.1211 15.1114 26.2363 14.9141 26.28 14.6961L26.2801 14.696L28.0801 5.69601C28.109 5.55098 28.1055 5.40133 28.0697 5.25784C28.0339 5.11435 27.9667 4.98059 27.873 4.8662L27.7956 4.92958L27.873 4.8662C27.7792 4.75181 27.6613 4.65963 27.5276 4.5963C27.394 4.53298 27.248 4.50009 27.1001 4.5H27.1H6.28009L5.57003 1.658C5.51605 1.44157 5.39125 1.2494 5.21549 1.11205C5.03973 0.974701 4.82309 0.900062 4.60003 0.9ZM8.17779 14.3579L6.7041 6.5H25.88L24.472 13.54L8.17779 14.3579ZM10 22.7C10.4509 22.7 10.8833 22.8791 11.2021 23.1979C11.5209 23.5167 11.7 23.9491 11.7 24.4C11.7 24.8509 11.5209 25.2833 11.2021 25.6021C10.8833 25.9209 10.4509 26.1 10 26.1C9.54913 26.1 9.11673 25.9209 8.79792 25.6021C8.47911 25.2833 8.3 24.8509 8.3 24.4C8.3 23.9491 8.47911 23.5167 8.79792 23.1979C9.11673 22.8791 9.54913 22.7 10 22.7ZM22.6 22.7C23.0509 22.7 23.4833 22.8791 23.8021 23.1979C24.1209 23.5167 24.3 23.9491 24.3 24.4C24.3 24.8509 24.1209 25.2833 23.8021 25.6021C23.4833 25.9209 23.0509 26.1 22.6 26.1C22.1491 26.1 21.7167 25.9209 21.3979 25.6021C21.0791 25.2833 20.9 24.8509 20.9 24.4C20.9 23.9491 21.0791 23.5167 21.3979 23.1979C21.7167 22.8791 22.1491 22.7 22.6 22.7Z"
                                    fill="white" stroke="white" stroke-width="0.2" />
                            </svg>
                            
                                @langucw('add to cart')
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>


        <!-- Related Product -->
        {{-- <div class="row mx-0">
            <h3>Related Products</h3>
            <div class="regular slider product-slider  mt-4">
                <div class="p-2">
                    <div class="card p-3" id="card">
                        <img src="assets/images/product.png" class="w-50 d-flex mx-auto" id="image_1" />
                    </div>
                    <h3 class="mt-3">Mini Cake</h3>
                    <a href="#" class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-row">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                        <div class="d-flex">
                            <h3> JOD 1.00</h3>
                        </div>
                    </a>
                </div>
                <div class="p-2">
                    <div class="card p-3" id="card">
                        <img src="assets/images/product.png" class="w-50 d-flex mx-auto" id="image_1" />
                    </div>
                    <h3 class="mt-3">Mini Cake</h3>
                    <a href="#" class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-row">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                        <div class="d-flex">
                            <h3> JOD 1.00</h3>
                        </div>
                    </a>
                </div>
                <div class="p-2">
                    <div class="card p-3" id="card">
                        <img src="assets/images/product.png" class="w-50 d-flex mx-auto" id="image_1" />
                    </div>
                    <h3 class="mt-3">Mini Cake</h3>
                    <a href="#" class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-row">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                        <div class="d-flex">
                            <h3> JOD 1.00</h3>
                        </div>
                    </a>
                </div>
                <div class="p-2">
                    <div class="card p-3" id="card">
                        <img src="assets/images/product.png" class="w-50 d-flex mx-auto" id="image_1" />
                    </div>
                    <h3 class="mt-3">Mini Cake</h3>
                    <a href="#" class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-row">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                        <div class="d-flex">
                            <h3> JOD 1.00</h3>
                        </div>
                    </a>
                </div>
                <div class="p-2">
                    <div class="card p-3" id="card">
                        <img src="assets/images/product.png" class="w-50 d-flex mx-auto" id="image_1" />
                    </div>
                    <h3 class="mt-3">Mini Cake</h3>
                    <a href="#" class="d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-row">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                        <div class="d-flex">
                            <h3> JOD 1.00</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div> --}}
        <!-- /Related Product -->
    </div>

    <div id="divLargerImage"></div>
    <div id="divOverlay"></div>

@endsection

@push('scripts')

    <style>
        .product-details .form-control, .checkout-details .form-control, .login .form-control {
    text-align: center;
}
    </style>
    <script src="{{asset('assets/js/jquery.zoom.js')}}"></script>
    <script src="{{asset('js/btn-number.js?v=1.2')}}"></script>
    <script>
        let uploadedDocumentMap = {};
        Dropzone.options.productDropzone = {
            url: '{{ route('cart.storeMedia') }}',
            maxFilesize: 10, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif,.txt,.docx,.doc,.pdf',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" id="productImage" name="image" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove();
                let name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name;
                } else {
                    name = uploadedDocumentMap[file.name];
                }
                $('form').find('input[name="image"][value="' + name + '"]').remove();
            },
            init: function () {
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }
                return _results
            }
        }

        $(function () {
            $('#zoom').zoom();
            $('.review-rating-bg').on('click', function (e) {
                var bcr = this.getBoundingClientRect();
                var n = (e.clientX - bcr.left) / bcr.width;
                var nR = Math.round(n * 5);
                if (nR < 1) {
                    nR = 1;
                } else if (nR > 5) {
                    nR = 5;
                }
                @if( isLogged() && !getLogged()->hasRated($product))
                AddToRate('{{$product->id}}', nR)
                @elseif(!isLogged())
                toastr.info("@langucw('you must log in first')");
                @else
                toastr.info("@langucw('you have voted before')");
                @endif
            });
            let image = $('#imageModalId img');
            $('#imageModalId').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);

                let rul = button.data('url');
                console.log(rul);
                image.attr('src', rul);
            });
        });
    </script>

<script>
    $('#qty').change(function () {
        var quy = $(this).val();
        console.log(quy)
        var price = $(".d-price").attr('data-price');
        console.log(price)


        $('.d-price-v').html(parseFloat((quy * price)).toFixed(2));

        // $(".price-" + id).attr('quantity',quy);
        // $(".total_" + id).html(parseFloat((quy * price)).toFixed(2));
        // $("#subtotal").html(getSubtotal());
        // var ZonePrice=$("#ZonePrice").attr('att')
        // $("#Discount").html(getDiscount());
        // var discount=$("#Discount").html();
        // var total= getSubtotal()-discount+parseFloat(ZonePrice)
        // $("#Total").html(parseFloat(total).toFixed(2))
    });

    $('#OptID').change(function () {
        // alert()
        var quy = $('#qty').val();
        console.log(quy)
        var price = $('#OptID option:selected').data('price');
        console.log(price)
        $(".d-price").attr('data-price',price)


        $('.d-price-v').html( price * quy )
    });
</script>
@endpush
