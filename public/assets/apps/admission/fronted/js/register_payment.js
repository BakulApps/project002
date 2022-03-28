var religionjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-invoice').DataTable({
            autoWidth: false,
            bLengthChange: true,
            bSort: false,
            scrollX: false,
            dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                emptyTable: 'Tak ada data yang tersedia pada tabel ini',
                loadingRecords: '<i class="icon-spinner4 spinner"></i> Memuat data...',
                info: 'Menampilkan _START_ Sampai _END_ Total _TOTAL_ Entri',
                search: '_INPUT_',
                binfo: false,
                orderable: false,
                searchPlaceholder: 'Pencarian...',
                lengthMenu: '<span>Tampilkan:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') === 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') === 'rtl' ? '&rarr;' : '&larr;' }
            },
            columnDefs : [
                {className: 'text-center', targets: 0},
                {className: 'text-center', 'width': '20%', targets: 1},
                {className: 'text-center', targets: 2},
                {className: 'text-center', targets: 3},
                {className: 'text-center', targets: 4},
                {className: 'text-center', targets: 5},
                {className: 'text-center', targets: 6},
            ],
            ajax: ({
                headers: csrf_token,
                url: baseurl + '/pembayaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var payment_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/pembayaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'edit',
                    'payment_id': payment_id,
                },
                success : function (resp) {
                    if (resp.payment_status === 3 || resp.payment_status === 4){
                        $('#payment_id').val(resp.payment_id).prop('disabled', true)
                        $('#payment_invoice').val(resp.payment_invoice).prop('disabled', true)
                        $('#payment_amount').val(resp.payment_amount).prop('disabled', true)
                        $('#payment_account_type').val(resp.payment_account_type).prop('disabled', true)
                        $('#payment_account_number').val(resp.payment_account_number).prop('disabled', true)
                        $('#payment_account_name').val(resp.payment_account_name).prop('disabled', true)
                        $('#payment_transaction_date').val(resp.payment_transaction_date).prop('disabled', true)

                    }
                    else {
                        $('#payment_id').val(resp.payment_id)
                        $('#payment_invoice').val(resp.payment_invoice)
                        $('#payment_amount').val(resp.payment_amount).prop('disabled', true)
                        $('#payment_account_type').val(resp.payment_account_type).prop('disabled', false)
                        $('#payment_account_number').val(resp.payment_account_number).prop('disabled', false)
                        $('#payment_account_name').val(resp.payment_account_name).prop('disabled', false)
                        $('#payment_transaction_date').val(resp.payment_transaction_date).prop('disabled', false)
                    }
                    $('#submit').val('update');
                    $('#payment-information').hide();
                    $('#payment-account').show();
                    $('#modal-payment').modal('show');
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var payment_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/pembayaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'payment_id': payment_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    if (resp.class === 'success'){
                        $('.datatable-invoice').DataTable().ajax.reload();
                    }
                }
            });
        })
    }
    var _componentDaterange = function () {
        $('.daterange-single').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            locale: {
                format: 'DD/MM/YYYY hh:mm:ss'
            }
        });

        $('.form-control-uniform-custom').uniform({
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas',
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400'
        });
    }
    var _componentSelect = function (){
        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });
        $('#cost_program').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/student',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'program'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
    }
    var _componentSubmit = function () {
        $("#submit").click(function (){
            var fd      = new FormData();
            var files   = $('#payment_transaction_file')[0].files[0];
            if (files !== undefined){
                fd.append('payment_transaction_file', files);
            }
            fd.append('_type', $('#submit').val());
            fd.append('payment_id', $('#payment_id').val());
            fd.append('payment_amount', $('#payment_amount').val())
            fd.append('payment_account_type', $('#payment_account_type').val());
            fd.append('payment_account_number', $('#payment_account_number').val());
            fd.append('payment_account_name', $('#payment_account_name').val());
            fd.append('payment_transaction_date', $('#payment_transaction_date').val());
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/pembayaran',
                type: 'post',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                success: function (resp){
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    if (resp.class === 'success'){
                        $('#payment_amount').val('');
                        $('#payment-information').show();
                        $('#payment-account').hide();
                        $('#modal-payment').modal('hide');
                        $('.datatable-invoice').DataTable().ajax.reload();
                    }
                }
            })
        })
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSelect();
            _componentSubmit();
            _componentDaterange();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    religionjs.init();
});
