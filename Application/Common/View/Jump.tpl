<!DOCTYPE html><html lang="zh-cn"><head><meta charset="utf-8"><meta name="renderer" content="webkit"><title>出错了 - SAE T-Shoot</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="http://sae.sina.com.cn/static/favicon.ico">
    <style type="text/css">
      body{font-family:"ff-tisa-web-pro-1","ff-tisa-web-pro-2","Lucida Grande","Helvetica Neue",Helvetica,Arial,"Hiragino Sans GB","Hiragino Sans GB W3","Microsoft YaHei UI","Microsoft YaHei","WenQuanYi Micro Hei",sans-serif !important;padding-top:30px}.starter-template{padding:40px 15px;text-align:center}
    </style>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand">SAE T-Shoot</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active">
              <a><?php if($status===1)echo '提示';else echo '错误';?>信息</a>
            </li>
          </ul>
          <p class="navbar-text pull-right">
          </p>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="starter-template">
        <h1><?php echo ($message);?></h1>
        <h4><span id="wait"><?php echo($waitSecond); ?></span>秒后页面将自动<a id="href" href="<?php echo($jumpUrl);?>">跳转</a></h4>
      </div>
    </div>
    <script type="text/javascript">
      (function(){
      var wait = document.getElementById('wait'),href = document.getElementById('href').href;
      var interval = setInterval(function(){
        var time = --wait.innerHTML;
        if(time <= 0) {
          location.href = href;
          clearInterval(interval);
        };
      }, 1000);
      })();
    </script>
  </body>

</html>