<?php

date_default_timezone_set('Asia/Almaty');

//echo "JSON Счета для 1С";
//
//echo "<pre>";

// адрес скрипта https://_______.kz/script/1c-roofing-center/to1c.php

define('DIR_ROOT', dirname(__FILE__));

// $file_Log = DIR_ROOT . '/config/logFile-to1c.txt'; // Путь к лог файлу
// $file_Log = DIR_ROOT . '/config/logFile.txt'; // Путь к лог файлу
// $cookie = DIR_ROOT . '/config/cookie.txt';   // Путь для файла cookie.txt

require_once ( DIR_ROOT . '/config/config.php' );


// Адрес 1с сервера
// $url_1c = "https://_______.ru/id20822-testASip/hs/Exchange/putorder";  // Старый адрес на тестовый сервис
   $url_1c = "http://______.cl/KC1_150422_bitrix24_test/hs/Exchange/putorder";  // Для передачи данных POST 


$iblockId = 25; //  тип информационного блока;

########     Товар карточка  ################  
$field_uid = FILD_PRODUCT_1C_UID;
const INVOICE_UID_1C = 'UF_CRM_1668598758368'; // Поле - 1С. uid счета
const INVOICE_NUMBER_1C = 'UF_CRM_1668598670132'; // Поле - 1С.Номер счета


#########   Документ Счет на Товар    ###########
const DOCUMENT_COMPANY_TEMPLATE_ID = 97; // Юр лицо Идентификатор шаблона
const DOCUMENT_CLIENT_TEMPLATE_ID = 195; //Физ лицо Идентификатор шаблона


file_put_contents($file_Log, '');


toLog("Приняли POST", $_POST);
toLog("Приняли GET", $_GET);

// !!!!!!!!!!  тестовая сделка
//$_GET['deal'] = 1903; 
//
// Принимаем ID ползователя с портала
$portal_user_id = preg_replace("/[^0-9]/", '', $_GET['portal_user_id']); // Вытащим ID текущего пользователя 


$document_id = $_POST['document_id'];
if($_GET['deal'] !='') {

    $document_id[1] = 'CCrmDocumentDeal';  
    $document_id[2] = $_GET['deal'];  // company
    // $document_id[2] =  4715; // contact
}



// Ловим вебХук из Битрикса  
if ($document_id[1] == 'Bitrix\Crm\Integration\BizProc\Document\SmartInvoice') { // Если отправлен ID Счета 
    
    $invoice_id = preg_replace("/[^0-9]/", '', $document_id[2]); // Вытащим номер счета
    
    // Через Счет узнаем ID Сделки
    $queryinvoice = [
     "id" => $invoice_id,
        "entityTypeId" => "31",
    ];
 
    usleep(200000);
    $invoice = requestBitrix('crm.item.get', $queryinvoice); 

    // toLog('invoice', $invoice); 
    $deal_id = $invoice['result']['item']['parentId2']; // Номер Сделки
    $invoice_user_id = $invoice['result']['item']['createdBy']; // Создатель счета
    
    toLog('Создатель счета invoice_user_id', $invoice_user_id); 
// die;
    
} elseif ($document_id[1] == 'CCrmDocumentDeal') {  // Если сделка
                
    

    $deal_id = preg_replace("/[^0-9]/", '', $document_id[2]);
          //  echo 'lead-'. $deal_id;
       
  
} else {    
            //echo 'Стоп. ВебХук вызван не сделкой';
            if($_POST) toLog('Стоп. ВебХук вызван не сделкой', $_POST);

            $sinhro_array = (file_get_contents($file_Log));

            echo "<pre>logs<br>";
            var_dump($sinhro_array);
                        
            die;
        }


if(!$deal_id>0) {
    toLog('Ошибка. получения ID Сделки', $deal); 
    die;
}

//$res_1c = sendTo1c($url_1c, []);
//tolog($res_1c);
//die;

########## Структура Сделки / Счета / Deal
// Получаем ID контакта из сделки
$queryData = array(
   'id'  => $deal_id   
);

toLog('Запрашиваем сделку', $queryData);
$deal = requestBitrix('crm.deal.get', $queryData);
$deal = $deal['result']; 
toLog('Получена сделка', $deal);
    
//$data_to1c['Zakaz']['KNP'] = null;

// if($deal["UF_CRM_1636266001"]==111)
//$data_to1c['Zakaz']['KNP'] = 710;   

// услуга                                         ["UF_CRM_1636266001"]=>    string(3) "109"
//if($deal["UF_CRM_1636266001"]==109)
//$data_to1c['Zakaz']['KNP'] = 852;   

// Дата создания
//$data_to1c['Zakaz']['DateCreat']= date("d.m.Y", strtotime($deal["DATE_CREATE"]));

// Номер Сделки
//$data_to1c['Zakaz']['Number'] = $deal["ID"];

// ответсвенный ID
$ASSIGNED_BY_ID = $deal["ASSIGNED_BY_ID"];




// Получаем пользователей из Битрикс
$queryData = array(
    'filter' => [
       "active" => true,
        "ID" => $ASSIGNED_BY_ID,
    ],
     'select' => ["*"]
);
usleep(200000);
$bitrix_user = requestBitrix('user.search', $queryData);
$bitrix_user = $bitrix_user['result'][0]; 
$data_to1c['Zakaz']['User'] = $bitrix_user["NAME"].' '. $bitrix_user["LAST_NAME"]; 


// Комментарий Сделки
$data_to1c['Zakaz']['Sklad'] = '000000004';

// Комментарий Сделки
$data_to1c['Zakaz']['Comment'] = $deal["COMMENTS"];

/*Добавление uid-1C--------------------------------------------------*/

$data_to1c["Zakaz"]["uid-1C"] = $bitrix_user["ID"];

/*--------------------------------------------------*/

########## Структура Компании / Контрагента / Company
//  "Company": {
//    "Title": "ТОО Рога и копыта",
//    "BIN": 830220320263,
//    "KBE": 19





########### Все Контакты Сделки ########################################

$queryData = array(
    'id'  => $deal_id,         
);
$contacts_b24 = requestBitrix('crm.deal.contact.items.get', $queryData);
$contacts_b24 = $contacts_b24['result']; 
toLog('Все Конакты у Сделки $deal_id', $contacts_b24);

// Если есть второй контакт у Сделки, то берем его
if($contacts_b24['1']['CONTACT_ID']) {
    $contact_id = $contacts_b24['1']['CONTACT_ID'];
    $deal_contacts = 2; // у Сдеки два контакта

} else {
    $contact_id = $deal['CONTACT_ID'];
    $deal_contacts = 1; // у Сдеки один контакт
    
}

toLog('Выбираем Контакт', $contact_id);


########### Контакт ########################################

$queryData = array(
    'id'  => $contact_id,      
    'select' => ["*","UF_*"],    
);
$CONTACT_b24 = requestBitrix('crm.contact.get', $queryData);
$CONTACT_b24 = $CONTACT_b24['result']; 
toLog('crm.contact.get', $CONTACT_b24);

//$data_to1c['Contact']['ID'] = $CONTACT_b24["ID"];

$CONTACT_FIO = trim($CONTACT_b24['LAST_NAME'] .' '. $CONTACT_b24['NAME'] .' '. $CONTACT_b24['SECOND_NAME']);
//$data_to1c['Contact']['Title'] = $CONTACT_FIO;  


foreach ($CONTACT_b24['PHONE'] as $key => $value) {
   // print_r($value); die;
   // if($value['VALUE'] != '') $data_to1c['Contact']['Phone'] = $value['VALUE'];
    if($value['VALUE'] != '') $contact_phone = $value['VALUE'];
    
}
foreach ($CONTACT_b24['EMAIL'] as $key => $value) {
   // print_r($value); die;
   // if($value['VALUE'] != '') $data_to1c['Contact']['Email'] = $value['VALUE'];
    if($value['VALUE'] != '') $contact_email = $value['VALUE'];
    
}



###########   Реквизиты Контакта    ####################
$query_requisite = [
    "filter" => array(
        "ENTITY_ID" => $contact_id, // $CONTACT_b24["ID"],
        "ENTITY_TYPE_ID" => 3,  // "Контакт"
       // "PRESET_ID"=> 1
    ),
    'select' => ["*","UF_*"]
    ];
usleep(200000);
toLog('query_requisite', $query_requisite);

$contact_requisite = requestBitrix('crm.requisite.list', $query_requisite); 
$contact_requisite = $contact_requisite['result'][0];    

toLog('Реквизиты Контакта contact_requisite', $contact_requisite);
// $data_to1c['Contact']['IIN'] = $contact_requisite['RQ_INN'];
 


#######  Реквизиты КОнтакта, добавить ФИО   #########
// Если у сделки один Контакт, необходимо скопировать его ФИО в реквизиты ФЛ, в поле ФИО, если там пусто
//if (($deal_contacts == 1) && ($contact_requisite['ID'] > 0) && ($contact_requisite['RQ_NAME'] == '')) {
//    
//    toLog('в Реквизиты физ лица добавляем ФИО из карточки Контакта.');
//    
//    $query_requisite = [
//        "id" => $contact_requisite['ID'],
//        "fields" => array(
//            "RQ_NAME" => $CONTACT_FIO,
//        ),
//    ];
//    usleep(200000);
//    toLog('crm.requisite.add', $query_requisite);
//
//    $contact_requisite_add = requestBitrix('crm.requisite.update', $query_requisite);   
//
//    toLog('Результат добавления ФИО в реквизиты Контакта', $contact_requisite_add);
//    
//} else {
//            toLog('в Реквизиты физ лица заполнено поле ФИО.');
//        }




#######   Получаем пользователей из Битрикс   #########
//$queryData = array(
//    'filter' => [
//       "active" => true,
//        "ID" => $CONTACT_b24['CREATED_BY_ID'],
//    ],
//     'select' => ["*"]
//);
//usleep(200000);
//$bitrix_user = requestBitrix('user.search', $queryData);
//$bitrix_user = $bitrix_user['result'][0]; 
//$data_to1c['Contact']['Creator'] = $bitrix_user["NAME"].' '. $bitrix_user["LAST_NAME"]; 



###########   Адрес Контакта    ####################
if($contact_requisite['ID'] > 0) {
    $query_address = [
        "filter" => array(
          //  "ENTITY_ID" => $deal["COMPANY_ID"],
           "ENTITY_ID" => $contact_requisite['ID'], //
           "ENTITY_TYPE_ID" => 8, // Реквизиты
        ),
    ];
    usleep(200000);
    toLog('crm.address.list', $query_address); 

    $contact_address = requestBitrix('crm.address.list', $query_address); 

    $contact_address = $contact_address['result']; 
}
toLog('Адрес Конакта crm.address.list', $contact_address);
    
//$data_to1c['Contact']['Address']['Country'] = $contact_address[0]["COUNTRY"];
//$data_to1c['Contact']['Address']['City'] = $contact_address[0]["CITY"];
//$data_to1c['Contact']['Address']['Address'] = $contact_address[0]["ADDRESS_1"];

$contact_addr = $contact_address[0]["COUNTRY"] ." ". $contact_address[0]["CITY"] ." ". $contact_address[0]["ADDRESS_1"];           
            





############## Если Компания #######################


if ($deal["COMPANY_ID"]>0) {  
  // Запрос Компаний
    $queryData = [
       // 'filter' => [
            'ID' => $deal["COMPANY_ID"],  //Связано с пользователем по ID
      //  ],
        //  'select' => ["*","UF_*","UF_CRM_TASK"], 
       //'select' => ["ID","ASSIGNED_BY_ID"],
    ];
    usleep(200000);
    $resp_company = requestBitrix('crm.company.get', $queryData); 
    $resp_company = $resp_company['result']; 
    toLog('запрос компании', $resp_company);
    
    //$data_to1c['Kontragent']['ID'] = $resp_company['ID'];
    $data_to1c['Kontragent']['Title'] = $resp_company["TITLE"];
  
    
    ###########   Реквизиты Компании    ####################
    $query_requisite = [
        "filter" => array(
            "ENTITY_ID" => $deal["COMPANY_ID"],
            "ENTITY_TYPE_ID" => 4,
           // "PRESET_ID"=> 1
        ),
        'select' => ["*","UF_*"]
        ];
    usleep(200000);

    toLog('query_requisite', $query_requisite);

    $requisite = requestBitrix('crm.requisite.list', $query_requisite); 
    $requisite = $requisite['result'];    

    toLog('crm.requisite.list', $requisite);

    foreach ($requisite as $key => $value) { 
        if($value['ENTITY_ID'] == $resp_company['ID']) {
               $requisite_ID = $value["ID"]; // ID Реквизита, для поиска адресов и Банковских реквизитов
        }
    } 

    ###########   Адрес Компании    ####################
    $query_address = [
        "filter" => array(
          //  "ENTITY_ID" => $deal["COMPANY_ID"],
           "ENTITY_ID" => $requisite_ID, //
           "ENTITY_TYPE_ID" => 8, // Реквизиты
        ),
    ];
    usleep(200000);

    toLog('crm.address.list', $query_address); 

    $address = requestBitrix('crm.address.list', $query_address); 

    $address = $address['result']; 
    toLog('crm.address.list', $address);

    // Собираем Рекивизиты и Адрес Компании

    foreach ($requisite as $key => $value) { 

        if($value['ENTITY_ID'] == $resp_company['ID']) {
            $data_to1c['Kontragent']['Type'] = 1; //1 Компания, 2 - физ лицо
            $data_to1c['Kontragent']['KBE'] = $value["RQ_KBE"];
            $data_to1c['Kontragent']['BIN'] = $value["RQ_BIN"];
            
            /*--------------------------------------------------*/
            
            $data_to1c['Kontragent']['Otkuda'] = $value["Otkuda"];
            $data_to1c['Kontragent']['Status'] = $value["Status"];
            
            /*--------------------------------------------------*/
            
            //$data_to1c['Kontragent']['ResidenceCountry'] = $value["RQ_RESIDENCE_COUNTRY"];
//            $data_to1c['Kontragent']['Address']['Country'] = $address[0]["COUNTRY"];
//            $data_to1c['Kontragent']['Address']['City'] = $address[0]["CITY"];
//            $data_to1c['Kontragent']['Address']['Address'] = $address[0]["ADDRESS_1"];
            $data_to1c['Kontragent']["Contacts"]['Address'] = $address[0]["COUNTRY"] ." ". $address[0]["CITY"] ." ". $address[0]["ADDRESS_1"];
            
            $data_to1c['Kontragent']["Contacts"]['Phone'] = $contact_phone; // Из контакта
            $data_to1c['Kontragent']["Contacts"]['Email'] = $contact_email; // Из контакта
            
        }
    }
    
    
    ########## Структура Банковских реквизитов компании / BankReq

    // Запрос Банка
    $queryData = [
        'filter' => [
            'ENTITY_ID' => $requisite_ID,  //Идентификатор родительской сущности.
            //'ENTITY_TYPE_ID' => '2',  // Идентификатор типа родительской сущности. По умолчанию тип: "Реквизит". Обязательное поле.
        ],
        //  'select' => ["*","UF_*","UF_CRM_TASK"],
        //'select' => ["ID","ASSIGNED_BY_ID"],
    ];
    usleep(200000);
    $bank = requestBitrix('crm.requisite.bankdetail.list', $queryData); // 	Возвращает список банковских реквизитов по фильтру.

    toLog('crm.requisite.bankdetail.list', $bank);

    $bank = $bank['result']['0']; 

    $data_to1c['BankReq']['BIK'] = $bank["RQ_BIK"];
    $data_to1c['BankReq']['Title'] = $bank["RQ_BANK_NAME"];
    $data_to1c['BankReq']['NomerScheta'] = $bank["RQ_COR_ACC_NUM"];

} else {  // если физ лицо
    
    $data_to1c['Kontragent']['Type'] = 2; //1 Компания, 2 - физ лицо
    $data_to1c['Kontragent']['Title'] = $CONTACT_FIO;
    $data_to1c['Kontragent']['IIN'] = $contact_requisite['RQ_INN'];
    
    $data_to1c['Kontragent']["Contacts"]['Address'] = $contact_addr; // Из контакта
    $data_to1c['Kontragent']["Contacts"]['Phone'] = $contact_phone; // Из контакта
    $data_to1c['Kontragent']["Contacts"]['Email'] = $contact_email; // Из контакта
    
}





             





########## Структура Сделки / Договора / Contract
//  "Contract": {
//    "ContractNumber": 13,
//    "ContractDate": "15.05.2021"
/// $data_to1c['Contract']['ContractNumber'] = $deal["UF_CRM_1636266124"];
//$data_to1c['Contract']['ContractNumber'] = "252/2022";
//$data_to1c['Contract']['ContractDate'] = date("d.m.Y", strtotime($deal["UF_CRM_1636266152"]));






##########  Структура Товаров / ТМЗ / Products
//  "Products": [
//    {
//      "ProductCode": "'00000002855'",
//      "ProductName": "72304 FM.D Цветная смесь для заделки швов, графитово-серый, мешок 30 кг",
//      "Quantity": 100,
//      "Price": 9100,
//      "Sum": 910000,
//      "VAT": "12%",
//      "VATsum": 97500,
//      "Total": 910000
//    },
//    
// Запрос товара в сделке
$query_productrows = [
    //  'filter' => [
            'ID' => $deal_id,  //Связано с пользователем по ID
        // ],
        'select' => ["*","UF_*"],
        //'select' => ["ID","ASSIGNED_BY_ID"],
]; 


usleep(200000);
$products_list = requestBitrix('crm.deal.productrows.get', $query_productrows); 
$products_list = $products_list['result'];
  
toLog('products_list', $products_list); 
// foreach ($products_list as $key => $value) {
//     $ids[] = $value['PRODUCT_ID'];
// }
//$ids[] = '41476';
// $ids = implode(',',$ids);
//toLog('ids', $ids); 



// toLog('product_full', $product_full); die;


    
foreach ($products_list as $key => $value) {
    $product_full = getproduct( $value["PRODUCT_ID"] , $iblockId); 
   // toLog('product_full', $product_full[FILD_PRODUCT_1C_UID]); 

    $summ = $value["QUANTITY"] * $value["PRICE"]; 
            
    $product[] = [
            //"ID" => $value["ID"],
            //"1С_uid" =>  $product_full[FILD_PRODUCT_1C_UID]["value"],
            "ProductUID" =>  $product_full[FILD_PRODUCT_1C_UID]["value"],
            "ProductName" => $value["PRODUCT_NAME"],
            "Quantity" => $value["QUANTITY"],
            "Price" => $value["PRICE"],
           // "Sum" => $summ,
        
           // "VAT" => $value["TAX_RATE"],
           // "VATsum" =>  round(($summ)  -  (($summ * 100) / (100 + $value["TAX_RATE"])),2),
           // "Total" =>  $summ,

        ];
} 

$data_to1c['Products'] = $product;





//die;


####################### СЧЕТ ###########################
//$queryinvoice = [
//   // "id" => 1,
//     "entityTypeId" => "31",
//      "filter" => [
//       //  "entityTypeId" => "31",
//         "parentId2" => $deal_id  // $deal,  // id Сделки 
//      ]
//  ];
// 
//  usleep(200000);
// $invoice = requestBitrix('crm.item.list', $queryinvoice); 
// // toLog('invoice', $invoice); 
//$invoice = $invoice['result']['items'][0];


//$data_to1c['Invoice']['ID'] = $invoice['id'];  



######## ТОВАРЫ ИЗ СЧЕТА  ###################

//$queryData_items = [
//  "order" => [],
//
//  "filter" => [ 
//                  "OWNER_TYPE" => "D", 
//                  "OWNER_ID" => $deal_id, // $deal,  
//              ],
//
//  "select" => ["*","ID","id","UF_*"],
//];
//
//usleep(200000);
//$invoice_items = requestBitrix('crm.productrow.list', $queryData_items); 
//$invoice_items = $invoice_items['result'];
//
//
//// print_r($invoice_items);
//
//$invoice_items_temp = array();
//foreach ($invoice_items as $key => $value) {
//    $product_full = getproduct( $value["PRODUCT_ID"] , $iblockId);
//    $invoice_items_temp[] = [  
//        "ID"=> $value['ID'],
//        "ProductUID" =>  $product_full[FILD_PRODUCT_1C_UID]["value"],
//        "Name"=> $value['PRODUCT_NAME'],
//        "Price"=> $value['PRICE'],
//        "Quantity"=> $value['QUANTITY'],
//    ]; 
//}
//$data_to1c['Invoice']['Items'] = $invoice_items_temp;  




$data_to1c_json = json_encode($data_to1c); 


echo "<pre>Для примера берем Сделку №1903" . PHP_EOL . PHP_EOL;
//print_r($data_to1c);

if($_GET['deal'] !='') {
    
    echo "<pre>";
    echo "<br>";
    print_r($data_to1c); 
    echo "<br>";
    
    echo '<textarea cols="150" rows="20">';
    print_r($data_to1c_json); 
    echo "</textarea>";
    
}

toLog('Отправка пакета в 1С. data_to1c', $data_to1c); 

$temp = "Данные для отпрвки в 1С" . PHP_EOL . print_r($data_to1c, true);
sendComm($deal_id, $temp);        

    
    

 

$res_1c = sendTo1c($url_1c, $data_to1c); 

//sendNotify($portal_user_id, '[COLOR=#58cc47]Счет №__ в 1С "создан".[/COLOR]');
  
//echo "<br>";
//echo "Ответ 1С";
//print_r($res_1c);
//
//$temp = "Ответ от 1С" . PHP_EOL . print_r($res_1c, true);
//sendComm($deal_id, $temp);
//
tolog($res_1c);  
 
  

// Если создался Ордер в 1С то записываем его в Сделку, для привязки к Счету
if($res_1c["OrderCreated"] == true) { 
    
    // Отправить комментарий к Сделке с JSON
    sendComm($deal_id, "В 1С создан Счет " . $res_1c["Number"] .". UID- " . $res_1c["OrderID"]); 
    
    if($portal_user_id) { 
        sendNotify($portal_user_id, '[COLOR=#58cc47]В 1C создан счет № ' . $res_1c["Number"]. '[/COLOR]');
    } 
    // Привязем Сделку к Счету, внесем номер в специальное поле 
    deal_update($deal_id, [INVOICE_UID_1C => $res_1c["OrderID"], INVOICE_NUMBER_1C => $res_1c["Number"]]);
    
    
} elseif($res_1c["OrderCreated"] == false) { 
     
    sendComm($deal_id, "Ошибка формирования Счета в 1С. " . print_r($res_1c, 1)); 
    
    if($portal_user_id) { 
        sendNotify($portal_user_id, '[COLOR=#ad0c0c]Ошибка формирования Счета в 1С'.print_r($res_1c, 1).'[/COLOR]');
    } 
    
    tolog("Ошибка формирования Счета в 1С. " . $res_1c); 
    die;
    
} else {
     
    sendComm($deal_id, "Ошибка создания Счета в 1С." . print_r($res_1c, 1)); 
    tolog("Ошибка создания Счета в 1С. Ответ 1С не форматный. " . print_r($res_1c, 1)); 
    die;
}  
die; 
   

###########   Документ Счет на товар     ###########
//if ($deal["COMPANY_ID"]>0)   
//    $templateId = DOCUMENT_COMPANY_TEMPLATE_ID;
// else     
//    $templateId = DOCUMENT_CLIENT_TEMPLATE_ID;
//
//
//$queryData = [];
//$queryData = [
//    'templateId' => $templateId,
//    'entityTypeId' => '2', // Сделка
//    'entityId'=> $deal_id,
//    // 'providerClassName' => 'Bitrix\\DocumentGenerator\\DataProvider\\Rest',
//    'stampsEnabled' => 1, // 1 (поставить), 0 (убрать) печати и подписи.
//    'values' => [
//        'DocumentNumber' => $res_1c["Number"],  
//        
//    ], 
//    'fields' => [
////        'Table' => [
////            'PROVIDER' => 'Bitrix\\DocumentGenerator\\DataProvider\\ArrayDataProvider',
////            'OPTIONS' => [
////                'ITEM_NAME' => 'Item',
////                'ITEM_PROVIDER' => 'Bitrix\\DocumentGenerator\\DataProvider\\HashDataProvider',
////            ],
////        ],
//        
//      //  'MyCompanyUfStamp' => ['TYPE' => 'STAMP'], // тип поля - печать
//        // 'Image' =>         ['TYPE' => 'IMAGE'], // тип поля - изображение
////        'CompanyRequisiteRqCeoName' => [
////            'TYPE' => 'NAME',
////            'FORMAT' => [ // здесь можно передать формат поля по умолчанию
////                 // 'case' => 0, // код падежа
////                'FORMAT' => '#LAST_NAME# #NAME_SHORT# #SECOND_NAME_SHORT#' // формат вывода
////            ],  
////        ],
//
//
//    ],
//];
//usleep(200000);
//toLog("Данные для создания документа - Счет на товар.", $queryData);
//$resp_documen_create = requestBitrix('crm.documentgenerator.document.add', $queryData);
//toLog("Результат создания документа - Счет на товар.", $resp_documen_create);




//echo "<pre>Для примера берем Сделку №1903" . PHP_EOL . PHP_EOL;
//print_r($data_to1c);
//
//
//$data_to1c_json = json_encode($data_to1c); 
//
//if($_GET['deal'] !='') {
//    
//    echo "<pre><p>Данные в формате JSON</p>";
//    echo '<textarea cols="150" rows="20">';
//    print_r($data_to1c_json); 
//    echo "</textarea>";
//    echo "<br>";
//    // print_r($data_to1c); 
//}




die;