<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class HoroscopeTable extends Table
{
	
	public function initialize(array $config): void
    {
        $this->setTable('horoscopes');
    }
    
}