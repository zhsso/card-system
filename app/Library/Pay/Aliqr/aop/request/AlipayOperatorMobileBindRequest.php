<?php
class AlipayOperatorMobileBindRequest { private $checkSigncard; private $fReturnUrl; private $hasSpi; private $operatorName; private $provinceName; private $sReturnUrl; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setCheckSigncard($spf9d3f7) { $this->checkSigncard = $spf9d3f7; $this->apiParas['check_signcard'] = $spf9d3f7; } public function getCheckSigncard() { return $this->checkSigncard; } public function setfReturnUrl($sp8fc8e5) { $this->fReturnUrl = $sp8fc8e5; $this->apiParas['f_return_url'] = $sp8fc8e5; } public function getfReturnUrl() { return $this->fReturnUrl; } public function setHasSpi($sp8114e9) { $this->hasSpi = $sp8114e9; $this->apiParas['has_spi'] = $sp8114e9; } public function getHasSpi() { return $this->hasSpi; } public function setOperatorName($spa2331e) { $this->operatorName = $spa2331e; $this->apiParas['operator_name'] = $spa2331e; } public function getOperatorName() { return $this->operatorName; } public function setProvinceName($sp631dab) { $this->provinceName = $sp631dab; $this->apiParas['province_name'] = $sp631dab; } public function getProvinceName() { return $this->provinceName; } public function setsReturnUrl($sp5c55c4) { $this->sReturnUrl = $sp5c55c4; $this->apiParas['s_return_url'] = $sp5c55c4; } public function getsReturnUrl() { return $this->sReturnUrl; } public function getApiMethodName() { return 'alipay.operator.mobile.bind'; } public function setNotifyUrl($sp9f70c8) { $this->notifyUrl = $sp9f70c8; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($sp16ae99) { $this->returnUrl = $sp16ae99; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($sp3fbe16) { $this->terminalType = $sp3fbe16; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($sp130e84) { $this->terminalInfo = $sp130e84; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp031480) { $this->prodCode = $sp031480; } public function setApiVersion($spad1878) { $this->apiVersion = $spad1878; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($sp6c9cdb) { $this->needEncrypt = $sp6c9cdb; } public function getNeedEncrypt() { return $this->needEncrypt; } }