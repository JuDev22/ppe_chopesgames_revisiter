<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModeleProduit;
use App\Models\ModeleClient;
use App\Models\ModeleCategorie;
use App\Models\ModeleMarque;
use App\Models\ModeleAdministrateur;
use App\Models\ModeleAbonne;
//use App\Models\ModeleAdministrateur;
//$pager = \Config\Services::pager();
helper(['url', 'assets', 'form']);
class Visiteur extends BaseController
{

    public function abonne()
    {
        $email = \Config\Services::email();
        $ModelAbo = new ModeleAbonne();
        $data['title'] = 'ChopeGames - Vente de jeux vidéos';
        $emailClient = esc($this->request->getPost('txtEmail'));
        $rules = [
            'txtEmail' => 'required|valid_email|is_unique[abonne.EMAIL]',
        ];
        if ($this->validate($rules)){
            $email->setSubject('Inscription à la Newsletter de ChopesGames');
            //$email->setMailType('text'); 
            $email->setFrom('b.julian.pro@gmail.com', 'ChopeGames', 'b.julian.pro@gmail.com');
            $email->setTo($emailClient);
            $message = "Ceci est un message automatique, merci de ne pas répondre. Nous sommes ravis de vous acceuillir dans notre équipe ! Voici le mail de confirmation pour votre inscription sur notre site. Vous pouvez nous signaler votre retrait en nous envoyant un mail intitulé 'Droit à l'oublie'. Pour ces demandes, un délai de 30 jours nous est accordé pour faire le nécessaire, un mail de confirmation vous sera envoyer manuellement.
            L'équipe de ChopesGames vous souhaite une bonne journée !";
            $email->setMessage($message);
            $email->send();
        } else {
            echo '<div class="text-white">Déjà abonné</div>';
        }
        return redirect()->to('visiteur/lister_les_produits');
        // }
    }
    public function accueil()
    {
        $modelProd = new ModeleProduit();
        $data['vitrines'] = $modelProd->retourner_vitrine();
        $data['TitreDeLaPage'] = 'Accueil';
        $data['title'] = 'ChopeGames - Accueil';
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();

        echo view('templates/header', $data);
        echo view('visiteur/accueil');
        echo view('templates/footer');
    }


    public function lister_les_produits()
    {
        $session = session();
        $pager = \Config\Services::pager();
        $match = esc($this->request->getPost('search')); // fonction recherche integrée
        $modelProd = new ModeleProduit();
        if (empty($match)) {
            $data['lesProduits'] = $modelProd->paginate(12);
        } else {
            $data['lesProduits'] = $modelProd->produits_search($match)->paginate(12);
        }
        $data['pager'] = $modelProd->pager;
        $data['title'] = 'ChopeGames - Nos jeux';
        $data['TitreDeLaPage'] = 'Nos jeux';
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();

        echo view('templates/header', $data);
        echo view("Visiteur/lister_les_produits");
        echo view('templates/footer');
    }
    
    public function marqueById($idMarque){
        $modelMarque = new ModeleMarque();
        $noMarque = $modelMarque->retournerLibelleMarqueById($idMarque);
        if ($noMarque != null){ 
            return redirect()->to('marque/'.$noMarque['LIBELLE']);
            }
    }
    public function marqueByLibelle($libelle)
    {
        $modelMarque = new ModeleMarque();
        $noMarque = $modelMarque->retournerIdMarqueByLibelle($libelle);
        if ($libelle != null){
            Visiteur::lister_les_produits_parmarque($noMarque);
        }
    }
    public function lister_les_produits_parmarque($nomarque = false)
    {
        if ($nomarque == false) {
            return redirect()->to('Visiteur/lister_les_produits');
        } else {
            $session = session();
            $pager = \Config\Services::pager();
            $modelMarq = new ModeleMarque();
            $marque = $modelMarq->retourner_marques($nomarque);
            $data['marques'] = $modelMarq->retourner_marques();
            $data['lamarque'] = $marque["NOM"];
            $data['TitreDeLaPage'] = $marque["NOM"];
            $data['title'] = 'ChopeGames - ' . $marque["NOM"];
            $modelCat = new ModeleCategorie();
            $data['categories'] = $modelCat->retourner_categories();
            $modelProd = new ModeleProduit();
            $data["lesProduits"] = $modelProd->retouner_produits_marque($nomarque)->paginate(12);
            $data['pager'] = $modelProd->pager;

            echo view('templates/header', $data);
            echo view("visiteur/lister_les_produits");
            echo view('templates/footer');
        }
    }
    
    public function catById($noCategorie){
        $modelCat = new ModeleCategorie();
        $libelle = $modelCat->retournerLibelleCategorieById($noCategorie);
    //redirection   
        if ($noCategorie != null){ 
        return redirect()->to('categorie/'.$libelle['LIBELLE']);
        }
    //else redirect 404 ?
    }
    public function catByLibelle($libelle){
        $modelCat = new ModeleCategorie();
        $noCategorie = $modelCat->retournerNoCategorieByLibelle($libelle);
    //redirection   
        if ($libelle != null){ 
            Visiteur::lister_les_produits_par_categorie($noCategorie);
        }
    //else redirect 404 ?
    }
    public function lister_les_produits_par_categorie($nocategorie = false)
    {
        if ($nocategorie == false) {
            return redirect()->to('Visiteur/lister_les_produits');
        } else {
            $session = session();
            $pager = \Config\Services::pager();

            $modelCat = new ModeleCategorie();
            $categorie = $modelCat->retourner_categories($nocategorie);
            $data['categories'] = $modelCat->retourner_categories();

            $data['TitreDeLaPage'] = $categorie["LIBELLE"];
            $data['title'] = 'ChopeGames - '. $categorie["LIBELLE"];
            $modelProd = new ModeleProduit();
            $data["lesProduits"] = $modelProd->retouner_produits_categorie($nocategorie)->paginate(12);
            $modelMarq = new ModeleMarque();
            $data['marques'] = $modelMarq->retourner_marques();
            $data['pager'] = $modelProd->pager;

            echo view('templates/header', $data);
            echo view("visiteur/lister_les_produits");
            echo view('templates/footer');
        }
    }

    public function voir_un_produit($noProduit = NULL)
    {
        $modelProd = new ModeleProduit();
        $data["unProduit"] = $modelProd->retourner_produits($noProduit);
        if (empty($data['unProduit'])) {
            //echo view('error404');
            //throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Page inconue');
        }

        $data['TitreDeLaPage'] = $data['unProduit']["LIBELLE"];
        $data['title'] = 'ChopeGames - '.$data["unProduit"]["LIBELLE"];
        $categorie = $data['unProduit']["NOCATEGORIE"];
        $marque = $data['unProduit']["NOMARQUE"];

        $modelCat = new ModeleCategorie();
        $data['categorie'] = $modelCat->retourner_categories($categorie);
        $data['categories'] = $modelCat->retourner_categories();

        $modelMarq = new ModeleMarque();
        $data['marque'] = $modelMarq->retourner_marques($marque);
        $data['marques'] = $modelMarq->retourner_marques();

        echo view('templates/header', $data);
        echo view('visiteur/voir_un_produit');
        echo view('templates/footer');
    }

    public function ajouter_au_panier($noProduit)
    {
        $modelProd = new ModeleProduit();
        $data['title'] = 'ChopeGames - Panier';
        $produit = $modelProd->retourner_produits($noProduit);
        $item = array(
            'id'    => $produit["NOPRODUIT"],
            'qty'    => 1,
            'price'    => ($produit["PRIXHT"]) + ($produit["TAUXTVA"]),
            'ht' => $produit["PRIXHT"],
            'tva' => $produit["TAUXTVA"],
            'name'    => $produit["LIBELLE"],
            'image' => $produit["NOMIMAGE"],
            'maxi' => $produit["QUANTITEENSTOCK"]
        );
        $session = session();
        if ($session->has('cart')) {
            $cart =  array_values(session('cart'));
            $index = $this->exists($item['id']);
            if ($index == -1) {
                array_push($cart, $item);
            } else {
                $cart[$index]['qty']++;
            }
            $session->set('cart', $cart);
        } else {
            $cart = array($item);
            $session->set('cart', $cart);
        }
        return redirect()->to('Visiteur/afficher_panier');
    }

    private function exists($id)
    {
        $items = array_values(session('cart'));
        for ($i = 0; $i < count($items); $i++) {
            if ($items[$i]['id'] == $id) return $i;
        }
        return -1;
    }

    function afficher_panier()
    {
        $session = session();
        helper(['form']);
        $modelCat = new ModeleCategorie();
        $data['title'] = 'ChopeGames - Panier';
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        if ($session->has('cart'))
            $data['items'] = array_values(session('cart'));
        else $data['items'] = array();
        echo view('templates/header', $data);
        echo view('visiteur/afficher_panier');
        echo view('templates/footer');
    }

    function suppression_item_panier($id = '')
    {
        $session = session();
        if ($session->has('cart')) {
            $items =  array_values(session('cart'));
            for ($i = 0; $i < count($items); $i++) {
                if ($items[$i]['id'] == $id) unset($items[$i]);
            }
            $session->set('cart', $items);
        }
        return redirect()->to('Visiteur/afficher_panier');
    }

    public function mise_a_jour_panier()
    {
        $session = session();
        if ($session->has('cart')) {
            $items =  array_values(session('cart'));
            $update = $this->request->getPost('update');
            for ($i = 0; $i < count($items); $i++) {
                $items[$i]['qty'] = $update[$items[$i]['id']];
            }
            $session->set('cart', $items);
        }
        return redirect()->to('Visiteur/afficher_panier');
    }

    
    public function s_enregistrer()
    {

        helper(['form']);
        $validation =  \Config\Services::validation();
        $data['TitreDeLaPage'] = "S'enregister";
        $session = session();


        $rules = [ //régles de validation creation
            'txtNom' => 'required',
            'txtPrenom' => 'required',
            'txtAdresse' => 'required',
            'txtVille'    => 'required',
            'txtCP' => 'required',
            'txtEmail' => 'required|valid_email|is_unique[client.EMAIL,id,{id}]',
            'txtMdp'    => 'required'
        ];

        if (!empty($session->get('statut'))) //régles de validation pour modification
            $rules['txtEmail'] = 'required|valid_email';

        $messages = [ //message à renvoyer en cas de non respect des règles de validation
            'txtNom' => [
                'required' => 'Un nom  est requis',
            ],
            'txtPrenom' => [
                'required' => 'Un prénom est requis',
            ],
            'txtAdresse' => [
                'required' => 'Une adresse est requise',
            ],
            'txtVille'    => [
                'required' => 'Une ville est requise',
            ],
            'txtCP' => [
                'required' => 'Un code postal est requis',
            ],
            'txtEmail' => [
                'required' => 'Un Email est requis',
                'valid_email' => 'Un Email valide est requis',
                'is_unique' => 'Cet Email est déjà utilisé',
            ],
            'txtMdp'    => [
                'required' => 'Un mot de passe est requis',
            ]
        ];
        $modelCat = new ModeleCategorie();
        $data_bis['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data_bis['marques'] = $modelMarq->retourner_marques();
        $data_bis['title'] = 'ChopeGames - Connexion';
        $data['title'] = "ChopeGames - S'enregistrer";
        echo view('templates/header', $data_bis);
        $modelCli = new ModeleClient();

        if (!$this->validate($rules, $messages)) {

            if ($_POST) //if ($this->request->getMethod()=='post') // si c'est une tentative d'enregistrement // erreur IDE !!
                $data['TitreDeLaPage'] = "Corriger votre formulaire";
            else {
                if (empty($session->get('statut'))) $data['TitreDeLaPage'] = "S'enregister"; // premier affichage création compte sans session
                else { // premier affichage modification compte car session
                    $data['TitreDeLaPage'] = "Modifier mon profil";
                    $compte = $modelCli->retourner_client_par_no($session->get('id'));
                    $data['txtNom'] = $compte['NOM'];
                    $data['txtPrenom'] = $compte['PRENOM'];
                    $data['txtAdresse'] = $compte['ADRESSE'];
                    $data['txtVille'] = $compte['VILLE'];
                    $data['txtCP'] = $compte['CODEPOSTAL'];
                    $data['txtEmail'] = $compte['EMAIL'];
                }
            }
        } else {  // envoi d'une modification de compte (email et mdp aussi ? A VOIR...) ou enregistrement
            $compte = [
                'NOM' => $this->request->getPost('txtNom'),
                'PRENOM' => $this->request->getPost('txtPrenom'),
                'ADRESSE' => $this->request->getPost('txtAdresse'),
                'VILLE' => $this->request->getPost('txtVille'),
                'CODEPOSTAL' => $this->request->getPost('txtCP'),
                'EMAIL' => $this->request->getPost('txtEmail'),
                'MOTDEPASSE' => $this->request->getPost('txtMdp')
            ];

            if (empty($session->get('statut'))) { // enregistrement
                $modelCli->save($compte);
                $data['TitreDeLaPage'] = "Bravo ! vous êtes enregister sur ChopesGames";
            } else { // envoi d'une modification de compte
                $id = $session->get('id');
                if ($modelCli->update($id, $compte))
                    $data['TitreDeLaPage'] = "Mise à jour effectuée";
                else $data['TitreDeLaPage'] = "Sorry";
            }
        }
        echo view('visiteur/s_enregistrer', $data);
        echo view('templates/footer');
    }

    public function se_connecter()
    {
        helper(['form']);
        $validation =  \Config\Services::validation();
        $session = session();     
        $data['TitreDeLaPage'] = 'Se connecter';
        $data['title'] = 'ChopeGames - Connexion';
        $rules = [ //régles de validation
            'txtMail' => 'required|valid_email',
            'txtMdp'   => 'required|is_not_unique[client.MOTDEPASSE,id,{id}]'
        ];
        $messages = [ //message à renvoyer en cas de non respect des règles de validation
            'txtMail' => [
                'required' => 'Identifiants incorrects',
                'valid_email' => 'Identifiants incorrects',
                'is_not_unique' => 'Identifiants incorrects',
            ],
            'txtMdp'    => [
                'required' => 'Identifiants incorrects',
                'is_not_unique' => 'Identifiants incorrects',
                ]
            ];
            $modelMarq = new ModeleMarque();
            $data_bis['marques'] = $modelMarq->retourner_marques();
            $modelCat = new ModeleCategorie();
            $data_bis['categories'] = $modelCat->retourner_categories();
            $data_bis['title'] = 'ChopeGames - Connexion';
            echo view('templates/header', $data_bis);
            if (!$this->validate($rules, $messages)) {
                if ($_POST) //if ($this->request->getMethod()=='post') // si c'est une tentative d'enregistrement // erreur IDE !!
                $data['TitreDeLaPage'] = "Corriger votre formulaire";
                else   $data['TitreDeLaPage'] = "Se connecter";
                echo view('visiteur/se_connecter', $data); // sinon premier affichage
            } else {
                $modelCli = new ModeleClient();
                $Identifiant = esc($this->request->getPost('txtMail'));
                $MdP = esc($this->request->getPost('txtMdp'));
            $UtilisateurRetourne = $modelCli->retourner_clientParMail($Identifiant);

            if (!$UtilisateurRetourne == null) {
                // if (password_verify($MdP,$UtilisateurRetourne->MOTDEPASSE))
                // PAS D'ENCODAGE DU MOT DE PASSE POUR FACILITATION OPERATIONS DE TESTS (ENCODAGE A FAIRE EN PRODUCTION!)
                if ($MdP == $UtilisateurRetourne["MOTDEPASSE"]) {
                    if (!empty($session->get('statut'))) {
                        unset($_SESSION['cart']);
                    }
                    $session->set('id', $UtilisateurRetourne["NOCLIENT"]);
                    $session->set('statut', 1);
                    return redirect()->to('jeux');
                } else {
                    $data['TitreDeLaPage'] = 'Identifiants incorrects';
                    echo view('visiteur/se_connecter', $data);
                }
            } else {
                $data['TitreDeLaPage'] = 'Identifiants incorrects';
                
        echo view('visiteur/se_connecter', $data);
            }
        }
        echo view('templates/footer');
    }
}