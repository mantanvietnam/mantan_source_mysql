<?php

function createQRPayAPI($input)
{
    global $controller;
    global $isRequestPost;



    $return = array('success' => false, 'message' => 'Dữ liệu không hợp lệ');

    if ($isRequestPost) {
        $modelCustomer = $controller->loadModel('Customers');
        $modelTransaction = $controller->loadModel('Transaction');
        $dataSend = $input['request']->getData();

        if (empty($dataSend['id_customer']) || empty($dataSend['money'])) {
            $return['message'] = 'Thiếu thông tin khách hàng hoặc số tiền thanh toán';
            return $return;
        }

        $id_Customer = (int)$dataSend['id_customer'];
        $totalPrice = (int)$dataSend['money'];

        if ($totalPrice <= 0) {
            $return['message'] = 'Số tiền thanh toán không hợp lệ';
            return $return;
        }

        $customer = $modelCustomer->find()->where(['id' => $id_Customer])->first();
        if (!$customer) {
            $return['message'] = 'Không tìm thấy khách hàng';
            return $return;
        }

        $transaction_id = date('His') . rand(1000, 9999);
        $sms = $transaction_id . ' THANHTOAN';

        if (!function_exists('checkpayos')) {
            $return['message'] = 'Hàm checkpayos không tồn tại';
            return $return;
        }

        $infobank = checkpayos($totalPrice, $sms);
        if (empty($infobank)) {
            $return['message'] = 'Không lấy được thông tin ngân hàng';
            return $return;
        }

        $bank_code = $infobank['bin'] ?? '';
        $account_holders_bank = $infobank['accountName'] ?? '';
        $number_bank = $infobank['accountNumber'] ?? '';
        $sms = $infobank['description'] ?? '';
        $amount = $infobank['amount'] ?? '';
        $code_bank = $infobank['code_bank'] ?? '';

        if (empty($bank_code) || empty($number_bank) || empty($account_holders_bank)) {
            $return['message'] = 'Dữ liệu ngân hàng không hợp lệ';
            return $return;
        }

        $transaction = $modelTransaction->newEmptyEntity();
        $transaction->transaction_id = $transaction_id;
        $transaction->id_customer = $id_Customer;
        $transaction->total = $amount;
        $transaction->status = 0;
        $transaction->created = time();
        $transaction->timeupdate = 0;

        if (!$modelTransaction->save($transaction)) {
            $return['message'] = 'Lỗi khi lưu giao dịch';
            return $return;
        }

        $link_qr_bank = 'https://img.vietqr.io/image/' . $bank_code . '-' . $number_bank . '-compact2.png?amount=' . $amount . '&addInfo=' . urlencode($sms) . '&accountName=' . urlencode($account_holders_bank);

        $return = array(
            'success' => true,
            'message' => 'Tạo yêu cầu thanh toán thành công',
            'data' => array(
                'transaction_id' => $transaction_id,
                'number_bank' => $number_bank,
                'name_bank' => $code_bank,
                'name_account_bank' => $account_holders_bank,
                'link_qr_bank' => $link_qr_bank,
                'content' => $sms,
                'amount' => $amount,
                'note' => "Vui lòng nhập đúng nội dung chuyển tiền, nhập sai không thanh toán được, chúng tôi không chịu trách nhiệm."
            )
        );
    }

    return $return;
}

function checkTransaction($input) {
    global $controller;

    $modelTransaction = $controller->loadModel('Transaction');
    $dataSend = $input['request']->getData();

    if (empty($dataSend['id_customer'])) {
        return ['success' => false, 'message' => 'Thiếu thông tin khách hàng'];
    }

    $id_Customer = (int)$dataSend['id_customer'];
    $transaction = $modelTransaction->find()->where(['id_customer' => $id_Customer])->order(['created' => 'DESC'])->first();

    if (!$transaction) {
        return ['success' => false, 'message' => 'Không tìm thấy giao dịch'];
    }

    return [
        'success' => true,
        'message' => 'Lấy thông tin giao dịch thành công',
        'data' => [
            'transaction_id' => $transaction->transaction_id,
            'status' => $transaction->status
        ]
    ];
}
