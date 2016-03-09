<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <title>SAE T-Shoot</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">body{font-family:"ff-tisa-web-pro-1","ff-tisa-web-pro-2","Lucida Grande","Helvetica Neue",Helvetica,Arial,"Hiragino Sans GB","Hiragino Sans GB W3","Microsoft YaHei UI","Microsoft YaHei","WenQuanYi Micro Hei",sans-serif !important;}</style>
    <link rel="shortcut icon" href="http://sae.sina.com.cn/static/favicon.ico">
  </head>
  <body style="padding-top: 50px;padding-bottom: 20px;">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/">SAE T-Shoot</a>
        </div>
      </div>
    </div>
    <div class="jumbotron">
      <div class="container">
        <h1>域名相关问题自动诊断</h1>
        <p>独立域名绑定、独立域名无法访问等问题</p>
      </div>
    </div>
    <div class="container">
      <div class="page-header">
        <h1>诊断报告 <small>Result</small></h1>
      </div>
      <h3>故障原因</h3>
      {$Think.session.DomainCheckResult.reason}
      <h3>指导建议</h3>
      {$Think.session.DomainCheckResult.suggestion}
      <h3>技术详情</h3>
      <foreach name="Think.session.DomainCheckResult.detail" item="line">
      <pre>{$line}</pre>
      </foreach>
    </div>
    <footer style="text-align:center;margin-top:20px;">
      <p>&copy;2016&nbsp;<a href="https://github.com/zhouyinan" target="_blank">Yinan Zhou</a></p>
    </footer>
  </body>
</html>
