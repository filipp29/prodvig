<?php


class SipuniAPI {
    
    private $user = "098554";
    private $sipnumber = "201";
    private $reverse = "0";
    private $antiaon = "0";
    private $secret = "0.zkk0ao2ve9l";
    private $url = "https://sipuni.com/api/callback/call_number";
    
    /*--------------------------------------------------*/
    
    public function __construct(
            $user = "",
            $sipnumber = "",
            $secret = ""
    ) {
        $this->user = $user ? $user : $this->user;
        $this->sipnumber = $sipnumber ? $sipnumber : $this->sipnumber;
        $this->secret = $secret ? $secret : $this->secret;
    }
    
    /*--------------------------------------------------*/
    
    public function setOptions(
            $options
    ){
        $optionKeys = [
            "user",
            "sipnumber",
            "reverse",
            "antiaon",
            "secret"
        ];
        foreach($optionKeys as $key){
            if (isset($options[$key])){
                $this->$key = $options[$key];
            }
        }
    }
    
    /*--------------------------------------------------*/
    
    public function callNumber(
            $phone
    ){
        $hashString = join('+', [
            $this->antiaon, 
            $phone, 
            $this->reverse, 
            $this->sipnumber, 
            $this->user, 
            $this->secret
        ]);
        $hash = md5($hashString);
        $query = http_build_query([
            'antiaon' => $this->antiaon,
            'phone' => $phone,
            'reverse' => $this->reverse,
            'sipnumber' => $this->sipnumber,
            'user' => $this->user,
            'hash' => $hash
        ]);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
        
    }
    
    /*--------------------------------------------------*/
    
}



