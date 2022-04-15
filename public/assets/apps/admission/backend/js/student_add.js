var student_addjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

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
        $('#student_father_status').select2({
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
        $('#student_mother_status').select2({
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
        $('#student_father_study').select2({
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
        $('#student_mother_study').select2({
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
        $('#student_guard_study').select2({
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
        $('#student_father_job').select2({
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
        $('#student_mother_job').select2({
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
        $('#student_guard_job').select2({
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
        $('#student_father_earning').select2({
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
        $('#student_mother_earning').select2({
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
        $('#student_guard_earning').select2({
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
        $('#student_home_province').select2({
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
            $('#student_home_distric').select2({
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
                $('#student_home_subdistric').select2({
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
                    $('#student_home_village').select2({
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
        $('#student_school_from ').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/student',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'school_from', _ladder: 'MI'},
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
        $('.form-control-uniform-custom').uniform({
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas',
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400'
        });
    };

    var _componentData = function () {
        $('.daterange').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });

        $('#student_program').on('change', function (){
            var program_id = $(this).val();
            if (program_id === '1' || program_id === '2'){
                $('#student_boarding').val(1).change().prop('disabled', true);
            }
            else if (program_id === '4'){
                $('#student_boarding').val(2).change().prop('disabled', true);
            }
            else {
                $('#student_boarding').val(1).change().prop('disabled', false);
            }
        });

        $('#student_father_status').on('change', function (){
            var status = $(this).val();
            if (status === '1'){
                $('#student_father_birthplace').prop('disabled', false)
                $('#student_father_birthday').prop('disabled', false)
                $('#student_father_nik').prop('disabled', false)
                $('#student_father_study').prop('disabled', false)
                $('#student_father_job').prop('disabled', false)
                $('#student_father_earning').prop('disabled', false)
                $('#student_father_phone').prop('disabled', false)
            }
            else {
                $('#student_father_birthplace').prop('disabled', true)
                $('#student_father_birthday').prop('disabled', true)
                $('#student_father_nik').prop('disabled', true)
                $('#student_father_study').prop('disabled', true)
                $('#student_father_job').prop('disabled', true)
                $('#student_father_earning').prop('disabled', true)
                $('#student_father_phone').prop('disabled', true)
            }
        });

        $('#student_mother_status').on('change', function (){
            var status = $(this).val();
            if (status === '1'){
                $('#student_mother_birthplace').prop('disabled', false)
                $('#student_mother_birthday').prop('disabled', false)
                $('#student_mother_nik').prop('disabled', false)
                $('#student_mother_study').prop('disabled', false)
                $('#student_mother_job').prop('disabled', false)
                $('#student_mother_earning').prop('disabled', false)
                $('#student_mother_phone').prop('disabled', false)
            }
            else {
                $('#student_mother_birthplace').prop('disabled', true)
                $('#student_mother_birthday').prop('disabled', true)
                $('#student_mother_nik').prop('disabled', true)
                $('#student_mother_study').prop('disabled', true)
                $('#student_mother_job').prop('disabled', true)
                $('#student_mother_earning').prop('disabled', true)
                $('#student_mother_phone').prop('disabled', true)
            }
        });

        $('#student_guard_status').on('change', function (){
            var status = $(this).val();
            if (status === '1'){
                var father_study = $('#student_father_study option:selected');
                var father_job = $('#student_father_job option:selected');
                var father_earning = $('#student_father_earning option:selected');
                $('#student_guard_name').val($('#student_father_name').val()).prop('disabled', true);
                $('#student_guard_birthplace').val($('#student_father_birthplace').val()).prop('disabled', true);
                $('#student_guard_birthday').val($('#student_father_birthday').val()).prop('disabled', true);
                $('#student_guard_nik').val($('#student_father_nik').val()).prop('disabled', true);
                $('#student_guard_study').append('<option value="'+ father_study.val() +'" selected>'+ father_study.text() +'</option>').prop('disabled', true);
                $('#student_guard_job').append('<option value="'+ father_job.val() +'" selected>'+ father_job.text() +'</option>').prop('disabled', true);
                $('#student_guard_earning').append('<option value="'+ father_earning.val() +'" selected>'+ father_earning.text() +'</option>').prop('disabled', true);
                $('#student_guard_phone').val($('#student_father_phone').val()).prop('disabled', true);
            }
            else if (status === '2'){
                var mother_study = $('#student_mother_study option:selected');
                var mother_job = $('#student_mother_job option:selected');
                var mother_earning = $('#student_mother_earning option:selected');
                $('#student_guard_name').val($('#student_mother_name').val()).prop('disabled', true);
                $('#student_guard_birthplace').val($('#student_mother_birthplace').val()).prop('disabled', true);
                $('#student_guard_birthday').val($('#student_mother_birthday').val()).prop('disabled', true);
                $('#student_guard_nik').val($('#student_mother_nik').val()).prop('disabled', true);
                $('#student_guard_study').append('<option value="'+ mother_study.val() +'" selected>'+ mother_study.text() +'</option>').prop('disabled', true);
                $('#student_guard_job').append('<option value="'+ mother_job.val() +'" selected>'+ mother_job.text() +'</option>').prop('disabled', true);
                $('#student_guard_earning').append('<option value="'+ mother_earning.val() +'" selected>'+ mother_earning.text() +'</option>').prop('disabled', true);
                $('#student_guard_phone').val($('#student_mother_phone').val()).prop('disabled', true);
            }
            else {
                $('#student_guard_name').val('').prop('disabled', false);
                $('#student_guard_birthplace').val('').prop('disabled', false);
                $('#student_guard_birthday').val('').prop('disabled', false);
                $('#student_guard_nik').val('').prop('disabled', false);
                $('#student_guard_study').val('').prop('disabled', false);
                $('#student_guard_job').val('').prop('disabled', false);
                $('#student_guard_earning').val('').prop('disabled', false);
                $('#student_guard_phone').val('').prop('disabled', false);
            }
        })
    }

    var _componentSubmit = function (){
        $('#store').click(function (){
            var fd = new FormData();
            fd.append('_type', 'store');
            fd.append('student_id', $('#student_id').val())
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
            fd.append('student_email', $('#student_email').val());
            fd.append('student_phone', $('#student_phone').val());
            if ($('#student_im_hepatitis').is(':checked')){fd.append('student_im_hepatitis', 1)}
            if ($('#student_im_polio').is(':checked')){fd.append('student_im_polio', 1)}
            if ($('#student_im_bcg').is(':checked')){fd.append('student_im_bcg', 1)}
            if ($('#student_im_campak').is(':checked')){fd.append('student_im_campak', 1)}
            if ($('#student_im_dpt').is(':checked')){fd.append('student_im_dpt', 1)}
            if ($('#student_im_covid').is(':checked')){fd.append('student_im_covid', 1)}
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
            fd.append('student_boarding', $('#student_boarding').val());
            fd.append('student_no_kk', $('#student_no_kk').val())
            fd.append('student_head_family', $('#student_head_family').val())
            fd.append('student_father_name', $('#student_father_name').val())
            fd.append('student_mother_name', $('#student_mother_name').val())
            fd.append('student_guard_name', $('#student_guard_name').val())
            fd.append('student_father_birthplace', $('#student_father_birthplace').val())
            fd.append('student_mother_birthplace', $('#student_mother_birthplace').val())
            fd.append('student_guard_birthplace', $('#student_guard_birthplace').val())
            fd.append('student_father_birthday', $('#student_father_birthday').val())
            fd.append('student_mother_birthday', $('#student_mother_birthday').val())
            fd.append('student_guard_birthday', $('#student_guard_birthday').val())
            fd.append('student_father_status', $('#student_father_status').val())
            fd.append('student_mother_status', $('#student_mother_status').val())
            fd.append('student_father_nik', $('#student_father_nik').val())
            fd.append('student_mother_nik', $('#student_mother_nik').val())
            fd.append('student_guard_nik', $('#student_guard_nik').val())
            fd.append('student_father_study', $('#student_father_study').val())
            fd.append('student_mother_study', $('#student_mother_study').val())
            fd.append('student_guard_study', $('#student_guard_study').val())
            fd.append('student_father_job', $('#student_father_job').val())
            fd.append('student_mother_job', $('#student_mother_job').val())
            fd.append('student_guard_job', $('#student_guard_job').val())
            fd.append('student_father_earning', $('#student_father_earning').val())
            fd.append('student_mother_earning', $('#student_mother_earning').val())
            fd.append('student_guard_earning', $('#student_guard_earning').val())
            fd.append('student_father_phone', $('#student_father_phone').val())
            fd.append('student_mother_phone', $('#student_mother_phone').val())
            fd.append('student_guard_phone', $('#student_guard_phone').val())
            fd.append('student_home_owner', $('#student_home_owner').val())
            fd.append('student_home_address', $('#student_home_address').val())
            fd.append('student_home_postal', $('#student_home_postal').val())
            fd.append('student_home_province', $('#student_home_province').val())
            fd.append('student_home_distric', $('#student_home_distric').val())
            fd.append('student_home_subdistric', $('#student_home_subdistric').val())
            fd.append('student_home_village', $('#student_home_village').val())
            fd.append('student_school_from', $('#student_school_from').val())
            fd.append('student_school_name', $('#student_school_name').val())
            fd.append('student_school_npsn', $('#student_school_npsn').val())
            fd.append('student_school_address', $('#student_school_address').val())
            fd.append('student_kip_no', $('#student_kip_no').val())
            fd.append('student_pkh_no', $('#student_pkh_no').val())
            fd.append('student_kks_no', $('#student_kks_no').val())
            $.ajax({
                headers: csrf_token,
                url: adminurl + '/siswa',
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
                        setTimeout(function (){
                            window.location.href = adminurl + '/siswa'
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
                    _type   : 'logout',
                },
                success: function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-' + resp['class'] + ' border-' + resp['class'] + ' alert-styled-left'
                    });
                    if (resp['class'] === 'success'){
                        setInterval(function (){
                            window.location.href = baseurl
                        }, 2000)
                    }
                }
            })
        });
        $('#print').click(function (){
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/pendaftaran',
                type: 'post',
                dataType: 'json',
                data: {
                    _type   : 'print',
                    _data   : $('#student_id').val()
                }
            })
        });
    }

    return {
        init: function() {
            _componentSelect();
            _componentCheck();
            _componentData()
            _componentSubmit();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    student_addjs.init();
});
