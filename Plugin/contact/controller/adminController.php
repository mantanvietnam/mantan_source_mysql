<?php

use App\Model\Table\contactTable;

function index()
{
    $table = new contactTable();
    $data = [];
    $list = $table
        ->find()
        ->order(["id" => "DESC"])
        ->toArray();

    $data["list"] = $list;
    setVariable("data", $data);
}

function add()
{
    $data = "Hello";
    setVariable("data", $data);
}

function store($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $routesPlugin;
    $svTable = new contactTable();
    if ($isRequestPost) {
        //Validate nếu cần

        //Kết thúc validate
        $data = $input["request"]->getData();


        $svTable->insert($data);
    }
    return $controller->redirect("/plugins/admin/contact-views-admin-index.php");
}

function edit()
{
    if (isset($_GET["id"])) {
        $id = (int)$_GET["id"];
        $table = new contactTable();
        $sv = $table->findID($id);
        setVariable("data", $sv);
    }
}

function update($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $routesPlugin;
    $svTable = new contactTable();
    if ($isRequestPost) {
        //Validate nếu cần

        //Kết thúc validate
        $data = $input["request"]->getData();
        $svTable->updateItem($data);
    }
    return $controller->redirect("/plugins/admin/contact-views-admin-index.php");
}

function delete()
{
    global $controller;
    global $routesPlugin;
    if (isset($_GET["id"])) {
        $id = (int)$_GET["id"];
        $table = new contactTable();
        $sv = $table->deleteID($id);
    }
    return $controller->redirect("/plugins/admin/contact-views-admin-index.php");
}

?>
