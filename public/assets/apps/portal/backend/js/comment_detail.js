var commentdetailjs = function () {
    var csrf_token = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')};

    var _componentSubmit = function () {
        $("#submit").click(function () {
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/komentar/' + $('#comment_id').val() + '/lihat',
                type: 'post',
                dataType: 'json',
                data: {
                    _type: $('#submit').val(),
                    comment_id: $('#comment_id').val(),
                    comment_parent: $('#comment_parent').val(),
                    comment_name: $('#comment_name').val(),
                    comment_content: $('#comment_content').val()
                },
                success : function (resp) {
                    new PNotify({
                        title: resp['title'],
                        text: resp['text'],
                        addclass: 'alert bg-'+resp['class']+' border-'+resp['class']+' alert-styled-left'
                    });
                    setTimeout(function (){
                        window.location.href = baseurl + '/komentar/' + $('#comment_parent').val() + '/lihat'
                    }, 2000);
                }
            })
        })
    }

    var _componentButton = function (){
        $('#btn-edit').click(function (){
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/komentar/' + $('#comment_id').val() + '/lihat',
                type: 'post',
                dataType: 'json',
                data: {
                    _type: 'edit',
                    comment_id: $('#btn-edit').val()
                },
                success : function (resp) {
                    $('#submit').val('update');
                    $('#comment_id').val(resp.comment_id);
                    $('#comment_content').val(resp.comment_content);
                }
            })
        });
        $('#btn-delete').click(function (){
            $.ajax({
                headers: csrf_token,
                url : baseurl + '/komentar/' + $('#comment_id').val() + '/lihat',
                type: 'post',
                dataType: 'json',
                data: {
                    _type: 'delete',
                    comment_id: $('#btn-edit').val()
                },
                success : function (resp) {
                    $('#submit').val('update');
                    $('#comment_id').val(resp.comment_id);
                    $('#comment_content').val(resp.comment_content);
                    setTimeout(function (){
                        window.location.href = baseurl + '/komentar/' + $('#comment_parent').val() + '/lihat'
                    }, 2000);
                }
            })
        });
    }

    return {
        init: function() {
            _componentSubmit();
            _componentButton();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    commentdetailjs.init();
});
