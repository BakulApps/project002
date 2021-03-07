var registerdetail = function() {

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

    var _componentCalender = function () {
        $('.daterange').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    }

    var _componentSubmit = function (){
        $('#update').click(function (){
            var swaphoto = $('#student_swaphoto')[0].files[0];
            var akta_photo = $('#student_akta_photo')[0].files[0];
            var kk_photo = $('#student_kk_photo')[0].files[0];
            var ijazah_photo = $('#student_ijazah_photo')[0].files[0];
            var skhun_photo = $('#student_skhun_photo')[0].files[0];
            var sholarship_photo = $('#student_sholarship_photo')[0].files[0];
            var fd = new FormData();
            fd.append('_type', 'update');
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
            fd.append('student_no_kk', $('#student_no_kk').val())
            fd.append('student_head_family', $('#student_head_family').val())
            fd.append('student_father_name', $('#student_father_name').val())
            fd.append('student_mother_name', $('#student_mother_name').val())
            fd.append('student_father_birthday', $('#student_father_birthday').val())
            fd.append('student_mother_birthday', $('#student_mother_birthday').val())
            fd.append('student_father_status', $('#student_father_status').val())
            fd.append('student_mother_status', $('#student_mother_status').val())
            fd.append('student_father_nik', $('#student_father_nik').val())
            fd.append('student_mother_nik', $('#student_mother_nik').val())
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
            fd.append('student_school_from', $('#student_school_from').val())
            fd.append('student_school_name', $('#student_school_name').val())
            fd.append('student_school_npsn', $('#student_school_npsn').val())
            fd.append('student_school_address', $('#student_school_address').val())

            if (swaphoto !== undefined){fd.append('student_swaphoto', swaphoto)}
            if (akta_photo !== undefined){fd.append('student_akta_photo', akta_photo)}
            if (kk_photo !== undefined){fd.append('student_kk_photo', kk_photo)}
            if (ijazah_photo !== undefined){fd.append('student_ijazah_photo', ijazah_photo)}
            if (skhun_photo !== undefined){fd.append('student_skhun_photo', skhun_photo)}
            if (sholarship_photo !== undefined){fd.append('student_sholarship_photo', sholarship_photo)}

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
                        setTimeout(function (){
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
            _componentCalender();
            _componentCheck();
            _componentSelect();
            _componentSubmit()
        }
    }
}();
document.addEventListener('DOMContentLoaded', function() {
    registerdetail.init();
});
