<?php

header("Content-type:text/html;charset=utf-8");

  function Get_host($host)
  {  //解析域名
    $Get_host=gethostbyname($host);
    echo "尝试连接 $host ...<br>\r\n ";
    if(!$Get_host)
    {
      echo "解析失败 (1)<HR>";
    }elseif($Get_host==$host){
      echo "解析失败 (2)： 可能是一个无效的主机名<HR>";
    }else{
      echo "域名解析为 $Get_host ...<br>\r\n";
      Open_host($host);
    } //解析成功，连接主机
    //函数结束
  }
  function Open_host($host)
  {  //连接主机函数
      if(function_exists('fsockopen'))
      {
        $fp = fsockopen($host,25,$errno,$errstr,60);
      }elseif(function_exists('pfsockopen'))
      {
        echo "服务器不支持Fsockopen，尝试pFsockopen函数 ...<br>\r\n";
        $fp = pfsockopen($host,25,$errno,$errstr,60);
      }else{
      exit('服务器不支持Fsockopen函数');}
      if(!$fp){
        echo "代号：$errno,<br>\n错误原因：$errstr<HR>";
    }else{
    echo "SMTP服务器连接ok!<br>\r\n";
    fwrite($fp, "");
    $out0= fgets($fp, 128);
    #echo $out0; //打印主机返回的数据包内容
    if (strncmp($out0,"220",3)==0){ // 判断三位字符内容
        echo '220 SMTP服务端响应正常<HR>';
    }else{
        echo '服务器端错误<HR>';}
    }
   //函数结束
}

//SMTP服务器地址

$site = array("smtp.163.com","smtp.sina.cn","smtp.sina.com","smtp.qqq.com","smtp.126.com");



//调运脚本

$host="smtp.sina.com";

echo Get_host($host);



/*foreach ($site as $host)

{

  echo Get_host($host);

}

*/

// for ($i=0; $i<=4; $i++)
//
// {
//
// $host= $site[$i];
//
//  echo Get_host($host);
//
// }


?>
