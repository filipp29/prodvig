<?php


namespace Okay\Modules\SP\BitrixCRMIntegration\Core;

use Okay\Core\EntityFactory;
use Okay\Core\Settings;
use Okay\Entities\DeliveriesEntity;
use Okay\Entities\PaymentsEntity;

class BitrixCRMApi
{   
    /** @var EntityFactory */
    private $entityFactory;
    
    /** @var Settings */
    private $settings;

    /* https://escaparate.bitrix24.kz/rest/14/a6o31******/ 
    private $bitrixWebhook;
    
    public $bitrixOrderType;
    
    // yqfov3me6e3w9bzf4
    public $outgoingWebhookToken;
    
    public $orderCancelStatusId;

    public function __construct(
        Settings $settings,
        EntityFactory $entityFactory
    )
    {
        $this->entityFactory = $entityFactory;
        $this->settings = $settings;
        
        $this->bitrixWebhook        = $settings->get('sp__bitrix_crm__webhook');
        $this->bitrixOrderType      = $settings->get('sp__bitrix_crm__order_type');
        $this->outgoingWebhookToken = $settings->get('sp__bitrix_crm__outgoing_webhook');
        $this->orderCancelStatusId  = $settings->get('sp__bitrix_crm__cancel_status');
    }
   
    
    public function getProduct($id)
    {
        $url = 'crm.product.get.json';
        
        $data = ['id' => $id];
        
        $result = $this->requestBitrix($data, $url);
        
        return $result;
    } 
         
    // Создает контакт 
    public function addContact($order)
    {
        $url = 'crm.contact.add.json';

        $data = http_build_query([
            'fields' => [
                'NAME'  => $order->name,
                'LAST_NAME' => $order->last_name,
                'PHONE' => [
                    "n0" => [
                        "VALUE" => $order->phone,
                        "VALUE_TYPE" => "WORK",
                    ],
                ],
                'EMAIL' => [
                    "n0" => [
                        "VALUE" => $order->email,
                        "VALUE_TYPE" => "WORK",
                    ],
                ],
                'UF_CRM_606DBF6F5DB49' => $order->ip,
            ],
        ]);

        $result = $this->requestBitrix($data, $url);
        
        return $result;
    }
    
    // Возвращает контакт по идентификатору
    public function getContact($id)
    {
        $url = 'crm.contact.get.json';
        
        $data = ['id' => $id];
        
        $result = $this->requestBitrix($data, $url);
        
        return $result;
    }
    
    // Возвращает список контактов по фильтру
    public function findContactByFilter($filter = [], $fields = [])
    {       
        $url = 'crm.contact.list.json';
        
        if(empty($fields)){
            $fields = ["ID", "NAME", "LAST_NAME", "TYPE_ID", "SOURCE_ID"];
        }
        
        $data = http_build_query([
            'filter' => $filter,
            'select' => $fields
        ]);               

        $result = $this->requestBitrix($data, $url);
        
        return $result;
    }
    
    // Возвращает идентификаторы лидов, контактов и компаний содержащих телефоны или email-адреса
    // Возможные значения entity_type - LEAD, CONTACT, COMPANY
    // Возможные значения type - PHONE, EMAIL
    public function findBitrixEntities($entityType, $type, $values = [])
    {       
        $url = 'crm.duplicate.findbycomm.json';
        
        $data = http_build_query([
            'entity_type' => $entityType,
            'type' => $type,
            'values' => $values,
        ]);               

        $result = $this->requestBitrix($data, $url);
        
        return $result;
    }
    
    // Метод проверяет наличие контакта по данным из заказа и при необходимости создаёт новый контакт, возвращает ID контакта для прикрепления к заказу
    public function getBitrixContactID($order)
    {       
        if($this->settings->sp__bitrix_crm__contact_search == 'phone' || $this->settings->sp__bitrix_crm__contact_search == 'phone_email'){
            $contact = $this->findBitrixEntities('CONTACT', 'PHONE', [$order->phone]);  
        } 
        
        if (($this->settings->sp__bitrix_crm__contact_search == 'email' || $this->settings->sp__bitrix_crm__contact_search == 'phone_email') && !$contact){
            $contact = $this->findBitrixEntities('CONTACT', 'EMAIL', [$order->email]);           
        } 
        
        $contactId = reset($contact['result']['CONTACT']);        
        
        if(!$contactId) {
            $contact = $this->addContact($order);
            $contactId = $contact['result'];
        }

        return $contactId;
    }
    
    // Создание заказа в Битрикс24
    public function addOrder($order, $isFastOrder = false)
    {              
        if($this->bitrixOrderType == "lead"){
            $bitrixOrder = $this->addLead($order, $isFastOrder);
        } elseif ($this->bitrixOrderType == "deal") {
            $bitrixOrder = $this->addDeal($order, $isFastOrder);
        }
        
        return $bitrixOrder;
    }
    
    // Возвращает лид по идентификатору
    public function getLead($id)
    {
        $url = 'crm.lead.get.json';
        
        $data = ['id' => $id];
        
        $result = $this->requestBitrix($data, $url);
        
        return $result['result'];
    }   
    
    public function addLead($order, $isFastOrder = false)
    {        
         /* Пользовательские поля и идентификаторы в Битрикс24 */
        // IP покупателя - UF_CRM_1617798908
        // Скидка - UF_CRM_1617803769
        // Купон - UF_CRM_1617803819
        // Способ доставки - UF_CRM_1617803920
        // Способ оплаты - UF_CRM_1617803957
                 
        $url = 'crm.lead.add.json';
        
        $contactId = $this->getBitrixContactID($order);
        
        if ($isFastOrder) {
            $data = http_build_query([
                'fields' => [               
                    'TITLE' => 'Быстрый заказ - №' . $order->id,
                    'NAME'  => $order->name,
                    'PHONE' => [
                        "n0" => [
                            "VALUE" => $order->phone,
                            "VALUE_TYPE" => "WORK",
                        ],
                    ],
                    'CONTACT_ID' => $contactId,
                    'ORIGIN_ID' => $order->id, 
                    'EMAIL' => 'Быстрый заказ',
                    "ADDRESS"  => 'Быстрый заказ',
                    'COMMENTS' => $order->comment,
                    'SOURCE_ID' => $order->referer_channel, 
                    'SOURCE_DESCRIPTION' => $order->referer_source,
                    'UF_CRM_1617798908' => $order->ip,
                ],
            ]);
        } else {
            $deliveriesEntity = $this->entityFactory->get(DeliveriesEntity::class);
            $paymentsEntity = $this->entityFactory->get(PaymentsEntity::class);

            $delivery = $deliveriesEntity->get((int) $order->delivery_id);
            $paymentMethod = $paymentsEntity->get((int) $order->payment_method_id);

            $data = http_build_query([
                'fields' => [               
                    'TITLE' => 'Заказ - №' . $order->id,
                    'NAME'  => $order->name,
                    'LAST_NAME' => $order->last_name,
                    'PHONE' => [
                        "n0" => [
                            "VALUE" => $order->phone,
                            "VALUE_TYPE" => "WORK",
                        ],
                    ],
                    'EMAIL' => [
                        "n0" => [
                            "VALUE" => $order->email,
                            "VALUE_TYPE" => "WORK",
                        ],
                    ],
                    'CONTACT_ID' => $contactId,
                    'ORIGIN_ID' => $order->id, 
                    'COMMENTS' => $order->comment,
                    "ADDRESS"  => $order->address,
                    'SOURCE_ID' => $order->referer_channel, 
                    'SOURCE_DESCRIPTION' => $order->referer_source,
                    'UF_CRM_1617798908' => $order->ip,
                    'UF_CRM_1617803769' => $order->discount,
                    'UF_CRM_1617803819' => $order->coupon_discount,
                    'UF_CRM_1617803920' => $delivery->name,
                    'UF_CRM_1617803957' => $paymentMethod->name,
                ],
            ]);
        }

        $this->log($order->id);
        $this->log($order->name);
        $this->log($data);
        $this->log('********************');
        
        $result = $this->requestBitrix($data, $url);

        return $result;
    }
    
    public function addCallbackLead($callback)
    {   
        $url = 'crm.lead.add.json';
                
        $fields = [               
                'TITLE' => 'Перезвоните мне',
                'NAME'  => $callback->name,
                'PHONE' => [
                    "n0" => [
                        "VALUE" => $callback->phone,
                        "VALUE_TYPE" => "WORK",
                    ],
                ],
                'STATUS_ID' => 'NEW',
                'STATUS_DESCRIPTION' => 'Новый',
                'EMAIL' => 'CALLBACK',
                'COMMENTS' => $callback->message,
                'SOURCE_ID' => $callback->url, 
                'SOURCE_DESCRIPTION' => $callback->url,
            ];
        
        if(($this->settings->sp__bitrix_crm__contact_search == 'phone' || $this->settings->sp__bitrix_crm__contact_search == 'phone_email') && $contact = $this->findBitrixEntities('CONTACT', 'PHONE', [$callback->phone])){
            $fields['CONTACT_ID'] = reset($contact['result']['CONTACT']);
        }
        
        $data = http_build_query([
            'fields' => $fields,
        ]);
        
        $result = $this->requestBitrix($data, $url);

        return $result;
    }
    
    // Возвращает сделку по идентификатору
    public function getDeal($id)
    {
        $url = 'crm.deal.get.json';
        
        $data = ['id' => $id];
        
        $result = $this->requestBitrix($data, $url);
        
        return $result['result'];
    }  
    
    public function addDeal($order, $isFastOrder = false)
    {
        /* Пользовательские поля и идентификаторы в Битрикс24 */
        // Адрес доставки - UF_CRM_1616938046820
        // IP покупателя - UF_CRM_606DBF6F9F4A2
        // Скидка - UF_CRM_606DBF6FAEE33
        // Купон - UF_CRM_606DBF6FBC692
        // Способ доставки - UF_CRM_606DBF6FCCD27
        // Способ оплаты - UF_CRM_606DBF6FDACE7
        
        $url = 'crm.deal.add.json';
        
        $contactId = $this->getBitrixContactID($order);
        
        if ($isFastOrder) {
            $data = http_build_query([
                'fields' => [
                    'TITLE' => 'Быстрый заказ №' . $order->id,
                    'OPENED' => "Y",     
                    'SOURCE_ID' => $order->referer_channel, 
                    'SOURCE_DESCRIPTION' => $order->referer_source,
                    'CONTACT_ID' => $contactId,
                    'ORIGIN_ID' => $order->id,                  
                    'UF_CRM_606DBF6F9F4A2' => $order->ip,
                    "UF_CRM_1616938046820"  => 'Быстрый заказ',
                ],
            ]);
        } else {
            $deliveriesEntity = $this->entityFactory->get(DeliveriesEntity::class);
            $paymentsEntity = $this->entityFactory->get(PaymentsEntity::class);

            $delivery = $deliveriesEntity->get((int) $order->delivery_id);
            $paymentMethod = $paymentsEntity->get((int) $order->payment_method_id);

            $data = http_build_query([
                'fields' => [
                    'TITLE' => 'Заказ №' . $order->id,
                    'OPPORTUNITY' => $order->total_price,
                    'OPENED' => "Y",
                    'CONTACT_ID' => $contactId,
                    'ORIGIN_ID' => $order->id,  
                    'SOURCE_ID' => $order->referer_channel, 
                    'SOURCE_DESCRIPTION' => $order->referer_source,
                    'UF_CRM_606DBF6F9F4A2' => $order->ip,
                    "UF_CRM_1616938046820"  => $order->address,
                    'UF_CRM_606DBF6FAEE33' => $order->discount,
                    'UF_CRM_606DBF6FBC692' => $order->coupon_discount,
                    'UF_CRM_606DBF6FCCD27' => $delivery->name,
                    'UF_CRM_606DBF6FDACE7' => $paymentMethod->name,
                ],
            ]);
        }
        $this->log($order->id);
        $this->log($contactId);
        $this->log($data);
        $this->log('********************');
        
        $result = $this->requestBitrix($data, $url);

        return $result;
    }
    
    public function addDealContact($dealId, $contactId)
    {

        $url = 'crm.deal.contact.add.json';

        $fields = new \stdClass();
        $fields->CONTACT_ID = (int)$contactId;
        
        $data = http_build_query([
            'id' => (int)$dealId,
            'fields' => $fields,
        ]);

        $result = $this->requestBitrix($data, $url);
        
        return $result;
    }   
    
    public function addOrderProducts($bitrixOrderId, $products = [])
    {         
        if($this->bitrixOrderType == "lead"){
            $url = 'crm.lead.productrows.set.json';
        } elseif ($this->bitrixOrderType == "deal") {
            $url = 'crm.deal.productrows.set.json';
        }
        
        $rows = [];
        foreach ($products as $product) {
            array_push($rows, [
                'PRODUCT_ID' => $product->product_id,
                'PRODUCT_NAME' => $product->product_name.' '.$product->variant_name,
                'PRICE' => $product->price,
                'QUANTITY' => $product->amount,
                'DESCRIPTION' => 'https://escaparate.kz/products/'.$product->url
            ]);
        }
        
        $data = http_build_query([
            'id' => $bitrixOrderId,
            'rows'=> $rows
        ]);

        $result = $this->requestBitrix($data, $url);
        
        return $result;
    }   
  
    public function requestBitrix($queryData, $queryUrl)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->bitrixWebhook . $queryUrl,
            CURLOPT_POSTFIELDS => $queryData,
        ]);

        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, 1);
    }

    public function isFastOrder($order)
    {
        if (preg_match("/быстрый/ui", strtolower($order->comment)) && preg_match("/заказ/ui", strtolower($order->comment))) {
            return true;
        }
        
        return false;
    }
    
    public function log($data) {
        
        $logFilename = 'bitrix_log.txt';
        
        if (!file_exists($logFilename)) {
            fopen($logFilename, "w");
        }
        
        file_put_contents($logFilename, print_r($data,1).PHP_EOL,8);
        
    }
}