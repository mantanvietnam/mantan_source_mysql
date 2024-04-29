<?php
function getInfoCampaign($id_campaign=0, $id_member=0)
{
    global $controller;
    
    $info = [];

    $modelCampaigns = $controller->loadModel('Campaigns');

    if(!empty($id_campaign) && !empty($id_member)){
        $info = $modelCampaigns->find()->where(['id'=>(int) $id_campaign, 'id_member'=>(int) $id_member])->first();
    }

    return $info;
}
?>