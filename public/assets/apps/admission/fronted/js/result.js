var resultjs = function() {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componentAxis = function() {

        var result_admission = document.getElementById('result_admission');

        $.ajax({
            headers: csrf_token,
            url: baseurl + '/rekap',
            dataType: 'json',
            type: 'post',
            data: {_type: 'data', _data: 'all'},
            async: true,
            cache: false,
            success: function (result){
                c3.generate({
                    bindto: result_admission,
                    size: { height: 400 },
                    data: {
                        columns: result
                    },
                    color: {
                        pattern: ['#1e212d', '#440a67', '#ac0d0d', '#00917c']
                    },
                    axis: {
                        x: {
                            type: 'category',
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'okt', 'Nov', 'Des'],
                            tick: {
                                rotate: -90
                            },
                            height: 100
                        },
                        y: {
                            min: 1
                        }
                    },
                    grid: {
                        x: {
                            show: true
                        },

                    }
                });
            }
        })
    };

    var _componentChangeAxis = function (){
        var result_admission = document.getElementById('result_admission');
        var result_axis = c3.generate({
            bindto: result_admission,
            size: { height: 400 },
            data: {
                columns: []
            },
            color: {
                pattern: ['#1e212d', '#440a67', '#ac0d0d', '#00917c']
            },
            axis: {
                x: {
                    type: 'category',
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'okt', 'Nov', 'Des'],
                    tick: {
                        rotate: -90
                    },
                    height: 100
                },
                y: {
                    min: 1
                }
            },
            grid: {
                x: {
                    show: true
                },

            }
        });

        $.ajax({
            headers: csrf_token,
            url: baseurl + '/rekap',
            dataType: 'json',
            type: 'post',
            data: {_type: 'data', _data: 'all'},
            async: true,
            cache: false,
            success: function (result){
                result_axis.load({
                    columns: result
                })
            }
        })

        $('#data').on('change', function (){
            var data = this.value
            if (data === '1'){
                $.ajax({
                    headers: csrf_token,
                    url: baseurl + '/rekap',
                    dataType: 'json',
                    type: 'post',
                    data: {_type: 'data', _data: 'all'},
                    async: true,
                    cache: false,
                    success: function (result){
                        result_axis.load({
                            columns: result,
                            unload: ['Jumlah Laki-laki', 'Jumlah Perempuan', 'Tahfidz', 'Sains & Bahasa', 'Kitab Kuning', 'Kelas Reguler']
                        })
                    }
                })
            }
            else if (data === '2'){
                $.ajax({
                    headers: csrf_token,
                    url: baseurl + '/rekap',
                    dataType: 'json',
                    type: 'post',
                    data: {_type: 'data', _data: 'gender'},
                    async: true,
                    cache: false,
                    success: function (result){
                        result_axis.load({
                            columns: result,
                            unload: ['Jumlah Pendaftar', 'Tahfidz', 'Sains & Bahasa', 'Kitab Kuning', 'Kelas Reguler']
                        })
                    }
                })
            }
            else if (data === '3'){
                $.ajax({
                    headers: csrf_token,
                    url: baseurl + '/rekap',
                    dataType: 'json',
                    type: 'post',
                    data: {_type: 'data', _data: 'program'},
                    async: true,
                    cache: false,
                    success: function (result){
                        result_axis.load({
                            columns: result,
                            unload: ['Jumlah Laki-laki', 'Jumlah Perempuan', 'Jumlah Pendaftar']
                        })
                    }
                })
            }
        });
    }

    var _componentSelect = function (){
        $('.select2').select2({
            minimumResultsForSearch: Infinity
        })
    }

    return {
        init: function() {
            _componentChangeAxis()
            _componentSelect();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    resultjs.init();
});
