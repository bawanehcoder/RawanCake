<section class="header-wrapper">
    <div class="chart-cake">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img alt="{{$product->getTitle()}}" src="{{asset($product->getFirstMediaUrl('products','small'))??''}}?v={{now()}}">
                </div>
                <div class="col">
                    <div class="tittle-chart-cake">
                        <h1 class="pink-color">
                            {{$product->getTitle()}}
                        </h1>
                    </div>
                    <div class="tittle-chart-cake mar-top-10">

                        <p>
                        @php
                            $offer=$product->offerActive->last();
                        @endphp
                        @if($offer)
                            <h1 class="pink-color">
                                <del style="color: #0a0a0a"> {{$product->Price}}</del>  {{$product->price()}}
                            </h1>

                        @else
                            <h1 class="pink-color">
                                {{$product->price()}}
                            </h1>
                            @endif
                            </p>


                    </div>
                    @php $options=$product->optionDetil->groupBy('POptID'); @endphp
                    @if(count($options)>0)
                        @foreach($options as $optin)
                            <div class="row">
                                <div class="col">
                                    <h5 class="pink-color">{{$optin[0]->subOption->itemOption->getTitle()}}</h5>

                                    <div class="form-group mar-btm-10">
                                        <select att="{{$optin[0]->subOption->itemOption->id}}" id="OptID" name="OptID" class="form-control form-control-custom selectCom">
                                            @foreach($optin as $item)
                                                <option value="{{$item->id}}" >{{$item->subOption['Name'.strtoupper(getLang())]}} | + {{$item->AdditionalValue}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <p class="mar-top-10 mar-btm-20">
                        {{$product->getDescription()}}
                    </p>
                    <button onclick="getItemDetails({{$product->id}})" class="button-d-cake pink-button-cake">@langucw('add')
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

    <script>
      function  getItemDetails($item){
          var optin = $("#OptID").find(":selected").val();
          var _data = [];
          $('.selectCom').each(function () {
              _data.push($(this).find(":selected").val());
          });
          $.ajax({
              url: '/dashboard/orders/add-item-order/' +{{$entity->id}}+'/'+ `${$item}`,
              type: "post",
              dataType: 'json',
              data: {data:JSON.stringify(_data)},
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function (response, textStatus, jqXHR) {
                  if(response.status==200){
                      $("#AddValue").html(response.addValue);
                      $("#content_table").html(response.content);
                      $('#myModal').modal('hide');
                  }else if(response.status==422){
                      alert("@langucw('item is exists')")
                  }else{
                      alert("@langucw('an error occurred')")
                  }
                  //
              },
              error: function (XHR, textStatus, errorThrown) {
                  if(xhr.responseJSON.message!=undefined && xhr.responseJSON.message!=null){
                      toastr.error(xhr.responseJSON.message);
                  }else{
                      toastr.error("@langucw('an error occurred')");
                  }
              },
              complete: function (xhr, status) {
              },
          });
        }
    </script>

