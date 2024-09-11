<?php 

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
                $id_ransaction = $removeSpace[0];

                $mess = processAddMoney($money, $id_ransaction);

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

 ?>