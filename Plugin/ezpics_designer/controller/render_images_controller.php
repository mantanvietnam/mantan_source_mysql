<?php
function deleteRenderImageAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;

    $modelRenderImages = $controller->loadModel('RenderImages');

    $render_at = time() - 24*60*60;

    $conditions = array('render_at >'=>0, 'render_at <='=>$render_at);

    $listData = $modelRenderImages->find()->where($conditions)->all()->toList();

    $delete = [];

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            unlink(__DIR__.'/../../../upload/admin/images/render_images/'.$value->fileName);

            $delete[] = $value->fileName;

            $modelRenderImages->delete($value);
        }
    }

    return $delete;
}
?>