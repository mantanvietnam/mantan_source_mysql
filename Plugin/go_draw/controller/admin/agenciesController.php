<?php

function listAgencyAdmin($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đại lý';
    $agencyModel = $controller->loadModel('Agencies');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] = $_GET['id'];
    }

    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['phone'])) {
        $conditions['phone LIKE'] = '%' . $_GET['phone'] . '%';
    }

    if (!empty($_GET['address'])) {
        $conditions['address LIKE'] = '%' . $_GET['address'] . '%';
    }

    if (isset($_GET['status']) && $_GET['status'] !== '' && is_numeric($_GET['status'])) {
        $conditions['status'] = $_GET['status'];
    }

    $listData = $agencyModel->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order(['id'=>'desc'])
        ->all()
        ->toList();
    $totalUser = $agencyModel->find()
        ->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(
        count($totalUser),
        $limit,
        $page
    );

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function updateStatusAgencyAdmin($input)
{
    global $controller;

    $agencyModel = $controller->loadModel('Agencies');

    if (!empty($_GET['id'])) {
        $data = $agencyModel->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($data && isset($_GET['status'])) {
            $data->status = $_GET['status'];
            $agencyModel->save($data);
        }
    }

    return $controller->redirect('/plugins/admin/go_draw-view-admin-agency-listAgencyAdmin.php');
}

function viewDetailAgencyAdmin($input)
{
    global $controller;
    global $isRequestPost;

    $agencyModel = $controller->loadModel('Agencies');
    $accountModel = $controller->loadModel('AgencyAccounts');
    $mess = '';
    $isCreateNewAgency = false;

    if (!empty($_GET['id'])) {
        $agency = $agencyModel->find()->where([
            'id' => $_GET['id']
        ])->first();

        $masterAccount = $accountModel->find()
            ->where([
                'agency_id' => $_GET['id'],
                'type' => 1,
            ])->first();

        $listStaffAccount = $accountModel->find()
            ->where([
                'agency_id' => $_GET['id'],
                'type' => 2
            ])->all()
            ->toList();
    } else {
        $isCreateNewAgency = true;
        $agency = $agencyModel->newEmptyEntity();
        $masterAccount = $accountModel->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if ($isCreateNewAgency) {
            if (!empty($dataSend['master_account_name'])
                && !empty($dataSend['master_account_password'])
                && !empty($dataSend['master_account_password_confirmation'])
                && !empty($dataSend['master_account_code_pin'])
                && !empty($dataSend['name'])
                && !empty($dataSend['address'])
                && !empty($dataSend['phone'])
            ) {
                $checkUsername = $accountModel->find()
                    ->where(['name' => $dataSend['master_account_name']])
                    ->first();

                if ($dataSend['master_account_password'] !== $dataSend['master_account_password_confirmation']) {
                    $mess = '<p class="text-danger">Mật khẩu nhập lại chưa trùng khớp</p>';
                } elseif ($checkUsername) {
                    $mess = '<p class="text-danger">Tên tài khoản đã tồn tại</p>';
                } else {
                    $agency->name = $dataSend['name'];
                    $agency->address = $dataSend['address'];
                    $agency->phone = $dataSend['phone'];
                    $agency->image = $dataSend['image'];
                    $agency->email = $dataSend['email'];
                    $agency->lat_gps = $dataSend['lat_gps'];
                    $agency->long_gps = $dataSend['long_gps'];
                    $agency->status = $dataSend['status'];
                    $agency->province_id = $dataSend['province_id'];
                    $agency->district_id = $dataSend['district_id'];
                    $agency->ward_id = $dataSend['ward_id'];

                    $agencyModel->save($agency);

                    $masterAccount->agency_id = $agency->id;
                    $masterAccount->name = $dataSend['master_account_name'];
                    $masterAccount->code_pin = $dataSend['master_account_code_pin'];
                    $masterAccount->password = md5($dataSend['master_account_password']);
                    $masterAccount->type = $dataSend['type'] ?? 1;
                    $accountModel->save($masterAccount);

                    $mess = '<p class="text-success">Tạo mới đại lý thành công</p>';
                }
            } else {
                $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
            }
        } else {
            if (!empty($dataSend['name'])
                || !empty($dataSend['address'])
                || !empty($dataSend['phone'])
            ) {
                $agency->name = $dataSend['name'];
                $agency->address = $dataSend['address'];
                $agency->phone = $dataSend['phone'];
                $agency->image = $dataSend['image'];
                $agency->email = $dataSend['email'];
                $agency->lat_gps = $dataSend['lat_gps'];
                $agency->long_gps = $dataSend['long_gps'];
                $agency->status = $dataSend['status'] ?? 1;
                $agency->province_id = $dataSend['province_id'];
                $agency->district_id = $dataSend['district_id'];
                $agency->ward_id = $dataSend['ward_id'];

                $agencyModel->save($agency);

                $masterAccount->name = $dataSend['master_account_name'];
                $masterAccount->code_pin = $dataSend['master_account_code_pin'];
                $accountModel->save($masterAccount);

                $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
            } else {
                $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
            }
        }
    }

    $listCity = [];
    if(function_exists('getProvince')){
        $listCity = getProvince();
    }

    setVariable('data', $agency);
    setVariable('masterAccount', $masterAccount);
    setVariable('mess', $mess);
    setVariable('listCity', $listCity);

    if (isset($listStaffAccount)) {
        setVariable('listStaffAccount', $listStaffAccount);
    }
}

function adminDeleteAccountApi($input): array
{
    global $controller;
    global $isRequestPost;

    $accountModel = $controller->loadModel('AgencyAccounts');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['id'])) {
            $account = $accountModel->find()->where([
                'id' => $dataSend['id']
            ])->first();

            if ($account) {
                $accountModel->delete($account);
            } else {
                return apiResponse(3, 'Tài khoản không tồn tại');
            }

            return apiResponse(0, 'Xóa thành công');
        }

        return apiResponse(2, 'Gửi thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng method POST');
}

function adminUpdateStaffAccountApi($input): array
{
    global $controller;
    global $isRequestPost;

    $accountModel = $controller->loadModel('AgencyAccounts');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['id'])) {
            $account = $accountModel->find()->where([
                'id' => $dataSend['id']
            ])->first();
            $checkUsername = $accountModel->find()
                ->where([
                    'name' => $dataSend['name'],
                    'id <>' => $dataSend['id']
                ])->first();

            if ($checkUsername) {
                return apiResponse(3, 'Tên tài khoản đã tồn tại');
            }
            if (isset($dataSend['password']) && isset($dataSend['password_confirmation'])) {
                if ($dataSend['password'] !== $dataSend['password_confirmation']) {
                    return apiResponse(3, 'Mật khẩu nhập lại không chính xác');
                }

                $account->password = md5($dataSend['password']);
            } else {
                return apiResponse(2, 'Gửi thiếu dữ liệu');
            }

            $account->name = $dataSend['name'] ?: $account->name;
            $account->type = 2;
            $accountModel->save($account);

            return apiResponse(0, 'Cập nhật thành công');
        } else {
            if (isset($dataSend['name'])
                && isset($dataSend['agency_id'])
                && isset($dataSend['password'])
                && isset($dataSend['password_confirmation'])
            ) {
                $account = $accountModel->newEmptyEntity();
                $checkUsername = $accountModel->find()
                    ->where(['name' => $dataSend['name']])
                    ->first();

                if ($dataSend['password'] !== $dataSend['password_confirmation']) {
                    return apiResponse(3, 'Mật khẩu nhập lại không chính xác');
                } elseif ($checkUsername) {
                    return apiResponse(3, 'Tên tài khoản đã tồn tại');
                }
                $account->name = $dataSend['name'];
                $account->agency_id = (int)$dataSend['agency_id'];
                $account->password = md5($dataSend['password']);
                $account->type = 2;
                $accountModel->save($account);

                return apiResponse(0, 'Cập nhật thành công');
            }

            return apiResponse(2, 'Gửi thiếu dữ liệu');
        }
    }

    return apiResponse(1, 'Bắt buộc sử dụng method POST');
}