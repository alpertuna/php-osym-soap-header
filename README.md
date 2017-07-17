2017 OSYM SOAP Servisi için PHP SOAP Headerı
============================================

## Örnek Kullanım
```php
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
```
