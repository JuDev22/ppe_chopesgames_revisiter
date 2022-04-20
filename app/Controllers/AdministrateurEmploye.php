<?php
namespace App\Controllers;

use App\Models\ModeleClient;
use App\Models\ModeleCategorie;
use App\Models\Modele_commande;
use App\Models\ModeleLigne;
use App\Models\ModeleMarque;
use App\Models\ModeleAbonne;

helper(['url', 'assets', 'form']);

class AdministrateurEmploye extends BaseController
{
    public function commande_non_traite($noCommande = false){
        $modelCli = new ModeleClient();
        $data['clients'] = $modelCli->retourner_clients();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $ModelCom = new Modele_commande();
        $data['commandes'] = $ModelCom->retourner_non_traite();
        // dd($data['commandes']);
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $data['clientCommande'] = $ModelCom->retourner_commande($noCommande);
        //dd($data['commandes']);
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/commande_non_traite');
        echo view('templates/footer');
    }
    public function afficher_les_clients($noclient = null)
    {
        $modelCli = new ModeleClient();
        $data['clients'] = $modelCli->retourner_clients();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $ModelCom = new Modele_commande();
        $data['commandes'] = $ModelCom->retourner_commandes();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/afficher_les_clients');
        echo view('templates/footer');
    }

    public function historique_des_commandes($noclient = null)
    {
        // if ($noclient == null) {
        //     return redirect()->to('AdministrateurEmploye/afficher_les_clients');
        // }
        $modelCli = new ModeleClient();
        $data['client'] = $modelCli->retourner_client_par_no($noclient);
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $modelComm = new Modele_commande();
        $data['commandes'] = $modelComm->retourner_commandes_client($noclient);
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/historique_des_commandes');
        echo view('templates/footer');
    }

    public function details_commande($noCommande = false)
    {
        if (empty($noCommande)) {
            return redirect()->to('AdministrateurEmploye/historique_des_commandes');
        }
        $modelComm = new Modele_commande();
        $data['commande'] = $modelComm->retourner_commande($noCommande);
        $modelLig = new ModeleLigne();
        $data['lignes'] = $modelLig->retourner_lignes($noCommande);
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/details_commande');
        echo view('templates/footer');
    }
    public function details_commande_non_traitee($noCommande = false)
    {
        if (empty($noCommande)) {
            return redirect()->to('AdministrateurEmploye/historique_des_commandes');
        }
        $modelComm = new Modele_commande();
        $data['commande'] = $modelComm->retourner_commande($noCommande);
        $modelLig = new ModeleLigne();
        $data['lignes'] = $modelLig->retourner_lignes($noCommande);
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        echo view('templates/header', $data);
        echo view('AdministrateurEmploye/details_commande_non_traitee');
        echo view('templates/footer');
    }
    public function commande_traitee($noCommande){
        $modelCli = new ModeleClient();
        $data['clients'] = $modelCli->retourner_clients();
        // $modelCat = new ModeleCategorie();
        // $data['categories'] = $modelCat->retourner_categories();
        $ModelCom = new Modele_commande();
        $data['commandes'] = $ModelCom->retourner_commandes();
        if ($this->request->getPost('submit')){
            date_default_timezone_set('Europe/Paris');
            $Tdate = date('Y-m-d H:i:s');
            $ModelCom->inserer_date($Tdate,$noCommande);
        }
        return redirect()->to('Visiteur/lister_les_produits');
    }
}
