var profilejs = function() {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componentSelect = function () {
        $('.select2').select2({
            minimumResultsForSearch: Infinity,
        });
        $('#student_gender').select2({
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
        $('#student_religion').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'religion'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('.select-civic').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'civic'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('#student_hobby').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/student',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'hobby'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('#student_purpose').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/student',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'purpose'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('#student_residence').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/student',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'residence'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('.select-province').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'province'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        }).change(function (){
            var province = $(this).val();
            $('.select-distric').select2({
                ajax: {
                    headers: csrf_token,
                    url: siteurl + '/api/master',
                    dataType: 'json',
                    type: 'post',
                    data: {
                        _type: 'select',
                        _data: 'distric',
                        province: province

                    },
                    processResults: function (data) {
                        return {results: data}
                    },
                    cache: true
                },
                minimumResultsForSearch: Infinity
            }).change(function (){
                var distric = $(this).val();
                $('.select-subdistric').select2({
                    ajax: {
                        headers: csrf_token,
                        url: siteurl + '/api/master',
                        dataType: 'json',
                        type: 'post',
                        data: {
                            _type: 'select',
                            _data: 'subdistric',
                            distric: distric

                        },
                        processResults: function (data) {
                            return {results: data}
                        },
                        cache: true
                    },
                    minimumResultsForSearch: Infinity
                }).change(function (){
                    var subdistric = $(this).val();
                    $('.select-village').select2({
                        ajax: {
                            headers: csrf_token,
                            url: siteurl + '/api/master',
                            dataType: 'json',
                            type: 'post',
                            data: {
                                _type: 'select',
                                _data: 'village',
                                subdistric: subdistric

                            },
                            processResults: function (data) {
                                return {results: data}
                            },
                            cache: true
                        },
                        minimumResultsForSearch: Infinity
                    })
                })
            })
        });
        $('#student_distance').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'distance'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('#student_transport').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'transport'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('#student_travel').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'travel'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('#student_program').select2({
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
        $('.select-parent-status').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/student',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'parent_status'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('.select-parent-study').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'study'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('.select-parent-job').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'job'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('.select-parent-earning').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'earning'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('#student_home_owner').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'home'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
    };

    var _componentCheck = function () {
        $('.form-check-input-styled').uniform({
            wrapperClass: 'border-info-600 text-info-800'
        });

        $('.form-check-input-styled-success').uniform({
            wrapperClass: 'border-success-600 text-success-800'
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

    var _componentSubmit = function (){
        $('#submit').click(function (){
            var fd = new FormData();
            fd.append('_type', 'store');
            fd.append('student_name', $('#student_name').val());
            fd.append('student_nisn', $('#student_nisn').val());
            fd.append('student_nik', $('#student_nik').val());
            fd.append('student_birthplace', $('#student_birthplace').val());
            fd.append('student_birthday', $('#student_birthday').val());
            fd.append('student_gender', $('#student_gender').val());
            fd.append('student_religion', $('#student_religion').val());
            fd.append('student_siblingplace', $('#student_siblingplace').val());
            fd.append('student_sibling', $('#student_sibling').val());
            fd.append('student_civic', $('#student_civic').val());
            fd.append('student_hobby', $('#student_hobby').val());
            fd.append('student_purpose', $('#student_purpose').val());
            if ($('#student_im_hepatitis').is(':checked')){fd.append('student_im_hepatitis', 1)}
            if ($('#student_im_polio').is(':checked')){fd.append('student_im_polio', 1)}
            if ($('#student_im_bcg').is(':checked')){fd.append('student_im_bcg', 1)}
            if ($('#student_im_campak').is(':checked')){fd.append('student_im_campak', 1)}
            if ($('#student_im_dpt').is(':checked')){fd.append('student_im_dpt', 1)}
            fd.append('student_residence', $('#student_residence').val());
            fd.append('student_address', $('#student_address').val());
            fd.append('student_province', $('#student_province').val());
            fd.append('student_distric', $('#student_distric').val());
            fd.append('student_subdistric', $('#student_subdistric').val());
            fd.append('student_village', $('#student_village').val());
            fd.append('student_postal', $('#student_postal').val());
            fd.append('student_distance', $('#student_distance').val());
            fd.append('student_transport', $('#student_transport').val());
            fd.append('student_travel', $('#student_travel').val());
            fd.append('student_program', $('#student_program').val());
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/pendaftaran',
                type: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: fd,
                success: function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-' + resp['class'] + ' border-' + resp['class'] + ' alert-styled-left'
                    });
                    if (resp['class'] === 'success'){
                        setInterval(function (){
                            window.location.href = baseurl + '/pendaftaran'
                        }, 2000)
                    }
                }
            });
        });
        $('#parent').click(function (){
            var fd = new FormData();
            fd.append('_type', 'update');
            fd.append('_data', 'parent');
            fd.append('student_id', $('#student_id').val());
            fd.append('student_kk_no', $('#student_kk_no').val())
            fd.append('student_head_family', $('#student_head_family').val())
            fd.append('student_father_name', $('#student_father_name').val())
            fd.append('student_mother_name', $('#student_mother_name').val())
            fd.append('student_father_status', $('#student_father_status').val())
            fd.append('student_mother_status', $('#student_mother_status').val())
            fd.append('student_father_civic', $('#student_father_civic').val())
            fd.append('student_mother_civic', $('#student_mother_civic').val())
            fd.append('student_father_nik', $('#student_father_nik').val())
            fd.append('student_mother_nik', $('#student_mother_nik').val())
            fd.append('student_father_birthplace', $('#student_father_birthplace').val())
            fd.append('student_mother_birthplace', $('#student_mother_birthplace').val())
            fd.append('student_father_birthday', $('#student_father_birthday').val())
            fd.append('student_mother_birthday', $('#student_mother_birthday').val())
            fd.append('student_father_study', $('#student_father_study').val())
            fd.append('student_mother_study', $('#student_mother_study').val())
            fd.append('student_father_job', $('#student_father_job').val())
            fd.append('student_mother_job', $('#student_mother_job').val())
            fd.append('student_father_earning', $('#student_father_earning').val())
            fd.append('student_mother_earning', $('#student_mother_earning').val())
            fd.append('student_father_phone', $('#student_father_phone').val())
            fd.append('student_mother_phone', $('#student_mother_phone').val())
            fd.append('student_home_owner', $('#student_home_owner').val())
            fd.append('student_home_address', $('#student_home_address').val())
            fd.append('student_home_postal', $('#student_home_postal').val())
            fd.append('student_home_province', $('#student_home_province').val())
            fd.append('student_home_distric', $('#student_home_distric').val())
            fd.append('student_home_subdistric', $('#student_home_subdistric').val())
            fd.append('student_home_village', $('#student_home_village').val())
            fd.append('student_regent_name', $('#student_regent_name').val())
            fd.append('student_regent_status', $('#student_regent_status').val())
            fd.append('student_regent_civic', $('#student_regent_civic').val())
            fd.append('student_regent_nik', $('#student_regent_nik').val())
            fd.append('student_regent_birthplace', $('#student_regent_birthplace').val())
            fd.append('student_regent_birthday', $('#student_regent_birthday').val())
            fd.append('student_regent_study', $('#student_regent_study').val())
            fd.append('student_regent_job', $('#student_regent_job').val())
            fd.append('student_regent_earning', $('#student_regent_earning').val())
            fd.append('student_regent_phone', $('#student_regent_phone').val())
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/profil',
                type: 'post',
                dataType: 'json',
                contentType: false,
                processData: false,
                data: fd,
                success: function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-' + resp['class'] + ' border-' + resp['class'] + ' alert-styled-left'
                    });
                }
            });
        })
    }

    var _componentChange = function (){
        $('#student_residence').change(function (){
            if ($(this).val() === '1'){
                var province = $('#student_home_province');
                var distric = $('#student_home_distric');
                var subdistric = $('#student_home_subdistric');
                var village = $('#student_home_village');
                $('#student_province').prop('disabled', true).append('<option value="'+ province.val() +'" selected>'+ province.text() +'</option>');
                $('#student_distric').prop('disabled', true).append('<option value="'+ distric.val() +'" selected>'+ distric.text() +'</option>');
                $('#student_subdistric').prop('disabled', true).append('<option value="'+ subdistric.val() +'" selected>'+ subdistric.text() +'</option>')
                $('#student_village').prop('disabled', true).append('<option value="'+ village.val() +'" selected>'+ village.text() +'</option>')
                $('#student_address').prop('disabled', true).val($('#student_home_address').val())
                $('#student_postal').prop('disabled', true).val($('#student_home_postal'))
            }
            else {
                $('#student_province').prop('disabled', false);
                $('#student_distric').prop('disabled', false);
                $('#student_subdistric').prop('disabled', false);
                $('#student_village').prop('disabled', false);
                $('#student_address').prop('disabled', false);
                $('#student_postal').prop('disabled', false);
            }
        })

        $('#student_father_status').change(function (){
            if ($(this).val() === '1'){
                $('#student_father_civic').prop('disabled', false);
                $('#student_father_nik').prop('disabled', false);
                $('#student_father_birthplace').prop('disabled', false);
                $('#student_father_birthday').prop('disabled', false);
                $('#student_father_study').prop('disabled', false);
                $('#student_father_job').prop('disabled', false);
                $('#student_father_earning').prop('disabled', false);
                $('#student_father_phone').prop('disabled', false);
            }
            else {
                $('#student_father_civic').prop('disabled', true);
                $('#student_father_nik').prop('disabled', true);
                $('#student_father_birthplace').prop('disabled', true);
                $('#student_father_birthday').prop('disabled', true);
                $('#student_father_study').prop('disabled', true);
                $('#student_father_job').prop('disabled', true);
                $('#student_father_earning').prop('disabled', true);
                $('#student_father_phone').prop('disabled', true);
            }
        });

        $('#student_mother_status').change(function (){
            if ($(this).val() === '1'){
                $('#student_mother_civic').prop('disabled', false);
                $('#student_mother_nik').prop('disabled', false);
                $('#student_mother_birthplace').prop('disabled', false);
                $('#student_mother_birthday').prop('disabled', false);
                $('#student_mother_study').prop('disabled', false);
                $('#student_mother_job').prop('disabled', false);
                $('#student_mother_earning').prop('disabled', false);
                $('#student_mother_phone').prop('disabled', false);
            }
            else {
                $('#student_mother_civic').prop('disabled', true);
                $('#student_mother_nik').prop('disabled', true);
                $('#student_mother_birthplace').prop('disabled', true);
                $('#student_mother_birthday').prop('disabled', true);
                $('#student_mother_study').prop('disabled', true);
                $('#student_mother_job').prop('disabled', true);
                $('#student_mother_earning').prop('disabled', true);
                $('#student_mother_phone').prop('disabled', true);
            }
        });

        $(':radio').change(function (){
            var status = '';
            var civic = '';
            var study = '';
            var job = '';
            var earning = '';
            var regent_name = $('#student_regent_name');
            var regent_status = $('#student_regent_status');
            var regent_civic = $('#student_regent_civic');
            var regent_nik = $('#student_regent_nik');
            var regent_birthplace = $('#student_regent_birthplace');
            var regent_birthday = $('#student_regent_birthday');
            var regent_study = $('#student_regent_study');
            var regent_job = $('#student_regent_job');
            var regent_earning = $('#student_regent_earning');
            var regent_phone = $('#student_regent_phone');
            if ($(this).val() === '1') {
                status = $('#student_father_status');
                civic = $('#student_father_civic');
                study = $('#student_father_study');
                job = $('#student_father_job');
                earning = $('#student_father_earning');
                regent_name.val($('#student_father_name').val()).prop('disabled', true);
                regent_status.prop('disabled',  true).append('<option value="'+ status.val() +'" selected>'+ status.text() +'</option>')
                regent_civic.prop('disabled',  true).append('<option value="'+ civic.val() +'" selected>'+ civic.text() +'</option>')
                regent_nik.val($('#student_father_nik').val()).prop('disabled', true);
                regent_birthplace.val($('#student_father_birthplace').val()).prop('disabled', true);
                regent_birthday.val($('#student_father_birthday').val()).prop('disabled', true);
                regent_study.prop('disabled',  true).append('<option value="'+ study.val() +'" selected>'+ study.text() +'</option>')
                regent_job.prop('disabled',  true).append('<option value="'+ job.val() +'" selected>'+ job.text() +'</option>')
                regent_earning.prop('disabled',  true).append('<option value="'+ earning.val() +'" selected>'+ earning.text() +'</option>')
                regent_phone.val($('#student_father_phone').val()).prop('disabled', true);
            }
            else if ($(this).val() === '2') {
                status = $('#student_mother_status');
                civic = $('#student_mother_civic');
                study = $('#student_mother_study');
                job = $('#student_mother_job');
                earning = $('#student_mother_earning');
                regent_name.val($('#student_father_name').val()).prop('disabled', true);
                regent_status.prop('disabled',  true).append('<option value="'+ status.val() +'" selected>'+ status.text() +'</option>')
                regent_civic.prop('disabled',  true).append('<option value="'+ civic.val() +'" selected>'+ civic.text() +'</option>')
                regent_nik.val($('#student_father_nik').val()).prop('disabled', true);
                regent_birthplace.val($('#student_father_birthplace').val()).prop('disabled', true);
                regent_birthday.val($('#student_father_birthday').val()).prop('disabled', true);
                regent_study.prop('disabled',  true).append('<option value="'+ study.val() +'" selected>'+ study.text() +'</option>')
                regent_job.prop('disabled',  true).append('<option value="'+ job.val() +'" selected>'+ job.text() +'</option>')
                regent_earning.prop('disabled',  true).append('<option value="'+ earning.val() +'" selected>'+ earning.text() +'</option>')
                regent_phone.val($('#student_father_phone').val()).prop('disabled', true);
            }
            else if ($(this).val() === '3'){
                regent_name.val('').prop('disabled', false);
                regent_status.prop('disabled', false);
                regent_civic.prop('disabled', false);
                regent_nik.val('').prop('disabled', false);
                regent_birthplace.val('').prop('disabled', false);
                regent_birthday.val('').prop('disabled', false);
                regent_study.prop('disabled', false);
                regent_job.prop('disabled', false);
                regent_earning.prop('disabled', false);
                regent_phone.val('').prop('disabled', false);
            }

        })
    }

    return {
        init: function() {
            _componentCalender();
            _componentCheck();
            _componentSelect();
            _componentSubmit()
            _componentChange();
        }
    }
}();
document.addEventListener('DOMContentLoaded', function() {
    profilejs.init();
});
