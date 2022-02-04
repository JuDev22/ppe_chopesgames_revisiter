<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleAdministrateur extends Model
{

    protected $table = 'administrateur';
    //protected $allowedFields = ['NOCLIENT', 'NOM', 'PRENOM', 'ADRESSE', 'VILLE', 'CODEPOSTAL', 'EMAIL', 'MOTDEPASSE'];
    protected $allowedFields = ['IDENTIFIANT','EMAIL', 'PROFIL','MOTDEPASSE'];
    protected $primaryKey = 'id';
    public function retourner_admins()
    {
        return $this->findAll();
        
    }
    public function inserer_un_admin($pDonneesAInserer)
    {
        return $this->insert($pDonneesAInserer);
    }
    public function retourner_administrateur($identifiant, $MotdePasse)
    {
        return $this->where(['IDENTIFIANT' => $identifiant, 'MOTDEPASSE' => $MotdePasse])
            ->first();
    }

    public function retourner_administrateur_par_identifiant($idadmin)
    {
        return $this->where(['IDENTIFIANT' => $idadmin])
            ->first();
    }
    public function retourner_administrateur_par_id($id)
    {
        return $this->where(['id' => $id])
            ->first();
    }


    function retourner_administrateurs_employes()
    {
        return $this->where(['PROFIL' => 'Employé'])
            ->findAll();
    }

    function retourner_administrateur_par_email($mail)
    {
        return $this->where(['EMAIL' => $mail])
            ->first();
    }
}
