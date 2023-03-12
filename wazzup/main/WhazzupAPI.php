<?php


class WhazzupAPI {
    
    private $bearer = "96711d7ff0634f898a2ea27f6dfb3d30";
    
    /*--------------------------------------------------*/
    
    public function answerSend(
            $message,
            $params
    ){
        $data = [
            "channelId" => $params["channelId"],
            "chatType" => $params["chatType"],
            "chatId" => $params["chatId"],
            "text" => $message
        ];
        $body = json_encode ($data, JSON_UNESCAPED_UNICODE);
        $curl = curl_init('https://api.wazzup24.com/v3/message');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,[
           "Content-Type: application/json",
           "Content-Length: " . strlen($body),
           "Authorization: Bearer {$this->bearer}"     
        ]);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    
    /*--------------------------------------------------*/
    
}
