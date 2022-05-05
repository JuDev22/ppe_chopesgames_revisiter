<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleMarque extends Model
{

    protected $table = 'marque';
    protected $allowedFields = ['NOMARQUE','NOM'];
    protected $primaryKey = 'NOMARQUE';

    public function retournerLibelleMarqueById($idMarque)
    {
        return $this->select('NOM')->where(['NOMARQUE' => $idMarque])->first();
    }
    public function retournerIdMarqueByLibelle($libelle)
    {
        return $this->select('id')->where(['NOM' => $libelle])->first();
    }
    public function inserer_une_categorie($pDonneesAInserer)
    {
        return $this->insert($pDonneesAInserer);
    }
    public function retourner_marques($pNoMarque = false)
    {
        if ($pNoMarque === false) {
            return $this->orderBy('NOM', 'asc')
            ->findAll();
        }

        return $this->where(['NOMARQUE' => $pNoMarque])->first();
    }
}