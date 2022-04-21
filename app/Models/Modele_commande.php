<?php

namespace App\Models;

use CodeIgniter\Model;

class Modele_commande extends Model
{
   protected $table = 'commande';
   protected $allowedFields = ['NOCLIENT', 'DATECOMMANDE', 'TOTALHT', 'TOTALTTC', 'DATETRAITEMENT'];
   protected $primaryKey = 'NOCOMMANDE';
   public function retourner_non_traite()
   {
      return $this->select('*')->where('DATETRAITEMENT', null)->findAll();
   }
   public function retourner_commande_client()
   {
      return $this->where(['DATETRAITEMENT' => null])
      ->join('client', 'client.NOCLIENT = commande.noclient')
      ->findAll();
   }
   public function inserer_date($Tdate, $noCommande)
   {
      return $this->set('DATETRAITEMENT', $Tdate)->where('NOCOMMANDE', $noCommande)->update();
   }
   public function retourner_commandes_null()
   {
      return $this->where(['DATETRAITEMENT' => null]);
   }
   public function retourner_commande($nocommande)
   {
      return $this->where(['NOCOMMANDE' => $nocommande])
         ->join('client', 'client.NOCLIENT = commande.noclient')
         ->first();
   }

   //    public function modifier_commande($nocommande,$pDonneesAInserer)
   //    {
   //     $this->db->where('NOCOMMANDE', $nocommande);
   //     $this->db->update('commande', $pDonneesAInserer);
   //    }

   public function retourner_commandes_client($noclient)
   {
      return $this->where(['commande.NOCLIENT' => $noclient])
         ->join('client', 'client.NOCLIENT = commande.noclient')
         ->findAll();
   }
}
