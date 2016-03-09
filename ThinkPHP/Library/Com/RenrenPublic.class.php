<?php
namespace Com;

class RenrenPublic {

  private $data = array();

  public function __construct($token){
    if($token){
      $xml = new \SimpleXMLElement($_POST['message']);
      $xml || exit;

      foreach ($xml as $key => $value) {
          $this->data[$key] = strval($value);
      }

    } else {
        throw new \Exception('参数错误！');
    }
  }

  public function request(){
      return $this->data;
  }
  
  public function response($content,$type = 'text'){
    switch($type){
      case 'text':
        $this->replyText($content);
        break;
      case 'image':
        $this->replyImage($content);
        break;
      case 'news':
        $this->replyNews($content);
        break;
      default:
        exit();
    }
  }

  private function replyText($text){
    $data['ToUser'] = $this->data['FromUser'];
    $data['FromUser'] = $this->data['ToUser'];
    $data['CreateTime'] = time();
    $data['MsgType'] = 'text';
    $data['Content'] = $text;
    $this->oxml($data);
  }
  
  private function replyImage($image){
    $data['ToUser'] = $this->data['FromUser'];
    $data['FromUser'] = $this->data['ToUser'];
    $data['CreateTime'] = time();
    $data['MsgType'] = 'image';
    if(empty($image[1]))$data['SmallUrl'] = $image[0];
    else $data['SmallUrl'] = $image[1];
    $data['LargeUrl'] = $image[0];
    $this->oxml($data);
  }

  private function replyVoice($voice){
    $data['ToUser'] = $this->data['FromUser'];
    $data['FromUser'] = $this->data['ToUser'];
    $data['CreateTime'] = time();
    $data['MsgType'] = 'image';
    $data['PicUrl'] = $voice[0];
    $data['PlayTime'] = $voice[1];
    $this->oxml($data);
  }
  
  private function replyNews($news){
    $data['ToUser'] = $this->data['FromUser'];
    $data['FromUser'] = $this->data['ToUser'];
    $data['CreateTime'] = time();
    $data['MsgType'] = 'news';
    $articles = array();
    foreach($news as $key => $value){
      $articles[$key]['Title'] = $value[0];
      $articles[$key]['Description'] = $value[1];
      $articles[$key]['PicUrl'] = $value[2];
      $articles[$key]['Url'] = $value[3];
    }
    $data['ArticleCount'] = count($articles);
    $data['Articles'] = $articles;
    $this->oxml($data);
  }

  protected static function data2xml($xml, $data, $item = 'item') {
    foreach ($data as $key => $value) {
      /* 指定默认的数字key */
      is_numeric($key) && $key = $item;

      /* 添加子元素 */
      if(is_array($value) || is_object($value)){
        $child = $xml->addChild($key);
        self::data2xml($child, $value, $item);
      }
      else {
        if(is_numeric($value)){
          $child = $xml->addChild($key, $value);
        }
        else{
          $child = $xml->addChild($key);
          $node  = dom_import_simplexml($child);
          $cdata = $node->ownerDocument->createCDATASection($value);
          $node->appendChild($cdata);
        }
      }
    }
  }
  
  private function oxml($data){
    $xml = new \SimpleXMLElement('<xml></xml>');
    self::data2xml($xml, $data);
    exit($xml->asXML());
  }
}
