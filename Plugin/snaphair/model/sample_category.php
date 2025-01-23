<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class SampleCategoryTable extends Table
{
	
	public function initialize(array $config): void
    {
        $this->setTable('sample_categories');
    }
    
}