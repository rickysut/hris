@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
</style>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12  d-none d-md-block" style="margin-top: 15px ">
                    <div class="pull-left">
                        <h5>Turnover Karyawan</h5>
                    </div>
                </div>

            </div>

            <x-moonshine::card
            >
                <div class="sm:flex gap-4
                    items-center
                    justify-center"
                >


                    <div class="row">


                        <div class="col">
                            <div class="form-group">
                            <label for="start_datepicker">Start Date:</label>
                            <input type="text" class="form-control" id="start_datepicker">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                            <label for="end_datepicker">End Date:</label>
                            <input type="text" class="form-control" id="end_datepicker">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="user_id">{{ trans('cruds.rpt_wallets.fields.user') }}</label>
                            <select class="select2" name="user_id" id="user_id">
                                <option value="0">All Users</option>

                            </select>
                        </div>
                        <div class="col d-none d-md-block">
                            <div class="form-group text-left">
                                <button class="btn btn-success mt-4" id="btn_filter" onclick="myNamespace.filter()">Filter</button>
                            </div>
                        </div>
                    </div>

                    <div class="d-sm-block d-md-none">
                        <div class="form-group">
                            <button class="btn btn-block btn-success mt-4" id="btn_filter" onclick="myNamespace.filter()">Filter</button>
                        </div>
                    </div>
                </div>
            </x-moonshine::card>


            <div id="detailtable" class="card" >
                <div class="card-body" style="overflow-x:auto;">
                    <h4 id="title_detail" class="card-title">Transactions Detail </h4>
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Transaction">
                        <thead class="bg-dark">
                            <tr>
                                <th >
                                    ID
                                </th>
                                <th >
                                    Type
                                </th>

                                <th >
                                    Detail
                                </th>
                                <th >
                                    Total
                                </th>
                                <th >
                                    User
                                </th>
                                <th >
                                    To
                                </th>
                                <th >
                                    Host
                                </th>
                                <th >
                                    Tgl
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        {{-- <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">Total:</th>
                                <th class="text-right"></th>
                                <th colspan="4" class="text-right"></th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    // var urlprint = "{ {route('admin.reportings.transactions.detailpdf') } }";
    var userName = 'All users';

    if (!window.myNamespace){
        // creating an empty global object
        var myNamespace = {};
    }
    $(function () {
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function pad (str, max) {
            str = str.toString();
            return str.length < max ? pad("0" + str, max) : str;
        }
        $('#start_datepicker, #end_datepicker').datepicker({
            dateFormat: 'dd/mm/yy',
        });
        let d = new Date()
        var firstDay = new Date(d.getFullYear(), d.getMonth(), 1);

        $("#start_datepicker").datepicker("setDate", firstDay);
        $("#end_datepicker").datepicker("setDate", d);


        $('#user_id').on('select2:select', function (e) {
            const selectedOption = e.params.data;
            userName = selectedOption.element.innerHTML;

        });

        function formatNumber(num) {
            const numStr = num.toString();
            const numArr = numStr.split('.');
            const wholeNum = numArr[0];
            const decimalNum = numArr.length > 1 ? numArr[1] : '00';
            const paddedWholeNum = wholeNum.padStart(2, '0');
            const paddedDecimalNum = decimalNum.padEnd(2, '0').substring(0, 2);
            return `${paddedWholeNum}.${paddedDecimalNum}`;
        }


        myNamespace.downloadPdf = function (){
            userId = $('#user_id').val();
            start = moment(moment($('#start_datepicker').val(), 'DD/MM/YYYY')).format('YYYY-MM-DD');
            end = moment(moment($('#end_datepicker').val(), 'DD/MM/YYYY')).format('YYYY-MM-DD');
            window.location.assign(urlprint + '?userid='+userId+'&username='+userName+'&startdt='+start+'&enddt='+end);
        }


        let dtOverrideGlobals = {
            buttons: [
                {
                    extend: 'pdf',
                    orientation: 'landscape',
                    className: 'btn btn-block btn-primary',
                    text: 'PDF',
                    title: 'Transaction Report',
                    customize : function(doc){
                        doc.styles.tableHeader.alignment = 'left';
                        doc.content[1].table.widths = [10,40,220,40,90,90,90,150];
                        var rowCount = doc.content[1].table.body.length;
                        for (i = 1; i < rowCount; i++) {
                            doc.content[1].table.body[i][3].alignment = 'right';
                        }
                    },
                    exportOptions: {
                        columns: ':visible'
                    },
                    footer: true,
                    action: function (e, dt, node, config)
                    {
                        var myButton = this;
                        var currentPageLen = dt.page.len();
                        var currentPage = dt.page.info().page;

                        dt.one( 'draw', function () {
                            $.fn.dataTable.ext.buttons.pdfHtml5.action.call(myButton, e, dt, node, config);
                            setTimeout(function() {
                                dt.page.len(currentPageLen).draw(); //set page length
                                dt.page(currentPage).draw('page'); //set current page
                            }), 1500;
                        });
                        dt.page.len(-1).draw();
                    }
                    // action: function (e, dt, node, config) {
                    //     myNamespace.downloadPdf();
                    // }
                },

            ],
            // dom: 'Btrlp',
            dom:
					"<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'>>" +
					"<'row'<'col-sm-12 col-md-12'tr>>" +
					"<'row'<'col'l><'col'p>>",

            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            language: {
                url : "/json/dataTables.i18n.en.json"
            },
            ajax: {
                // url : " { { route('admin.reportings.transactions') } }",
                type: 'GET',
                data: {
                    userid: function() { return $('#user_id').val() },
                    startDate: function() { return  moment(moment($('#start_datepicker').val(), 'DD/MM/YYYY')).format('YYYY-MM-DD') },
                    endDate: function() { return   moment(moment($('#end_datepicker').val(), 'DD/MM/YYYY')).format('YYYY-MM-DD') }
                }
            },
            columnDefs: [
                {
                    orderable: false,
                    searchable: false,
                    targets: -1,
                },
            ],

            columns: [
                { data: 'id', name: 'id', render: function( data, type, row ) {
                    // var url = "{ { route('admin.reportings.getTransactions', [':id']) } }";
                    var stUrl = url.replace(':id', data);
                    return '<a href='+stUrl+' style="color:darkorange"><u>'+data+'</u></a>';
                }},
                { data: 'trans_type', name: 'trans_type', class: 'text-center' ,
                    render: function( data, type, row ) {
                        if (data === 'db') {
                            return '<span class="text-danger">' + 'Debit' + '</span>';
                        } else if (data === 'cr') {
                            return '<span class="text-success">' + 'Credit' + '</span>';
                        }
                    }
                },
                { data: 'detail', name: 'detail',  render: function( data, type, row ) {
                    var line = data.split(';');
                    var cellHtml = '';
                    for (var i = 0; i < line.length; i++) {
                        cellHtml += '<div>' + line[i] + '</div>';
                    }
                    return cellHtml;
                }},
                { data: 'total', name: 'total', class: 'text-right', render: function( data, type, row ) {
                    if ((data!='-') ){
                        return '$ ' + data;
                    }

                    else
                    return data;
                },},
                { data: 'from', name: 'from' },
                { data: 'to', name: 'to' },
                { data: 'host', name: 'host' },
                { data: 'created_at', name: 'created_at' },

            ],
            // footerCallback : function ( row, data, start, end, display ) {
            //     var api = this.api(), data;

            //     var intVal = function ( i ) {
            //         return typeof i === 'string' ? i.replace(/[\.,]/g, '')*1 : typeof i === 'number' ? i : 0;
            //     };

            //     // Total over this page
            //     pageTotal1 = api
            //     .column( 3, { page: 'current'} )
            //     .data()
            //     .reduce( function (a, b) {
            //         return intVal(a) + intVal(b);
            //     }, 0 );

            //     // Update footer
            //     $( api.column( 3 ).footer() ).html(
            //         '$ ' + numberWithCommas(pageTotal1)
            //     )


            // },
            orderCellsTop: true,
            order: [[ 0, 'desc' ]],
            pageLength: 10,
        };
        let table = $('.datatable-Transaction').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        myNamespace.filter = function (){
            table.ajax.reload();
        }

    });
</script>

@endsection
