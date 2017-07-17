<?php
/**
 * File: ornek.php
 * @author H.Alper Tuna <halpertuna@gmail.com>
 * Date: 12.07.2017
 * Last Modified Date: 12.07.2017
 * Last Modified By: H.Alper Tuna <halpertuna@gmail.com>
 */

require 'SoapOsymHeader';

$wsdl = "https://vps.osym.gov.tr/Ext/Provider/BilgiServisi/Sonuc?wsdl";
$kullanici = 'kullanici';
$sifre = '******';
$istemci = new SoapClient($wsdl, array(
  // Http basic auth
  'login' => $kullanici,
  'password' => $sifre,
 ));
$istemci->__setSoapHeaders([new SoapOsymHeader($kullanici, $sifre)]);

print_r($istemci->__getFunctions());

$cevap = $istemci->SinavGrupBilgileriniGetir();

print_r($cevap);
