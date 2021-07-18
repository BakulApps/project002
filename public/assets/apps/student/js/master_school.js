var school = function() {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componentSelect = function () {
        $('.select2').select2({
            minimumResultsForSearch: Infinity,
        });
        $('#school_status').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'school_status'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('#school_ladder').select2({
            ajax: {
                headers: csrf_token,
                url: siteurl + '/api/master',
                dataType: 'json',
                type: 'post',
                data: {_type: 'select', _data: 'ladder'},
                processResults: function (data) {
                    return {results: data}
                },
                cache: true
            },
            minimumResultsForSearch: Infinity
        });
        $('#school_province').select2({
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
            $('#school_distric').select2({
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
                $('#school_subdistric').select2({
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
                    $('#school_village').select2({
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
    };

    var _componentCalender = function () {
        $('.daterange').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    }

    var _componentFileUpload = function () {
        $('.form-control-uniform-custom').uniform({
            fileButtonHtml: 'Pilih Berkas',
            fileDefaultHtml: 'Tidak ada berkas',
            fileButtonClass: 'action btn bg-blue',
            selectClass: 'uniform-select bg-pink-400 border-pink-400'
        })
    }

    var _componentSubmit = function (){
        $('#address').click(function (){
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/master/sekolah',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'update',
                    '_data': 'address',
                    'school_address': $('#school_address').val(),
                    'school_province': $('#school_province').val(),
                    'school_distric': $('#school_distric').val(),
                    'school_subdistric': $('#school_subdistric').val(),
                    'school_village': $('#school_village').val(),
                    'school_postal': $('#school_postal').val()
                },
                success: function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-' + resp['class'] + ' border-' + resp['class'] + ' alert-styled-left'
                    });
                    if (resp['class'] === 'success'){
                        setInterval(function (){
                            location.reload()
                        }, 2000)
                    }
                }
            });
        });
        $('#school').click(function (){
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/master/sekolah',
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'update',
                    '_data': 'school',
                    'school_npsn': $('#school_npsn').val(),
                    'school_nsm': $('#school_nsm').val(),
                    'school_name': $('#school_name').val(),
                    'school_nickname': $('#school_nickname').val(),
                    'school_ladder': $('#school_ladder').val(),
                    'school_npwp': $('#school_npwp').val(),
                    'school_phone': $('#school_phone').val(),
                    'school_website': $('#school_website').val(),
                    'school_email': $('#school_email').val(),
                    'school_since_year': $('#school_since_year').val(),
                    'school_since_deed': $('#school_since_deed').val(),
                    'school_lisence_number': $('#school_lisence_number').val(),
                    'school_lisence_date': $('#school_lisence_date').val(),
                    'school_kemenkumham_number': $('#school_kemenkumham_number').val(),
                    'school_kemenkumham_date': $('#school_kemenkumham_date').val(),
                    'school_organizer': $('#school_organizer').val(),
                    'school_fundation': $('#school_fundation').val(),
                },
                success: function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-' + resp['class'] + ' border-' + resp['class'] + ' alert-styled-left'
                    });
                    if (resp['class'] === 'success'){
                        setInterval(function (){
                            location.reload()
                        }, 2000)
                    }
                }
            });
        });
        $('#school_logo').change(function (){
            var fd = new FormData();
            var school_logo = $('#school_logo')[0].files[0];
            fd.append('_type', 'update');
            fd.append('_data', 'logo');
            if (school_logo !== undefined){
                fd.append('school_logo', school_logo);
            }
            else {
                fd.append('school_logo', null);
            }
            $.ajax({
                headers: csrf_token,
                url: baseurl + '/master/sekolah',
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
                    if (resp['class'] === 'success'){
                        setInterval(function (){
                            location.reload();
                        }, 2000)
                    }
                }
            })
        });
    }

    return {
        init: function() {
            _componentSelect();
            _componentCalender();
            _componentSubmit();
            _componentFileUpload();
        }
    }
}();
document.addEventListener('DOMContentLoaded', function() {
    school.init();
});
