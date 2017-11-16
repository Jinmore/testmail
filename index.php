<?php
define('MIAL_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
$config=array(
   'from'=>'i_strive@126.com',//邮箱
   'fromname'=>'mydear.vip',//发送人名字
   'host'=>'smtp.126.com',//邮件服务器
   'username'=>'i_strive@126.com',//邮箱用户名
   'password'=>'******' //邮箱密码
);
function sendMail($to,$title,$content,$attachment=null)
{
  global $config;
  require MIAL_PATH.'phpmailer/class.phpmailer.php';
  $mail=new PHPMailer;
  $mail->IsSMTP();
  //是否发送html代码
  $mail->IsHTML(TRUE);
  $mail->CharSet='UTF-8';
  $mail->SMTPAuth=TRUE;
  $mail->From=$config['from'];
  $mail->FromName=$config['fromname'];
  $mail->Host=$config['host'];
  $mail->Username=$config['username'];
  $mail->Password=$config['password'];
  // 判断是否是有附件
  if($attachment != null && is_file($attachment)){
      $mail->AddAttachment($attachment);
  }
  // 发邮件端口25
  $mail->Port=25;
  $mail->AddAddress($to);
  $mail->Subject=$title;
  $mail->Body=$content;
  $re=$mail->Send()?true : $mail->ErrorInfo;
  return $re;
}
$data=sendMail("1032102865@qq.com","我爱你","你好吗，最近？");
var_dump($data);




 ?>
