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
        $order = ['Bookings.created_at' => 'DESC'];
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
            $conditions[] = ['Transactions.created_at >=' => $startTime];
        }

        if (!empty($dataSend['to_date'])) {
            $finishTime = DateTime::createFromFormat('d/m/Y', $dataSend['to_date']);
            $conditions[] = ['Transactions.created_at <=' => $finishTime];
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
