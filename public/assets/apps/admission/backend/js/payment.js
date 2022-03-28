var paymentjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    var _componetnDataTable = function () {
        $('#payment_status').change(function (){
            $('.datatable-payment').DataTable().ajax.reload();
        })
        $('.datatable-payment').DataTable({
            autoWidth: false,
            bLengthChange: true,
            bSort: true,
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
            ],
            bprocessing: true,
            bserverSide: true,
            ajax: ({
                headers: csrf_token,
                url: baseurl + '/pembayaran',
                type: 'post',
                dataType: 'json',
                data: function (d){
                    d._type = 'data';
                    d._data = 'all';
                    d.payment_status = $('#payment_status').val()
                }
            })
        }).on('click', '.btn-view', function (e) {
            e.preventDefault();
            var student_id = $(this).data('num');
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/siswa',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'data',
                    '_data': 'student',
                    'student_id': student_id,
                },
                success : function (resp) {
                    $('#student_name').val(resp.student_name).prop('disabled', true)
                    $('#student_nisn').val(resp.student_nisn).prop('disabled', true)
                    $('#student_nik').val(resp.student_nik).prop('disabled', true)
                    $('#student_birthplace').val(resp.student_birthplace).prop('disabled', true)
                    $('#student_birthday').val(resp.student_birthday).prop('disabled', true)
                    $('#student_gender').append('<option value="'+ resp.student_gender.id +'" selected>'+ resp.student_gender.text +'</option>').prop('disabled', true);
                    $('#student_religion').append('<option value="'+ resp.student_religion.id +'" selected>'+ resp.student_religion.text +'</option>').prop('disabled', true);
                    $('#student_siblingplace').val(resp.student_siblingplace).prop('disabled', true)
                    $('#student_sibling').val(resp.student_sibling).prop('disabled', true)
                    $('#student_civic').append('<option value="'+ resp.student_civic.id +'" selected>'+ resp.student_civic.text +'</option>').prop('disabled', true);
                    $('#student_hobby').append('<option value="'+ resp.student_hobby.id +'" selected>'+ resp.student_hobby.text +'</option>').prop('disabled', true);
                    $('#student_purpose').append('<option value="'+ resp.student_purpose.id +'" selected>'+ resp.student_purpose.text +'</option>').prop('disabled', true);
                    $('#student_email').val(resp.student_email).prop('disabled', true)
                    $('#student_phone').val(resp.student_phone).prop('disabled', true)
                    if (resp.student_im_hepatitis === 1){$('#student_im_hepatitis').prop('checked', true); $.uniform.update('#student_im_hepatitis')}
                    if (resp.student_im_polio === 1){$('#student_im_polio').prop('checked', true); $.uniform.update('#student_im_polio')}
                    if (resp.student_im_bcg === 1){$('#student_im_bcg').prop('checked', true); $.uniform.update('#student_im_bcg')}
                    if (resp.student_im_campak === 1){$('#student_im_campak').prop('checked', true); $.uniform.update('#student_im_campak')}
                    if (resp.student_im_dpt === 1){$('#student_im_dpt').prop('checked', true); $.uniform.update('#student_im_dpt')}
                    if (resp.student_im_covid === 1){$('#student_im_covid').prop('checked', true); $.uniform.update('#student_im_covid')}
                    $('#student_residence').append('<option value="'+ resp.student_residence.id +'" selected>'+ resp.student_residence.text +'</option>').prop('disabled', true);
                    $('#student_address').val(resp.student_address).prop('disabled', true)
                    $('#student_province').append('<option value="'+ resp.student_province.id +'" selected>'+ resp.student_province.text +'</option>').prop('disabled', true);
                    $('#student_distric').append('<option value="'+ resp.student_distric.id +'" selected>'+ resp.student_distric.text +'</option>').prop('disabled', true);
                    $('#student_subdistric').append('<option value="'+ resp.student_subdistric.id +'" selected>'+ resp.student_distric.text +'</option>').prop('disabled', true);
                    $('#student_village').append('<option value="'+ resp.student_village.id +'" selected>'+ resp.student_distric.text +'</option>').prop('disabled', true);
                    $('#student_postal').val(resp.student_postal).prop('disabled', true)
                    $('#student_distance').append('<option value="'+ resp.student_distance.id +'" selected>'+ resp.student_distance.text +'</option>').prop('disabled', true);
                    $('#student_transport').append('<option value="'+ resp.student_transport.id +'" selected>'+ resp.student_transport.text +'</option>').prop('disabled', true);
                    $('#student_travel').append('<option value="'+ resp.student_travel.id +'" selected>'+ resp.student_travel.text +'</option>').prop('disabled', true);
                    $('#student_program').append('<option value="'+ resp.student_program.id +'" selected>'+ resp.student_program.text +'</option>').prop('disabled', true);
                    $('#student_boarding').val(resp.student_boarding).change().prop('disabled', true)
                    $('#student_no_kk').val(resp.student_no_kk).prop('disabled', true)
                    $('#student_head_family').val(resp.student_head_family).prop('disabled', true)
                    $('#student_father_name').val(resp.student_father_name).prop('disabled', true)
                    $('#student_mother_name').val(resp.student_father_name).prop('disabled', true)
                    $('#student_father_status').append('<option value="'+ resp.student_father_status.id +'" selected>'+ resp.student_father_status.text +'</option>').prop('disabled', true);
                    $('#student_mother_status').append('<option value="'+ resp.student_mother_status.id +'" selected>'+ resp.student_mother_status.text +'</option>').prop('disabled', true);
                    $('#student_father_birthplace').val(resp.student_father_birthplace).prop('disabled', true)
                    $('#student_mother_birthplace').val(resp.student_mother_birthplace).prop('disabled', true)
                    $('#student_father_birthday').val(resp.student_father_birthday).prop('disabled', true)
                    $('#student_mother_birthday').val(resp.student_mother_birthday).prop('disabled', true)
                    $('#student_father_nik').val(resp.student_father_nik).prop('disabled', true)
                    $('#student_mother_nik').val(resp.student_mother_nik).prop('disabled', true)
                    $('#student_father_study').append('<option value="'+ resp.student_father_study.id +'" selected>'+ resp.student_father_study.text +'</option>').prop('disabled', true);
                    $('#student_mother_study').append('<option value="'+ resp.student_mother_study.id +'" selected>'+ resp.student_mother_study.text +'</option>').prop('disabled', true);
                    $('#student_father_job').append('<option value="'+ resp.student_father_job.id +'" selected>'+ resp.student_father_job.text +'</option>').prop('disabled', true);
                    $('#student_mother_job').append('<option value="'+ resp.student_mother_job.id +'" selected>'+ resp.student_mother_job.text +'</option>').prop('disabled', true);
                    $('#student_father_earning').append('<option value="'+ resp.student_father_earning.id +'" selected>'+ resp.student_father_earning.text +'</option>').prop('disabled', true);
                    $('#student_mother_earning').append('<option value="'+ resp.student_mother_earning.id +'" selected>'+ resp.student_mother_earning.text +'</option>').prop('disabled', true);
                    $('#student_father_phone').val(resp.student_father_phone).prop('disabled', true)
                    $('#student_mother_phone').val(resp.student_mother_phone).prop('disabled', true)
                    $('#student_guard_name').val(resp.student_guard_name).prop('disabled', true)
                    $('#student_guard_nik').val(resp.student_guard_nik).prop('disabled', true)
                    $('#student_guard_birthplace').val(resp.student_guard_birthplace).prop('disabled', true)
                    $('#student_guard_birthday').val(resp.student_guard_birthday).prop('disabled', true)
                    $('#student_guard_study').append('<option value="'+ resp.student_guard_study.id +'" selected>'+ resp.student_guard_study.text +'</option>').prop('disabled', true);
                    $('#student_guard_job').append('<option value="'+ resp.student_guard_job.id +'" selected>'+ resp.student_guard_job.text +'</option>').prop('disabled', true);
                    $('#student_guard_earning').append('<option value="'+ resp.student_guard_earning.id +'" selected>'+ resp.student_guard_earning.text +'</option>').prop('disabled', true);
                    $('#student_guard_phone').val(resp.student_guard_phone).prop('disabled', true)

                    $('#modal-student').modal('show')
                }
            });
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
                    '_data': 'payment',
                    'payment_id': payment_id,
                },
                success : function (resp) {
                    $('#payment_id').val(resp.payment_id)
                    $('#payment_invoice').val(resp.payment_invoice)
                    $('#payment_amount').val(resp.payment_amount)
                    $('#payment_account_type').val(resp.payment_account_type)
                    $('#payment_account_number').val(resp.payment_account_number)
                    $('#payment_account_name').val(resp.payment_account_name)
                    $('#payment_transaction_date').val(resp.payment_transaction_date)
                    $('#payment_transaction_file').attr('href', resp.payment_transaction_file)
                   $('#modal-payment').modal('show')
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
                    $('.datatable-payment').DataTable().ajax.reload();
                }
            });
        })
    }

    var _componentSelect = function (){
        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });
    }

    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/pembayaran',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'update',
                    '_data': 'payment',
                    'payment_id' : $('#payment_id').val(),
                    'payment_status': $('#submit').val()
                },
                success : function (resp) {
                    if (resp.class === 'danger'){
                        new PNotify({
                            title: resp['title'],
                            text: resp['text'],
                            addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                        });
                    }
                    else {
                        new PNotify({
                            title: resp['title'],
                            text: resp['text'],
                            addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                        });
                        $('#payment_id').val('')
                        $('#payment_invoice').val('')
                        $('#payment_amount').val('')
                        $('#payment_account_type').val('')
                        $('#payment_account_number').val('')
                        $('#payment_account_name').val('')
                        $('#payment_transaction_date').val('')
                        $('#payment_transaction_file').attr('href', '')
                        $('#modal-payment').modal('hide')
                        $('.datatable-payment').DataTable().ajax.reload();
                    }
                }
            })
        })
    }

    var _componenCheck = function (){
        $('.form-check-input-styled').uniform({
            wrapperClass: 'border-info-600 text-info-800'
        });
    }

    return {
        init: function() {
            _componetnDataTable();
            _componentSelect();
            _componentSubmit();
            _componenCheck();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    paymentjs.init();
});
