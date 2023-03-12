<?php


// ТЗ https://docs.google.com/document/d/1gdledKmKF3EzVnWWerXb_2ZEZ-v02KvYLHNAxE0pvVU/edit#
//
//
// Резрешаем только нужные Сделки
//if(($_GET['deal'] == 4073 )||($_GET['deal'] == 4163 )) {
//
//}else {
//    die;
//}



/*
 * Боевая интеграция
 * Путь к скрипту https://web.prodvig.kz/script/koblandin/index.php
 */

// Часовой пояс
date_default_timezone_set('Asia/Almaty');
$dtz = new DateTimeZone('Asia/Almaty');

########    Настройки Битрикса24   #########
$custom_color_consultation_step1 = "2196f3";  //ff2828 красный, 009800 зеленый, aa11ff фиолетовый, 2196f3 синий
$custom_font_color_consultation_step1 = "ffffff";

//Воронка Администратор
$custom_color_consultation_step2 = "4caf50";  //ff2828 красный, 009800 зеленый, aa11ff фиолетовый, 2196f3 синий
$custom_font_color_consultation_step2 = "ffffff";

//const IBLOCK_STAFF = 28; // Список Доктора
//const IBLOCK_FILIAL = 30; // Список Адреса филиалов и ID филиалов
//const IBLOCK_SERVICE = 32; // Список Услуг

const fild_consultation_format = 'UF_CRM_1649170106278'; // Поле формат консультации Очно/Онлайн/Осмотр
const fild_record_link = 'https://app.alteg.io/timetable/708148#open_modal_by_record_id='; // Поле формат консультации Очно/Онлайн/Осмотр

const deal_product_fild_yclients_service_id = 'PROPERTY_70'; // В карточке товара ID eслуги Alteg


// const deal_product_fild_yclients_category_id = 'PROPERTY_111'; // В карточке товара ID категории Alteg
const deal_fild_yclients_record_id = 'UF_CRM_1660851851'; // id Записи Alteg
const deal_fild_yclients_url = 'UF_CRM_1660852601'; // id Записи Alteg


########## Клиент, комментарии ############
const USER_FILD_DOCTOR = 'UF_XING';  // Поле выбора доктора в карточке сотрудника
const DEAL_FILD_DOCTOR1 = 'UF_CRM_1660850307';  // Поле выбора доктора в Сделке
const DEAL_FILD_DOCTOR2 = 'UF_CRM_1649159565';  // 2 Поле выбора доктора в Сделке

const DEAL_LINK = 'https://b24.koblandinclinic.kz/crm/deal/details/'; // Линк на сделку

const deal_fild_comments = 'UF_CRM_1653392104594'; // Комментарий в Сделке
const deal_fild_datetime_step1 = 'UF_CRM_1653392064811'; //Консультация Дата и время записи
const deal_fild_datetime_step2 = 'UF_CRM_1649170826446'; //Операция Дата и время записи
 
// const deal_fild_birthday = 'UF_CRM_1642703947887'; // Дата рождения

// const deal_fild_client_tape = 'UF_CRM_1642704010557'; // тип клиента ребенок/взрослый
// const deal_fild_3d_snimok = 'UF_CRM_1642704039084'; // наличие 3д снимка
// const deal_fild_3d_payment_tape = 'UF_CRM_1642704092803'; // тип оплаты




// const DEAL_FILD_DOCTOR1_userfield_ID = 231; // ID пользовательского поля


// Настройки филиала
//const deal_fild_filial__select_id = 'UF_CRM_1649782923'; // Сделка поле Адрес записи
//const LISTS_FILIAL_fild_yclients_id = 'PROPERTY_112'; // id Филиала из Списка
//
//// Настройки Услуг
//const deal_fild_service__select_id = 'UF_CRM_1649784223'; // Сделка поле Услуга
//const LISTS_SERVICE_fild_yclients_id = 'PROPERTY_116'; // id услуги из Списка
//
//// Настройки доктора
//const deal_fild_staff__select_id = 'UF_CRM_1649782310'; // Сделка поле кто Доктор
//const LISTS_STAFF_fild_yclients_id = 'PROPERTY_110'; // id доктора из Списка

const VORONKA_STEP1 = 1;  // ID воронки Отдел продаж
const VORONKA_STEP2 = 2;  // ID воронки Администратор

const STATUS_BEFORE_CREATE = 'C1:1'; // Заявка обработана
const STATUS_BEFORE_CREATE_STEP2 = 'C2:2'; // Заявка обработана
// const STATUS_CONSULTATION_HELD = 'C2:NEW'; // Консультация проведена

//const STATUS_CAME_STEP1 = 'UC_REB9ZX'; // Статус Сделки - Клиент пришел
const STATUS_CAME_STEP1 = 'C1:WON'; // Статус Сделки - Клиент пришел
const STATUS_NOT_CAME_STEP1 = 'C1:12'; // Статус Сделки - “Клиент не пришел после подтверждения”

const STATUS_CAME_STEP2 = 'C2:WON'; // Статус Сделки - Операция проведена
const STATUS_NOT_CAME_STEP2 = 'C2:LOSE'; // Статус Сделки - “Клиент не пришел после подтверждения”

##########    Настройки Alteg    ###########
// Логин и пароль пользователя для получения токена
$login = '770595______'; // тут удалено пока
$password = 'vfiby____';	// тут удалено пока

$tokenPartner = 'kh5taghpy3xa9yg______'; // Токен к Alteg	// тут удалено пока
$Yclients_company_id = '708148'; // ID Компании
$seanceLength_default_15min = 900; // Длительность записи в секундах
$seanceLength_default_60min = 3600; // Длительность записи в секундах

const B24_WEBHOOK_URL = 'https://b24.koblandinclinic.kz/rest/1/*******/'; // Вебхук удален пока

define('DIR_ROOT', dirname(__FILE__));
const file_Log = DIR_ROOT . '/logs/logFile.txt'; // Путь к лог файлу

// Автоматическая подгрузка классов
function __autoload($className) {
    $className = str_replace("..", "", $className);
    require_once ("classes/$className.php");
    echo "Загружен класс/$className.php<br>";
}



$b24 = new Bitrix24Api(B24_WEBHOOK_URL, file_Log);
 $b24->toLogClean();

$y = new YclientsApi($tokenPartner, file_Log);
//$y->toLogClean();

$b24->toLog("Приняли POST", $_POST);
$b24->toLog("Приняли GET", $_GET);

$postData = file_get_contents('php://input');
if(!empty($postData)) {
  $data_json = json_decode($postData, true);
  $b24->toLog("Принимаем php://input", $data_json);
}

$user_id = preg_replace("/[^0-9]/", '', $_GET['user_id']); // Вытащим ID текущего пользователя
$b24->toLog("Получен пользователь", $user_id);
// $user_id = $_GET['user_id'];



####################################################
###### Клиент пришел, вебхук из Alteg в Б24.  #####
####################################################


// Если пришли изменения по Записи и статус 1 - Клиент пришел наша Компания [status]
if(($data_json['resource'] == 'record')&&($data_json['data']['attendance'] == 1)&&($data_json['status'] == 'update') ) {

    $Yclients_company_id = $data_json['company_id']; // Получим ID Компании из Yclients
    $yclients_task_id = $data_json['resource_id']; // Получим ID заявки из Yclients
    $yclients_last_change_date = $data_json['last_change_date']; // Дата изменения Заявки

    $date_modifi = date_create($yclients_last_change_date);

    // Запросим сделку у которой поле с нашим идентификатором yclients
    $deals = $b24->crm_deal_list(
                [deal_fild_yclients_record_id => $yclients_task_id], // Поле id записи Yclients
                []
            );

    $b24->toLog("Получили сделку по идентификатору Alteg", $deals);
    $deal_id =$deals[0]['ID'];
    $deal_status = $deals[0]['STAGE_ID'];
    $deal_category_id = $deals[0]['CATEGORY_ID'];  // ID Воронка
    $user_id = $deals[0]['CREATED_BY_ID'];

    $b24->toLog("Из сделки получили ответсвенного, ему отправим уведомление ", $user_id);

    if(!($deal_id>0)) {
        $b24->toLog("Не найдена сделка соответсвующая записи Alteg ", $deal_id);
        die;
    }

    $b24->toLog("Номер Сделки: ", $deal_id);
    
    if($deal_category_id == VORONKA_STEP1) { // Если первая воронка
        $status_came = STATUS_CAME_STEP1;
        
    } elseif ($deal_category_id == VORONKA_STEP2) { // Вторая воронка
        $status_came = STATUS_CAME_STEP2;
        
    } else {
        $b24->toLog("Ошибка определения воронки: ", $deal_id);
        $b24->sendComm($deal_id,
                '[COLOR=#ff0000]Ошибка разпознования воронки[/COLOR]'
                ,'deal',
                $user_id
        );
        die;
    }

    if($deal_status != $status_came) {
        // Изменим статус сделки в Б24
        $b24->deal_update(
                $deal_id,
                [
                    'STAGE_ID' => $status_came,   // Клиент пришел
                    'CATEGORY_ID' => $deal_category_id,
                ]
        );
    }

   //if($task_update["success"] == 1) {
        $b24->sendComm($deal_id,
                '[COLOR=#58cc47]Клиент  '. $data_json['data']['client']['name'] .'  пришел '
                . 'на процедуру '.  date_format($date_modifi, "d.m.Y") .' в '.date_format($date_modifi, "H:i").'. '
                . ' Статус записи - “Клиент пришел”[/COLOR]'
                ,'deal',
                $user_id
        );
   // }

}

####################################################
###### Клиент не пришел, вебхук из Alteg в Б24.  #####
####################################################


// Если пришли изменения по Записи и статус (-1) - Клиент не пришел
if(($data_json['resource'] == 'record')&&($data_json['data']['attendance'] == -1)&&($data_json['status'] == 'update') ) {

    $Yclients_company_id = $data_json['company_id']; // Получим ID Компании из Yclients
    $yclients_task_id = $data_json['resource_id']; // Получим ID заявки из Yclients
    $yclients_last_change_date = $data_json['last_change_date']; // Дата изменения Заявки

    $date_modifi = date_create($yclients_last_change_date);

    // Запросим сделку у которой поле с нашим идентификатором yclients
    $deals = $b24->crm_deal_list(
                [deal_fild_yclients_record_id => $yclients_task_id], // Поле id записи Yclients
                []
            );

    $b24->toLog("Получили сделку по идентификатору Alteg", $deals);
    $deal_id =$deals[0]['ID'];
    $deal_status = $deals[0]['STAGE_ID'];
    $deal_category_id = $deals[0]['CATEGORY_ID'];  // ID Воронка
    $user_id = $deals[0]['CREATED_BY_ID'];

    $b24->toLog("Из сделки получили ответсвенного, ему отправим уведомление ", $user_id);

    if(!($deal_id>0)) {
        $b24->toLog("Не найдена сделка соответсвующая записи Alteg ", $deal_id);
        die;
    }

    $b24->toLog("Номер Сделки: ", $deal_id);
    
    if($deal_category_id == VORONKA_STEP1) { // Если первая воронка
        $status_came = STATUS_NOT_CAME_STEP1;
        
    } elseif ($deal_category_id == VORONKA_STEP2) { // Вторая воронка
        $status_came = STATUS_NOT_CAME_STEP2;
        
    } else {
        $b24->toLog("Ошибка определения воронки: ", $deal_id);
        $b24->sendComm($deal_id,
                '[COLOR=#ff0000]Ошибка разпознования воронки[/COLOR]'
                ,'deal',
                $user_id
        );
        die;
    }

    if ($deal_status != $status_came) {
        // Изменим статус сделки в Б24
        $b24->deal_update(
                $deal_id,
                [
                    'STAGE_ID' => $status_came,   // Клиент пришел
                    'CATEGORY_ID' => $deal_category_id,
                ]
        );
    }
    $b24->toLog("Пакет на обновление Сделки: ", [ 'STAGE_ID' => $status_came, 'CATEGORY_ID' => $deal_category_id, ]);

   //if($task_update["success"] == 1) {
        $b24->sendComm($deal_id,
                '[COLOR=#ff0000]Клиент  '. $data_json['data']['client']['name'] .' не  пришел '
                . 'на процедуру '.  date_format($date_modifi, "d.m.Y") .' в '.date_format($date_modifi, "H:i").'. '
                . ' Статус записи - “Клиент не пришел после подтверждения”[/COLOR]'
                ,'deal',
                $user_id
        );
   // }

}


####################################################
#      Не пришел клиент в Б24. Статуса в Yclients     #
####################################################

// https://web.prodvig.kz/script/koblandin/index.php?deal={{ID}}&task=confirmed
if(($_GET['task'] == 'doesntcame')&&($_GET['deal']>0)) {
    $deal_id = $_GET['deal'];

    // Данные из Сделки
    $deal = $b24->deal_get($deal_id);
    $b24->toLog("Запрос Сделки", $deal);

    $Yclients_task_id = $deal[deal_fild_yclients_record_id]; // Получим ID заявки из Б24

    if(empty($Yclients_task_id)) {
        $b24->sendComm($deal_id,
                '[COLOR=#ff0000]По данной Сделке не создана Заявка в Alteg! Для создания заявки переместите в статус "Записан".[/COLOR]'
                ,'deal',
                $user_id
                );
        die;
    }


    $userToken = $y->getAuth($login, $password);
    $y->toLog("Получаем токен:", $userToken);

    ### Получить настройки Филиала ###
    // получить ID филиала из Списка
//    $company = $b24->lists_element_get(
//            IBLOCK_FILIAL,
//            [ '=ID' => $deal[deal_fild_filial__select_id] ]
//            );
//
//    $b24->toLog( "Запрос Филиала из Списка", $company );
//
//    $Yclients_company_id = current($company[0][LISTS_FILIAL_fild_yclients_id]);
//    $b24->toLog( "Запрос ID Филиала из Списка", $Yclients_company_id );

    // Если не верно выбрали ID филиала
    if(empty($Yclients_company_id)) {
        $b24->sendComm($deal_id,
            'Не указан Адрес записи (филиал)!'
            ,'deal',
            $user_id
        );
        die;
    }

    $task_get = $y->getRecord(
            $Yclients_company_id,
            $Yclients_task_id,
            $userToken
    );
    $y->toLog("запрос Заявки:", $task_get);

    $task_get['data']['attendance'] = -1;// Статус записи (2 - Пользователь подтвердил запись, 1 - Пользователь пришел, услуги оказаны, 0 - ожидание пользователя, -1 - пользователь не пришел на визит)

    $y->toLog("параметры task_get после изменений:", $task_get['data']);

    // Изменить статус заявки в Yclients на Клиент подтвердил
    $task_update = $y->putRecord(
            $Yclients_company_id,
            $Yclients_task_id,
            $userToken,
            $task_get['data']
    );
    $y->toLog("параметры task_update:", $task_update);

    $datetime = $task_update['data']['datetime'];

    if($task_update["success"] == 1) {
        $b24->sendComm( $deal_id,
                '[COLOR=#ff0000]Клиент '. $task_get['data']['client']['name'] .' не пришел '
                . 'на процедуру '.  date("d.m.Y", strtotime($datetime)) .' в '.date("H:i", strtotime($datetime)).'. '
                . 'Статус записи - "Клиент не пришел"[/COLOR]'
                ,'deal',
                $user_id
        );
    }
}


####################################################
#      Пришел клиент в Б24. Статуса в Yclients     #
####################################################

// https://web.prodvig.kz/script/koblandin/index.php?deal={{ID}}&task=confirmed
if(($_GET['task'] == 'came')&&($_GET['deal']>0)) {
    $deal_id = $_GET['deal'];

    // Данные из Сделки
    $deal = $b24->deal_get($deal_id);
    $b24->toLog("Запрос Сделки", $deal);

    $Yclients_task_id = $deal[deal_fild_yclients_record_id]; // Получим ID заявки из Б24

    if(empty($Yclients_task_id)) {
        $b24->sendComm($deal_id,
                '[COLOR=#ff0000]По данной Сделке не создана Заявка в Alteg! Для создания заявки переместите в статус "Записан".[/COLOR]'
                ,'deal',
                $user_id
                );
        die;
    }


    $userToken = $y->getAuth($login, $password);
    $y->toLog("Получаем токен:", $userToken);

    ### Получить настройки Филиала ###
    // получить ID филиала из Списка
//    $company = $b24->lists_element_get(
//            IBLOCK_FILIAL,
//            [ '=ID' => $deal[deal_fild_filial__select_id] ]
//            );
//
//    $b24->toLog( "Запрос Филиала из Списка", $company );
//
//    $Yclients_company_id = current($company[0][LISTS_FILIAL_fild_yclients_id]);
//    $b24->toLog( "Запрос ID Филиала из Списка", $Yclients_company_id );

    // Если не верно выбрали ID филиала
    if(empty($Yclients_company_id)) {
        $b24->sendComm($deal_id,
            'Не указан Адрес записи (филиал)!'
            ,'deal',
            $user_id
        );
        die;
    }

    $task_get = $y->getRecord(
            $Yclients_company_id,
            $Yclients_task_id,
            $userToken
    );
    $y->toLog("запрос Заявки:", $task_get);

    $task_get['data']['attendance'] = 1;// Статус записи (2 - Пользователь подтвердил запись, 1 - Пользователь пришел, услуги оказаны, 0 - ожидание пользователя, -1 - пользователь не пришел на визит)

    $y->toLog("параметры task_get после изменений:", $task_get['data']);

    // Изменить статус заявки в Yclients на Клиент подтвердил
    $task_update = $y->putRecord(
            $Yclients_company_id,
            $Yclients_task_id,
            $userToken,
            $task_get['data']
    );
    $y->toLog("параметры task_update:", $task_update);

    $datetime = $task_update['data']['datetime'];

    if($task_update["success"] == 1) {
        $b24->sendComm( $deal_id,
                '[COLOR=#58cc47]Клиент '. $task_get['data']['client']['name'] .' пришел '
                . 'на процедуру '.  date("d.m.Y", strtotime($datetime)) .' в '.date("H:i", strtotime($datetime)).'. '
                . 'Статус записи - "Клиент пришел"[/COLOR]'
                ,'deal',
                $user_id
        );
    }
}


############################################################
###### Подтверждение Клиента в Б24. Статуса в Yclients #####
############################################################

// https://web.prodvig.kz/script/koblandin/index.php?deal={{ID}}&task=confirmed
if(($_GET['task'] == 'confirmed')&&($_GET['deal']>0)) {
    $deal_id = $_GET['deal'];

    // Данные из Сделки
    $deal = $b24->deal_get($deal_id);
    $b24->toLog("Запрос Сделки", $deal);

    $consultation_format = $deal[fild_consultation_format]; // Получим значение поля Формат консультации, если 28 то создаем заявку в Alteg

    if($consultation_format != 28) {
        $b24->toLog("Формат консультации не очный. Стоп скрипт.", $consultation_format);
        die;
    }


    $Yclients_task_id = $deal[deal_fild_yclients_record_id]; // Получим ID заявки из Б24

    if(empty($Yclients_task_id)) {
        $b24->sendComm($deal_id,
            '[COLOR=#ff0000]По данной Сделке не создана Заявка в Alteg! Для создания заявки переместите в статус "Записан".[/COLOR]'
            ,'deal',
            $user_id
            );
        die;
    }


    $userToken = $y->getAuth($login, $password);
    $y->toLog("Получаем токен:", $userToken);

    ### Получить настройки Филиала ###
    // получить ID филиала из Списка
//    $company = $b24->lists_element_get(
//            IBLOCK_FILIAL,
//            [ '=ID' => $deal[deal_fild_filial__select_id] ]
//            );
//
//    $b24->toLog( "Запрос Филиала из Списка", $company );
//
//    $Yclients_company_id = current($company[0][LISTS_FILIAL_fild_yclients_id]);
//    $b24->toLog( "Запрос ID Филиала из Списка", $Yclients_company_id );

    // Если не верно выбрали ID филиала
    if(empty($Yclients_company_id)) {
        $b24->sendComm($deal_id,
            'Не указан Адрес записи (филиал)!'
            ,'deal',
            $user_id
        );
        die;
    }

    $task_get = $y->getRecord(
            $Yclients_company_id,
            $Yclients_task_id,
            $userToken
    );
    $y->toLog("запрос Заявки:", $task_get);

    $task_get['data']['attendance'] = 2;// Статус записи (2 - Пользователь подтвердил запись, 1 - Пользователь пришел, услуги оказаны, 0 - ожидание пользователя, -1 - пользователь не пришел на визит)

    $y->toLog("параметры task_get после изменений:", $task_get['data']);


    // Изменить статус заявки в Yclients на Клиент подтвердил
    // $task_update = $y->putRecord(
    $task_update = $y->putRecord(
            $Yclients_company_id,
            $Yclients_task_id,
            $userToken,
            $task_get['data']
    );
    $y->toLog("параметры task_update:", $task_update);
    // die;

    $datetime = $task_update['data']['datetime'];

    if($task_update["success"] == 1) {
        $b24->sendComm( $deal_id,
                '[COLOR=#58cc47]Запись для клиента '. $task_get['data']['client']['name'] .' была успешно подтверждена в Alteg '
                . 'на '.  date("d.m.Y", strtotime($datetime)) .' в '.date("H:i", strtotime($datetime)).'. '
                . 'Статус записи - "Клиент подтвердил"[/COLOR]',
                'deal',
                $user_id

        );
    }
}



#######################################################
###### Создание/изменение консультации в Yclients #####
#######################################################

// https://web.prodvig.kz/script/koblandin/index.php?task=new&lead={{ID}}

if(($_GET['task'] == 'new')&&($_GET['deal']>0)) { // Создание новой записи
    $deal_id = $_GET['deal'];

    $userToken = $y->getAuth($login, $password);
    $y->toLog("Получаем токен:", $userToken);

    // Данные из Сделки
    $deal = $b24->deal_get($deal_id);
    $b24->toLog("Запрос Сделки", $deal);


    $consultation_format = $deal[fild_consultation_format]; // Получим значение поля Формат консультации, если 28 то создаем заявку в Alteg

    if($consultation_format != 28) {
        $b24->toLog("Формат консультации не очный. Стоп скрипт.", $consultation_format);
        die;
    }

    $Yclients_task_id = $deal[deal_fild_yclients_record_id]; // Получим ID заявки из Б24

    $userB24_id = $deal[DEAL_FILD_DOCTOR1]; // Выбранный доктор

    $b24->toLog("Получен идентификтаор пользователя userB24_id", $userB24_id);


    // Получаем пользователей из Битрикс и у пользователя запрашиваем идентификатор UF_XING который содержит staff_id
    $userB24 = $b24->user_get($userB24_id);
    // $b24->toLog("Полученs данные доктора userB24_id", $staff_id);
    $staff_id = $userB24[0][USER_FILD_DOCTOR];
    $lead_fild_doctor_fio = $userB24[0]["LAST_NAME"] . ' ' . $userB24[0]["NAME"];

    $b24->toLog("Получен идентификтаор доктора userB24_id", $staff_id);

    $b24->toLog("Найденый starr_id", $staff_id);


    // Если не верно выбрали ID доктора
    if(empty($staff_id)) {
        $b24->sendComm($deal_id,
            '[COLOR=#ff0000]Ошибка! Выбранный доктор '.$lead_fild_doctor_fio.' не найден в Alteg![/COLOR]'
            ,'deal',
            $user_id
        );

        // Изменим статус сделки в Б24
        $b24->deal_update(
                $deal_id,
                [ 'STAGE_ID' => STATUS_BEFORE_CREATE, ]  // В статус "Заявка обработана"
        );
        die;
    }


    $date_birthday = '';

   // if($deal[deal_fild_birthday] !='') $date_birthday = date("d.m.Y", strtotime($deal[deal_fild_birthday]));

    // Комментарий к записи;
    $comment = $deal[deal_fild_comments].PHP_EOL; // Комментарий из сделки
    $b24->toLog( "Комментарий к заявке: ", $comment );


    if($Yclients_task_id > 0) { // Если заявка в Yclients есть, то изменим

        $task_get = $y->getRecord(
            $Yclients_company_id,
            $Yclients_task_id,
            $userToken
        );
        $y->toLog("запрос Заявки:", $task_get);

        if($task_get["success"] == false) $error_text .= $task_get['meta']['message'];

        // Если заявка в Alteg удалена
        if($task_get['data']['deleted'] == 1) {
            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Заявка '. $Yclients_task_id .' в Alteg удалена. Очистите поле altegio_record_id в карточке сделки, чтобы созать новую заявку! [/COLOR]'
                    .  PHP_EOL . 'Описание: ' . $error_text
                    ,'deal',
                    $user_id
            );

            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE, ]  // В статус "Заявка обработана"
            );
            die;
        }

        ### Настройки Услуги ###
        $deal_productrows = $b24->deal_productrows_get($deal_id);

        foreach ($deal_productrows as $key => $item) {
            $b24->toLog("Запрос Продукта из Сделки", $item);
            $product_full = $b24->product_get($item['PRODUCT_ID']); // Запрос продукта со всеми полями
            $b24->toLog("Запрос Продукта product_full", $product_full);
            $service_id = $product_full[deal_product_fild_yclients_service_id]['value']; // Вытаскиваем ID услуги из продукта

            // Получение данных из Б24
            $services[$key]['id'] = $service_id;
            $services[$key]['first_cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта

            // Получить услугу из Yclients
            $Y_resp_services = $y->getServices(
                $Yclients_company_id,
                $service_id
                );
            $b24->toLog("Список услуг Alteg", $Y_resp_services);

            if($Y_resp_services['success'] == 1)
            {
                $seanceLength += $Y_resp_services['data']['duration']; // Длительность услуги берем из Alteg s

                $Y_services[$key]['id'] = $service_id;
                $Y_services[$key]['discount'] = $Y_resp_services['data']['discount'];
                if($product_full['PRICE']>0)
                {
                    $Y_services[$key]['first_cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта
                    $Y_services[$key]['cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта
                }
                else
                {
                    $Y_services[$key]['first_cost'] = $Y_resp_services['data']['first_cost']; // Вытаскиваем цену услуги из продукта
                    $Y_services[$key]['cost'] = $Y_resp_services['data']['cost']; // Вытаскиваем цену услуги из продукта
                }

            }
            else
            {

                $error_text .= $Y_resp_services['meta']['message'] . print_r($Y_resp_services['meta']['errors'], true);
                $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Ошибка запроса услуги из Alteg! [/COLOR]'
                    .  PHP_EOL . 'Описание: ' . $error_text
                    ,'deal',
                    $user_id

                );
                // Изменим статус сделки в Б24
                $b24->deal_update(
                        $deal_id,
                        [ 'STAGE_ID' => STATUS_BEFORE_CREATE_STEP2, ]  // В статус "Заявка обработана"
                );
                die;
            }

        } 

        $b24->toLog("Запрос услуг из карточки товара, из Сделки", $services);
        $b24->toLog("Запрос услуг из Alteg", $Y_services);



        // Если не выбрана не одна услуга
        if(count($Y_services) == 0) {
            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Не выбраны услуги![/COLOR]'
                    ,'deal',
                    $user_id
            );
            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE_STEP2, ]  // В статус "Заявка обработана"
            );
            die;
        }
        
        // Если в Yclients не прописана длительность услуг, ставим по умолчанию
        if(empty($seanceLength)) $seanceLength = $seanceLength_default_15min;

        $task_get['data']['seance_length'] = $seanceLength;// Длительность процедуры
        $task_get['data']['attendance'] = 0;// Статус записи (2 - Пользователь подтвердил запись, 1 - Пользователь пришел, услуги оказаны, 0 - ожидание пользователя, -1 - пользователь не пришел на визит)
        $task_get['data']['datetime'] = $y->toISO($deal[deal_fild_datetime_step1]);  // Дата и время сеанса в формате ISO8601 +3 часа
        $task_get['data']['custom_fields']['btrx_id_deal'] = $deal_id;  // Кастомное поле id Сделки
        $task_get['data']['custom_fields']['b24_deal_link'] = DEAL_LINK . $deal_id . '/'; // Кастомное поле с сылкой

        $task_get['data']['comment'] = $comment; // Комментарий к записи;
        $task_get['data']['custom_color'] = $custom_color_consultation_step1; // Цвет заявки
        $task_get['data']['custom_font_color'] = $custom_font_color_consultation_step1; //$custom_font_color; // Цвет текста
        $task_get['data']['services'] = $Y_services; // Меняем услуги
        $task_get['data']['services'] = $staff_id;
         
        // $staff_id = $task_get['data']['staff_id']; 

        $y->toLog("параметры task_get после изменений:", $task_get['data']);

        // Обновить заявку
        $task_update = $y->putRecord(
            $Yclients_company_id,
            $Yclients_task_id,
            $userToken,
            $task_get['data']
        );

        if($task_update["success"] == false) $error_text .= $task_update['meta']['message'];

        if($task_update["success"] == true) { // Если данные сохранены удачно
            $b24->sendComm($deal_id,
                    '[COLOR=#58cc47]Запись для клиента '. $task_get['data']['client']['name'] .' была успешно перенесена  в Alteg '
                    . 'на '.  date("d.m.Y", strtotime($deal[deal_fild_datetime_step1])) .' в '.date("H:i", strtotime($deal[deal_fild_datetime_step1])).'. '
                    . 'Статус записи - "В ожидании"[/COLOR]',
                    "deal",
                    $user_id
            );

        } else {

            // Запрос свободных сеансов
            $seance_get = $y->getBookStaffSeances(
                    $Yclients_company_id,
                    $staff_id
                   //'2022-07-16' , // time(),
                   // []// $userToken
            );
            $y->toLog("Ближайшие свободные сеансы:", $seance_get);
            if($seance_get["success"] == true) {
                foreach ($seance_get["data"]["seances"] as $key => $value) {
                    $time_str.= $value["time"]. PHP_EOL;
                }
                $text_free_seanses = PHP_EOL . 'Ближайшие свободные сеансы на: ' . date('d.m.Y' ,strtotime($seance_get["data"]["seance_date"])) . PHP_EOL . $time_str;
            }


            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Запись клиента '. $task_get['data']['client']['name'] .' '
                    . 'на '.  date("d.m.Y", strtotime($deal[deal_fild_datetime_step1])) .' в '.date("H:i", strtotime($deal[deal_fild_datetime_step1])).'. '
                    . 'невозможна ввиду отсутствия свободного окна или расписания доктора '.$lead_fild_doctor_fio.'. Выберите другое время записи![/COLOR]'
                    .  $text_free_seanses . PHP_EOL . 'Описание: ' . $error_text
                    ,'deal',
                    $user_id
            );

            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE, ]  // В статус "Заявка обработана"
            );
            die;

        }



    } else {


        // Создадим новую заявку в clients


//        $staff_arr = $y->getStaff($Yclients_company_id);
//
//        foreach($staff_arr["data"] as $val) {
//            if(mb_strtoupper(str_replace('  ',' ',mb_strtoupper($val["name"])))  == ($lead_fild_doctor_fio)) {
//                $staff_id = $val["id"];
//            }
//        }

        



        $deal_productrows = $b24->deal_productrows_get($deal_id);
        $b24->toLog("Список товарный позиций", $deal_productrows);



        ### Настройки Услуги ###
        $deal_productrows = $b24->deal_productrows_get($deal_id);

        foreach ($deal_productrows as $key => $item) {
            $b24->toLog("Запрос Продукта из Сделки", $item);
            $product_full = $b24->product_get($item['PRODUCT_ID']); // Запрос продукта со всеми полями
            $b24->toLog("Запрос Продукта product_full", $product_full);
            $service_id = $product_full[deal_product_fild_yclients_service_id]['value']; // Вытаскиваем ID услуги из продукта

            // Получение данных из Б24
            $services[$key]['id'] = $service_id;
            $services[$key]['first_cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта

            // Получить услугу из Yclients
            $Y_resp_services = $y->getServices(
                $Yclients_company_id,
                $service_id
                );
            $b24->toLog("Список услуг Alteg", $Y_resp_services);

            if($Y_resp_services['success'] == 1)
            {
                $seanceLength += $Y_resp_services['data']['duration']; // Длительность услуги берем из Alteg s

                $Y_services[$key]['id'] = $service_id;
                $Y_services[$key]['discount'] = $Y_resp_services['data']['discount'];
                if($product_full['PRICE']>0)
                {
                    $Y_services[$key]['first_cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта
                    $Y_services[$key]['cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта
                }
                else
                {
                    $Y_services[$key]['first_cost'] = $Y_resp_services['data']['first_cost']; // Вытаскиваем цену услуги из продукта
                    $Y_services[$key]['cost'] = $Y_resp_services['data']['cost']; // Вытаскиваем цену услуги из продукта
                }

            }
            else
            {

                $error_text .= $Y_resp_services['meta']['message'] . print_r($Y_resp_services['meta']['errors'], true);
                $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Ошибка запроса услуги из Alteg! [/COLOR]'
                    .  PHP_EOL . 'Описание: ' . $error_text
                    ,'deal',
                    $user_id

                );
                // Изменим статус сделки в Б24
                $b24->deal_update(
                        $deal_id,
                        [ 'STAGE_ID' => STATUS_BEFORE_CREATE, ]  // В статус "Заявка обработана"
                );
                die;
            }

        }

        $b24->toLog("Запрос услуг из карточки товара, из Сделки", $services);
        $b24->toLog("Запрос услуг из Alteg", $Y_services);



        // Если не выбрана не одна услуга
        if(count($Y_services) == 0) {
            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Не выбраны услуги![/COLOR]'
                    ,'deal',
                    $user_id
            );
            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE, ]  // В статус "Заявка обработана"
            );
            die;
        }

        // Если не верно время
        if(empty($deal[deal_fild_datetime_step1])) {
            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Не указанны дата и время записи![/COLOR]'
                    ,'deal',
                    $user_id
            );
            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE, ]  // В статус "Заявка обработана"
            );

        }
        $b24->toLog("Дата и время записи", $deal[deal_fild_datetime_step1]);



        // Данные из Контакта
        // usleep(100000);
        $contact = $b24->contact_get($deal['CONTACT_ID']);
        $b24->toLog("Запрос Контакта", $contact);

        $FIO .= $contact['NAME']; //    Имя
        if($contact['SECOND_NAME'] !='') $FIO .= " ". $contact['SECOND_NAME'];
        if($contact['LAST_NAME'] !='') $FIO .= " ". $contact['LAST_NAME'];

        $phone = $contact['PHONE'][0]['VALUE'];//    Телефон
        $email = $contact['EMAIL'][0]['VALUE'];//    E-mail

        // Если в Yclients не прописана длительность услуг, ставим по умолчанию
        if(empty($seanceLength)) $seanceLength = $seanceLength_default_15min;

        $new_task = $y->postRecords(
      //     $new_task = [
                $Yclients_company_id, // $companyId $companyId ID Компании
                $userToken,   // Токен пользователя
                $staff_id, // Идентификатор сотрудника
                $Y_services,
    //            $services = [
    //                    'id' => 1, // Идентификатор записи для обратной связи после сохранения (смотри ответ на запрос).
    //                     'services' => [   // Массив идентификаторов услуг, на которые клиент хочет записаться
    //                        deal_fild_yclients_service_id
    //                    ],
    //                    'staff_id' =>    ,// Идентификатор специалиста, к которому клиент хочет записаться (0 если выбран любой доктор)
    //                    'datetime' =>  $deal[deal_fild_datetime_step1],  // Дата и время сеанса в формате ISO8601 (передается для каждого сеанса в ресурсе book_times)
    //                ],$client =


                [
                        "phone" => $phone,
                        "name" => $FIO,
                        "email" => $email,
                ],
                $y->toISO($deal[deal_fild_datetime_step1]), // $deal[deal_fild_datetime_step1], // Дата и время записи
                $seanceLength, //Длительность записи в секундах
                false,  //$saveIfBusy Сохранять ли запись если время занято или нерабочее, или выдать ошибку
                false,  // $sendSms boolean Отправлять ли смс с деталями записи клиенту
                $comment, // Комментарий к записи
                0, //$smsRemainHours За сколько часов до визита следует выслать смс напоминание клиенту (0 - если не нужно)
                0, //$emailRemainHours = За сколько часов до визита следует выслать email напоминание клиенту (0 - если не нужно)
                $deal_id,    // Внешний идентификатор записи (будем записывать номер Сделки) $apiId
                0, //$attendance = Статус записи (2 - Пользователь подтвердил запись, 1 - Пользователь пришел, услуги оказаны, 0 - ожидание пользователя, -1 - пользователь не пришел на визит)
                ['b24_deal_id' => $deal_id, 'b24_deal_link'=>DEAL_LINK . $deal_id . '/'],  // null //$custom_fields['btrx_id_deal'] = $deal_id
                $custom_color_consultation_step1  // Цвет фона заявки
  // ];
        );

        $y->toLog("Результат создания заявки", $new_task);

        if($new_task["success"] == false) $error_text .= $new_task['meta']['message'] . print_r($new_task['meta']['errors'], true);




        // Отправим комментарий в Сделку
        if($new_task["success"] == true) { // Если данные сохранены удачно

             // Запишем ответ id заявки из Yclients в Сделку Б24
            $b24->deal_update(
                    $deal_id,
                    [
                        deal_fild_yclients_record_id => $new_task['data']['id'], //$new_task,
                        deal_fild_yclients_url => fild_record_link . $new_task['data']['id'], //$new_task,
                    ]
            );

            $b24->sendComm($deal_id,
                    '[COLOR=#58cc47]Запись для клиента '. $FIO .' была успешно создана в Alteg [/COLOR]'
                    . 'на '.  date("d.m.Y", strtotime($deal[deal_fild_datetime_step1])) .' в '.date("H:i", strtotime($deal[deal_fild_datetime_step1])).'. '
                    . 'Статус записи - "В ожидании"'
                    ,'deal',
                    $user_id
            );

        } else {

            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE, ]  // В статус "Заявка обработана"
            );

            // Запрос свободных сеансов
            $seance_get = $y->getBookStaffSeances(
                    $Yclients_company_id,
                    $staff_id
                   //'2022-07-16' , // time(),
                   // []// $userToken
            );

            if($seance_get["success"] == true) {
                foreach ($seance_get["data"]["seances"] as $key => $value) {
                    $time_str.= $value["time"]. PHP_EOL;
                }

                $text_free_seanses = PHP_EOL . 'Ближайшие свободные сеансы на: ' . date('d.m.Y' ,strtotime($seance_get["data"]["seance_date"])) . PHP_EOL . $time_str;
            }


            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Запись клиента '. $FIO .' '
                    . 'на '.  date("d.m.Y", strtotime($deal[deal_fild_datetime_step1])) .' в '.date("H:i", strtotime($deal[deal_fild_datetime_step1])).'. '
                    . 'невозможна ввиду отсутствия свободного окна или расписания доктора '.$lead_fild_doctor_fio.'. Выберите другое время записи![/COLOR]'
                    .   $text_free_seanses . PHP_EOL . 'Описание: ' . $error_text
                    ,'deal',
                    $user_id
            );

        }


    }


}


#############################################################
###### Создание/изменение запись на операцию в Yclients #####
#############################################################

// https://web.prodvig.kz/script/koblandin/index.php?task=new&lead={{ID}}

if(($_GET['task'] == 'step2')&&($_GET['deal']>0)) { // Создание новой записи
    $deal_id = $_GET['deal'];

    $userToken = $y->getAuth($login, $password);
    $y->toLog("Получаем токен:", $userToken);

    // Данные из Сделки
    $deal = $b24->deal_get($deal_id);
    $b24->toLog("Запрос Сделки", $deal);


    $consultation_format = $deal[fild_consultation_format]; // Получим значение поля Формат консультации, если 28 то создаем заявку в Alteg

    if($consultation_format != 28) {
        $b24->toLog("Формат консультации не очный. Стоп скрипт.", $consultation_format);
        die;
    }

    $Yclients_task_id = $deal[deal_fild_yclients_record_id]; // Получим ID заявки из Б24

    $userB24_id = $deal[DEAL_FILD_DOCTOR2]; // Выбираный доктор 2, для операций

    $b24->toLog("Получен идентификтаор пользователя userB24_id", $userB24_id);


    // Получаем пользователей из Битрикс и у пользователя запрашиваем идентификатор UF_XING который содержит staff_id
    $userB24 = $b24->user_get($userB24_id);
    $b24->toLog("Полученs данные доктора userB24_id", $userB24);
    
    $staff_id = $userB24[0][USER_FILD_DOCTOR];
    $lead_fild_doctor_fio = $userB24[0]["LAST_NAME"] . ' ' . $userB24[0]["NAME"];

    $b24->toLog("Получен идентификтаор доктора userB24_id", $staff_id);

    $b24->toLog("Найденый starr_id", $staff_id);


    // Если не верно выбрали ID доктора
    if(empty($staff_id)) {
        $b24->sendComm($deal_id,
            '[COLOR=#ff0000]Ошибка! Выбранный доктор '.$lead_fild_doctor_fio.' не найден в Alteg![/COLOR]'
            ,'deal',
            $user_id
        );

        // Изменим статус сделки в Б24
        $b24->deal_update(
                $deal_id,
                [ 'STAGE_ID' => STATUS_BEFORE_CREATE_STEP2, ]  // В статус "Заявка обработана"
        );
        die;
    }
        
        
    $date_birthday = '';

   // if($deal[deal_fild_birthday] !='') $date_birthday = date("d.m.Y", strtotime($deal[deal_fild_birthday]));

    // Комментарий к записи;
    $comment = $deal[deal_fild_comments].PHP_EOL; // Комментарий из сделки
    $b24->toLog( "Комментарий к заявке: ", $comment );


    if($Yclients_task_id > 0) { // Если заявка в Yclients есть, то изменим

        $task_get = $y->getRecord(
            $Yclients_company_id,
            $Yclients_task_id,
            $userToken
        );
        $y->toLog("запрос Заявки:", $task_get);

        if($task_get["success"] == false) $error_text .= $task_get['meta']['message'];

        // Если заявка в Alteg удалена
        if($task_get['data']['deleted'] == 1) {
            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Заявка '. $Yclients_task_id .' в Alteg удалена. Очистите поле altegio_record_id в карточке сделки, чтобы созать новую заявку! [/COLOR]'
                    .  PHP_EOL . 'Описание: ' . $error_text
                    ,'deal',
                    $user_id
            );

            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE_STEP2, ]  // В статус "Заявка обработана"
            );
            die;
        }

        
        ### Настройки Услуги ###
        $deal_productrows = $b24->deal_productrows_get($deal_id);

        foreach ($deal_productrows as $key => $item) {
            $b24->toLog("Запрос Продукта из Сделки", $item);
            $product_full = $b24->product_get($item['PRODUCT_ID']); // Запрос продукта со всеми полями
            $b24->toLog("Запрос Продукта product_full", $product_full);
            $service_id = $product_full[deal_product_fild_yclients_service_id]['value']; // Вытаскиваем ID услуги из продукта

            // Получение данных из Б24
            $services[$key]['id'] = $service_id;
            $services[$key]['first_cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта

            // Получить услугу из Yclients
            $Y_resp_services = $y->getServices(
                $Yclients_company_id,
                $service_id
                );
            $b24->toLog("Список услуг Alteg", $Y_resp_services);

            if($Y_resp_services['success'] == 1)
            {
                $seanceLength += $Y_resp_services['data']['duration']; // Длительность услуги берем из Alteg s

                $Y_services[$key]['id'] = $service_id;
                $Y_services[$key]['discount'] = $Y_resp_services['data']['discount'];
                if($product_full['PRICE']>0)
                {
                    $Y_services[$key]['first_cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта
                    $Y_services[$key]['cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта
                }
                else
                {
                    $Y_services[$key]['first_cost'] = $Y_resp_services['data']['first_cost']; // Вытаскиваем цену услуги из продукта
                    $Y_services[$key]['cost'] = $Y_resp_services['data']['cost']; // Вытаскиваем цену услуги из продукта
                }

            }
            else
            {

                $error_text .= $Y_resp_services['meta']['message'] . print_r($Y_resp_services['meta']['errors'], true);
                $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Ошибка запроса услуги из Alteg! [/COLOR]'
                    .  PHP_EOL . 'Описание: ' . $error_text
                    ,'deal',
                    $user_id

                );
                // Изменим статус сделки в Б24
                $b24->deal_update(
                        $deal_id,
                        [ 'STAGE_ID' => STATUS_BEFORE_CREATE_STEP2, ]  // В статус "Заявка обработана"
                );
                die;
            }

        } 

        $b24->toLog("Запрос услуг из карточки товара, из Сделки", $services);
        $b24->toLog("Запрос услуг из Alteg", $Y_services);



        // Если не выбрана не одна услуга
        if(count($Y_services) == 0) {
            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Не выбраны услуги![/COLOR]'
                    ,'deal',
                    $user_id
            );
            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE_STEP2, ]  // В статус "Заявка обработана"
            );
            die;
        }

        // Если в Yclients не прописана длительность услуг, ставим по умолчанию
        if(empty($seanceLength)) $seanceLength = $seanceLength_default_15min;

        $task_get['data']['seance_length'] = $seanceLength;// Длительность процедуры
        $task_get['data']['attendance'] = 0;// Статус записи (2 - Пользователь подтвердил запись, 1 - Пользователь пришел, услуги оказаны, 0 - ожидание пользователя, -1 - пользователь не пришел на визит)
        $task_get['data']['datetime'] = $y->toISO($deal[deal_fild_datetime_step2]);  // Дата и время сеанса в формате ISO8601 +3 часа
        $task_get['data']['custom_fields']['btrx_id_deal'] = $deal_id;
        $task_get['data']['custom_fields']['b24_deal_link'] = DEAL_LINK . $deal_id . '/'; // Кастомное поле с сылкой
        $task_get['data']['comment'] = $comment; // Комментарий к записи;
        $task_get['data']['custom_color'] = $custom_color_consultation_step2; // Цвет заявки
        $task_get['data']['custom_font_color'] = $custom_font_color_consultation_step2; //$custom_font_color; // Цвет текста
        $task_get['data']['services'] = $Y_services; // Меняем услуги
        $task_get['data']['staff_id'] = $staff_id;  

       // $staff_id = $task_get['data']['staff_id'];

        $y->toLog("параметры task_get после изменений:", $task_get['data']);

        // Обновить заявку
        $task_update = $y->putRecord(
            $Yclients_company_id,
            $Yclients_task_id,
            $userToken,
            $task_get['data']
        );

        if($task_update["success"] == false) $error_text .= $task_update['meta']['message'];

        if($task_update["success"] == true) { // Если данные сохранены удачно
            $b24->sendComm($deal_id,
                    '[COLOR=#58cc47]Запись для клиента '. $task_get['data']['client']['name'] .' была успешно перенесена  в Alteg '
                    . 'на '.  date("d.m.Y", strtotime($deal[deal_fild_datetime_step2])) .' в '.date("H:i", strtotime($deal[deal_fild_datetime_step2])).'. '
                    . 'Статус записи - "В ожидании"[/COLOR]',
                    "deal",
                    $user_id
            );

        } else {

            // Запрос свободных сеансов
            $seance_get = $y->getBookStaffSeances(
                    $Yclients_company_id,
                    $staff_id
                   //'2022-07-16' , // time(),
                   // []// $userToken
            );
            $y->toLog("Ближайшие свободные сеансы:", $seance_get);
            if($seance_get["success"] == true) {
                foreach ($seance_get["data"]["seances"] as $key => $value) {
                    $time_str.= $value["time"]. PHP_EOL;
                }
                $text_free_seanses = PHP_EOL . 'Ближайшие свободные сеансы на: ' . date('d.m.Y' ,strtotime($seance_get["data"]["seance_date"])) . PHP_EOL . $time_str;
            }


            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Запись клиента '. $task_get['data']['client']['name'] .' '
                    . 'на '.  date("d.m.Y", strtotime($deal[deal_fild_datetime_step2])) .' в '.date("H:i", strtotime($deal[deal_fild_datetime_step2])).'. '
                    . 'невозможна ввиду отсутствия свободного окна или расписания доктора '.$lead_fild_doctor_fio.'. Выберите другое время записи![/COLOR]'
                    .  $text_free_seanses . PHP_EOL . 'Описание: ' . $error_text
                    ,'deal',
                    $user_id
            );

            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE_STEP2, ]  // В статус "Заявка обработана"
            );
            die;

        }



    } else {


        // Создадим новую заявку в clients


//        $staff_arr = $y->getStaff($Yclients_company_id);
//
//        foreach($staff_arr["data"] as $val) {
//            if(mb_strtoupper(str_replace('  ',' ',mb_strtoupper($val["name"])))  == ($lead_fild_doctor_fio)) {
//                $staff_id = $val["id"];
//            }
//        }

        



        $deal_productrows = $b24->deal_productrows_get($deal_id);
        $b24->toLog("Список товарный позиций", $deal_productrows);



        ### Настройки Услуги ###
        $deal_productrows = $b24->deal_productrows_get($deal_id);

        foreach ($deal_productrows as $key => $item) {
            $b24->toLog("Запрос Продукта из Сделки", $item);
            $product_full = $b24->product_get($item['PRODUCT_ID']); // Запрос продукта со всеми полями
            $b24->toLog("Запрос Продукта product_full", $product_full);
            $service_id = $product_full[deal_product_fild_yclients_service_id]['value']; // Вытаскиваем ID услуги из продукта

            // Получение данных из Б24
            $services[$key]['id'] = $service_id;
            $services[$key]['first_cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта

            // Получить услугу из Yclients
            $Y_resp_services = $y->getServices(
                $Yclients_company_id,
                $service_id
                );
            $b24->toLog("Список услуг Alteg", $Y_resp_services);

            if($Y_resp_services['success'] == 1)
            {
                $seanceLength += $Y_resp_services['data']['duration']; // Длительность услуги берем из Alteg s

                $Y_services[$key]['id'] = $service_id;
                $Y_services[$key]['discount'] = $Y_resp_services['data']['discount'];
                if($product_full['PRICE']>0)
                {
                    $Y_services[$key]['first_cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта
                    $Y_services[$key]['cost'] = $product_full['PRICE']; // Вытаскиваем цену услуги из продукта
                }
                else
                {
                    $Y_services[$key]['first_cost'] = $Y_resp_services['data']['first_cost']; // Вытаскиваем цену услуги из продукта
                    $Y_services[$key]['cost'] = $Y_resp_services['data']['cost']; // Вытаскиваем цену услуги из продукта
                }

            }
            else
            {

                $error_text .= $Y_resp_services['meta']['message'] . print_r($Y_resp_services['meta']['errors'], true);
                $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Ошибка запроса услуги из Alteg! [/COLOR]'
                    .  PHP_EOL . 'Описание: ' . $error_text
                    ,'deal',
                    $user_id

                );
                // Изменим статус сделки в Б24
                $b24->deal_update(
                        $deal_id,
                        [ 'STAGE_ID' => STATUS_BEFORE_CREATE_STEP2, ]  // В статус "Заявка обработана"
                );
                die;
            }

        }

        $b24->toLog("Запрос услуг из карточки товара, из Сделки", $services);
        $b24->toLog("Запрос услуг из Alteg", $Y_services);



        // Если не выбрана не одна услуга
        if(count($Y_services) == 0) {
            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Не выбраны услуги![/COLOR]'
                    ,'deal',
                    $user_id
            );
            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE_STEP2, ]  // В статус "Заявка обработана"
            );
            die;
        }

        // Если не верно время
        if(empty($deal[deal_fild_datetime_step2])) {
            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Не указанны дата и время записи![/COLOR]'
                    ,'deal',
                    $user_id
            );
            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE_STEP2, ]  // В статус "Заявка обработана"
            );

        }
        $b24->toLog("Дата и время записи", $deal[deal_fild_datetime_step2]);



        // Данные из Контакта
        // usleep(100000);
        $contact = $b24->contact_get($deal['CONTACT_ID']);
        $b24->toLog("Запрос Контакта", $contact);

        $FIO .= $contact['NAME']; //    Имя
        if($contact['SECOND_NAME'] !='') $FIO .= " ". $contact['SECOND_NAME'];
        if($contact['LAST_NAME'] !='') $FIO .= " ". $contact['LAST_NAME'];

        $phone = $contact['PHONE'][0]['VALUE'];//    Телефон
        $email = $contact['EMAIL'][0]['VALUE'];//    E-mail

        // Если в Yclients не прописана длительность услуг, ставим по умолчанию
        if(empty($seanceLength)) $seanceLength = $seanceLength_default_60min;

        $new_task = $y->postRecords(
      //     $new_task = [
                $Yclients_company_id, // $companyId $companyId ID Компании
                $userToken,   // Токен пользователя
                $staff_id, // Идентификатор сотрудника
                $Y_services,
    //            $services = [
    //                    'id' => 1, // Идентификатор записи для обратной связи после сохранения (смотри ответ на запрос).
    //                     'services' => [   // Массив идентификаторов услуг, на которые клиент хочет записаться
    //                        deal_fild_yclients_service_id
    //                    ],
    //                    'staff_id' =>    ,// Идентификатор специалиста, к которому клиент хочет записаться (0 если выбран любой доктор)
    //                    'datetime' =>  $deal[deal_fild_datetime_step1],  // Дата и время сеанса в формате ISO8601 (передается для каждого сеанса в ресурсе book_times)
    //                ],$client =


                [
                        "phone" => $phone,
                        "name" => $FIO,
                        "email" => $email,
                ],
                $y->toISO($deal[deal_fild_datetime_step2]), // $deal[deal_fild_datetime_step1], // Дата и время записи
                $seanceLength, //Длительность записи в секундах
                false,  //$saveIfBusy Сохранять ли запись если время занято или нерабочее, или выдать ошибку
                false,  // $sendSms boolean Отправлять ли смс с деталями записи клиенту
                $comment, // Комментарий к записи
                0, //$smsRemainHours За сколько часов до визита следует выслать смс напоминание клиенту (0 - если не нужно)
                0, //$emailRemainHours = За сколько часов до визита следует выслать email напоминание клиенту (0 - если не нужно)
                $deal_id,    // Внешний идентификатор записи (будем записывать номер Сделки) $apiId
                0, //$attendance = Статус записи (2 - Пользователь подтвердил запись, 1 - Пользователь пришел, услуги оказаны, 0 - ожидание пользователя, -1 - пользователь не пришел на визит)
                ['b24_deal_id' => $deal_id],  // null //$custom_fields['btrx_id_deal'] = $deal_id
                $custom_color_consultation  // Цвет фона заявки
  // ];
        );

        $y->toLog("Результат создания заявки", $new_task);

        if($new_task["success"] == false) $error_text .= $new_task['meta']['message'] . print_r($new_task['meta']['errors'], true);




        // Отправим комментарий в Сделку
        if($new_task["success"] == true) { // Если данные сохранены удачно

             // Запишем ответ id заявки из Yclients в Сделку Б24
            $b24->deal_update(
                    $deal_id,
                    [
                        deal_fild_yclients_record_id => $new_task['data']['id'], //$new_task,
                        deal_fild_yclients_url => fild_record_link . $new_task['data']['id'], //$new_task,
                    ]
            );

            $b24->sendComm($deal_id,
                    '[COLOR=#58cc47]Запись для клиента '. $FIO .' была успешно создана в Alteg [/COLOR]'
                    . 'на '.  date("d.m.Y", strtotime($deal[deal_fild_datetime_step2])) .' в '.date("H:i", strtotime($deal[deal_fild_datetime_step2])).'. '
                    . 'Статус записи - "В ожидании"'
                    ,'deal',
                    $user_id
            );

        } else {

            // Изменим статус сделки в Б24
            $b24->deal_update(
                    $deal_id,
                    [ 'STAGE_ID' => STATUS_BEFORE_CREATE_STEP2, ]  // В статус "Заявка обработана"
            );

            // Запрос свободных сеансов
            $seance_get = $y->getBookStaffSeances(
                    $Yclients_company_id,
                    $staff_id
                   //'2022-07-16' , // time(),
                   // []// $userToken
            );

            if($seance_get["success"] == true) {
                foreach ($seance_get["data"]["seances"] as $key => $value) {
                    $time_str.= $value["time"]. PHP_EOL;
                }

                $text_free_seanses = PHP_EOL . 'Ближайшие свободные сеансы на: ' . date('d.m.Y' ,strtotime($seance_get["data"]["seance_date"])) . PHP_EOL . $time_str;
            }


            $b24->sendComm($deal_id,
                    '[COLOR=#ff0000]Запись клиента '. $FIO .' '
                    . 'на '.  date("d.m.Y", strtotime($deal[deal_fild_datetime_step2])) .' в '.date("H:i", strtotime($deal[deal_fild_datetime_step2])).'. '
                    . 'невозможна ввиду отсутствия свободного окна или расписания доктора '.$lead_fild_doctor_fio.'. Выберите другое время записи![/COLOR]'
                    .   $text_free_seanses . PHP_EOL . 'Описание: ' . $error_text
                    ,'deal',
                    $user_id
            );

        }


    }


}


#############################################################
######    Удаление записи, в Б24 двигаем в стадию Отказ  ####
#############################################################


if (($_GET['task'] == 'delete') && ($_GET['deal']>0)) {
    $deal_id = $_GET['deal'];

    $userToken = $y->getAuth($login, $password);
    $y->toLog("Получаем токен:", $userToken);

    // Данные из Сделки
    $deal = $b24->deal_get($deal_id);
    $b24->toLog("Запрос Сделки", $deal);

    $Yclients_task_id = $deal[deal_fild_yclients_record_id]; // Получим ID заявки из Б24

    // Если не верно время
    if(empty($Yclients_task_id)) {
        $b24->sendComm($deal_id,
            '[COLOR=#ff0000]По данной Сделке не создана Заявка в Alteg! Для создания заявки переместите в статус "Записан".[/COLOR]'
            ,'deal',
            $user_id
            );
        die;
//        // Изменим статус сделки в Б24
//        $b24->deal_update(
//                $deal_id,
//                [ 'STAGE_ID' => STATUS_BEFORE_CREATE, ]  // В статус "Заявка обработана"
//        );

    }

    ### Получить настройки Филиала ###
    // получить ID филиала из Списка
//    $company = $b24->lists_element_get(
//            IBLOCK_FILIAL,
//            [ '=ID' => $deal[deal_fild_filial__select_id] ]
//            );
//
//    $b24->toLog( "Запрос Филиала из Списка", $company );
//
//    $Yclients_company_id = current($company[0][LISTS_FILIAL_fild_yclients_id]);
//    $b24->toLog( "Запрос ID Филиала из Списка", $Yclients_company_id );
//
//    // Если не верно выбрали ID филиала
//    if(empty($Yclients_company_id)) {
//        $b24->sendComm($deal_id,
//            'Не указан Адрес записи (филиал)!'
//        );
//        die;
//    }


    $task_delete = $y->deleteRecord(
           $Yclients_company_id,
           $Yclients_task_id,
           $userToken
    );

    $y->toLog("Результат удаления заявки", $task_delete);


    // Очистим id записи Alteg
    $b24->deal_update(
            $deal_id,
            [
                deal_fild_yclients_record_id => '',   // Клиент пришел
            ]
    );

    // Отправим комментарий в Сделку
  // if($task_delete["success"] == true) { // Если данные удалены удачно
   // if(1) { // Если данные сохранены удачно
        $b24->sendComm($deal_id,
                '[COLOR=#df532d]Клиент '. $FIO .' отказался от проведения услуги '
                . 'на '.  date("d.m.Y", strtotime($deal[deal_fild_datetime_step1])) .' в '.date("H:i", strtotime($deal[deal_fild_datetime_step1])).'. '
                . 'Запись была удалена в Alteg![/COLOR]'
                ,'deal',
                $user_id
        );
  //  }
    $b24->toLog("Разница во времени", date("d.m.Y H:i", strtotime($deal[deal_fild_datetime_step1])));

}



