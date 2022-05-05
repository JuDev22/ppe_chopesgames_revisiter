<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleCategorie extends Model
{

    protected $table = 'categorie';
    protected $allowedFields = ['NOCATEGORIE', 'LIBELLE'];
    protected $primaryKey= 'NOCATEGORIE';

    public function retournerLibelleCategorieById($noCategorie)
    {
    return $this->select('LIBELLE')->where(['NOCATEGORIE' => $noCategorie])->first();
    }
    public function retournerNoCategorieByLibelle($libelle)
    {
    return $this->select('NOCATEGORIE')->where(['LIBELLE' => $libelle])->first();
    }

    public function inserer_une_categorie($pDonneesAInserer)
    {
        return $this->insert($pDonneesAInserer);
    }
    public function retourner_categories($pNoCategorie = false)
    {
        if ($pNoCategorie === false) {
            return $this->orderBy('LIBELLE', 'asc')
            ->findAll();
        }

        return $this->where(['NOCATEGORIE' => $pNoCategorie])
        ->first();
    }
}
