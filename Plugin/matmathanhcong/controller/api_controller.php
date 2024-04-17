<?php
function getLinkFullAPI()
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    global $idBot;
    global $tokenBot;
    global $idBlockConfirm;
    global $idBlockDownload;

    $metaTitleMantan = 'Danh sách yêu cầu xuất bản đầy đủ';

    $modelRequestExports = $controller->loadModel('RequestExports');

    $conditions = array('link_download'=>'', 'avatar !='=>'');
    $limit = 5;
    $page = 1;
    $order = ['id'=>'asc'];

    $listData = $modelRequestExports->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    $return = [];

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $link_download = getLinkFullMMTCAPI($value->name, $value->birthday, $value->phone, $value->email, $value->address, $value->avatar, 1);

            if(!empty($link_download)){
                $value->link_download = $link_download;

                $modelRequestExports->save($value);

                process_send_link($value->id);

                $return[$value->id] = $link_download;

                if(!empty($value->idMessenger)){
                    // gửi Smax Bot
                    if(!empty($idBot)
                        && !empty($tokenBot)
                        && !empty($idBlockConfirm)
                    ) {
                        $attributesSmax = [];
                        //$attributesSmax['linkQRBankingMMTC']= $linkQR;
                        //$attributesSmax['linkAffMMTC']= 'https://matmathanhcong.vn/?aff='.$data->phone;
                        $attributesSmax['linkAffMMTC']= 'https://m.me/100405719654447?ref=Dang-ky-Mat-ma-thanh-cong-affiliate.'.$value->phone;
                        $attributesSmax['phone']= $value->phone;
                        $attributesSmax['linkDownloadMMTC']= $value->link_download;
                        
                        $urlSmax= 'https://api.smax.bot/bots/'.$idBot.'/users/'.$value->idMessenger.'/send?bot_token='.$tokenBot.'&block_id='.$idBlockDownload.'&messaging_tag="CONFIRMED_EVENT_UPDATE"';
                        
                        $returnSmax= sendDataConnectMantan($urlSmax, $attributesSmax);
                    }
                }

                if(!empty($value->idZalo)){
                    // gửi tin nhắn chatbot Zalo
                    
                    if(function_exists('sendMessZalo')){
                        $id_oa = '';
                        $app_id = '';
                        $user_id_zalo = $value->idZalo;
                        $text = 'Link tải bản đầy đủ Mật Mã Thành Công của '.$value->name.': '.$value->link_download;
                        //$text = 'Chúng tôi sẽ gửi link tải bản đầy đủ Thần Số Học về email của bạn ngay khi hệ thống xử lý xong yêu cầu';
                        $image = '';

                        sendMessZalo($id_oa, $app_id, $user_id_zalo, $text, $image);

                        return ['code'=>0, 'mess'=>'Gửi link thành công'];
                    }
                
                }
            }
        }
    }

    return $return;
}
?>