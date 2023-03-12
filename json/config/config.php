<?php

const LOG_ON = 1; // запись логов

// Часовой пояс
date_default_timezone_set('Asia/Almaty'); 
 
//Подключение файлов 
define('DIR_ROOT', dirname(__FILE__));
$file_Log = DIR_ROOT . '/config/logFile.txt'; // Путь к лог файлу
$cookie = DIR_ROOT . '/config/cookie.txt';   // Путь для файла cookie.txt
//$temp_file = DIR_ROOT . '/config/temp.txt';   // Путь для файла с продукам
$process_file = DIR_ROOT . '/config/process.txt'; // Путь к блокировщику повторного запуска


//Подключение к базе данных
$hostname   = "localhost";
$username   = "v_roofing-center";
$password   = "____";
$dbname     = "v_roofing_center";

const VATID = 3;   // id налога с 12%
const VAT_INCLUDED = 'Y'; // Налог включен в стоимость

$iblockId = 25; // Торговый католог тип информационного блока;


// Настройки Базы данных. Таблицы
$table_quantity_1c = 'quantity_1c'; // Таблица количество от 1С
$table_quantity_b24 = 'quantity_b24'; // Таблица количество от Б24

$table_product_1c = 'product_1c'; // Таблица Номенклатура от 1С
$table_product_b24 = 'product_b24'; // Таблица Номенклатура от Б24

$table_structure_1c = 'structure_1c'; // Таблица Структура(папки) от 1С
$table_structure_b24 = 'structure_b24'; // Таблица Структура (папки) от Б24


 

// Категория товара
$fild_category_1C_parent =  'description';   //Связка Категории товара с 1С
$Parent_value =  '00000000-0000-0000-0000-000000000000'; // UID родительской категории или пустая строка
                    

// Товар
const PRODUCT_FOLDER_UID_ACTUAL_FALSE = "bb71451c-48c2-11ea-a904-7085c225c76e"; // Название папки в которой будут не активные, не актульные товары

const DEAL_FIELD_ARTICUL = 'PROPERTY_111';    // Артикул
const TNVED = 'PROPERTY_113';   // tnved 

const FILD_PRODUCT_EDINIC_IZMER_REPORT = 'PROPERTY_139'; // Отчетная еденица измерения
// const FILD_PRICE = 'PROPERTY_527'; // Поле Цена в карточки облать Общие 
 

const FILD_PRODUCT_1C_UID =  'PROPERTY_115';   // Связка id с 1С
const  FILD_PRODUCT_1C_CODE =  'PROPERTY_117';   // Связка id с 1С
const FILD_PRODUCT_1C_CAT_UID =  'PROPERTY_137';   //Связка Категории товара с 1С

// const FILD_PRODUCT_DISCRIPTION  =  'PROPERTY_109';  // Характеристика товара
// const FILD_PRODUCT_SIZE  =  'PROPERTY_105';  // Поле размер
// const FILD_PRODUCT_COLOR  =  'PROPERTY_107';  // Поле цвет
 
const FILD_PRODUCT_coef_m2  =  'PROPERTY_121';  // Коэффициенты
const FILD_PRODUCT_coef_sht  =  'PROPERTY_125';  // Коэффициенты 
const FILD_PRODUCT_coef_upak  =  'PROPERTY_127';  // Коэффициенты
const FILD_PRODUCT_coef_palet  =  'PROPERTY_129';  // Коэффициенты
const FILD_PRODUCT_coef_plita  =  'PROPERTY_131';  // Коэффициенты
const FILD_PRODUCT_coef_m3  =  'PROPERTY_133';  // Коэффициенты 
const FILD_PRODUCT_coef_kg  =  'PROPERTY_135';  // Коэффициенты


const PRESET_ID_FIZ_LICO = 5; // Шаблон физ.лица
const PRESET_ID_UR_LICO = 3; // Шаблон физ.лица

// const FILD_ED_IZM_TO_M2 = 'PROPERTY_193';
//const FILD_COEFF_FOR_M2 = 'PROPERTY_145';


// Склады
const STORE1 = 'PROPERTY_107'; // Свободные остатки
const STORE2 = 'PROPERTY_109'; // Зарезервированные остатки
const STORE3 = 'PROPERTY_149'; // Зарезервированные остатки
const STORE4 = 'PROPERTY_151'; // Зарезервированные остатки
const STORE5 = 'PROPERTY_153'; // Зарезервированные остатки
 
//const SKLAD1 = 'PROPERTY_529'; // STROHER GMBH DE
//const SKLAD1_PRIZNAK = '000000002'; // Идентификатор склада
//
//const SKLAD2 = 'PROPERTY_531'; // Основной склад
//const SKLAD2_PRIZNAK = '000000001'; // Идентификатор склада
//
//const SKLAD3 = 'PROPERTY_533'; // FELDHAUS KLINKER VERTRIEBS GMBH DE
//const SKLAD3_PRIZNAK = '000000003'; // Идентификатор склада 
//
//const SKLAD4 = 'PROPERTY_535'; //Борнит ООО
//const SKLAD4_PRIZNAK = '000000004'; // Идентификатор склада
//
//const SKLAD5 = 'PROPERTY_537'; // Quick Mix
//const SKLAD5_PRIZNAK = '000000005'; // Идентификатор склада
//
//const SKLAD6 = 'PROPERTY_539'; // Резерв
//const SKLAD6_PRIZNAK = '000000007'; // Идентификатор склада
//
//const SKLAD7 = 'PROPERTY_541'; // MBS
//const SKLAD7_PRIZNAK = '000000010'; // Идентификатор склада
//
//const SKLAD8 = 'PROPERTY_543'; // MUHR KLINKERWERK
//const SKLAD8_PRIZNAK = '000000009'; // Идентификатор склада
//
//const SKLAD9 = 'PROPERTY_545'; // ООО СТО
//const SKLAD9_PRIZNAK = '000000006'; // Идентификатор склада
//
//const SKLAD10 = 'PROPERTY_171'; //Итого по складам
//const SKLAD10_PRIZNAK = 'Total'; // Идентификатор склада

 
const FILD_PRODUCT_division = 'PROPERTY_143'; // Идентификатор региона
 
// Идентификаторы регионов (создаем одинаковые товары по каждому региону со своей ценой)
$region_arr_index['5783d136-a967-11eb-88a0-7085c225c76e'] = 99; // г.Караганда
$region_arr_index['1b3e4713-90de-11e1-a9d8-6c626d78d2f8'] = 101; // г.Усть-Каменогорск
$region_arr_index['902bf29f-d8b8-11e3-813e-902b345ade16'] = 103; //г.Павлодар
$region_arr_index['1b3e4714-90de-11e1-a9d8-6c626d78d2f8'] = 105; //г.Нур-Султан
$region_arr_index['1ac9f018-78f9-11e8-873c-7085c225c76e'] = 107; //г.Семей
$region_arr_index['867203e5-e5fc-11e9-80c7-7085c225c76e'] = 109; //г.Алматы 
$region_arr_index['00000000-0000-0000-0000-000000000000'] = null; //

// Склады, по которым разрешено брать остатки. (Основные по регионам)
//$store_need = [
//    "40b03c17-82d7-11e1-b608-e02a822a5f2d", // "WarehouseName": "Склад г. Астана",
//    "5783d138-a967-11eb-88a0-7085c225c76e", // "WarehouseName": "Склад г. Караганда",
//    "902bf2a0-d8b8-11e3-813e-902b345ade16", // "WarehouseName": "Склад г. Павлодар",
//    "1ac9f01a-78f9-11e8-873c-7085c225c76e", // "WarehouseName": "Склад г. Семей",
//    "40b03c14-82d7-11e1-b608-e02a822a5f2d", // "WarehouseName": "Склад г. Усть-Каменогорск",
//];
 

$store_need["40b03c17-82d7-11e1-b608-e02a822a5f2d"] = 1; // "WarehouseName": "Склад г. Астана",
$store_need["5783d138-a967-11eb-88a0-7085c225c76e"] = 2;    // "WarehouseName": "Склад г. Караганда",
$store_need["902bf2a0-d8b8-11e3-813e-902b345ade16"] = 3; // "WarehouseName": "Склад г. Павлодар",
$store_need["1ac9f01a-78f9-11e8-873c-7085c225c76e"] = 4; // "WarehouseName": "Склад г. Семей",
$store_need["40b03c14-82d7-11e1-b608-e02a822a5f2d"] = 5; // "WarehouseName": "Склад г. Усть-Каменогорск",


// Еденицы измерения  

$measure_value_key['упак']  = '27';
$measure_value_key['т']  = '25';
$measure_value_key['пог. м']  = '23';
$measure_value_key['плита']  = '21';
$measure_value_key['м3']      = '19';
$measure_value_key['м2']   = '17';
$measure_value_key['лист']     = '15';
$measure_value_key['вагон']     = '13'; 
$measure_value_key['бут']      = '11';

$measure_value_key['шт']      = '9';
$measure_value_key['кг']      = '7'; 
$measure_value_key['г']       = '5'; 
$measure_value_key['л']      = '3'; 
$measure_value_key['м']       = '1'; 

$measure_key_value = array_flip($measure_value_key); // Ключами становятся цифры

// Задачи
// Отгрузка товара кладовщиком
$task_title = 'Отгрузить: '; // Заголовок задачи 
const TASK_TIME_OTGRUZKA_TOVARA = 24;  // Время выполнение Задачи 
const TASK_AUDITORS_1_ID = "21"; // Наблюдатель    Сахинур Темирова
const TASK_AUDITORS_2_ID = "9";  // Фарид Губайдуллин, теперь ответсвенный по Сделки 
const TASK_RESPONSIBLE_ID = "1227"; // "Исполнитель" кладовщик,  Игорь Ромащенко 
const TASK_FILD_CONTACT_ADRESS = 'UF_CRM_1636271072790';

###### Файлы #############  
$folder_id  = '8959'; // В какую папку сохранять Накладные.  PRODVIG


######    Договор  #############
const CONTRACT_FILD_NUMBER = 'UF_CRM_1636266124'; // Поле в Сделке - Номер договора
const CONTRACT_FILD_DATE = 'UF_CRM_1636266152'; // Поле в Сделке - Номер договора

 

#########    Документы     ###################
const CHASTNOE_LICO_INN = '123456789012'; // Условие применяется при создании документов
const MEASURE_CODE_M2 = 55; // Код ед изм. при котором переводим м2 -> штуки и вычисляем наличие на складе
const DEAL_FILD_NUMERATOR_PRILOJENIYA_N1 = 'UF_CRM_1649824605163'; // Код ед изм. при котором переводим м2 -> штуки и вычисляем наличие на складе



// ----------------- Bitrix 24 ------------------ //
// Создаем Входящий ВебХук и берем ссылку.
$queryUrl = 'https://krov.bitrix24.kz/rest/73/c8________/'; // URL к CRM

// ----------------- 1C ------------------ //
$login_1c = ""; 
$password_1c = "";  

// Чтобы 1С не ждала завершения работы скрипта ответим ей сразу, чтобы не тормозила.
function sendOK200for1C() { 
    ignore_user_abort(true);
    //set_time_limit(0);
    ob_start();
    // echo $some_response; // если нужно вернуть какие-то данные
    header('Connection: close');
    header('Content-Length: '.ob_get_length());
    ob_end_flush();
    ob_flush();
    flush();
    toLog("Ответили 1С. Заголовок: ОК 200", $resp_total);
}

// Запросы выполняются с заданным количеством записей.
// Запрос структуры невыдает какое количество находтся в БД, поэтому высталяем вручную
function requestBitrixListForIDs($link, $POSTFIELDS = null) {
    
    $batch_count_max = 50; // За один запрос через batch можно получить 50 подзапросов
    $resp_total = count($POSTFIELDS);// Количество записей всего 
    $next = 0;
    $resp_array = array(); 
      
    toLog("Количество записе для Баш", $resp_total); 
 //  die;  
//    echo "Количество записе для Баш";
//    print_r($resp_total);
    
    for ($i = 1; $i <= ceil($resp_total / 50); $i++) { // если записей больше чем 50*50 =250 то создаем следующие запросы к Битрикс
    
        $batch = array();

        for ($a = 1; $a <= $batch_count_max; $a++) { // заполняем подзапросами с ограничением 50
          //  $POSTFIELDS['start'] = $next;
            $batch['resp_'.$i.'_row_'.$a] = $link.'?'.http_build_query($POSTFIELDS[$next]);

            $next = $next + 1;
            
            $delta = $resp_total - $next; // Вычисляем надо ли еще добавлять подзапрос
            if($delta > 50) {
                $delta = $batch_count_max;
            } 
            
            if($delta <= 0)  break;
        }
     
        usleep(100000); 
        $rest = requestBitrix('/batch.json', ['cmd' => $batch]); // делаем запрос к Битрикс
        toLog("Структура Баш:", $batch);
         
        // toLog("Формат", $rest);
        
        $count_items = count($rest['result']['result']);
        
        toLog("Запрос пакета данных. Количество", count($count_items)); 
        //  toLog("Запрос пакета данных",($rest)); 
        
        // Если записи закончились в БД, выходим
        if (empty($count_items)) {
            toLog("Выбраны все записи, прервать запрос", $count_items);
            return $resp_array;
        }
        
        if (array_key_exists('result', $rest['result'])) {
            
            foreach ($rest['result']['result'] as $key => $value)  {
                $resp_array[] = $value;      
            }
        } else  {   

            foreach ($rest['result'] as $key => $value)  {
                $resp_array = array_merge($resp_array, $value);
            }
            
        }
          
    }
   return $resp_array;
}

// Выборка по 50 товаров, для методов get, по одному id
function selectBitrixParts50 ($link, $POSTFIELDS = null) {
   
    $array_count = count($POSTFIELDS);
    $next =0;
    $resp_array = array();

    
    foreach ($POSTFIELDS as $key => $value) {
        $next++;
        $batch['resp_'.$key.'_row_'.$key] = $link.'?'.http_build_query($value);
        
        if(($next%50 == 0)||($next == $array_count)) {
            
//             echo "Партия";
//            print_r($batch);
//            die;              
 
            
            usleep(500000); 
            $rest = requestBitrix('/batch.json', ['cmd' => $batch]); // делаем запрос к Битрикс
            toLog("Запрос пакета selectBitrixParts50", count($batch)); 
            $batch = [];
           //  toLog("Результат пакета selectBitrixParts50", $rest);       
     
            if (array_key_exists('result', $rest['result'])) {
                foreach ($rest['result']['result'] as $key => $value)  {
                    if (array_key_exists('products', $value)) {
                         foreach ($value as $key_products => $value_products)  {
                             $resp_array = array_merge($resp_array, $value_products); 
                         }
                    } else {
                        $resp_array = array_merge($resp_array, $value); 
                    }
   
                }
                
            } elseif (array_key_exists('products', $rest['result'])) {
                foreach ($rest['result']['products'] as $key => $value)  {
                    $resp_array = array_merge($resp_array, $value);   
                } 
                
            } elseif (array_key_exists('0', $rest['result'])) {
                foreach ($rest['result'] as $key => $value)  {
                    $resp_array = array_merge($resp_array, $value);
                }

            }
        }
    }

    return $resp_array;
}

 
// Групповая вставка товара
function insertBitrixListBatch ($POSTFIELDS = null) { 
   
    $array_count = count($POSTFIELDS);
    $next = 0; 
    $serias = 0; // Контролируем превышение 50 конструкций  

    foreach ($POSTFIELDS as $keyb => $blok){ // в каждом блоке серия на контакт с реквизитами или компания с реквизитами
        
        if(($serias + count($blok)) > 50){ 
            
            // usleep(100000);  
            $rest = requestBitrix('/batch.json', ['cmd' => $batch]); // делаем запрос к Битрикс
            toLog("Изменения базы Б24 insertBitrixList", count($batch));  
            // toLog("Изменения базы Б24 insertBitrixList", ($batch)); 
            $batch = [];
            $serias = 0; 
            set_time_limit(600);
        }
        
        $serias += count($blok); // Накапливаем
        
        foreach ($blok as $key => $value) { 
            $next++;
            $batch[$key] = $value['link'].'?'.http_build_query($value['query']);
        }
    }
      
    // Если остались остатки по заполенению буфера, до отправим тоже
    if(count($batch) > 0) {    
              
            // usleep(100000);     
            $rest = requestBitrix('/batch.json', ['cmd' => $batch]); // делаем запрос к Битрикс
            toLog("Изменения базы Б24 insertBitrixList. Остаток: ", count($batch)); 
            // toLog("Изменения базы Б24 insertBitrixList", ($batch)); 
            $batch = [];
            $serias = 0;
            set_time_limit(600); 
    }
    return $rest;  
}


 

// Групповая вставка товара
function insertBitrixList ($link, $POSTFIELDS = null) {
  
    $array_count = count($POSTFIELDS);
    $next =0;

    
    foreach ($POSTFIELDS as $key => $value) {
        $next++;
        $batch['resp_'.$key.'_row_'.$key] = $link.'?'.http_build_query($value);
        
        if(($next%50 == 0)||($next == $array_count)) {
            
//             echo "Партия";
//            print_r($batch);
//            die;              

            
           usleep(100000); 
           $rest = requestBitrix('/batch.json', ['cmd' => $batch]); // делаем запрос к Битрикс
           toLog("Изменения базы Б24 insertBitrixList", count($batch)); 
           $batch = [];
           
        }
    }
    
    return $rest;

}


// Группируем запросы в batch
function requestBitrixList($link, $POSTFIELDS = null) {
      $batch_count_max = 50; // За один запрос через batch можно получить 50 подзапросов
    
    $resp_info = requestBitrix($link, $POSTFIELDS);
    $resp_total = $resp_info['total']; // Количество записей всего 
    $next_count = 0;
    $resp_array = array();
   
    toLog("Количество записе для Баш",$resp_total);
    toLog("Первые 50 записей.",$resp_info );
// die;     
//    echo "Количество записе для Баш";
//    print_r($resp_total);
    
    for ($i = 1; $i <= ceil($resp_total / 2500); $i++) { // если записей больше чем 50*50 =250 то создаем следующие запросы к Битрикс
    
        $batch = array();

        for ($a = 1; $a <= $batch_count_max; $a++) { // заполняем подзапросами с ограничением 50
            $POSTFIELDS['start'] = $next_count;
            $batch['resp_'.$i.'_row_'.$a] = $link.'?'.http_build_query($POSTFIELDS);

            $next_count = $next_count + 50;
            
            $delta = $resp_total - $next_count; // Вычисляем надо ли еще добавлять подзапрос
            if($delta > 50) {
                $delta = $batch_count_max;
            } 
            
            if($delta <= 0)  break;
        }
     
        usleep(100000);
        $rest = requestBitrix('/batch.json', ['cmd' => $batch]); // делаем запрос к Битрикс
        
        toLog("Запрос пакета данных",count($batch)); 
             //   toLog("Запрос пакета данных",($rest)); 

        
 // toLog("Отправили запрос 500"); 
//        echo "Собираем ответ<pre>"; 
//        print_r($value);   die; 
        
        if (array_key_exists('result', $rest['result'])) {
            foreach ($rest['result']['result'] as $key => $value)  {
               // toLog("Проверка значения",($value));  
    //            if (array_key_exists('tasks', $value)) {
    //
              //  if([sections])
                if (array_key_exists('sections', $value)) {
                    foreach ($value as $key1 => $value1) {
                            $resp_array = array_merge($resp_array, $value1);     
                    }
                    
                } elseif (array_key_exists('products', $value)) { // Если разбираем товары
                    foreach ($value as $key1 => $value1) {
                            $resp_array = array_merge($resp_array, $value1);     
                    }
                    
                } else {
                    $resp_array = array_merge($resp_array, $value);   
                }
            }
        } else  {    toLog("для товара",($rest));  
      //  } elseif (array_key_exists('0', $rest['result'])) {
            foreach ($rest['result'] as $key => $value)  {
                $resp_array = array_merge($resp_array, $value);
            }
            
        }
          
    }
   return $resp_array;
}

// function requestBitrixBach($POSTFIELDS = null) { // Для Баш запросов
//     global $queryUrl;
//          $curl=curl_init();
//          curl_setopt($curl, CURLOPT_URL, $queryUrl .'/batch.json');
//          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
//          curl_setopt($curl, CURLOPT_POST, 1);
//          curl_setopt($curl, CURLOPT_HEADER, 0);
//          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//          curl_setopt($curl,CURLOPT_POSTFIELDS, http_build_query($POSTFIELDS));
//          $out = curl_exec($curl);
//          $code = curl_getinfo($curl,CURLINFO_HTTP_CODE); // Получим HTTP-код ответа сервера
//          curl_close($curl); // Завершаем сеанс cURL
//          $code = (int)$code;
//           $errors = array(
//               301 => 'Переехал навсегда',
//               400 => 'Неверный запрос',
//               401 => 'Несанкционированное',
//               403 => 'Запрещено',
//               404 => 'Не найдено',
//               500 => 'Внутренняя ошибка сервера',
//               502 => 'Плохой шлюз',
//               503 => 'Сервис недоступен'
//           );

//           if($code!=200 && $code!=204) {
//               toLog("Ответ/ошибка Bitrix",(isset($errors[$code]) ? $errors[$code] : 'Неизвестная ошибка'));
//               toLog("Описание", $out);

//               file_put_contents($process_file, ""); // Разрешаем следующий запуск скрипта
//               toLog("Разрешаем следующий запуск скрипта");
//               die;
//           }

//          $resp = json_decode($out, true);
//          return $resp;
// }


function requestBitrix($link, $POSTFIELDS = null) // Для одиночных запросов (максимум 50 записей)
{
   // var_dump( http_build_query($POSTFIELDS) );
      global $queryUrl;
      $curl=curl_init();
      curl_setopt($curl, CURLOPT_URL, $queryUrl.''.$link);
          //  var_dump($queryUrl.''.$link);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_HEADER, 0);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl,CURLOPT_POSTFIELDS, http_build_query($POSTFIELDS));
      $out = curl_exec($curl);
      $code = curl_getinfo($curl,CURLINFO_HTTP_CODE); // Получим HTTP-код ответа сервера
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

      if($code!=200 && $code!=204) {
          toLog("Ответ/ошибка Bitrix",(isset($errors[$code]) ? $errors[$code] : 'Неизвестная ошибка'));
          toLog("Описание", $out);
            //file_put_contents($process_file, ""); // Разрешаем следующий запуск скрипта
           //  toLog("Разрешаем следующий запуск скрипта");
         // die;
      }
      $Response = json_decode($out, true);
      // toLog("Ответ Bitrix", $Response); 

      return($Response);
}


function getproduct($id) {
    // Получаем товары из Битрикс
    $queryData = array(
            "id" => $id, 
    );
  
    usleep(300000);
   // $products_full = requestBitrix('catalog.product.get', $queryData);
    $products_full = requestBitrix('crm.product.get', $queryData);
    $products_full = $products_full["result"];
    // $products_full = $products_full["result"]["product"];
    return $products_full;
//         echo "<pre>products_id"; 
//    var_dump($products_full);  
}

// Отправить уведомление пользователю
function sendNotify($USER_ID, $comment) {
    if(empty($USER_ID)) return false;

    $queryData2 = (array(
      //  "FIELDS" => array(
            "USER_ID" => $USER_ID, 
            "MESSAGE" => $comment,
            // "TAG" => $comment, 
      //  ),
    ));
    
    toLog("Отправляем сообщение менеджеру: ", $queryData2);
    $resp = requestBitrix('im.notify.system.add', $queryData2);
    return $resp; // ['result']; 
} 

// Отправить комментарий в сущность
function sendComm($ENTITY_ID, $comment, $ENTITY_TYPE = "deal") {
    $queryData = (array(
        "fields" => array(
            "ENTITY_ID" => $ENTITY_ID,
            "ENTITY_TYPE" => $ENTITY_TYPE,
            "COMMENT" => $comment,
        ),
    ));
    toLog("Отправляем комментарий к Сущности. $ENTITY_TYPE $ENTITY_ID", $comment);
//    Тип элемента, к которому привязан комментарий.
//    Значения:
//    lead - лид;
//    deal - сделка;
//    contact - контакт;
//    company - компания;
//    order - заказ. 
    
    $comment = requestBitrix('crm.timeline.comment.add', $queryData);
    // var_dump($comment);
}






// Запише логи в файл
function toLog($textTitl='',$textLog='') {

    if (LOG_ON) {   

        global $file_Log;
        file_put_contents($file_Log, $textTitl."\n\r".print_r($textLog, true), FILE_APPEND);
        file_put_contents($file_Log, "\n\r".'======================= '.date('Y-m-d H:i:s') .'======================= '."\n", FILE_APPEND);
    
//        echo ('======================= '.date('Y-m-d H:i:s') .'======================= </br>');
//        echo $textTitl ."</br>";
//        echo "<pre>";
//
//           // print_r($textLog, true);
//        
//              var_dump($textLog);
//            //  print_r($textLog, true);
//        
//        echo "</pre>";


    }
}



function resp_BD ($query) {
    global $hostname,$username,$password,$dbname;

    $conn = mysqli_connect($hostname, $username, $password,$dbname);

    if ($conn === false) {
        toLog("Ошибка подключения к БД: ", mysqli_connect_error());
        die;
    } 


    // $result = mysqli_query($conn, $query); 
    
    // if($result){
    //  while($row = mysqli_fetch_array($result)){
    //      $name = $row["$yourfield"];
    //      echo "Name: ".$name."br/>";
    //  }
    // }

    if ( $result = mysqli_query($conn, $query) ) {
        toLog("Запрос выполнен");
     } else {
        toLog("Ошибка: ", mysqli_error($conn));
        die;
     }
    
    // Закрыть подключение
    mysqli_close($conn);
    return $result;
}
 
// Экранирует ковычки
function apostrophOf ($string) {
    $string = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $string);
    return $string;
}


function sendTo1c($url, $data){
   $ch = curl_init();
   if (strtolower((substr($url,0,5))=='https')) { // если соединяемся с https
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   }
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  // curl_setopt($ch, CURLOPT_USERPWD, "ТемироваС:"); 
   curl_setopt($ch, CURLOPT_USERPWD,"Программист:627153");   
   
   curl_setopt($ch, CURLOPT_URL, $url); 
   // откуда пришли на эту страницу
   curl_setopt($ch, CURLOPT_REFERER, $url);
   // cURL будет выводить подробные сообщения о всех производимых действиях
   curl_setopt($ch, CURLOPT_VERBOSE, 1);
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // http_build_query 
   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   //сохранять полученные COOKIE в файл
   curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie );
   $result=curl_exec($ch);
   
   $result= ltrim ($result,'﻿');
   
   $result = trim($result);
   curl_close($ch);
   toLog("Ответ 1С", $result);
   $Response = json_decode($result, true);   
   //$Response = $result;
   return $Response;
}

// Ответ для 1С в JSON
function respondTo1C($date) {
    $respond = json_encode($date);
    echo $respond;
}

// Обновления Сделки
function deal_update ($deal_id, $fiels) {
    $queryData = [
                'id'  => $deal_id,
                'fields' =>  $fiels,
    ];
    toLog('Отправляем данные для обновления Сделки', $queryData);

    $b24_resp = requestBitrix('crm.deal.update', $queryData);
    toLog('Б24. Обновляем Сделку', $b24_resp);  
}


// Обновления Сделки
function deal_get ($deal_id) {
    $queryData = array(
        'id'  => $deal_id   
    );
    
    toLog('Отправляем данные для запроса Сделки', $queryData);

    toLog('Запрашиваем сделку', $queryData);
    $deal = requestBitrix('crm.deal.get', $queryData);
    $deal = $deal['result']; 
    toLog('Получена сделка', $deal);
    return  $deal;
}

// Временная функция для превода из шт в м2, из строки выбирает числа их переводит опять в строку
function ToM2 ($string, $coeff) {
        
    if( ($string == '')|| ($string == 0) ) return '';

    if(($coeff == 0) || ($coeff == '')) $coeff = 1; 

//    $temp_ed = explode("/", $string);
//    $temp1 = explode("-", $temp_ed[0]);
    
//    if($temp1[1]>0) $temp1 = number_format(round($temp1[1]/$coeff,3),3);
//    else $temp1 = 0;
//
//
//    $temp2 = explode("-", $temp_ed[1]);
//    if($temp2[1]>0)  $temp2 = number_format(round($temp2[1]/$coeff,3),3);
//    else $temp2 = 0;
//
//    $temp3 = explode("-", $temp_ed[2]);
//    if($temp3[1]>0) $temp3 = number_format(round($temp3[1]/$coeff,3),3);
//    else $temp3 = 0;
//
//    $temp4 = explode("-", $temp_ed[3]);
//    if($temp4[1]>0) $temp4 = number_format(round($temp4[1]/$coeff,3),3);
//    else $temp4 = 0;
//
//    $str_m2 = "Общ-".$temp1." Своб-".$temp2." Ожид-".$temp3." Рез-".$temp4."";
    
     
    return number_format(round($string/$coeff,3),3);

} 


