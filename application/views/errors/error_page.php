<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>提示</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="<?php echo $this -> config -> item('oss_static_host');?>/public/css/error/cxt/lib/frozen/css/frozen.css"/>
    <link rel="stylesheet" href="<?php echo $this -> config -> item('oss_static_host');?>/public/css/error/cxt/css/style.css?v=1.0"/>

</head>
<body class="white p-5 text-center">
<section class="blank-label" style="width: 100%;text-align: center;">
    <img src="http://mlx.oss-cn-hangzhou.aliyuncs.com/2016-02-23/720093c0710c5b6983f3fbbf05328465.PNG" alt=""/>
    <h1 class="m-t-30"><?php echo $msg; ?></h1>
    <!-- <p>System information prompt.</p> -->
    <?php if(isset($btn)){ ?>
    <a style="display: block; padding: 5px;" href="<?php echo $btn_url?$btn_url:'/';?>" class="m-center deep2-blue white-text"><?php echo $btn?$btn:'返回首页';?></a>
    <?php } ?>
</section>
</body>
</html>