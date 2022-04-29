<?php

namespace App\Controllers;

use App\Models\ModeleAdministrateur;
use App\Models\ModeleProduit;
use App\Models\ModeleCategorie;
use App\Models\ModeleClient;
use App\Models\ModeleIdentifiant;
use App\Models\ModeleMarque;
use App\Models\ModeleAbonne;
use App\Models\ModeleNouvelle;

helper(['url', 'assets', 'form']);

class AdministrateurSuper extends BaseController
{
    public function lettre_information($prod = false)
    {
        $validation = \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $ModelAbo = new ModeleAbonne();
        $data['mailAbonne'] = $ModelAbo->recuperer_mail();
        $ModelNouv = new ModeleNouvelle();
        $data['infoLettre'] = $ModelNouv->retourner_lettre();
        $ModelAbo = new ModeleAbonne();
        $data['TitreDeLaPage'] = "Lettre d'information";
        $data['title'] = 'ChopeGames - Lettre information';
        $rules = [
            'objet' => 'required|max_length[20]',
            'titre' => 'required|max_length[20]',
            'message' => 'required|max_length[200]',
        ];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                if ($prod == false) {
                    $data['TitreDeLaPage'] = "Lettre d'information";
                }
                // else { //abandonné !
                //     $data['TitreDeLaPage'] = 'Modifier un produit';
                //     $modelProd = new ModeleProduit();
                //     $produit =  $modelProd->retourner_produits($prod);
                //     $data['Categorie'] = $produit['NOCATEGORIE'];
                //     $data['Marque'] = $produit['NOMARQUE'];
                //     $data['txtLibelle'] = $produit['LIBELLE'];
                //     $data['txtDetail'] = $produit['DETAIL'];
                //     $data['txtPrixHT'] = $produit['PRIXHT'];
                //     $data['txtNomimage'] = $produit['NOMIMAGE'];
                //     $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
                // }
            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/lettre_information');
            echo view('templates/footer');
        } else {
            $donneesAInserer = array(
                'Objet' => $this->request->getPost('objet'),
                'Titre' => $this->request->getPost('titre'),
                'Message' => $this->request->getPost('message'),
            );
            if ($this->request->getPost('submit')) {
                $to = implode(",", $ModelAbo->recuperer_mail());
                mail($to, $donneesAInserer['Objet'], $donneesAInserer['Titre'], $donneesAInserer['Message']);
            }
            $ModelNouv->insert($donneesAInserer);
            return redirect()->to('visiteur/lister_les_produits');
        }
    }

    public function supprimer_un_admin($id)
    {
        // $validation =  \Config\Services::validation();
        // $modelCat = new ModeleCategorie();
        // $data['categories'] = $modelCat->retourner_categories();
        // $modelMarq = new ModeleMarque();
        // $data['marques'] = $modelMarq->retourner_marques();
        $modelAdmin = new ModeleAdministrateur();
        $modelAdmin->retourner_administrateur_par_id($id);
        // echo view('templates/header', $data);
        // echo view('templates/footer');
        $modelAdmin->delete($id);
        return redirect()->to('visiteur/lister_les_produits');
    }
    public function modifier_un_admin($id, $prod = false)
    {
        $validation =  \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $modelAdmin = new ModeleAdministrateur();
        $data['TitreDeLaPage'] = 'Modifier un admin';
        $data['title'] = 'ChopeGames - Modifier un admin';

        $rules = [ //régles de validation creation
            'identifiant' => 'required|is_unique[administrateur.identifiant,id,{id}]',
            'email' => 'required|is_unique[administrateur.email,id,{id}]',
        ];
        $data['admin'] = $modelAdmin->retourner_administrateur_par_id($id);
        if (!$this->validate($rules)) {
            if ($_POST) {
                $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            } else {
                if ($prod == false) {
                    $data['TitreDeLaPage'] = 'Modifier un admin';
                    //d($data['admin']);
                }
                // else { //abandonné !
                //     $data['TitreDeLaPage'] = 'Modifier un produit';
                //     $modelProd = new ModeleProduit();
                //     $produit =  $modelProd->retourner_produits($prod);
                //     $data['Categorie'] = $produit['NOCATEGORIE'];
                //     $data['Marque'] = $produit['NOMARQUE'];
                //     $data['txtLibelle'] = $produit['LIBELLE'];
                //     $data['txtDetail'] = $produit['DETAIL'];
                //     $data['txtPrixHT'] = $produit['PRIXHT'];
                //     $data['txtNomimage'] = $produit['NOMIMAGE'];
                //     $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
                // }

            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/modifier_un_admin');
            echo view('templates/footer');
        } else // si formulaire valide
        {
            $donneesAInserer = array(
                'IDENTIFIANT' => $this->request->getPost('identifiant'),
                'EMAIL' => $this->request->getPost('email'),
                //'PROFIL' => $this->insert('Employé'),
                'MOTDEPASSE' => $this->request->getPost('motdepasse'),
            );
            if (empty($donneesAInserer['MOTDEPASSE'])) {
                unset($donneesAInserer['MOTDEPASSE']);
            }
            print_r($donneesAInserer);
            $modelAdmin->update($id, $donneesAInserer);
            return redirect()->to('visiteur/lister_les_produits');
            //else redirecte ??
        }
    }
    public function afficher_les_admins()
    {
        $modelAdmin = new ModeleAdministrateur();
        $data['admins'] = $modelAdmin->retourner_admins();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $data['title'] = 'ChopeGames - Afficher les admins';
        echo view('templates/header', $data);
        echo view('AdministrateurSuper/afficher_les_admins');
        echo view('templates/footer');
    }
    public function ajouter_un_admin($prod = false)
    {
        $validation =  \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $data['TitreDeLaPage'] = 'Ajouter un admin';
        $data['title'] = 'ChopeGames - Ajouter un admin';

        $rules = [ //régles de validation creation
            'identifiant' => 'required|is_unique[administrateur.identifiant]',
            'email' => 'required|is_unique[administrateur.email]',
            'motdepasse' => 'required',
        ];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                if ($prod == false) {
                    $data['TitreDeLaPage'] = 'Ajouter un admin';
                }
                // else { //abandonné !
                //     $data['TitreDeLaPage'] = 'Modifier un produit';
                //     $modelProd = new ModeleProduit();
                //     $produit =  $modelProd->retourner_produits($prod);
                //     $data['Categorie'] = $produit['NOCATEGORIE'];
                //     $data['Marque'] = $produit['NOMARQUE'];
                //     $data['txtLibelle'] = $produit['LIBELLE'];
                //     $data['txtDetail'] = $produit['DETAIL'];
                //     $data['txtPrixHT'] = $produit['PRIXHT'];
                //     $data['txtNomimage'] = $produit['NOMIMAGE'];
                //     $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
                // }

            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouter_un_admin');
            echo view('templates/footer');
        } else // si formulaire valide
        {
            $donneesAInserer = array(
                'IDENTIFIANT' => $this->request->getPost('identifiant'),
                'EMAIL' => $this->request->getPost('email'),
                // 'PROFIL' => $this->insert('Employé'),
                'MOTDEPASSE' => $this->request->getPost('motdepasse'),
            );
            print_r($donneesAInserer);
            $modelAdmin = new ModeleAdministrateur();
            $modelAdmin->insert($donneesAInserer);
            return redirect()->to('visiteur/lister_les_produits');
            //else redirecte ??
        }
    }
    public function ajouter_une_marque($prod = false)
    {
        $validation =  \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $data['TitreDeLaPage'] = 'Ajouter une marque';
        $data['title'] = 'ChopeGames - Ajouter une marque';


        $rules = [ //régles de validation creation
            'nom' => 'required|is_unique[marque.nom]',
        ];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                if ($prod == false) {
                    $data['TitreDeLaPage'] = 'Ajouter une marque';
                }
                // else { //abandonné !
                //     $data['TitreDeLaPage'] = 'Modifier un produit';
                //     $modelProd = new ModeleProduit();
                //     $produit =  $modelProd->retourner_produits($prod);
                //     $data['Categorie'] = $produit['NOCATEGORIE'];
                //     $data['Marque'] = $produit['NOMARQUE'];
                //     $data['txtLibelle'] = $produit['LIBELLE'];
                //     $data['txtDetail'] = $produit['DETAIL'];
                //     $data['txtPrixHT'] = $produit['PRIXHT'];
                //     $data['txtNomimage'] = $produit['NOMIMAGE'];
                //     $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
                // }

            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouter_une_marque');
            echo view('templates/footer');
        } else // si formulaire valide
        {
            $donneesAInserer = array(
                'NOM' => $this->request->getPost('nom'),
            );
            $modelMarq = new ModeleMarque();
            $modelMarq->insert($donneesAInserer);
            return redirect()->to('visiteur/lister_les_produits');
            //else redirecte ??
        }
    }

    public function ajouter_une_categorie($prod = false)
    {
        $validation =  \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $data['TitreDeLaPage'] = 'Ajouter une categorie';
        $data['title'] = 'ChopeGames - Ajouter une categorie';


        $rules = [ //régles de validation creation
            'txtLibelle' => 'required|is_unique[categorie.libelle]',
        ];
        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire'; //correction
            else {
                if ($prod == false) {
                    $data['TitreDeLaPage'] = 'Ajouter une catégorie';
                }
                // else { //abandonné !
                //     $data['TitreDeLaPage'] = 'Modifier un produit';
                //     $modelProd = new ModeleProduit();
                //     $produit =  $modelProd->retourner_produits($prod);
                //     $data['Categorie'] = $produit['NOCATEGORIE'];
                //     $data['Marque'] = $produit['NOMARQUE'];
                //     $data['txtLibelle'] = $produit['LIBELLE'];
                //     $data['txtDetail'] = $produit['DETAIL'];
                //     $data['txtPrixHT'] = $produit['PRIXHT'];
                //     $data['txtNomimage'] = $produit['NOMIMAGE'];
                //     $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
                // }

            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouter_une_categorie');
            echo view('templates/footer');
        } else // si formulaire valide
        {
            $donneesAInserer = array(
                'LIBELLE' => $this->request->getPost('txtLibelle'),
            );
            $modelCat = new ModeleCategorie();
            $modelCat->insert($donneesAInserer);
            return redirect()->to('visiteur/lister_les_produits');
            //else redirecte ??
        }
    }

    public function ajouter_un_produit($prod = false)
    {
        $validation =  \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $data['TitreDeLaPage'] = 'Ajouter un produit';
        $data['title'] = 'ChopeGames - Ajouter un produit';


        $rules = [ //régles de validation creation
            'Categorie' => 'required',
            'Marque' => 'required',
            'txtLibelle' => 'required',
            'txtDetail'    => 'required',
            'txtPrixHT' => 'required',
            'txtQuantite' => 'required',
            'txtNomimage' => 'required',
            'image' => [
                'uploaded[image]',
                'mime_in[image,image/jpg,image/jpeg]',
                'max_size[image,1024]',
            ]
        ];
        if (!$this->validate($rules)) {
            if ($_POST) {
                $data['TitreDeLaPage'] = 'Corriger votre formulaire';
            } //correction
            else {
                if ($prod == false) {
                    $data['TitreDeLaPage'] = 'Ajouter un produit';
                }
                // else { //abandonné !
                //     $data['TitreDeLaPage'] = 'Modifier un produit';
                //     $modelProd = new ModeleProduit();
                //     $produit =  $modelProd->retourner_produits($prod);
                //     $data['Categorie'] = $produit['NOCATEGORIE'];
                //     $data['Marque'] = $produit['NOMARQUE'];
                //     $data['txtLibelle'] = $produit['LIBELLE'];
                //     $data['txtDetail'] = $produit['DETAIL'];
                //     $data['txtPrixHT'] = $produit['PRIXHT'];
                //     $data['txtNomimage'] = $produit['NOMIMAGE'];
                //     $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
                // }

            }
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/ajouter_un_produit');
            echo view('templates/footer');
        } else // si formulaire valide
        {


            $donneesAInserer = array(
                'NOCATEGORIE' => $this->request->getPost('Categorie'),
                'NOMARQUE' => $this->request->getPost('Marque'),
                'LIBELLE' => $this->request->getPost('txtLibelle'),
                'DETAIL' => $this->request->getPost('txtDetail'),
                'PRIXHT' => $this->request->getPost('txtPrixHT'),
                'TAUXTVA' => (($this->request->getPost('txtPrixHT') * 20) / 100),
                'NOMIMAGE' => pathinfo($this->request->getPost('txtNomimage'), PATHINFO_FILENAME), // on n'insère que le nom du fichier dans la BDD
                'QUANTITEENSTOCK' => $this->request->getPost('txtQuantite'),
                'DATEAJOUT' => date("Y-m-d"),
                'DISPONIBLE' => 0,
            );

            if ($this->request->getPost('txtQuantite') > 0) $donneesAInserer['DISPONIBLE'] = 1;

            if ($img = $this->request->getFile('image')) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $this->request->getPost('txtNomimage') . '.jpg';
                    $img->move('assets/images/', $newName);
                    print_r($donneesAInserer);
                    $modelProd = new ModeleProduit();
                    $modelProd->save($donneesAInserer);

                    return redirect()->to('visiteur/lister_les_produits');
                }
            }
            //else redirecte ??
        }
    }

    public function rendre_indisponible($noProduit = null)
    {
        if ($noProduit == null) {
            return redirect()->to('visiteur/lister_les_produits');
        }

        $donneesAInserer = array(
            'DISPONIBLE' => 0
        );
        $modelProd = new ModeleProduit();
        $modelProd->update($noProduit, $donneesAInserer);
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function rendre_disponible($noProduit = null)
    {
        if ($noProduit == null) {
            return redirect()->to('visiteur/lister_les_produits');
        }
        $donneesAInserer = array(
            'DISPONIBLE' => 1
        );
        $modelProd = new ModeleProduit();
        $modelProd->update($noProduit, $donneesAInserer);
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function modifier_produit($noProduit = null)
    {
        if ($noProduit == null) {
            return redirect()->to('visiteur/lister_les_produits');
        }
        $validation =  \Config\Services::validation();
        $modelCat = new ModeleCategorie();
        $data['categories'] = $modelCat->retourner_categories();
        $modelMarq = new ModeleMarque();
        $data['marques'] = $modelMarq->retourner_marques();
        $modelProd = new ModeleProduit();
        $data['TitreDeLaPage'] = 'Modifier un produit';
        $data['title'] = 'ChopeGames - Modifier un produit';


        $rules = [ //régles de validation creation
            'Categorie' => 'required',
            'Marque' => 'required',
            'txtLibelle' => 'required',
            'txtDetail'    => 'required',
            'txtPrixHT' => 'required',
            'txtQuantite' => 'required',
            'txtNomimage' => 'required',
            'vitrine' => '',
        ];

        if (!$this->validate($rules)) {
            if ($_POST) $data['TitreDeLaPage'] = 'Corriger votre formulaire';
            $produit =  $modelProd->retourner_produits($noProduit);
            $data['noProduit'] = $produit['NOPRODUIT'];
            $data['Categorie'] = $produit['NOCATEGORIE'];
            $data['Marque'] = $produit['NOMARQUE'];
            $data['txtLibelle'] = $produit['LIBELLE'];
            $data['txtDetail'] = $produit['DETAIL'];
            $data['txtPrixHT'] = $produit['PRIXHT'];
            $data['txtNomimage'] = $produit['NOMIMAGE'];
            $data['txtQuantite'] = $produit['QUANTITEENSTOCK'];
            $data['vitrine'] = $produit['VITRINE'];

            echo view('templates/header', $data);
            echo view('AdministrateurSuper/modifier_produit');
            echo view('templates/footer');
        } else {

            $donneesAInserer = array(
                'NOCATEGORIE' => $this->request->getPost('Categorie'),
                'NOMARQUE ' => $this->request->getPost('Marque'),
                'LIBELLE' => $this->request->getPost('txtLibelle'),
                'DETAIL' => $this->request->getPost('txtDetail'),
                'PRIXHT' => $this->request->getPost('txtPrixHT'),
                'TAUXTVA' => (($this->request->getPost('txtPrixHT') * 20) / 100),
                'DATEAJOUT' => date("Y-m-d"),
                'NOMIMAGE' => $this->request->getPost('txtNomimage'),
                'QUANTITEENSTOCK' => $this->request->getPost('txtQuantite'),
                'VITRINE' => 0
            );

            if ($this->request->getPost('checkbox') == 1) {
                $donneesAInserer['VITRINE'] = 1;
            }

            $modelProd->update($noProduit, $donneesAInserer);

            return redirect()->to('visiteur/lister_les_produits');
        }
    }

    function modifier_identifiants_bancaires_site()
    {
        $data['title'] = 'ChopeGames - Id bancaire';

        $modelIdent = new ModeleIdentifiant();
        $data['identifiant'] = $modelIdent->retourner_identifiant();

        $rules = [ //régles de validation creation
            'txtSite' => 'required',
            'txtRang' => 'required',
            'txtIdentifiant' => 'required',
            'txtHmac'    => 'required',
        ];


        if (!$this->validate($rules)) {
            $modelCat = new ModeleCategorie();
            $data['categories'] = $modelCat->retourner_categories();
            echo view('templates/header', $data);
            echo view('AdministrateurSuper/modifier_identifiants_bancaires_site');
            echo view('templates/footer');
        } else {

            $donneesAInserer = array(
                'SITE' => $this->request->getPost('txtSite'),
                'RANG' => $this->request->getPost('txtRang'),
                'IDENTIFIANT' => $this->request->getPost('txtIdentifiant'),
                'CLEHMAC' => $this->request->getPost('txtHmac'),
                'SITEENPRODUCTION' => 0
            );

            if ($this->request->getPost('checkbox') == 1) {
                $donneesAInserer['SITEENPRODUCTION'] = 1;
            }

            $modelIdent->update(1, $donneesAInserer);
            return redirect()->to('visiteur/lister_les_produits');
        }
    }
}
