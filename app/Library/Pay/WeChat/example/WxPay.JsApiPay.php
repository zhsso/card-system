<?php
require_once '../lib/WxPay.Api.php'; class JsApiPay { public $data = null; public function GetOpenid() { if (!isset($_GET['code'])) { $sp1937f9 = urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']); $sp78f833 = $this->__CreateOauthUrlForCode($sp1937f9); Header("Location: {$sp78f833}"); die; } else { $sp14e657 = $_GET['code']; $sp26d38e = $this->getOpenidFromMp($sp14e657); return $sp26d38e; } } public function GetJsApiParameters($spb0157f) { if (!array_key_exists('appid', $spb0157f) || !array_key_exists('prepay_id', $spb0157f) || $spb0157f['prepay_id'] == '') { throw new WxPayException('参数错误'); } $sp16cabe = new WxPayJsApiPay(); $sp16cabe->SetAppid($spb0157f['appid']); $spe55180 = time(); $sp16cabe->SetTimeStamp("{$spe55180}"); $sp16cabe->SetNonceStr(WxPayApi::getNonceStr()); $sp16cabe->SetPackage('prepay_id=' . $spb0157f['prepay_id']); $sp16cabe->SetSignType('MD5'); $sp16cabe->SetPaySign($sp16cabe->MakeSign()); $sp277ac1 = json_encode($sp16cabe->GetValues()); return $sp277ac1; } public function GetOpenidFromMp($sp14e657) { $sp78f833 = $this->__CreateOauthUrlForOpenid($sp14e657); $sp7a336f = curl_init(); curl_setopt($sp7a336f, CURLOPT_TIMEOUT, $this->curl_timeout); curl_setopt($sp7a336f, CURLOPT_URL, $sp78f833); curl_setopt($sp7a336f, CURLOPT_SSL_VERIFYPEER, FALSE); curl_setopt($sp7a336f, CURLOPT_SSL_VERIFYHOST, FALSE); curl_setopt($sp7a336f, CURLOPT_HEADER, FALSE); curl_setopt($sp7a336f, CURLOPT_RETURNTRANSFER, TRUE); if (WxPayConfig::CURL_PROXY_HOST != '0.0.0.0' && WxPayConfig::CURL_PROXY_PORT != 0) { curl_setopt($sp7a336f, CURLOPT_PROXY, WxPayConfig::CURL_PROXY_HOST); curl_setopt($sp7a336f, CURLOPT_PROXYPORT, WxPayConfig::CURL_PROXY_PORT); } $spa4652a = curl_exec($sp7a336f); curl_close($sp7a336f); $sp151100 = json_decode($spa4652a, true); $this->data = $sp151100; $sp26d38e = $sp151100['openid']; return $sp26d38e; } private function ToUrlParams($sp325b55) { $spd48832 = ''; foreach ($sp325b55 as $sp08a7aa => $sp99652d) { if ($sp08a7aa != 'sign') { $spd48832 .= $sp08a7aa . '=' . $sp99652d . '&'; } } $spd48832 = trim($spd48832, '&'); return $spd48832; } public function GetEditAddressParameters() { $sp07c24d = $this->data; $sp151100 = array(); $sp151100['appid'] = WxPayConfig::APPID; $sp151100['url'] = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; $sp5cd2af = time(); $sp151100['timestamp'] = "{$sp5cd2af}"; $sp151100['noncestr'] = '1234568'; $sp151100['accesstoken'] = $sp07c24d['access_token']; ksort($sp151100); $sp50fc45 = $this->ToUrlParams($sp151100); $sp87e238 = sha1($sp50fc45); $spa77c55 = array('addrSign' => $sp87e238, 'signType' => 'sha1', 'scope' => 'jsapi_address', 'appId' => WxPayConfig::APPID, 'timeStamp' => $sp151100['timestamp'], 'nonceStr' => $sp151100['noncestr']); $sp277ac1 = json_encode($spa77c55); return $sp277ac1; } private function __CreateOauthUrlForCode($sp008cb3) { $sp325b55['appid'] = WxPayConfig::APPID; $sp325b55['redirect_uri'] = "{$sp008cb3}"; $sp325b55['response_type'] = 'code'; $sp325b55['scope'] = 'snsapi_base'; $sp325b55['state'] = 'STATE' . '#wechat_redirect'; $sp2196c7 = $this->ToUrlParams($sp325b55); return 'https://open.weixin.qq.com/connect/oauth2/authorize?' . $sp2196c7; } private function __CreateOauthUrlForOpenid($sp14e657) { $sp325b55['appid'] = WxPayConfig::APPID; $sp325b55['secret'] = WxPayConfig::APPSECRET; $sp325b55['code'] = $sp14e657; $sp325b55['grant_type'] = 'authorization_code'; $sp2196c7 = $this->ToUrlParams($sp325b55); return 'https://api.weixin.qq.com/sns/oauth2/access_token?' . $sp2196c7; } }