const TableDataTableHtml = {

    spinnerTable: $('#spinner-table'),
    initSpinner: function (status) {
        if (status) {
            this.spinnerTable.html(` <div role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2">
                                        <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>`)
        }
        if (status == false) {
            this.spinnerTable.html(``)
        }
    },
    // initTemplate: function () {
    //
    //     $('#mytable_BS').html(``)
    // },

    initReloadTable: function (data, focus = false) {

        let dataL = TableDatatablesAjax.getLocalDataTable($(location).attr('pathname'));
        $('#mytable_BS').html(data['data'])

        let fieldSearch = $('#search_datatable').val(dataL.search)

        TableDataTableHtml.initSpinner(false);
    },

    init: function () {
        this.initSpinner();
        // this.initTemplate();
    }

}

const TableDatatablesAjax = {
    pathname: $(location).attr('pathname'),
    initLocalStorage: function (table) {
        // let dataL = ''
        let dataL = TableDatatablesAjax.getLocalDataTable(table);
        if (!dataL) {
            dataL = {
                'sort': {
                    'col': '',
                    'dir': ''
                },
                'search': '',
                'page': '',
                'filter': '',
            }
        }

        localStorage.setItem('data-table' + this.pathname, JSON.stringify(dataL));

    },
    getLocalDataTable: function (table) {
        return JSON.parse(localStorage.getItem('data-table' + this.pathname))
    },
    storeLocalDataTable: function (data) {

        let dataL = TableDatatablesAjax.getLocalDataTable(this.pathname);
        let dataSort = {};

        if (dataL.sort.col || data['col']) {
            dataSort = {
                'col': data['col'] ?? dataL.sort.col,
                'dir': data['dir'] ?? dataL.sort.dir
            }
        }

        dataL = {
            'sort': dataSort,
            'search': data['search'] ?? dataL.search ?? '',
            'page': data['page'] ?? dataL.page ?? '',
            'pagination': data['pagination'] ?? dataL.pagination ?? '',
            'filter': data['filter'] ?? dataL.filter ?? '',
        }

        localStorage.setItem('data-table' + this.pathname, JSON.stringify(dataL));

    },
    initDataTable: async function () {
        try {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            TableDataTableHtml.initSpinner(true);
            await $.ajax({
                url: $(location).attr('href'),
                type: 'POST',
                data: this.getLocalDataTable(this.pathname),
                success: function (data) {
                    TableDatatablesAjax.initLocalStorage(this.pathname)
                    TableDataTableHtml.initReloadTable(data)
                },
            })

        } catch (error) {
            console.log(error);
        }

    },
    sortDataTable: function () {

        let elementClick;

        $(document).on('click', '.sortable', (e) => {
            elementClick = e

            this.storeLocalDataTable({
                'table': this.pathname,
                'dir': $(e.currentTarget).attr('data-dir') ?? 'ASC',
                'col': $(e.currentTarget).attr('data-sort'),
            });


            TableDataTableHtml.initSpinner(true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            $.ajax({
                url: $(location).attr('href'),
                type: 'POST',
                data: this.getLocalDataTable(this.pathname),
                success: function (data) {
                    function resolveAfter2Seconds() {
                        return new Promise(resolve => {
                            resolve($('#mytable_BS').html(data['data']));
                        });
                    }

                    resolveAfter2Seconds().then((e) => {
                        let $dataLocal = TableDatatablesAjax.getLocalDataTable(data.table);

                        $('#search_datatable').val($dataLocal.search)
                        TableDatatablesAjax.storeLocalDataTable({
                            'table': this.pathname,
                            'dir': $('.sort_' + $dataLocal['sort']['col']).attr('data-dir'),
                            'col': $('.sort_' + $dataLocal['sort']['col']).attr('data-sort'),
                        })

                        let sort = $dataLocal['sort']['dir'] == "ASC" ? 'DESC' : 'ASC';
                        $('.sortable').removeAttr('data-dir')
                        $('.sort_' + $dataLocal['sort']['col']).attr('data-dir', sort)
                    });
                },
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
            const url = $(e.currentTarget).attr('data-href');
            const urlParams = new URLSearchParams(url.split('?')[1]);
            const page = urlParams.get('page');

            this.storeLocalDataTable({
                'table': this.pathname,
                'page': page,
            });

            TableDataTableHtml.initSpinner(true);
            $.ajax({
                url: $(e.currentTarget).attr('data-href'),
                type: 'POST',
                data: this.getLocalDataTable(this.pathname),
                success: function (data) {
                    TableDataTableHtml.initReloadTable(data)
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

            TableDatatablesAjax.storeLocalDataTable({
                'table': this.pathname,
                'search': $(e.target).val().toLowerCase(),
            });

            $.ajax({
                url: $(document).attr('href'),
                type: 'POST',
                data: TableDatatablesAjax.getLocalDataTable(this.pathname),
                success: function (data) {
                    TableDataTableHtml.initReloadTable(data, true)
                    if($('#search_datatable').val() != ''){
                        $('#search_datatable').focus()
                    }
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

            console.log($(e.currentTarget).val())

            let datFilt =  {
                    'field': $(e.currentTarget).attr('name'),
                    'value': $(e.currentTarget).val()
                }
            TableDatatablesAjax.storeLocalDataTable({
                'table': this.pathname,
                'filter':  {
                    datFilt
                },
            });

            console.log(TableDatatablesAjax.getLocalDataTable(this.pathname))
            $.ajax({
                url: $(document).attr('href'),
                type: 'POST',
                data: TableDatatablesAjax.getLocalDataTable(this.pathname),
                success: function (data) {
                    TableDataTableHtml.initReloadTable(data, true)
                    if($('#search_datatable').val() != ''){
                        $('#search_datatable').focus()
                    }
                }
            })
        })
    },


    numberPaginationDataTable: function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('change', '#number_pagination', (e) => {
            this.storeLocalDataTable({
                'table': this.pathname,
                'pagination': $(e.target).val(),
            });


            TableDataTableHtml.initSpinner(true);
            $.ajax({
                url: $(e.currentTarget).attr('data-href'),
                type: 'POST',
                data: this.getLocalDataTable(this.pathname),
                success: function (data) {
                    TableDataTableHtml.initReloadTable(data)
                }
            })
        })
    },

    init: function () {
        this.initDataTable().then(() => {
            this.sortDataTable();
            // this.storeLocalDataTable();

            this.paginationDataTable();
            this.searchDataTable();
            this.numberPaginationDataTable();
            this.filterDataTable();
        });
    }


};

jQuery(document).ready(function () {
    TableDatatablesAjax.init();
    TableDataTableHtml.init();
});



