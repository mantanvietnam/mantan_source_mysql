<?php
function configServiceFeeAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách tỉnh thành';
    $modelOption = $controller->loadModel('Options');
    $mess = '';

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $config = $modelOption->find()->where(['key_word' => 'service_fee'])->first();
        if (empty($config)) {
            $config = $modelOption->newEmptyEntity();
            $config->key_word = 'service_fee';
        }
        $serviceFee = $dataSend['service-fee'] ?? 0;

        $config->value = json_encode(['price' => $serviceFee]);
        $modelOption->save($config);
        $mess = '<p class="text-success"> Cập nhật phí sàn thành công</p>';
    } else {
        $config = $modelOption->find()->where(['key_word' => 'service_fee'])->first();
        $serviceFee = json_decode($config->value ?? '', true)['price'] ?? 0;
    }

    setVariable('serviceFee', $serviceFee);
    setVariable('mess', $mess);
}

function checkCompletedBookingAdmin($input)
{
    global $isRequestPost;
    $mess = '';

    if ($isRequestPost) {
        checkFinishedBooking();
        $mess = '<p class="text-success"> Thao tác thành công</p>';
    }

    setVariable('mess', $mess);
}

function configSendEmailAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelOptions;

    $metaTitleMantan = 'Cài đặt gửi Email';
    $mess = '';

    $config = $modelOptions->find()->where(['key_word' => 'configSendEmail'])->first();

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        
        
        if (empty($config)) {
            $config = $modelOptions->newEmptyEntity();
            $config->key_word = 'configSendEmail';
        }

        $value['listUpgradeRequestToDriverAdmin']= str_replace(' ', '', $dataSend['listUpgradeRequestToDriverAdmin']);
        $value['listWithdrawRequestAdmin']= str_replace(' ', '', $dataSend['listWithdrawRequestAdmin']);
        $value['listComplaintAdmin']= str_replace(' ', '', $dataSend['listComplaintAdmin']);
        $value['listSupportAdmin']= str_replace(' ', '', $dataSend['listSupportAdmin']);

        $config->value = json_encode($value);

        $modelOptions->save($config);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($config->value)){
        $data_value = json_decode($config->value, true);
    }

    setVariable('data_value', $data_value);
    setVariable('mess', $mess);
}