<?php

use \App\Recipient;
namespace App\Repository;

class RecipientRepository implements IRecipientRepository {
    
    public function getAll()
    {
        return \App\Recipient::all();
    }

}
