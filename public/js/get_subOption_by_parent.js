function getSubOptions($id){

    $.ajax({
        type: 'GET',
        url: `/dashboard/product-sub-options/get_subOption_by_parent/${$id}`,
        data: '',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function(){

        },
        success: function(response){

            if(response.status==200){
                try{
                    options='';
                    if(response.data && response.data.subOption){
                        response.data.subOption.forEach(myFunction);
                    }
                    $('#OptID').html(options);
                }catch(err){

                }
            }
        },
        complete: function(response){
        }
        ,
        error: function (xhr, status, error)
        {
            if(xhr.responseJSON.message!=undefined && xhr.responseJSON.message!=null){
                toastr.error(xhr.responseJSON.message)
            }else{
                toastr.error("@langucw('an error occurred')")
            }
        }
    });
}
function myFunction(item, index){
    options+='<option  value="'+item.id+'">'+item.Name +'|'+item.NameEN+'</option>'

}
