var subjectjs = function () {
    var _componetnDataTable = function () {
        $('.datatable-subject').DataTable({
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
            ],
            ajax: ({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: adminurl + '/master/pelajaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var subject_id = $(this).data('num');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/master/pelajaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'subject',
                    'subject_id': subject_id,
                },
                success : function (resp) {
                    $('.title-add').html('UBAH DATA');
                    $('#submit').val('update');
                    $('#subject_id').val(resp.subject_id)
                    $('#subject_number').val(resp.subject_number)
                    $('#subject_code').val(resp.subject_code)
                    $('#subject_name').val(resp.subject_name);
                    $('#subject_desc').val(resp.subject_desc);
                    $('#subject_exam').val(resp.subject_exam).trigger('change');
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var subject_id = $(this).data('num');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/master/pelajaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'subject_id': subject_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-subject').DataTable().ajax.reload();
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

    var _componentUniform = function () {
        $('.form-control-uniform-custom').uniform({
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400',
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas terpilih'
        });
    }

    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url : adminurl + '/master/pelajaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'subject_id': $('#subject_id').val(),
                    'subject_number': $('#subject_number').val(),
                    'subject_code': $('#subject_code').val(),
                    'subject_name': $('#subject_name').val(),
                    'subject_desc': $('#subject_desc').val(),
                    'subject_exam': $('#subject_exam').val(),
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.title-add').html('TAMBAH DATA');
                    $('#submit').val('store');
                    $('#subject_id').val('')
                    $('#subject_number').val('')
                    $('#subject_code').val('')
                    $('#subject_name').val('');
                    $('#subject_desc').val('');
                    $('.datatable-subject').DataTable().ajax.reload();
                }
            })
        })
    }

    var _componentUpload = function () {
        $('#data_subject').change(function () {
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
            var files = $('#data_subject')[0].files[0];
            fd.append('_type', 'data');
            fd.append('_data', 'upload');
            fd.append('data_subject', files);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: adminurl + '/master/pelajaran',
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
                    $('.datatable-subject').DataTable().ajax.reload();
                    $('#data_subject').val('')
                },
            });
        })
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSelect();
            _componentUniform();
            _componentSubmit();
            _componentUpload();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    subjectjs.init();
});
