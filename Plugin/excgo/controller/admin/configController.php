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