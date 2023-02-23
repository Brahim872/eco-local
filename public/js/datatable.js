const TableDatatablesAjax = {
    initDataTable: async function () {
        try {
            await $.ajax({
                url: $(location).attr('href'),
                type: 'GET',
                success: function (data) {
                    $('#pagination').html(data['pagination']);
                    $('#pagination-info').html(data['paginationInfo']);
                    $('#bs__table').html(data['data']);
                },
            })
        } catch (error) {
            console.log(error);
        }
    },
    sortDataTable: function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function iconSort(e) {

            if ($(e.target).attr('data-dir') == 'DESC') {
                $('.sortable').removeAttr('data-dir')
                $(e.target).attr('data-dir', 'ASC')
            } else {
                $('.sortable').removeAttr('data-dir')
                $(e.target).attr('data-dir', 'DESC')
            }

        }

        $('.sortable').on('click', (e) => {

            let array = {
                'sort': {
                    'col': $(e.target).attr('data-sort'),
                    'dir': $(e.target).attr('data-dir') ?? 'ASC'
                }
            }
            localStorage.setItem('data-table', JSON.stringify(array));

            $.ajax({
                url: $(location).attr('href'),
                type: 'POST',
                data: JSON.parse(localStorage.getItem('data-table')),
                success: function (data) {

                    iconSort(e)
                    $('#bs__table').html(data['data']);
                }
            })
        })
    },
    paginationDataTable: function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.page_item', (e) => {
            $.ajax({
                url: $(e.currentTarget).attr('data-href'),
                type: 'GET',
                success: function (data) {
                    $('#bs__table').html(data['data']);
                    $('#pagination').html(data['pagination']);
                    $('#pagination-info').html(data['paginationInfo']);
                }
            })
        })
    },
    searchDataTable: function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('keyup', '#search_datatable', function(e) {
            let obj = JSON.parse(localStorage.getItem('data-table'))
            obj['search'] = $(e.currentTarget).val().toLowerCase()

            $.ajax({
                url: $(document).attr('href'),
                type: 'POST',
                data:obj,
                success: function (data) {
                    $('#bs__table').html(data['data']);
                    $('#pagination').html(data['pagination']);
                    $('#pagination-info').html(data['paginationInfo']);
                }
            })
        })
    },

    init: function () {
        this.initDataTable().then(() => {
            this.paginationDataTable();
            this.searchDataTable();
            this.sortDataTable();
        });
    }


};

jQuery(document).ready(function () {
    TableDatatablesAjax.init();
});



