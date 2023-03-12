<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



class Bitrix24Api
{   
    public $WEBHOOK_URL; // Вебхук 
    
    const LOG_ON = 1; // Включить логирование
    //const LOG_ON = 1; // Путь к лог файлу
    
    //Подключение файлов
    public $file_Log;
  
    public function __construct($WEBHOOK_URL, $file_Log) {  
        $this->WEBHOOK_URL = $WEBHOOK_URL;
        $this->file_Log = $file_Log; // Путь к лог файлу
    }
    
    public function user_get ($user_id) { // Запрос пользователя по id
        
        $queryData = [
            //'filter' => [
                "ACTIVE" => true, 
           //     "ADMIN_MODE" => true, 
                "ID" => $user_id,
          //  ],
           // 'SELECT' => ["*", "UF_*", "UF_ALTEG_DOCTOR_ID"]       
           // 'SELECT' => ["ID"]       
        ];
 
        $this->toLog('Отправляем данные для запроса Пользователя Б24', $queryData);
        $user = $this->requestCurl('user.get', $queryData);
        $user = $user['result']; 
        $this->toLog('Получен пользователь из Б24', $user);
        return  $user;
    }
    
   
    public function deal_get ($deal_id) { // Запрос Сделки
        
        $queryData = [
            'id'  => $deal_id   
        ];
 
        $this->toLog('Отправляем данные для запроса Сделки', $queryData);
        $deal = $this->requestCurl('crm.deal.get', $queryData);
        $deal = $deal['result']; 
        //$this->toLog('Получена сделка', $deal);
        return  $deal;
    }
    // Обновления Сделки
    function deal_update ($deal_id, $fiels) {
        $queryData = [
                    'id'  => $deal_id,
                    'fields' =>  $fiels, 
        ];
        $this->toLog('Отправляем данные для обновления Сделки', $queryData);

        $b24_resp = $this->requestCurl('crm.deal.update', $queryData);
        $this->toLog('Б24. Обновляем Сделку', $b24_resp);  
    }
    
    // Запрос списка Сделок crm.deal.list
    public function crm_deal_list ($filter, $select = ["*", "UF_*"]) {
        $queryData = [
            'order' => [ "ID" => "ASC" ],
            'filter' => $filter,
            'select' => $select,
        ]; 
  
        $this->toLog('Запрашиваем список Сделок', $queryData);
        $b24_deals = $this->requestCurl('crm.deal.list', $queryData); 
        $b24_deals = $b24_deals['result'];  
        $this->toLog('Получены сделки', $b24_deals); 
        return $b24_deals; 
    }
    
    public function contact_get ($contact_id) { // Запрос Сделки
        
        $queryData = [
            'id'  => $contact_id   
        ];

        $this->toLog('Отправляем данные для запроса Контакта', $queryData);
        $contact = $this->requestCurl('crm.contact.get', $queryData);
        $contact = $contact['result']; 
        return  $contact;
    }
    
    public function deal_productrows_get ($deal_id, $select = ["*","UF_*"]) { // Запрос Сделки
        
        $query_productrows = [
            'ID' => $deal_id,  //Связано с пользователем по ID
            'select' => $select,
        ]; 

        
        $products_list = $this->requestCurl('crm.deal.productrows.get', $query_productrows); 
        $products_list = $products_list['result'];
        return $products_list;
    }
    
    function product_get( $product_id, $select = ['*', 'PROPERTY_*'] ) {
        // Получаем товары из Битрикс
        $queryData = array(
            "ID" => $product_id, 
            'SELECT' => $select, 
        );

        $product = $this->requestCurl('crm.product.get', $queryData);
        $product = $product["result"];
        return $product;
    }
    /*
     * Возвращает пользовательское поле сделок по идентификатору.
     * @param integer userfield_id - Идентификатор поля.
     */
    
    public function crm_deal_userfield_get ($userfield_id) { // Запрос Сделки
        
        $queryData = [
            'id'  => $userfield_id   
        ];
 
        $this->toLog('пользовательское поле сделок по идентификатору', $queryData);
        $userfield = $this->requestCurl('crm.deal.userfield.get', $queryData);
        $userfield = $userfield['result']; 
        return  $userfield;
    }
    
    /*
     * Возвращает список пользовательских полей сделок по фильтру.
     * @param integer filter - Поля фильтра.
     */ 
    
    public function crm_deal_userfield_list ($filter) { // Запрос Сделки
        
        $queryData = [
            'order' => [ "ID" => "ASC" ],
            'filter' => $filter,  
        ];
 
        $this->toLog('пользовательское поле сделок по идентификатору', $queryData);
        $userfield = $this->requestCurl('crm.deal.userfield.list', $queryData);
        $userfield = $userfield['result']; 
        return  $userfield;
    }
    
    
            
            
    public function lists_element_get($IBLOCK_ID, $FILTER) {
  
        $queryData = [
            'IBLOCK_TYPE_ID'  => 'lists',
            'IBLOCK_ID'  => $IBLOCK_ID,
            // 'ORDER' => ["ID" => 'ASC'],  // сортируем по ID
            'FILTER' => $FILTER,
        ]; 
        
        $this->toLog('Запрос из Списков с id', $queryData);

        $lists = $this->requestCurl('lists.element.get', $queryData);
        return $lists['result'];
    }
    //    Тип элемента, к которому привязан комментарий.
    //    Значения:
    //    @param lead - лид;
    //    @param deal - сделка;
    //    @param contact - контакт;
    //    @param company - компания;
    //    @param order - заказ. 
//    public function sendComm($ENTITY_ID, $comment, $ENTITY_TYPE = "deal") {
//        
//        $queryData = (array(
//            "fields" => array(
//                "ENTITY_ID" => $ENTITY_ID,
//                "ENTITY_TYPE" => $ENTITY_TYPE,
//                "COMMENT" => $comment,
//            ),
//        ));
//        $this->toLog("Отправляем комментарий к Сущности: $ENTITY_TYPE $ENTITY_ID", $comment);
//
//        $comment = $this->requestCurl('crm.timeline.comment.add', $queryData);
//        return $comment; // ['result']; 
//    }
    
    
    
    
    public function sendComm($ENTITY_ID, $comment, $ENTITY_TYPE = "deal", $USER_ID = null) {
        
        $queryData = (array(
            "fields" => array(
                "ENTITY_ID" => $ENTITY_ID,
                "ENTITY_TYPE" => $ENTITY_TYPE,
                "COMMENT" => $comment,
            ),
        ));
        $this->toLog("Отправляем комментарий к Сущности: $ENTITY_TYPE $ENTITY_ID", $comment);
        $resp = $this->requestCurl('crm.timeline.comment.add', $queryData);
        
        if($USER_ID) {
            $queryData2 = (array(
              //  "FIELDS" => array(
                    "USER_ID" => $USER_ID, 
                    "MESSAGE" => $comment,
                    // "TAG" => $comment, 
              //  ),
            ));
            $this->toLog("Отправляем сообщение менеджеру: ", $queryData2);
            $resp = $this->requestCurl('im.notify.system.add', $queryData2);
            
        } 
        return $resp; // ['result']; 
    }
    
    
    
    public function requestCurl($link, $POSTFIELDS = null) // Для одиночных запросов (максимум 50 записей)
    {

        $curl=curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->WEBHOOK_URL.''.$link);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_POSTFIELDS, http_build_query($POSTFIELDS));
        $out = curl_exec($curl);
        $code = curl_getinfo($curl,CURLINFO_HTTP_CODE); // Получим HTTP-код ответа сервера
        
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        
        curl_close($curl); // Завершаем сеанс cURL
        //var_dump($out);
        $code = (int)$code;
        $errors = array(
            301 => 'Переехал навсегда',
            400 => 'Неверный запрос',
            401 => 'Несанкционированное',
            403 => 'Запрещено',
            404 => 'Не найдено',
            500 => 'Внутренняя ошибка сервера',
            502 => 'Плохой шлюз',
            503 => 'Сервис недоступен'
        );
        
        if ($errno) {
            $this->toLog('Запрос произвести не удалось: ' . $error, $errno);
        }
        
        if($code!=200 && $code!=204) {
            $this->toLog("Ответ/ошибка Bitrix",(isset($errors[$code]) ? $errors[$code] : 'Неизвестная ошибка'));
            $this->toLog("Описание", $out);
              //file_put_contents($process_file, ""); // Разрешаем следующий запуск скрипта
             //  toLog("Разрешаем следующий запуск скрипта");
           // die;
        }
        $Response = json_decode($out, true);
        // toLog("Ответ Bitrix", $Response);

        return($Response);
    }
    
    // Запише логи в файл
    public function toLog($textTitl='',$textLog='') {

        if (self::LOG_ON) { 

            
            file_put_contents($this->file_Log, "\n\r".'======================= '.date('Y-m-d H:i:s') .'======================= '."\n", FILE_APPEND);
            file_put_contents($this->file_Log, $textTitl."\n\r".print_r($textLog, true), FILE_APPEND);
            echo ('======================= '.date('Y-m-d H:i:s') .'======================= </br>');
            echo $textTitl ."</br>";
            echo "<pre>";
    
               // print_r($textLog, true);
            
                  var_dump($textLog);
                //  print_r($textLog, true);
            
            echo "</pre>";

        }
    } 
    public function toLogClean() { // Очистим лог файл
        file_put_contents($this->file_Log, '');
    }

}