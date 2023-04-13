<?php

use App\Model\Table\contactTable;

function getCurrentTime(): string
{
    $now = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
    $date_time_str = $now->format('Y-m-d H:i:s');
    return $date_time_str;
}


function contact($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $routesPlugin;
    $table = new contactTable();
    if ($isRequestPost) {
        $data = $input["request"]->getData();
        $data["created_at"] = time();
        $table->insert($data);

        setVariable("mess", true);
        session_start();
        $_SESSION['contactSubmit'] = true;
        return $controller->redirect("/contact");
    }
}
