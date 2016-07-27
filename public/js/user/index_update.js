$(function () {
        $('select[name=groupid]').change(function () {
//            alert($(this).attr('uid'));
            var result=confirm('确定要修改吗？');
            if(!result){
                location.reload();
                return;
            }
            
            $.ajax({
                type : 'get',
                url : '/admin/user/group/'+$(this).attr('uid')+"/"+$(this).val(),
                data : null,
                dataType : 'json',
                success: function (result) {
                    alert(result.info);
                    if(!result.status) location.reload();
                },
            });
        });
})