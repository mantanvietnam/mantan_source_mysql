<?php

function getListTransactionApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $transactionType;

    $transactionModel = $controller->loadModel('Transactions');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!isset($dataSend['access_token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }
        }

        $conditions = ['Transactions.user_id' => $currentUser->id];
        $order = [
            'Transactions.created_at' => 'DESC',
            'Bookings.created_at' => 'DESC'
        ];
        $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
        $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;

        $query = $transactionModel->find()
            ->join([
                [
                    'table' => 'bookings',
                    'alias' => 'Bookings',
                    'type' => 'LEFT',
                    'conditions' => [
                        'Transactions.booking_id = Bookings.id',
                    ],
                ]
            ]);

        if (!empty($dataSend['from_date'])) {
            $startTime = DateTime::createFromFormat('d/m/Y', $dataSend['from_date']);
            $conditions[] = ['Transactions.created_at >=' => $startTime->format('Y-m-d').' 0:0:0'];
        }

        if (!empty($dataSend['to_date'])) {
            $finishTime = DateTime::createFromFormat('d/m/Y', $dataSend['to_date']);
            $conditions[] = ['Transactions.created_at <=' => $finishTime->format('Y-m-d').' 23:59:59'];
        }

        if (!empty($dataSend['type']) && in_array((int) $dataSend['type'], $transactionType)) {
            $conditions[] = ['Transactions.type' => (int) $dataSend['type']];
        }

        $data = $query->select([
               'Transactions.id',
               'Transactions.user_id',
               'Transactions.booking_id',
               'Transactions.name',
               'Transactions.amount',
               'Transactions.description',
               'Transactions.status',
               'Transactions.type',
               'Transactions.created_at',
               'Transactions.updated_at',
            ])->limit($limit)
            ->page($page)
            ->where($conditions)
            ->order($order)
            ->all()
            ->toList();
        $total = $query->where($conditions)->count();
        $paginationMeta = createPaginationMetaData($total, $limit, $page);

        return apiResponse(0, 'Lấy lịch sử giao dịch thành công', $data, $paginationMeta);
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function generateQRCodeApi($input): array
{
    global $isRequestPost;
    global $urlTransaction;
    global $transactionKey;

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!isset($dataSend['access_token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }
        }

        if (isset($dataSend['amount'])) {
            $amount = $dataSend['amount'];
            $addInfo = "$currentUser->phone_number $transactionKey";
            $url = $urlTransaction . "amount=$amount&addInfo=$addInfo&accountName=CTY CP THUONG MAI VA DV EXC-GO";
            $data = [
                'url' => $url,
                'bank' => 'Ngân hàng Tiên Phong Bank (TPB)',
                'account_number' => '26689898989',
                'account_name' => 'CTY CP THUONG MAI VA DV EXC-GO',
                'content' => $addInfo
            ];

            return apiResponse(0, 'Gửi yêu cầu nạp tiền thành công', $data);
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function addMoneyTPBankApi($input): array
{
    global $transactionKey;
    global $isRequestPost;

    if ($isRequestPost) {
        if (!empty($_POST['message'])) {
            $keyApp = strtoupper($transactionKey);
            $message = strtoupper($_POST['message']);

            $description = explode('ND: ', $message);
            $description = trim($description[1]);
            $description = str_replace(array('IBFT ', 'THANH TOAN QR ', 'QR - '), '', $description);

            $money = explode('PS:+', $message);
            $money = explode('SD:', $money[1]);
            $money = (int)str_replace(array('.', 'VND'), '', $money[0]);

            if ($money > 0 && strlen(strstr($description, $keyApp)) > 0) {
                // xóa dấu chấm
                $removeDot = explode('.', $description);
                if (count($removeDot) > 1) {
                    for ($i = 0; $i < count($removeDot); $i++) {
                        if (strlen(strstr($removeDot[$i], $keyApp)) > 0) {
                            $description = $removeDot[$i];
                            break;
                        }
                    }
                }

                // xóa dấu chấm phẩy
                $removeDot = explode(';', $description);
                if (count($removeDot) > 1) {
                    for ($i = 0; $i < count($removeDot); $i++) {
                        if (strlen(strstr($removeDot[$i], $keyApp)) > 0) {
                            $description = $removeDot[$i];
                            break;
                        }
                    }
                }

                // xóa dấu gạch ngang
                $removeDot = explode('-', $description);
                if (count($removeDot) > 1) {
                    for ($i = 0; $i < count($removeDot); $i++) {
                        if (strlen(strstr($removeDot[$i], $keyApp)) > 0) {
                            $description = $removeDot[$i];
                            break;
                        }
                    }
                }


                $removeSpace = explode(' ', trim($description));
                $phoneNumber = $removeSpace[0];

                $mess = processAddMoney($money, $phoneNumber);

                return apiResponse(0, $mess);
            } else {
                return apiResponse(3, 'Sai cú pháp hoặc số tiền không đủ');
            }
        } else {
            return apiResponse(2, 'Gửi thiếu nội dung SMS');
        }
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function createWithdrawRequestApi($input): array
{
    global $controller;
    global $isRequestPost;

    $withdrawRequestModel = $controller->loadModel('WithdrawRequests');
    $modelBooking = $controller->loadModel('Bookings');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!isset($dataSend['access_token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }
        }

        if ($dataSend['amount']) {
            $checkWithdrawRequest = $withdrawRequestModel->find()->where(array('user_id'=>$currentUser->id,'status'=>0))->first();
            if(!empty($checkWithdrawRequest)){
                 return apiResponse(0, 'Yêu cầu của bạn đang được xử lý.');
            }
            $posted = count($modelBooking->find()->where(array('posted_by'=>$currentUser->id))->all()->toList());
            $received = count($modelBooking->find()->where(array('received_by'=>$currentUser->id))->all()->toList());

            $parameter = parameter();
          /*  if(!empty($currentUser->difference_booking)){
                 if($currentUser->received - $currentUser->posted  >= $currentUser->difference_booking){
                     return apiResponse(4, 'Số cuốc nhận đang nhiều hơn số cuốc đăng, yêu câu đăng thêm quốc.');
                }


            }*/
            /*elseif($currentUser->received - $currentUser->posted >= $parameter['maximumTrip']){
                return apiResponse(4, 'Số cuốc nhận đang nhiều hơn số cuốc đăng, yêu câu đăng thêm quốc. ');
                
            }*/

            /*if($currentUser->received > $currentUser->posted){
                return apiResponse(4, 'Số cuốc nhận đang nhiều hơn số cuốc đăng, yêu câu đăng thêm quốc.');
            }*/



           /* $received = $modelBooking->find()->where(array('received_by'=>$currentUser->id,'status'=>1))->first();
            if(!empty($received)){
                if(500000 > $currentUser->total_coin-$dataSend['amount']) {
                    return apiResponse(4, 'Số tiền để lại tối thiểu là 500.000 đ');
                }
            }*/
            

            if ($currentUser->point < 0 ) {
                return apiResponse(4, 'Số điểm của bạn dang bị âm không rút được tiền.');
            }

            if ($dataSend['amount'] > $currentUser->total_coin) {
                return apiResponse(4, 'Số tiền trong ví không đủ');
            }



            

            $newRequest = $withdrawRequestModel->newEmptyEntity();
            $newRequest->user_id = $currentUser->id;
            $newRequest->amount = $dataSend['amount'];
            $withdrawRequestModel->save($newRequest);

            sendEmailWithdrawRequest($currentUser->name, $newRequest->id);
            return apiResponse(0, 'Gửi yêu cầu thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getListBookingTransaction($input): array
{
    global $controller;
    global $isRequestPost;

    $bookingModel = $controller->loadModel('Bookings');
    $transactionModel = $controller->loadModel('Transactions');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!isset($dataSend['access_token'])) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        } else {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }
        }
        $conditions = ['OR' => [
                    'Bookings.received_by' => $currentUser->id,
                    'Bookings.posted_by' => $currentUser->id
                ] ];
        $order = ['Bookings.received_at' => 'DESC'];
        $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 10;
        $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;

        if (!empty($dataSend['from_date'])) {
            $startTime = DateTime::createFromFormat('d/m/Y', $dataSend['from_date'])->setTime(0, 0, 0);
            $conditions[] = ['Bookings.received_at >=' => $startTime];
        }

        if (!empty($dataSend['to_date'])) {
            $finishTime = DateTime::createFromFormat('d/m/Y', $dataSend['to_date'])->setTime(23, 59, 59);
            $conditions[] = ['Bookings.received_at <=' => $finishTime];
        }

        if (!empty($dataSend['name'])) {
            $conditions[] = ['Bookings.name LIKE' => '%' . $dataSend['name'] . '%'];
        }

        $listBooking = $bookingModel->find()
            ->limit($limit)
            ->page($page)
            ->where($conditions)
            ->order($order)
            ->all()
            ->toList();
        $total = $bookingModel->find()->where($conditions)->order($order)->count();
        $paginationMeta = createPaginationMetaData($total, $limit, $page);


        foreach ($listBooking as &$item) {
            $listTransaction = $transactionModel->find()
                ->where(['booking_id' => $item['id']])
                ->where(['user_id' => $currentUser->id])
                ->order(['created_at' => 'DESC'])
                ->all()
                ->toList();

            $item['transactions'] = $listTransaction;
        }

        return apiResponse(0, 'Lấy danh sách giao dịch thành công', $listBooking, $paginationMeta);
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}


?>