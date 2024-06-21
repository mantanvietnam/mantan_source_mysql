<?php
function createComplaintApi($input): array
{
    global $controller;
    global $isRequestPost;

    $complaintModel = $controller->loadModel('Complaints');
    $bookingModel = $controller->loadModel('Bookings');

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

        if (!empty($dataSend['content']) && !empty($dataSend['booking_id'])) {
            $booking = $bookingModel->find()->where(['id' => $dataSend['booking_id']])->first();

            if ($booking->posted_by !== $currentUser->id && $booking->received_by !== $currentUser->id) {
                return apiResponse(4, 'Bạn không có quyền khiếu nại');
            }
            $newComplaint = $complaintModel->newEmptyEntity();
            $newComplaint->posted_by = $currentUser->id;
            $newComplaint->booking_id = $dataSend['booking_id'];
            $newComplaint->content = $dataSend['content'];
            if (!empty($dataSend['complained_driver_id'])) {
                $newComplaint->complained_driver_id = $dataSend['complained_driver_id'];
            } else {
                $newComplaint->complained_driver_id = $booking->posted_by === $currentUser->id ?
                    $booking->received_by : $booking->posted_by;
            }
            $complaintModel->save($newComplaint);

            sendEmailComplaint($currentUser->name, $newComplaint->id);

            return apiResponse(0, 'Tạo khiếu nại thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getComplaintListApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $complaintType;

    $complaintModel = $controller->loadModel('Complaints');

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

        $order = ['Complaints.created_at' => 'DESC'];
        $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
        $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
        $conditions = [];
        $query = $complaintModel->find()
            ->join([
                [
                    'table' => 'bookings',
                    'alias' => 'Bookings',
                    'type' => 'LEFT',
                    'conditions' => [
                        'Complaints.booking_id = Bookings.id',
                    ],
                ],
                [
                    'table' => 'users',
                    'alias' => 'ComplainedUsers',
                    'type' => 'LEFT',
                    'conditions' => [
                        'Complaints.complained_driver_id = ComplainedUsers.id',
                    ],
                ],
                [
                    'table' => 'users',
                    'alias' => 'PostedUsers',
                    'type' => 'LEFT',
                    'conditions' => [
                        'Complaints.posted_by = PostedUsers.id',
                    ],
                ],
            ]);

        if (!empty($dataSend['type']) && (int) $dataSend['type'] === $complaintType['passive']) {
            $conditions['Complaints.complained_driver_id'] = $currentUser->id;
        } else {
            $conditions['Complaints.posted_by'] = $currentUser->id;
        }

        if (!empty($dataSend['from_date'])) {
            $startTime = DateTime::createFromFormat('d/m/Y', $dataSend['from_date']);
            $conditions['Complaints.created_at >='] = $startTime->format('Y-m-d H:i:s');
        }

        if (!empty($dataSend['to_date'])) {
            $startTime = DateTime::createFromFormat('d/m/Y', $dataSend['from_date']);
            $conditions['Complaints.created_at <='] = $startTime->format('Y-m-d H:i:s');
        }

        $listData = $query->select([
                'Complaints.id',
                'Complaints.posted_by',
                'Complaints.booking_id',
                'Complaints.complained_driver_id',
                'Complaints.content',
                'Complaints.created_at',
                'PostedUsers.id',
                'PostedUsers.name',
                'ComplainedUsers.id',
                'ComplainedUsers.name',
                'Complaints.status',
                'Bookings.name',
            ])->limit($limit)
            ->page($page)
            ->where($conditions)
            ->order($order)
            ->all();
        foreach ($listData as $item) {
            $item->PostedUsers['id'] = (int)$item->PostedUsers['id'];
            $item->ComplainedUsers['id'] = (int)$item->ComplainedUsers['id'];
        }

        $total = $query->where($conditions)->count();
        $paginationMeta = createPaginationMetaData($total, $limit, $page);

        return apiResponse(0, 'Lấy danh khiếu nại thành công', $listData, $paginationMeta);
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}