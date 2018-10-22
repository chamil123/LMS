<?php

class valid {

    public static function validLength($txt, $len) {
        return strlen($txt) > 1 && strlen($txt) <= $len;
    }

    public static function valiedLettersAndSpace($tex) {
        if (ctype_alpha(str_replace(' ', '', $tex)) === false) {
            $final = FALSE;
        } else {
            $final = TRUE;
        }
        return $final;
    }

    public static function valiedLettersNumbersAndSpace($text) {
        $pattern = '/^[a-zA-Z0-9 ]+$/';
        return preg_match($pattern, $text);
    }

    public static function validNIC($nic) {
        $final = TRUE;
        if (!(substr($nic, strlen($nic) - 1, 1) == "v" || substr($nic, strlen($nic) - 1, 1) == "V")) {
            $final = FALSE;
        }
        if (strlen($nic) == 12 || strlen($nic) == 10) {
            $final = TRUE;
        } else {
            $final = FALSE;
        }
        return $final;
    }

    public static function validEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function validUrl($email) {
        return filter_var($email, FILTER_VALIDATE_URL);
    }

    public static function validINT($email) {
        return filter_var($email, FILTER_VALIDATE_INT);
    }

    public static function validFloat($email) {
        return filter_var($email, FILTER_VALIDATE_FLOAT);
    }

    public static function validLettersAndNumbers($txt) {
        return preg_match("/^[a-z0-9]+$/i", $txt);
    }

    public static function validSpecialChars($txt) {
        return !preg_match("/^[a-z0-9]+$/i", $txt);
    }

    public static function validNumbersOnly($txt) {
        return preg_match("/^[0-9]+$/i", $txt);
    }

    public static function validLettersOnly($txt) {
        return preg_match("/^[a-z]+$/i", $txt);
    }

    public static function validPassword($pass) {
        if (strlen($pass) < 5) {
            return FALSE;
        }
        if (!preg_match("/[$&@#\/%?=~_|!:,.;^*]/", $pass)) {
            return FALSE;
        }
        if (!preg_match("/[a-z]/", $pass)) {
            return FALSE;
        }
        if (!preg_match("/[A-Z]/", $pass)) {
            return FALSE;
        }
        if (!preg_match("/[0-9]/", $pass)) {
            return FALSE;
        }
        return TRUE;
    }

    public static function encryptIt($q) {
        $cryptKey = 'Wxq1EJRc6vYBf2Tze@q#0a!r;:Gt[{In3]5}7\+-_UB=|418xLfG0,9.5P3ej/f?yCl"p';
        $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return( $qEncoded );
    }

    public static function decryptIt($q) {
        $cryptKey = 'Wxq1EJRc6vYBf2Tze@q#0a!r;:Gt[{In3]5}7\+-_UB=|418xLfG0,9.5P3ej/f?yCl"p';
        $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return( $qDecoded );
    }

}
