<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleClient extends Model
{

    protected $table = 'client';
    protected $allowedFields = ['NOCLIENT', 'NOM', 'PRENOM', 'ADRESSE', 'VILLE', 'CODEPOSTAL', 'EMAIL', 'MOTDEPASSE'];
    protected $primaryKey = 'NOCLIENT';


    public function retourner_clientParMail($mail = false)
    {
        return $this->where(['EMAIL' => $mail])
            ->first();
    }
    public function droit_a_loubli($client){
        return $this->where('NOCLIENT', $client['NOCLIENT'])
                    ->set('NOM', $client['NOM'])
                    ->set('PRENOM', $client['PRENOM'])
                    ->set('ADRESSE', $client['ADRESSE'])
                    ->set('VILLE', $client['VILLE'])
                    ->set('CODEPOSTAL', $client['CODEPOSTAL'])
                    ->set('MOTDEPASSE', $client['MOTDEPASSE'])
                    ->set('EMAIL', $client['EMAIL'])
                    ->update();
    }
    public function retourner_client_par_no($noclient)
    {
        return $this->where(['NOCLIENT' => $noclient])->first();
    }
    public function retourner_clients()
    {
        return $this->findAll();
    }
}
