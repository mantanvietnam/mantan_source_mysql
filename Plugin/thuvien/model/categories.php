<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class CategoryTable extends Table
{
	
	public function initialize(array $config): void
    {
        $this->setTable('categories');
    }
    
}