<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class CommerceItemsTable extends Table
{
	
	public function initialize(array $config): void
    {
        $this->setTable('commerce_items');
    }
    
}
?>