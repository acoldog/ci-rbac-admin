/**
 * [initUploadInput 初始化上传表单项]
 * @return {[type]} [description]
 */
function initUploadInput(element, title) {
    title = title || '封面图';
    $(element).empty();
    $(element).append('<label>'+ title +'</label>');
    $(element).append('<input id="pic" name="photo_upload" type="file" class="form-control" >');
}

/**
 * [applyAjaxFileUpload 异步上传图片]
 * @param  {[type]} element [description]
 * @return {[type]}         [description]
 */
function applyAjaxFileUpload(element) {
    $(element).AjaxFileUpload({
      action: "/api/Upload/local",
      onChange: function(filename) {
        // Create a div element to notify the user of an upload in progress
        var $div = $("<div />")
          .attr("class", $(this).attr("id"))
          .attr("style", "margin:10px 0;")
          .text("Uploading")
          .insertAfter($(this));

        $(this).remove();

        interval = window.setInterval(function() {
          var text = $div.text();
          if (text.length < 13) {
            $div.text(text + ".");
          } else {
            $div.text("Uploading");
          }
        }, 200);
      },
      onComplete: function(filename, response) {
        window.clearInterval(interval);

        var $div = $("div." + $(this).attr("id")).text(" "),
            $fileInput = $("<input />").attr({
              type: "file",
              name: $(this).attr("name"),
              id: $(this).attr("id")
            });

        if (typeof(response.error) === "string") {
          $div.replaceWith($fileInput);

          applyAjaxFileUpload($fileInput);

          alert(response.error);

          return;
        }else{
          if(typeof upload_pic_success != 'undefined' 
            && typeof upload_pic_limit != 'undefined' 
            && ++upload_pic_success < upload_pic_limit ) {
              $('#pic_upload').append('<input id="pic'+ upload_pic_success +'" name="photo_upload" type="file" class="form-control" >');
              applyAjaxFileUpload('#pic'+ upload_pic_success);
          }

        }

        $("div." + $(this).attr("id")).prepend('<img width="50x" height="50px" src="'+ response.url +'">');
        //设置hidden input
        $("div." + $(this).attr("id")).append('<input type="hidden" name="images[]" value="'+ response.originalName +'">');

        $("<a />")
          .attr("href", "#")
          .text("x")
          .bind("click", function(e) {
            typeof upload_pic_success != 'undefined' && upload_pic_success--;
            $div.replaceWith($fileInput);

            applyAjaxFileUpload($fileInput);
          })
          .appendTo($div);
      }
    });
}