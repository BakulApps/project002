var homejs = function () {

    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componentSubmit = function () {
        $('#lack_detail').hide();
        $("#submit").click(function () {
            $('#forget').hide();
            $.ajax({
                headers: csrf_token,
                url : baseurl,
                type: 'post',
                dataType: 'json',
                data: {
                    '_type': 'submit',
                    '_data': 'lack',
                    'student_nisn': $('#student_nisn').val(),
                },
                success : function (resp) {
                    if (resp.status === 1){
                        $('#student_name').html(resp.data.student_name);
                        $('#student_class').html(resp.data.student_class);
                        $('#student_lack').html(resp.data.student_lack);
                        $('#lack_detail').show()
                    }
                }
            })
        })
    }

    return {
        init: function() {
            _componentSubmit();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    homejs.init();
});
