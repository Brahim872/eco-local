$('.switchStatus').on('change', function (e) {
    e.preventDefault();

    $.ajax({
        'url': $(this).data('url'),
        'method': 'GET',
        'data': {
            'client_id': $(this).data('client_id'),
            'product_id': $(this).data('product_id'),
            'status': $(this).is(':checked'),
        },
        'success': function (data) {
            $.toastr.success('success --- ');
        },
        'error': function (error) {
            console.log(error)
        }
    })
})

