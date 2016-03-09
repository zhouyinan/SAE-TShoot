<?php
namespace Main\Controller;
use Think\Controller;
class DomainController extends Controller{

  public function index(){
    $this->redirect('start',null,0,'Redirecting');
  }

  public function result(){
    if(false&&isset($_SESSION['DomainCheckResult'])==false){
      $this->redirect('start',null,0,'Redirecting');
      exit();
    }
    $this->display();
  }

  public function start(){
    if(!IS_POST){
      $this->display();
      exit();
    }
    unset($_SESSION['DomainCheckResult']);
    $error = false;
    if(!mb_ereg('^[a-z0-9]{4,32}$',$_POST['appname'])){
      $errmessage[] = '二级域名输入错误';
    }
    if(empty($_POST['domain'])){
      $errmessage[] = '独立域名输入错误';
    }
    if($_POST['beian']!=true&&$_POST['beian']!=false){
      $errmessage[] = '请选择CNAME地址';
    }
    if(isset($errmessage)){
      $this->assign('errmsgs',$errmessage);
      $this->display();
      exit();
    }
    $domain_split = explode('.',$_POST['domain']);
    if(count($domain_split)<2){
      $this->assign('errmsgs',array('您想要绑定的不是合法域名或者为顶级域名、nTLDs或者gTLDs'));
      $this->display();
      exit();
    }
    $level2domain = false;
    switch($domain_split[count($domain_split)-1]){
      case 'cn':
        if(in_array($domain_split[count($domain_split)-2],array('ac','bj','sh','tj','cq','he','sx','nm','ln','jl','hl','js','zj','ah','fj','jx','sd','ha','hb','hn','gd','gx','hi','sc','gz','yn','gs','qh','nx','xj','tw','hk','mo','sn'))){
          $level2domain = true;
        }
      case 'pro':
        if(in_array($domain_split[count($domain_split)-2],array('cpa','eng','law','med'))){
          $level2domain = true;
        }
        break;
      case 'com':
        if(in_array($domain_split[count($domain_split)-2],array('de','africa','de','gb','gr','hu','jpn','kr','no','qc','sa','uk','us','za','cn'))){
          $level2domain = true;
        }
        break;
      case 'org':
        if(in_array($domain_split[count($domain_split)-2],array('ae','us'))){
          $level2domain = true;
        }
        break;
      case 'net':
        if(in_array($domain_split[count($domain_split)-2],array('hu','jp','se','uk'))){
          $level2domain = true;
        }
        break;
      case 'au':
        if(in_array($domain_split[count($domain_split)-2],array('asn'))){
          $level2domain = true;
        }
        break;
      case 'ai':
        if(in_array($domain_split[count($domain_split)-2],array('off'))){
          $level2domain = true;
        }
        break;
      case 'bi':
        if(in_array($domain_split[count($domain_split)-2],array('info','or'))){
          $level2domain = true;
        }
        break;
      case 'cy':
        if(in_array($domain_split[count($domain_split)-2],array('tm'))){
          $level2domain = true;
        }
      case 'uk':
        if(in_array($domain_split[count($domain_split)-2],array('ltd','me','plc'))){
          $level2domain = true;
        }
        break;
      case 'ug':
        if(in_array($domain_split[count($domain_split)-2],array('ne','sc'))){
          $level2domain = true;
        }
        break;
      default:
        break;
    }
    if(in_array($domain_split[count($domain_split)-2],array('com','co','org','net','gov','edu','mil','biz','mobi'))){
      $level2domain = true;
    }
    if($level2domain && count($domain_split) == 2){
      $this->assign('errmsgs',array('您输入的是可供公众直接注册的一级域名，请检查您的输入。'));
      $this->display();
      exit();
    }
    if($_POST['beian']=='yes'){
      $SAEIP = $this->dns_resolute('sinaapp.com');
    }
    else{
      $SAEIP = $this->dns_resolute('hk.cname.saebbs.com');
    }
    $DomainResolution = explode(',',$this->dns_resolute($_POST['domain'],true));
    $DomainIP = $DomainResolution[0];
    $DomainTTL = $DomainResolution[1];
    if(empty($DomainIP)){
      if($level2domain){
        $AlternateDomain = $_POST['domain'] . '.' . $domain_split[count($domain_split)-3] . '.' . $domain_split[count($domain_split)-2] .'.'. $domain_split[count($domain_split)-1];
        $AlternateIP = $this->dns_resolute($AlternateDomain);
      }
      else{
        $AlternateDomain = $_POST['domain'] . '.' . $domain_split[count($domain_split)-2] .'.'. $domain_split[count($domain_split)-1];
        $AlternateIP = $this->dns_resolute($AlternateDomain);
      }
      if($AlternateIP == $SAEIP){
        $_SESSION['DomainCheckResult']['reason'] = '您将域名' . $AlternateDomain . '指向了';
        if($_POST['beian']=='yes'){
          $_SESSION['DomainCheckResult']['reason'] = $_SESSION['DomainCheckResult']['reason'] . $_POST['appname'] . 'sinaapp.com';
        }
        else{
          $_SESSION['DomainCheckResult']['reason'] = $_SESSION['DomainCheckResult']['reason'] . 'hk.cname.saebbs.com';
        }
        $_SESSION['DomainCheckResult']['reason'] = $_SESSION['DomainCheckResult']['reason'] . '而没有将' . $_POST['domain'] . '指向';
        if($_POST['beian']=='yes'){
          $_SESSION['DomainCheckResult']['reason'] = $_SESSION['DomainCheckResult']['reason'] . $_POST['appname'] . 'sinaapp.com';
        }
        else{
          $_SESSION['DomainCheckResult']['reason'] = $_SESSION['DomainCheckResult']['reason'] . 'hk.cname.saebbs.com';
        }
        $_SESSION['DomainCheckResult']['reason'] = $_SESSION['DomainCheckResult']['reason'] . '。这个错误通常是由于您在DNS设置中在记录的子域中填写了全域导致的。您可以<a href="http://saebbs.com/forum.php?mod=viewthread&tid=31256&fromuid=28205" target="_blank">点击这里并阅读其中的Q4了解详情</a>。';
        $_SESSION['DomainCheckResult']['suggestion'] = '前往域名DNS处正确设置相应记录（不要在子域中填写全域名，详见上方了解详情链接）。';
        $this->redirect('result',null,0,'Redirecting');
        exit();
      }
      $_SESSION['DomainCheckResult']['reason'] = '域名' . $_POST['domain'] . '的DNS记录为空，并未CNAME指向';
      if($_POST['beian']=='yes'){
        $_SESSION['DomainCheckResult']['reason'] = $_SESSION['DomainCheckResult']['reason'] . $_POST['appname'] . '.sinaapp.com';
      }
      else{
        $_SESSION['DomainCheckResult']['reason'] = $_SESSION['DomainCheckResult']['reason'] . 'hk.cname.saebbs.com';
      }
      $_SESSION['DomainCheckResult']['suggestion'] = '前往域名DNS处设置相应记录';
      $this->redirect('result',null,0,'Redirecting');
      exit();
    }
    else{
      if(!$this->is_equal_ip_list($SAEIP,$DomainIP)){
        $_SESSION['DomainCheckResult']['reason'] = 'DNS记录设置错误，并未将域名' . $_POST['domain'] . '用CNAME记录指向';
        if($_POST['beian']=='yes'){
        $_SESSION['DomainCheckResult']['reason'] = $_SESSION['DomainCheckResult']['reason'] . $_POST['appname'] . '.sinaapp.com';
        }
        else{
          $_SESSION['DomainCheckResult']['reason'] = $_SESSION['DomainCheckResult']['reason'] . 'hk.cname.saebbs.com';
        }
        $_SESSION['DomainCheckResult']['reason'] = $_SESSION['DomainCheckResult']['reason'] . '。或者修改记录暂未生效，TTL值为' . $DomainTTL .'，代表对应秒数后Local DNS缓存失效将进行一轮刷新。';
        $_SESSION['DomainCheckResult']['suggestion'] = '前往域名DNS处检查是否正确设置相应记录，如果已经正确设置请等待DNS记录生效。';
        $this->redirect('result',null,0,'Redirecting');
        exit();
      }
      else{
        $_SESSION['DomainCheckResult']['reason'] = '系统未检测到异常';
        $_SESSION['DomainCheckResult']['suggestion'] = '系统未检测到异常';
        $this->redirect('result',null,0,'Redirecting');
        exit();
      }
    }
  }

  private function dns_resolute($domain,$require_ttl = false){
    if(empty($domain))return false;
    $ch = curl_init();
    $parameter['dn']=$domain;
    if($require_ttl)$parameter['ttl']=1;
    curl_setopt($ch,CURLOPT_URL,'http://119.29.29.29/d?'.http_build_query($parameter));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);
    $result = curl_exec($ch);
    curl_close($ch);
    if(empty($result)){
      $_SESSION['DomainCheckResult']['detail'][]='nslookup ' .$domain. '<br /><br />找不到' .$domain. ': Non-existent domain';
      return false;
    }else{
      if($require_ttl){
        $IP = explode(',',$result);
        $IP = implode(',',explode(';',$IP[0]));
      }
      else{
        $IP = implode(',',explode(';',$result));
      }
      $_SESSION['DomainCheckResult']['detail'][]='nslookup ' .$domain. '<br /><br />非权威应答<br />Domain: ' .$domain. '<br />IP: ' . $IP;
      return $result;
    }
  }

  private function get_http_code($url){
    if(empty($url))return false;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($curl,CURLOPT_NOBODY,true);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_HEADER,0);
    $result = curl_getinfo($curl,CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $result;
  }

  private function is_equal_ip_list($sae,$target){
    $sae = explode(';',$sae);
    foreach(explode(';',$target) as $i=>$ip){
      if(!in_array($ip,$sae))return false;
    }
    return true;
  }
}
