var studentalljs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-student').DataTable({
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
                {className: 'text-center', targets: 5},
                {className: 'text-center', targets: 6},
            ],
            ajax: ({
                headers: csrf_token,
                url: adminurl + '/siswa/semua',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var class_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/kelas',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'class',
                    'class_id': class_id,
                },
                success : function (resp) {
                    $('.title-add').html('UBAH DATA');
                    $('#submit').val('update');
                    $('#class_id').val(resp.class_id);
                    $('#class_level').val(resp.class_level).change();
                    $('#class_major').val(resp.class_major).change();
                    $('#class_name').val(resp.class_name);
                    $('#class_alias').val(resp.class_alias);
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var class_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/master/kelas',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'class_id': class_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-class').DataTable().ajax.reload();
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
        $('#class_id').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'class'},
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
                url : adminurl + '/master/kelas',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'class_id': $('#class_id').val(),
                    'class_level': $('#class_level').val(),
                    'class_major': $('#class_major').val(),
                    'class_name': $('#class_name').val(),
                    'class_alias': $('#class_alias').val(),
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.title-add').html('TAMBAH DATA');
                    $('#submit').val('store');
                    $('#class_id').val('')
                    $('#class_level').val('')
                    $('#class_major').val('')
                    $('#class_name').val('');
                    $('#year_desc').val('');
                    $('#class_alias').val('');
                    $('.datatable-class').DataTable().ajax.reload();
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

    var _componentUpload = function () {
        $('#data_student').change(function () {
            $('#modal-upload').modal('hide');
            var notice = new PNotify({
                text: "Mengunggah...",
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
            var fd = new FormData();
            var files = $('#data_student')[0].files[0];
            fd.append('_type', 'data');
            fd.append('_data', 'upload');
            fd.append('class_id', $('#class_id').val());
            fd.append('data_student', files);
            $.ajax({
                headers: csrf_token,
                url: adminurl + '/siswa/semua',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(resp){
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
                    $('data_student').val('');
                    $('.datatable-student').DataTable().ajax.reload();
                },
            });
        })
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSelect();
            _componentSubmit();
            _componentUniform();
            _componentUpload();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    studentalljs.init();
});
