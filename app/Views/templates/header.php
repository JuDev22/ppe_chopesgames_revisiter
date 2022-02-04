<!DOCTYPE html>
<html>
<?php $session = session();
if ($session->has('cart')) {
    $cart = session('cart');
    $nb = count($cart);
} else $nb = 0; ?>

<head>
    <title>ChopesGames</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() . 'assets/images/favicon.ico' ?>">
    <link rel="alternate" type="application/rss+XML" title="ChopesGames" href="<?php echo site_url('AdministrateurSuper/flux_rss') ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= css_url('style') ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
    <div class="container-fluid justify-content-start">
        <a class="navbar-brand" href="<?php echo site_url('Visiteur/accueil') ?>">
            <img class="d-block" style="width:30px;height:30px;'" src="<?= base_url() . '/assets/images/mario-bros.png' ?>" alt="ChopesGames">
        </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-0 mb-1 mb-md-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?= site_url('Visiteur/lister_les_produits') ?>">Nos produits</a>
            </li>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        Nos catégories
                    </a>
                    <div class="dropdown-menu dropdown-menu-dark border-0 pt-0 mx-0 rounded-3 shadow overflow-hidden" style="width: 280px">
                        <ul class="list-unstyled mb-0">
                            <?php foreach ($categories as $categorie) { ?>
                                <li class="dropdown-item d-flex align-items-center gap-2 py-2">
                                <?php foreach($lesProduits as $unProduit)
                                { if ($unProduit['DISPONIBLE'] == 0) { ?> 
                                <?= '<span class="d-inline-block bg-danger rounded-circle flex-row" style="width: .5em; height: .5em;"></span>' ?>
                                <?php } else echo '<span class="d-inline-block bg-success rounded-circle flex-row" style="width: .5em; height: .5em;"></span>'?>
                                    <?= anchor('Visiteur/lister_les_produits_par_categorie/' . $categorie["NOCATEGORIE"], $categorie["LIBELLE"]); ?>
                                </li>
                            <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            </div>
        </ul>
        <form class="d-flex" method="post" action="<?php echo site_url('Visiteur/lister_les_produits') ?>">
            <input class="form-control mx-1 sm" type="text" name="search" id="search" placeholder="Rechercher...">
            <button class="btn btn-success mx-1 btn-sm" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <div class="navbar-collapse justify-content-end collapse">
        <ul class="navbar-nav">
            <?php if ($nb > 0) { ?>
                <li class="nav-item">
                    <a href="<?php echo site_url('Visiteur/afficher_panier') ?>" class="text-primary ft">
                        <span class="fas fa-shopping-bag"><?php if ($nb > 0) echo "($nb)" ?></span>
                    </a>
                </li>
            <?php } ?>
            <div class="flex-shrink-0 dropdown dropstart">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php if (is_null($session->get('statut'))) { ?>
                        <img src="<?= img_url('user.jpg') ?> " width="32" height="32"> <?php } else { ?>
                        <!-- Chercher l'image de l'utilisateur | Image user par default  -->
                        <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle" width="32" height="32">
                    <?php } ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-macos mx-0 border-0 shadow" style="width: 220px;">
                    <?php if (!is_null($session->get('statut'))) { ?>
                        <?php if ($session->get('statut') == 1) { ?>
                            <li><a class="dropdown-item" href="<?php echo site_url('Client/historique_des_commandes') ?>">Mes commandes</a></li>
                            <li><a class="dropdown-item" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">Modifier mon compte</a></li>
                        <?php } ?>
                        <li><a class="dropdown-item" href="<?php echo site_url('Client/se_de_connecter') ?>">Se déconnecter</a></li>
                        <hr class="dropdown-diviser">
                        </hr>
                    <?php } else { ?>
                        <li><a class="dropdown-item" href="<?php echo site_url('Visiteur/se_connecter') ?>">Se connecter</a></li>
                        <li><a class="dropdown-item" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">S'inscrire</a></li>
                    <?php } ?>
                    <?php if ($session->get('statut') == 2 or $session->get('statut') == 3) : ?>
                        <li><a class="dropdown-item" href="<?php echo site_url('AdministrateurEmploye/afficher_les_clients') ?>">Clients/Commandes</a></li>
                        <li><a class="dropdown-item" href="<?php echo site_url('AdministrateurEmploye/commande_non_traite') ?>">Commandes non traitées</a></li>
                        <?php if ($session->get('statut') == 3) { ?>
                            <hr class="dropdown-diviser">
                            </hr>
                            <li> <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_un_produit') ?>">Ajouter un produit</a></li>
                            <li> <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_une_categorie') ?>">Ajouter une catégorie</a></li>
                            <li> <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_une_marque') ?>">Ajouter une marque</a></li>
                            <li> <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/ajouter_un_admin') ?>">Ajouter un administrateur</a></li>
                            <li> <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/afficher_les_admins') ?>">Lister les administrateurs</a></li>
                            <li> <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/lettre_information') ?>">Lettre d'information</a></li>
                            <li> <a class="dropdown-item" href="<?php echo site_url('AdministrateurSuper/modifier_identifiants_bancaires_site') ?>">Identifiants bancaires</a></li>
                        <?php } ?>
                </ul>
            </div>
        <?php endif; ?>
        </ul>
    </div>
    <?php if (empty($session->get('statut'))) : ?>
        <li class="nav-item droite">
            <a href="<?php echo site_url('Visiteur/connexion_administrateur') ?>" class="fas fa-lock"></a>
        </li>
    <?php endif; ?>
    </ul>
    </div>
</nav>