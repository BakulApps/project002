var paymentjs = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componetnDataTable = function () {
        $('.datatable-payment').DataTable({
            autoWidth: false,
            bLengthChange: true,
            bSort: false,
            scrollX: true,
            dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                binfo: false,
                emptyTable: 'Tak ada data yang tersedia pada tabel ini',
                lengthMenu: '<span>Tampilkan:</span> _MENU_',
                loadingRecords: '<i class="icon-spinner4 spinner"></i> Memuat data...',
                info: 'Menampilkan _START_ Sampai _END_ Total _TOTAL_ Entri',
                orderable: false,
                search: '_INPUT_',
                searchPlaceholder: 'Pencarian...',
                paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') === 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') === 'rtl' ? '&rarr;' : '&larr;' }
            },
            columnDefs : [
                {className: 'text-center', targets: 0},
                {className: 'text-center', targets: 1},
                {className: 'text-center', targets: 2},
                {className: 'text-center', targets: 3},
                {className: 'text-center', targets: 4},
                {className: 'text-center', targets: 5},
                {className: 'text-center', targets: 6}
            ],
            ajax: ({
                headers: csrf_token,
                url: baseurl + '/keuangan/pembayaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-info', function (e) {
            e.preventDefault();
            var payment_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/keuangan/pembayaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'payment',
                    'payment_id': payment_id,
                },
                success: function (resp) {
                    $('#payment_id').val(resp.payment_id)
                    $('#payment_number').html('#' + resp.payment_number)
                    $('#payment_created_at').html(resp.created_at_convert)
                    $('#payment_price').html(resp.payment_cost)
                    $('#modal-invoice').modal('show');
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var payment_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/keuangan/pembayaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'payment_id': payment_id,
                },
                success: function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-payment').DataTable().ajax.reload();
                }
            });
        });
    }

    var _componentSelect = function () {
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });

        $('.select').select2({
            minimumResultsForSearch: Infinity
        });
    }

    var _componentCheckbox = function () {
        var nf = new Intl.NumberFormat();
        function sum(input){
            if (toString.call(input) !== "[object Array]")
                return false;
            var total =  0;
            for(var i=0;i<input.length;i++)
            {
                if(isNaN(input[i])){
                    continue;
                }
                total += Number(input[i]);
            }
            return total;
        }
        $('.checkbox').uniform({wrapperClass: 'border-primary-600 text-primary-800'});

        $('.payment_item').change(function (){
            var cost = $('input[type=checkbox]:checked').map(function(_, el) {
                return $(el).data('info');
            }).get();
            $('#payment_cost').val(nf.format(sum(cost)))
        });
    }

    var _componentSubmit = function () {
        var payment_item;
        $('.payment_item').change(function (){
             payment_item = $('input[type=checkbox]:checked').map(function(_, el) {
                return $(el).val();
            }).get();
        });
        $("#submit").click(function () {
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/keuangan/pembayaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'payment_id': $('#payment_id').val(),
                    'payment_item': payment_item,
                    'payment_cost': $('#payment_cost').val(),
                    'payment_type_account': $('#payment_type_account').val(),
                    'payment_number_account': $('#payment_number_account').val(),
                    'payment_name_account': $('#payment_name_account').val(),
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('#submit').val('store');
                    $('#payment_id').val('')
                    $('#payment_item').val('')
                    $('#payment_cost').val('')
                    $('#payment_type_account').val('');
                    $('#payment_number_account').val('');
                    $('#payment_name_account').val('');
                    $('.datatable-payment').DataTable().ajax.reload();
                    $('#modal-payment').modal('hide');
                }
            })
        })
        $("#update").click(function () {
            var fd = new FormData();
            var payment_file = $('#payment_file')[0].files[0];
            fd.append('_type', 'update');
            fd.append('_data', 'payment');
            fd.append('payment_id', $('#payment_id').val());
            fd.append('payment_date', $('#payment_date').val());
            if (payment_file !== undefined){
                fd.append('payment_file', payment_file);
            }
            else {
                fd.append('payment_file', null);
            }
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/keuangan/pembayaran',
                type: 'post',
                dataType: 'json',
                data: fd,
                contentType: false,
                processData: false,
                success: function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-' + resp['class'] + ' border-' + resp['class'] + ' alert-styled-left'
                    });
                    $('.datatable-payment').DataTable().ajax.reload();
                    $('#modal-invoice').modal('hide')
                }
            })
        })
    }

    var _componentUniform = function () {
        $('.form-control-uniform-custom').uniform({
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400',
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas terpilih'
        });
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSelect();
            _componentCheckbox();
            _componentSubmit();
            _componentUniform();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    paymentjs.init();
});
