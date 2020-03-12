<?php namespace Trihtm\RSA\Encode;

class Encode{

	static $keyBase64 	= '!#%#@%$#fgameth#@%#@andieu!@$%@!';

    public static function encodeBase64($string)
    {
        $string = base64_encode($string);

        $returnString   = "";
        $charsArray     = str_split("e7NjchMCEGgTpsx3mKXbVPiAqn8DLzWo_6.tvwJQ-R0OUrSak954fd2FYyuH~1lIBZ");
        $charsLength    = count($charsArray);
        $stringArray    = str_split($string);
        $keyArray       = str_split(md5(static::$keyBase64));
        $randomKeyArray = array();

        while(count($randomKeyArray) < $charsLength){
            $randomKeyArray[] = $charsArray[rand(0, $charsLength-1)];
        }

        for ($a = 0; $a < count($stringArray); $a++){
            $numeric = ord($stringArray[$a]) + ord($randomKeyArray[$a%$charsLength]);
            $returnString .= $charsArray[floor($numeric/$charsLength)];
            $returnString .= $charsArray[$numeric%$charsLength];
        }

        $randomKeyEnc = '';
        for ($a = 0; $a < $charsLength; $a++){
            $numeric = ord($randomKeyArray[$a]) + ord($keyArray[$a%count($keyArray)]);
            $randomKeyEnc .= $charsArray[floor($numeric/$charsLength)];
            $randomKeyEnc .= $charsArray[$numeric%$charsLength];
        }

        return $randomKeyEnc.md5($string).$returnString;
    }

    public static function decodeBase64($string)
    {
        $returnString   = "";
        $charsArray     = str_split("e7NjchMCEGgTpsx3mKXbVPiAqn8DLzWo_6.tvwJQ-R0OUrSak954fd2FYyuH~1lIBZ");
        $charsLength    = count($charsArray);
        $keyArray       = str_split(md5(static::$keyBase64));
        $stringArray    = str_split(substr($string,($charsLength*2)+32));
        $md5            = substr($string,($charsLength*2),32);
        $randomKeyArray = str_split(substr($string,0,$charsLength*2));
        $randomKeyDec   = array();

        for ($a = 0; $a < $charsLength*2; $a+=2){
            $numeric = array_search($randomKeyArray[$a],$charsArray) * $charsLength;
            $numeric += array_search($randomKeyArray[$a+1],$charsArray);
            $numeric -= ord($keyArray[floor($a/2)%count($keyArray)]);
            $randomKeyDec[] = chr($numeric);
        }

        for ($a = 0; $a < count($stringArray); $a+=2){
            $numeric = array_search($stringArray[$a],$charsArray) * $charsLength;
            $numeric += array_search($stringArray[$a+1],$charsArray);
            $numeric -= ord($randomKeyDec[floor($a/2)%$charsLength]);
            $returnString .= chr($numeric);
        }

        return (md5($returnString) != $md5) ? false : base64_decode($returnString);
    }

}