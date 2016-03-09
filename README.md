# SAE-TShoot
使用[ThinkPHP](http://document.thinkphp.cn)框架编写的新浪云引擎自助排障工具，目前支持排除域名绑定故障。

http://sae-tshoot.pumpkin.name/

## 运行环境
* PHP（与ThinkPHP框架要求相同：PHP5.3以上版本，不支持PHP5.3dev版本和PHP6）
* 如在SAE上运行需启用Memcache

## 检测原理
* 通过使用[DNSPOD D+ 服务](https://www.dnspod.cn/httpdns)进行DNS解析，根据我撰写的[SAE域名绑定自助排障指南](http://saebbs.com/forum.php?mod=viewthread&tid=31256&fromuid=28205)中的策略进行检测
