<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class TransactionTable extends Table
{
	
	public function initialize(array $config): void
    {
        $this->setTable('transactions');
    }
    
}