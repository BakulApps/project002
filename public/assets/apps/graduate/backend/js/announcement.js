var notifyjs = function () {
    var _componetnDataTable = function () {
        $('.datatable-notify').DataTable({
            autoWidth: false,
            bLengthChange: true,
            bSort: false,
            scrollX: true,
            dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                emptyTable: 'Tak ada data yang tersedia pada tabel ini',
                loadingRecords: '<i class="icon-spinner4 spinner"></i> Memuat data...',
                info: 'Menampilkan _START_ - _END_ Total _TOTAL_ entri',
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
                {className: 'text-center', targets: 8},
                {className: 'text-center', targets: 9}
            ],
            ajax: ({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: adminurl + '/pengumuman',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var announcement_id = $(this).data('num');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/pengumuman',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'announcement',
                    'announcement_id': announcement_id,
                },
                success : function (resp) {
                    $('#announcement_id').val(resp.announcement.announcement_id);
                    $('#announcement_name').val(resp.student.student_name);
                    $('#announcement_nism').val(resp.student.student_nism);
                    $('#announcement_nisn').val(resp.student.student_nisn);
                    $('#submit').val('update');
                    $('#modal-edit').modal('show');
                }
            });
        }).on('click', '.btn-view', function (e) {
            e.preventDefault();
            var announcement_id = $(this).data('num');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/pengumuman',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'announcement',
                    'announcement_id': announcement_id,
                },
                success : function (resp) {
                    $('#student_name').val(resp.student.student_name)
                    $('#student_nism').val(resp.student.student_nism)
                    $('#student_nisn').val(resp.student.student_nisn)
                    var values = JSON.parse(resp.announcement.announcement_value_know)
                    values.unshift('first');
                    $.each(values, function (id, value) {
                        $('#value' + id).html(value);
                    })
                    $('#modal-show').modal('show');
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
            minimumResultsForSearch: Infinity,
        });
    }

    var _componentSubmit = function () {
        $('#submit').click(function () {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: adminurl + '/pengumuman',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'update',
                    'announcement_id' : $('#announcement_id').val(),
                    'announcement_status' : $('#announcement_status').val(),
                    'announcement_finance' : $('#announcement_finance').val()
                },
                success: function (resp) {
                    $('#modal-edit').modal('hide')
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-' + resp['class'] + ' border-' + resp['class'] + ' alert-styled-left'
                    });
                    $('.datatable-notify').DataTable().ajax.reload();
                }
            });
        });
    }

    var _componentSync = function () {
        $('#btn-sync').click(function () {
            var notice = new PNotify({
                text: "Membuat Nilai Kelulusan...",
                addclass: 'bg-primary border-primary',
                type: 'info',
                icon: 'icon-spinner4 spinner',
                hide: false,
                buttons: {
                    closer: false,
                    sticker: false
                },
                opacity: .9,
                width: "200px"
            });
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: adminurl + '/pengumuman',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'store',
                },
                success: function (resp) {
                    var options = {
                        title: resp.title,
                        addclass: 'alert bg-'+resp.class+' border-'+resp.class+' alert-styled-left',
                        type: resp.class,
                        icon: false,
                        hide: true,
                        text: resp.text,
                        buttons: {closer: true, sticker: true},
                        opacity: 1,
                        width: PNotify.prototype.options.width,
                    };
                    notice.update(options);
                    $('.datatable-notify').DataTable().ajax.reload();
                }
            });
        });
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSelect();
            _componentSubmit();
            _componentSync();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    notifyjs.init();
});
