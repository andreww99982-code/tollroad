<?php
session_start(); $cfg=require __DIR__.'/config.php'; $tolls=require __DIR__.'/data/tolls.php';
if($_SERVER['REQUEST_METHOD']!=='POST'||!hash_equals($_SESSION['csrf']??'',$_POST['csrf']??'')){http_response_code(403);exit('Invalid request');}
$c=$_POST['country']??'';$id=$_POST['product_id']??'';$p=null;
if(!isset($tolls[$c]))exit('Invalid country');
foreach($tolls[$c]['products'] as $x)if($x['id']===$id)$p=$x;
if(!$p||($p['dynamic']??false)||$p['price']<=0)exit('This selection requires an authorised route/category tariff integration and cannot be sold as a fixed-price item.');
$vehicle=$_POST['vehicle']??'';$plate_country=strtoupper(trim($_POST['plate_country']??''));$plate=strtoupper(trim($_POST['plate']??''));$email=trim($_POST['email']??'');
if(!preg_match('/^[A-Z0-9][A-Z0-9 ._-]{1,14}$/',$plate))exit('Invalid registration number');
if(!filter_var($email,FILTER_VALIDATE_EMAIL))exit('Invalid email');
$discount=(float)$cfg['discount_percent'];$original=(float)$p['price'];$amount=round($original*(1-$discount/100)+(float)$cfg['service_fee'],2);
$cur=$p['currency']??$tolls[$c]['currency'];$order='ET-'.date('Ymd').'-'.strtoupper(bin2hex(random_bytes(4)));
$rec=['order'=>$order,'created_at'=>date('c'),'country'=>$c,'vehicle'=>$vehicle,'plate_country'=>$plate_country,'plate'=>$plate,'email'=>$email,'start_date'=>$_POST['start_date']??'','transponder'=>$_POST['transponder']??'none','product'=>$p,'original_amount'=>$original,'discount_percent'=>$discount,'amount'=>$amount,'currency'=>$cur,'status'=>'pending'];
$orders=is_file($cfg['orders_file'])?json_decode(file_get_contents($cfg['orders_file']),true):[];$orders[]=$rec;file_put_contents($cfg['orders_file'],json_encode($orders,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE),LOCK_EX);
$params=[$cfg['payment']['amount_param']=>number_format($amount,2,'.',''),$cfg['payment']['currency_param']=>$cur,$cfg['payment']['order_param']=>$order];
$pay=$cfg['payment']['url'].(str_contains($cfg['payment']['url'],'?')?'&':'?').http_build_query($params);
?><!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width"><title><?=$order?> — EuroToll</title><link rel="icon" href="assets/favicon.png"><link rel="stylesheet" href="assets/site.css"></head><body><main class="review"><section class="reviewBox"><a class="brand dark" href="index.php"><img src="assets/favicon.png"><span>EuroToll<small>Travel across Europe</small></span></a><div class="reviewKicker">ORDER REVIEW</div><h1>Your vignette is ready to order</h1><div class="reviewRows">
<p>Country <b><?=$tolls[$c]['flag'].' '.htmlspecialchars($tolls[$c]['name'])?></b></p>
<p>Product <b><?=htmlspecialchars($p['name'])?></b></p>
<p>Vehicle <b><?=htmlspecialchars($vehicle)?></b></p>
<p>Registration <b><?=htmlspecialchars($plate_country.' · '.$plate)?></b></p>
<p>Start date <b><?=htmlspecialchars($_POST['start_date']??'')?></b></p>
<p>Email <b><?=htmlspecialchars($email)?></b></p>
</div><div class="discountLine"><span>Official rate</span><del><?=number_format($original,2,'.',' ').' '.$cur?></del></div><div class="discountLine"><span>EuroToll offer · <?=$discount?>% OFF</span><b>-<?=number_format($original-$amount,2,'.',' ').' '.$cur?></b></div><div class="total"><span>Total</span><b><?=number_format($amount,2,'.',' ').' '.$cur?></b></div><a class="payBtn" href="<?=htmlspecialchars($pay,ENT_QUOTES)?>">Proceed to secure payment →</a><p class="note">Card details are entered only on the configured payment provider. Configure the payment URL in <code>config.php</code>.</p><a href="index.php">← Back to EuroToll</a></section></main></body></html>