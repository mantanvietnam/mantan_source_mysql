<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class CommerceTable extends Table
{
	
	public function initialize(array $config): void
    {
        $this->setTable('commerce');
    }
    
}
?>