var register = function() {

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
        $('#student_civic').select2({
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
        $('#student_province').select2({
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
            $('#student_distric').select2({
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
                $('#student_subdistric').select2({
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
                    $('#student_village').select2({
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
        $('#auth').click(function (){
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/pendaftaran',
                type: 'post',
                dataType: 'json',
                data: {
                    _type   : 'login',
                    student_nisn: $('#student_nisn_login').val(),
                    student_birthday: $('#student_birthday_login').val(),
                },
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
            })
        });
    }

    return {
        init: function() {
            _componentCalender();
            _componentCheck();
            _componentSelect();
            _componentSubmit()
        }
    }
}();
document.addEventListener('DOMContentLoaded', function() {
    register.init();
});
