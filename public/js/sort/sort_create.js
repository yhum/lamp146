
$(function () {
//   alert('1');
 $('#upload').uploadify({
        swf : '/plugins/uploadify/uploadify.swf', //绑定样式
        buttonText : "上传图片",
         fileSizeLimit : 1*1024*1024,
        fileTypeExts : '*.jpg;*.jpeg;*.png;*.gif',
        method : 'post',
         formData : { //要发送的数据
            _token : document.fm._token.value
        },
        uploader : '/admin/sort/upload',
          onUploadSuccess : function (file,txt,response){
            eval('var result=' + txt);
           
            if(!result.status) alert(result.info)
            else{
                $('#pre').html("<img src='"+ result.info +"' width=150 >");
                
                $('#img').val(result.info);
//                alert(result.info);
            }
        }
        });

})