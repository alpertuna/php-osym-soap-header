<?php
/**
 * File: SoapOsymHeader.php
 * @author H.Alper Tuna <halpertuna@gmail.com>
 * Date: 12.07.2017
 * Last Modified Date: 12.07.2017
 * Last Modified By: H.Alper Tuna <halpertuna@gmail.com>
 */

class SoapOsymHeader extends SoapHeader {
    private $wss_ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';
    private $wsu_ns = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd';
    private $type_password_digest= 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest';
    private $type_password_text= 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText';
    private $encoding_type_base64 = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary';

    private function authText($user, $pass) {
        $auth = new stdClass();
        $auth->Username = new SoapVar($user, XSD_STRING, NULL, $this->wss_ns, NULL, $this->wss_ns);
        $auth->Password = new SoapVar('<ns2:Password Type="'.$this->type_password_text.'">' . $pass . '</ns2:Password>', XSD_ANYXML );
        return $auth;
    }

    function __construct($user, $pass) {
        $auth = $this->authText($user, $pass);
        $username_token = new stdClass();
        $username_token->UsernameToken = new SoapVar($auth, SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'UsernameToken', $this->wss_ns);

        $security_sv = new SoapVar(
            new SoapVar($username_token, SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'UsernameToken', $this->wss_ns),
            SOAP_ENC_OBJECT, NULL, $this->wss_ns, 'Security', $this->wss_ns);
        parent::__construct($this->wss_ns, 'Security', $security_sv, true);
    }
}
