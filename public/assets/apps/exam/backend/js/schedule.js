var schedulejs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};
    var _componetnDataTable = function () {
        $('.datatable-schedule').DataTable({
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
                {className: 'text-center', targets: 1},
                {className: 'text-center', targets: 2},
                {className: 'text-center', targets: 3},
                {className: 'text-center', targets: 4},
                {className: 'text-center', targets: 5},
                {className: 'text-center', targets: 6},
                {className: 'text-center', targets: 7},
            ],
            ajax: ({
                headers: csrf_token,
                url: adminurl + '/jadwal',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var schedule_id = $(this).data('num');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/data/tingkat',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'schedule',
                    'schedule_id': schedule_id,
                },
                success : function (resp) {
                    $('#form-title').html('UBAH TINGKAT');
                    $('#submit').val('update');
                    $('#schedule_id').val(resp.schedule_id);
                    $('#schedule_name').val(resp.schedule_name);
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var schedule_id = $(this).data('num');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/data/tingkat',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'schedule_id': schedule_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-schedule').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/data/tingkat',
                type: 'post',
                dataType: 'json',
                data: {
                    _type: $('#submit').val(),
                    schedule_id: $('#schedule_id').val(),
                    schedule_name: $('#schedule_name').val()
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('#submit').val('store');
                    $('#schedule_name').val('');
                    $('.datatable-schedule').DataTable().ajax.reload();
                }
            })
        })
    }

    var _componentSelect2 = function() {
        $('.dataTables_length  select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
        $('#schedule_subject').select2({
            ajax: {
                headers: csrf_token,
                url: adminurl + '/data/mapel',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'subject'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('#schedule_level').select2({
            ajax: {
                headers: csrf_token,
                url: adminurl + '/data/tingkat',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'level'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
    };

    var _componentCalender = function () {
        $('.daterange').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    }


    return {
        init: function() {
            _componetnDataTable();
            _componentSubmit();
            _componentSelect2();
            _componentCalender();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    schedulejs.init();
});
