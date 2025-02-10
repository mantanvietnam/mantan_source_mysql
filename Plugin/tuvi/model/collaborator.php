<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class CollaboratorTable extends Table
{
	
	public function initialize(array $config): void
    {
        $this->setTable('collaborators');
    }
    
}