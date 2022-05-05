<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleAbonne extends Model{
    protected $table = 'abonne';
    protected $allowedFields = ['id','email'];
    protected $primaryKey = 'id';
    public function verification($email){
        if ($this->findColumn('email') == $email){
            return null;
        } else {
            $this->insert($email);
        }
    }
    public function inserer($email){

            return $this->set('email', $email)
                        ->insert();
        }
    
    public function recuperer_mail(){
        return $this->findColumn('email');
    }
}