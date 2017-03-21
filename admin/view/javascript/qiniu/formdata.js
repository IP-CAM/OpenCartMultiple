// jQuery zepto vue angular 等库皆有 progress 的实现 以jQuery为例：

$(function(){


  var $key = $('#cloud_file_name');  // file name    eg: the file is image.jpg,but $key='a.jpg', you will upload the file named 'a.jpg'
  var $userfile = $('#cloud_file');  // the file you selected
  // upload info
  var $progress = $(".progress");

  $(".img-upload-single").click(function(){
      var filename = $(this).data("filename");
      $('#cloud_file_name').val(filename);
      $('#img_id').val($(this).find('img').attr("id"));
      $('#input_id').val($(this).data("inputid"));
      $("#cloud_file").click();
  });

  $("#cloud_file").change(function() {  // you can ues 'onchange' here to uplpad automatically after select a file

    var selectedFile = $userfile.val();
    if (selectedFile) {
      // randomly generate the final file name
      var ramdomName = Math.random().toString(36).substr(2) + $userfile.val().match(/\.?[^.\/]+$/);
      $key.val($("#img_dir").val()+ramdomName);
    } else {
      return false;
    }
    var f = new FormData(document.getElementById("cloud_upload_form"));
    $.ajax({

      url: 'http://up-na0.qiniu.com/',  // Different bucket zone has different upload url, you can get right url by the browser error massage when uploading a file with wrong upload url.
      type: 'POST',
      data: f,
      processData: false,
      contentType: false,
      xhr: function(){
        myXhr = $.ajaxSettings.xhr();  
        if(myXhr.upload){
          myXhr.upload.addEventListener('progress',function(e) {
            // console.log(e);
            if (e.lengthComputable) {
              var percent = e.loaded/e.total*100;
              $progress.html('上传：' + e.loaded + "/" + e.total+" bytes. " + percent.toFixed(2) + "%");
            }
          }, false);
        }
        return myXhr;
      },
      success: function(res) {
          console.log("成功：" + JSON.stringify(res));
          var str = '<span>已上传：' + res.key + '</span>';
          $('#'+$('#img_id').val()).attr('src',domain + res.key+"!thumb");
          $('#cloud_file').val("");
          $('#'+$('#input_id').val()).val($key.val());
      },
      error: function(res) {  
          console.log("失败:" +  JSON.stringify(res));
          $('#cloud_file').val("");
      }
    });

    return false;
  });
});