<?php

require_once './main/Logger.php';
require_once './main/WhazzupAPI.php';

/*--------------------------------------------------*/
$whazzup = new WhazzupAPI();
$body = file_get_contents("php://input");
Logger::write($body);
$contentType = getallheaders()["Content-Type"];
if ($contentType == "application/json"){
    
    $data = json_decode($body,JSON_OBJECT_AS_ARRAY);
}

if (isset($data["messages"])){
    
    foreach($data["messages"] as $message){
        if (mb_ereg_match("/😂|😍|🤩|👍|😢|🔥|❤|️😮|👏|круто|шикарно|красиво/", $message["text"],"i")){
            $whazzup->answerSend($message, "Благодарим Вас за реакции 🙌");
        }
    }
}


