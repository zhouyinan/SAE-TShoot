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
      <div style="max-width:500px;margin-left:auto;margin-right:auto;">
        <form method="POST" class="form-horizontal" style="margin:auto;margin-top:30px;"
        role="form">
          <div id="appnameinputdiv" class="form-group">
            <label for="appnamefield" class="col-sm-2 control-label">
              二级域名
            </label>
            <div class="col-sm-8">
              <div class="input-group">
                <input id="appnamefield" name="appname" type="text" class="form-control" maxlength="32" required="required">
                <span class="input-group-addon">.sinaapp.com</span>
              </div>
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8 col-sm-offset-2">
              <span class="help-block">创建应用时设定的二级域名</span>
            </div>
            <div class="col-sm-2"></div>
            <br>
          </div>
          <div id="domaininputdiv" class="form-group">
            <label for="domainfield" class="col-sm-2 control-label">
              独立域名
            </label>
            <div class="col-sm-8">
              <input id="domainfield" name="domain" type="text" class="form-control" maxlength="32" required="required">
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-8 col-sm-offset-2">
              <span class="help-block">您想要绑定的独立域名</span>
            </div>
            <div class="col-sm-2"></div>
            <br>
          </div>
          <div id="beianinputdiv" class="form-group">
            <label for="verificationoption" class="col-sm-2 control-label">CNAME地址</label>
            <div class="col-sm-8">
              <select id="beianfield" name="beian" class="form-control" required="required">
                <option disabled="disabled">请选择</option>
                <option id="cnameurlbeianed" value="yes">applinzi.com</option>
                <option value="no">hk.cname.saebbs.com</option>
              </select>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <span class="help-block">应用设置中对应绑定域名的CNAME地址</span>
            </div>
            <div class="col-sm-2"></div>
            <br>
          </div>
          <div class="col-sm-8 col-sm-offset-2" style="padding:0px 0px">
            <p>
              <button id="check" type="button" id="submitbutton" class="btn btn-lg btn-primary btn-block" data-loading-text="正在诊断中..." autocomplete="off">
                进行诊断
              </button>
            </p>
          </div>
        </form>
      </div>
    </div>
    <footer style="text-align:center;margin-top:20px;">
      <p>&copy;2016&nbsp;<a href="https://github.com/zhouyinan" target="_blank">Yinan Zhou</a></p>
    </footer>
    <script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script>
      $('#check').click(function(){
        $('#check').button('loading');
        $('form').submit();
      });
      $('#appnamefield').change(function(){
        $("#cnameurlbeianed").text($('#appnamefield').val() + ".applinzi.com");
      });
      <foreach name="errmsgs" item="errmsg">
        alert('{$errmsg}');
      </foreach>
    </script>
  </body>
</html>
