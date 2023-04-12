<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class contactTable extends Table
{
    //Config table name trong Cake PHP
    public function initialize(array $config): void
    {
        $this->setTable('Contact');
    }

    public function getArrayItem()
    {
        return $this
            ->find()
            ->order(['id' => 'DESC'])
            ->first()
            ->toArray();
    }

    public function findID($studentID)
    {
        return $this->get($studentID);
    }

    /*
    $studentData = [
    "name" => "Huyen trang",
    "age" => 19,
    ];
    */
    public function insert($data)
    {
        $dataAdd = $this->newEntity($data);
        $this->save($dataAdd);
        return true;
    }

    /*
    $studentData = [
    "id" => 14,
    "name" => "Huyen trang",
    "age" => 19,
    ];
    */
    public function updateItem($data)
    {
        $dataFind = $this->get($data['id']);
        $new = $this->patchEntity($dataFind, $data);
        $this->save($new);
        return $new;
    }


// Using Student ID
    public function deleteID($id)
    {
        $dataDel = $this->get($id);
        $this->delete($dataDel);
        return true;
    }
}
