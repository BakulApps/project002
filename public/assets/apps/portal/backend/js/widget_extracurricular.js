var extracurricularjs = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componetnDataTable = function () {
        $('.datatable-extracurricular').DataTable({
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
                {className: 'text-center', targets: 4}
            ],
            ajax: ({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: baseurl + '/widget/ekstrakurikuler',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e){
            e.preventDefault();
            var extracurricular_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/widget/ekstrakurikuler',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'extracurricular',
                    'extracurricular_id': extracurricular_id,
                },
                success : function (resp) {
                    $('#extracurricular_id').val(resp.extracurricular_id);
                    $('#extracurricular_name').val(resp.extracurricular_name);
                    $('#extracurricular_desc').val(resp.extracurricular_desc);
                    $('#extracurricular_link').val(resp.extracurricular_link);
                    $('.title').html('Ubah Ekstrakurikuler');
                    $('#submit').val('update');
                    $('#modal-extracurricular').modal('show');
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var extracurricular_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/widget/ekstrakurikuler',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'extracurricular_id': extracurricular_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-extracurricular').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSubmit = function () {
        $('#submit').click(function () {
            var fd      = new FormData();
            var files   = $('#extracurricular_image')[0].files[0];

            if (files !== undefined){

                fd.append('extracurricular_image', files);
            }
            fd.append('_type', $('#submit').val());
            fd.append('extracurricular_id', $('#extracurricular_id').val());
            fd.append('extracurricular_name', $('#extracurricular_name').val());
            fd.append('extracurricular_desc', $('#extracurricular_desc').val());
            fd.append('extracurricular_link', $('#extracurricular_link').val());
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/widget/ekstrakurikuler',
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
                    $('.datatable-extracurricular').DataTable().ajax.reload();
                    $('#extracurricular_id').val('');
                    $('#extracurricular_name').val('');
                    $('#extracurricular_desc').val('');
                    $('#extracurricular_link').val('');
                    $('#extracurricular_image').val('');
                    $('#submit').val('store');
                    $('#modal-extracurricular').modal('hide');
                }
            });
        });
    }

    var _componentSelect2 = function() {
        $('.dataTables_length  select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });
        $('.select').select2({
            minimumResultsForSearch: Infinity,
        })
    };

    var _componentFileUpload = function () {
        $('.form-control-uniform-custom').uniform({
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas',
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400'
        });
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSubmit();
            _componentSelect2();
            _componentFileUpload();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    extracurricularjs.init();
});
