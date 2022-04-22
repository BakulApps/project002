var studentjs = function () {
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
            ],
            ajax: ({
                headers: csrf_token,
                url: adminurl + '/siswa',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var student_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : adminurl + '/siswa',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'student',
                    'student_id': student_id,
                },
                success : function (resp) {
                    $('#student_id').val(resp.student_id)
                    $('#student_name').val(resp.student_name)
                    $('#student_nisn').val(resp.student_nisn)
                    $('#student_nism').val(resp.student_nism)
                    $('#student_number_exam').val(resp.student_number_exam)
                    $('#student_class').val(resp.student_class)
                    $('#student_place_birth').val(resp.student_place_birth)
                    $('#student_birthday').val(resp.student_birthday)
                    $('#student_gender').val(resp.student_gender).trigger('change')
                    $('#student_address').val(resp.student_address)
                    $('#student_father').val(resp.student_father)
                    $('#student_mother').val(resp.student_mother)
                    $('#modal-edit').modal('show');
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var student_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url: adminurl + '/siswa',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'student_id': student_id,
                },
                success: function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-' + resp['class'] + ' border-' + resp['class'] + ' alert-styled-left'
                    });
                    $('.datatable-student').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentDateTime = function () {
        $('.daterange-time').daterangepicker({
            timePicker: false,
            singleDatePicker: true,
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-light',
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    }

    var _componentSelect = function () {
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
        $('.select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
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
            fd.append('data_student', files);
            $.ajax({
                headers: csrf_token,
                url: adminurl + '/siswa',
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

    var _componentSubmit = function () {
        $('#submit').click(function () {
            $.ajax({
                headers: csrf_token,
                url: adminurl + '/siswa',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'update',
                    'student_id' : $('#student_id').val(),
                    'student_name' : $('#student_name').val(),
                    'student_nisn' : $('#student_nisn').val(),
                    'student_nism' : $('#student_nism').val(),
                    'student_number_exam' : $('#student_number_exam').val(),
                    'student_class' : $('#student_class').val(),
                    'student_place_birth' : $('#student_place_birth').val(),
                    'student_birthday' : $('#student_birthday').val(),
                    'student_gender' : $('#student_gender').val(),
                    'student_address' : $('#student_address').val(),
                    'student_father' : $('#student_father').val(),
                    'student_mother' : $('#student_mother').val()
                },
                success: function (resp) {
                    $('#modal-edit').modal('hide')
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-' + resp['class'] + ' border-' + resp['class'] + ' alert-styled-left'
                    });
                    $('.datatable-student').DataTable().ajax.reload();
                }
            });
        });
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSelect();
            _componentDateTime();
            _componentUniform();
            _componentUpload();
            _componentSubmit();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    studentjs.init();
});
