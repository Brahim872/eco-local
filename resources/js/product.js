$('.switchStatus').on('change', function (e) {
    e.preventDefault();

    console.log($(this).data('url'))

    $.ajax({
        'url': $(this).data('url'),
        'method': 'GET',
        'data':{
          'client_id':  $(this).data('client_id'),
          'product_id':  $(this).data('product_id'),
        },
        'success':function(data){
            alert('success')
        }
    })
})

