<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleNouvelle extends Model{

    protected $table = 'nouvelle';
    protected $allowedFields = ['id','Objet','Titre','Message'];
    protected $primaryKey= 'id';
    public function retourner_lettre(){
        return $this->findAll();
    }
    public function retourner_obj(){ // WHERE
        return $this->findColumn('Objet');
    }
    public function retourner_titre(){
        return $this->findColumn('Titre');
    }
    public function retourner_msg(){
        return $this->findColumn('Message');
    }
}