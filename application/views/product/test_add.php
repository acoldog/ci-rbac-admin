<h1>新增关系</h1>
<form role="form" action="" method="post">

  <div class="form-group">
    <label>名称</label>
    <input name="username" type="text" class="form-control" placeholder="在此输入控制器" value="<?php if(!empty($username)){echo $username;} ?>" >
  </div>

  <div class="form-group" id="pic_upload">
      <label>图标</label>
      <br>
      <img id="upload_btn" width="50px" height="50px" src="<?php if(!empty($ico)){echo $ico;} ?>">
      <i>（点击上传/修改图片）</i>
      <input type="hidden" name="ico" value="<?php if(!empty($ico)){echo htmlentities($ico);} ?>">
  </div>

  <div class="form-group">
    <label>介绍</label>
    <script type="text/plain" id="descr" style="width:100%;height:300px;"><?php if(!empty($descr)){echo $descr;} ?></script>
    <textarea id="desc_d" class="form-control" style="display: none;" name="descr" placeholder="内容"></textarea>
  </div>


  <button type="submit" class="btn btn-success">确认提交</button>
  <a class="btn btn-danger" href="<?php echo site_url('product/index/test'); ?>">取消操作</a>
</form>

<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>static/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>static/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>static/ueditor/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>static/plugins/jquery.ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/upload.js"></script>

<script type="text/javascript">
  $(function() {
      //editor
      UE.getEditor('descr');

      $('#upload_btn').on('click', function(){
        initUploadInput('#pic_upload');
        //图片异步上传
        applyAjaxFileUpload('#pic');
      });
  });

</script>