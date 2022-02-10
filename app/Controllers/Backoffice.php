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

class Backoffice extends BaseController
{
    public function connexion()
    {
        helper(['form']);
        $validation =  \Config\Services::validation();
        $session = session();

        $rules = [ //régles de validation
            'txtIdentifiant' => 'required',
            'txtMotDePasse'   => 'required'
        ];
        $messages = [ //message à renvoyer en cas de non respect des règles de validation
            'txtIdentifiant' => [
                'required' => 'Un identifiant est requis',
            ],
            'txtMotDePasse'    => [
                'required' => 'Un mot de passe est requis',
            ]
        ];

        $modelCat = new ModeleCategorie();
        $data_bis['categories'] = $modelCat->retourner_categories();
        echo view('templates/header', $data_bis);
        if (!$this->validate($rules, $messages)) {
            if ($_POST) //if ($this->request->getMethod()=='post') // si c'est une tentative d'enregistrement // erreur IDE !!
                $data['TitreDeLaPage'] = "Corriger votre formulaire";
            else   $data['TitreDeLaPage'] = "Se connecter";
            echo view('Backoffice/connexion', $data); // sinon premier affichage

        } else { //validation ok
            $modelAdm = new ModeleAdministrateur();
            $Identifiant = esc($this->request->getPost('txtIdentifiant'));
            $MdP = esc($this->request->getPost('txtMotDePasse'));
            $adminRetourne = $modelAdm->retourner_administrateur_par_id($Identifiant);

            if (!$adminRetourne == null) {
                //  if (password_verify($MdP,$adminRetourne->MOTDEPASSE))
                // PAS D'ENCODAGE DU MOT DE PASSE POUR FACILITATION OPERATIONS DE TESTS (ENCODAGE A FAIRE EN PRODUCTION!)
                if ($MdP == $adminRetourne["MOTDEPASSE"]) {
                    $session->set('identifiant', $adminRetourne["IDENTIFIANT"]);
                    $session->set('mail', $adminRetourne["EMAIL"]);
                    if (!empty($session->get('statut'))) {
                        unset($_SESSION['cart']);
                    }
                    if ($adminRetourne["PROFIL"] == 'Employé') {
                        $session->set('statut', 2);
                    } elseif ($adminRetourne["PROFIL"] == 'Super') {
                        $session->set('statut', 3);
                    }
                    return redirect()->to('Visiteur/lister_les_produits');
                } else {
                    $data['TitreDeLaPage'] = 'Mot de passe incorrect';
                    echo view('Backoffice/connexion', $data);
                }
            } else {
                $data['TitreDeLaPage'] = 'Identifiant incorrecte';
                echo view('Backoffice/connexion', $data);
            }
            echo view('templates/footer');
        }
    }
}
