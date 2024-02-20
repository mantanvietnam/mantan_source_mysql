<?php 
function sendZNSDataBot($data, $product_name, $name_system, $agency)
{
    // gửi Zalo đơn hàng
    $urlZNS = 'https://quantri.databot.vn/sendZNS309784';
    $dataZNS = ['phone'=> $data->phone,
                'customer_name' => $data->full_name,
                'order_code' => 'OD'.$data->id,
                'payment_status' => 'Chờ thanh toán',
                'product_name' => $product_name,
                'author' => $name_system,
                'cost' => $data->money,
                'note' => 'Đơn hàng của đại lý '.$agency
                ];

    $mesZNS = sendDataConnectMantan($urlZNS, $dataZNS);
}
?>