<?php

function listTransactionAdmin($input)
{
    global $controller;
    $transactionModel = $controller->loadModel('Transactions');
    $listData = $transactionModel->find()->order(['created_at' => 'DESC'])->all()->toList();

    setVariable('listData', $listData);
}