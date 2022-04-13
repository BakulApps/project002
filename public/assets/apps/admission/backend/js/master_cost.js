var religionjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('.datatable-cost').DataTable({
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
            ],
            ajax: ({
                headers: csrf_token,
                url: baseurl + '/master/biaya',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type' : 'data',
                    '_data' : 'all'
                }
            })
        }).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            var cost_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/master/biaya',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'cost',
                    'cost_id': cost_id,
                },
                success : function (resp) {
                    $('.title-add').html('UBAH DATA');
                    $('#submit').val('update');
                    $('#cost_id').val(resp.cost_id);
                    $('#cost_program').append($('<option value="'+ resp.program.program_id +'" selected>'+ resp.program.program_name +'</option>'))
                    $('#cost_boarding').val(resp.cost_boarding).change()
                    $('#cost_gender').append($('<option value="'+ resp.gender.gender_id +'" selected>'+ resp.gender.gender_name +'</option>'))
                    $('#cost_amount').val(resp.cost_amount)
                }
            });
        }).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var cost_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/master/biaya',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'delete',
                    'cost_id': cost_id,
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.datatable-cost').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSelect = function (){
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity,
            dropdownAutoWidth: true,
            width: 'auto'
        });

        $('.select').select2({
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
        $('#cost_gender').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'gender'},
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
                url : baseurl + '/master/biaya',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': $('#submit').val(),
                    'cost_id': $('#cost_id').val(),
                    'cost_program': $('#cost_program').val(),
                    'cost_boarding': $('#cost_boarding').val(),
                    'cost_gender': $('#cost_gender').val(),
                    'cost_amount': $('#cost_amount').val(),
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    $('.title-add').html('TAMBAH DATA');
                    $('#submit').val('store');
                    $('#cost_id').val('')
                    $('#cost_program').val('').trigger('change')
                    $('#cost_boarding').val('').trigger('change')
                    $('#cost_gender').val('').trigger('change')
                    $('#cost_amount').val('')
                    $('.datatable-cost').DataTable().ajax.reload();
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
    religionjs.init();
});
