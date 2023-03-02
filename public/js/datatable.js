
const TableDataTableHtml = {
    initSearch : function () {
        $('#search').html(` <form>
                                    <div>
                                    <input type="text"
                                            id="search_datatable"
                                            placeholder="Search...."
                                            class = 'bg-gray-50 border
                                            border-gray-300 text-gray-900 text-sm
                                            rounded-lg focus:ring-gray-500 focus:border-gray-500 mb-4 block  w-full p-2.5'>
                                        </div>
                                    </form>`)
    },
    initSpinner : function (status) {

        if(status == true){
            $('#spinner-table').html(` <div role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                                        <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>`)
        }
        if(status == false){
            console.log("true")
            $('#spinner-table').html(``)
        }
    },

    init: function () {
        this.initSearch();
        this.initSpinner();
    }

}

const TableDatatablesAjax = {
    initDataTable: async function () {
        try {
            TableDataTableHtml.initSpinner(true);
            await $.ajax({
                url: $(location).attr('href'),
                type: 'GET',
                success: function (data) {
                    $('#pagination').html(data['pagination']);
                    $('#pagination-info').html(data['paginationInfo']);
                    $('#bs__table').html(data['data']);
                    $('#filter').html(data['filter'])
                    TableDataTableHtml.initSpinner(false);
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

             TableDataTableHtml.initSpinner(true);
            $.ajax({
                url: $(location).attr('href'),
                type: 'POST',
                data: JSON.parse(localStorage.getItem('data-table')),
                success: function (data) {
                    iconSort(e)
                    $('#bs__table').html(data['data']);
                     TableDataTableHtml.initSpinner(false);
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

             TableDataTableHtml.initSpinner(true);
            $.ajax({
                url: $(e.currentTarget).attr('data-href'),
                type: 'GET',
                data:JSON.parse(localStorage.getItem('data-table')),
                success: function (data) {
                    $('#bs__table').html(data['data']);
                    $('#pagination').html(data['pagination']);
                    $('#pagination-info').html(data['paginationInfo']);
                     TableDataTableHtml.initSpinner(false);
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

        $(document).on('keyup', '#search_datatable', function (e) {
             TableDataTableHtml.initSpinner(true);
            let obj = JSON.parse(localStorage.getItem('data-table'))
            obj['search'] = $(e.currentTarget).val().toLowerCase()

            $.ajax({
                url: $(document).attr('href'),
                type: 'POST',
                data: obj,
                success: function (data) {
                    $('#bs__table').html(data['data']);
                    $('#pagination').html(data['pagination']);
                    $('#pagination-info').html(data['paginationInfo']);
                     TableDataTableHtml.initSpinner(false);

                }
            })
        })
    },
    filterDataTable: function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('change', '.filter_table_data', function (e) {
             TableDataTableHtml.initSpinner(true);
            let obj = JSON.parse(localStorage.getItem('data-table'))

            obj['filter']= {
                [$(e.currentTarget).attr('name')]:$(e.currentTarget).val().toLowerCase(),
            }

            $.ajax({
                url: $(document).attr('href'),
                type: 'POST',
                data: obj,
                success: function (data) {
                    $('#bs__table').html(data['data']);
                    $('#pagination').html(data['pagination']);
                    $('#pagination-info').html(data['paginationInfo']);
                     TableDataTableHtml.initSpinner(false);

                }
            })
        })
    },

    init: function () {
        this.initDataTable().then(() => {
            this.paginationDataTable();
            this.searchDataTable();
            this.sortDataTable();
            this.filterDataTable();
        });
    }


};

jQuery(document).ready(function () {
    TableDatatablesAjax.init();
    TableDataTableHtml.init();
});



