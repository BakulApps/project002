var itemjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-account').DataTable({
            autoWidth: false,
            bLengthChange: true,
            bSort: false,
            scrollX: true,
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
                {className: 'text-center', targets: 1},
                {className: 'text-center', targets: 2},
                {className: 'text-center', targets: 3},
                {className: 'text-center', targets: 4},
                {className: 'text-center', targets: 5}
            ],
            ajax: ({
                headers: csrf_token,
                url: baseurl + '/master/rekening',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var account_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/master/rekening',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'item',
                    'account_id': account_id,
                },
                success : function (resp) {
                    $('.title-add').html('UBAH DATA');
                    $('#submit').val('update');
                    $('#account_id').val(resp.account_id)
                    $('#account_bank').val(resp.account_bank);
                    $('#account_number').val(resp.account_number);
                    $('#account_name').val(resp.account_name);
                    $('#account_active').val(resp.account_active);
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var account_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/master/rekening',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'account_id': account_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-account').DataTable().ajax.reload();
                }
            });
        })
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

        $('#account_bank').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'bank'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
    }

    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/master/rekening',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'account_id': $('#account_id').val(),
                    'account_bank': $('#account_bank').val(),
                    'account_number': $('#account_number').val(),
                    'account_name': $('#account_name').val(),
                    'account_active': $('#account_active').val(),
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.title-add').html('TAMBAH DATA');
                    $('#submit').val('store');
                    $('#account_id').val('')
                    $('#account_bank').val('')
                    $('#account_number').val('')
                    $('#account_name').val('')
                    $('#account_active').val('')
                    $('.datatable-account').DataTable().ajax.reload();
                }
            })
        })
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSelect();
            _componentSubmit();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    itemjs.init();
});
