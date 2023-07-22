<?php 
$menus= array();
$menus[0]['title']= 'Smax Bot';

$menus[0]['sub'][0]= array( 'title'=>'Cài đặt chung',
                            'url'=>'/plugins/admin/smaxbot-view-admin-setting-settingSmaxbot.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingSmaxbot'
                        );


addMenuAdminMantan($menus);

function sendNotificationAdmin($idBlock='', $attributesSmax=['new_notification'=>1])
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

	$conditions = array('key_word' => 'settingSmaxBot');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

	// gửi thông báo cho smax.bot
	if(empty($idBlock)) $idBlock = $data_value['idBlock'];

    if(!empty($data_value['idBot']) && !empty($data_value['tokenBot']) && !empty($idBlock) && !empty($data_value['idMessAdmin']) ){
        $idMessAdmin= explode(',', $data_value['idMessAdmin']);
        foreach(@$idMessAdmin as $key => $item){
            $urlSmax = 'https://api.smax.bot/bots/' . $data_value['idBot'] . '/users/' . $item . '/send?bot_token=' . $data_value['tokenBot'] . '&block_id=' . $idBlock . '&messaging_tag="CONFIRMED_EVENT_UPDATE"';
            $sendSmax = sendDataConnectMantan($urlSmax, $attributesSmax);   
        }
    }
}