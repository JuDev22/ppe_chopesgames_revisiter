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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="<?php echo site_url('Visiteur/accueil') ?>" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img class="d-block" style="width:30px;height:30px;'" src="<?= base_url() . '/assets/images/mario-bros.png' ?>" alt="ChopesGames">
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>
                    <a href="<?php echo site_url('Visiteur/accueil') ?>" class="nav-link px-2 text-primary">Accueil</a>
                </li>
                <li>
                    <a href="<?php echo site_url('Visiteur/lister_les_produits') ?>" class="nav-link px-2 text-primary">Nos produits</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-primary px-2" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        Nos catégories
                    </a>
                    <div class="dropdown-menu dropdown-menu-dark border-0 pt-0 mx-0 rounded-3 shadow overflow-hidden over" style="width: 280px">
                        <ul class="list-unstyled mb-0">
                            <?php foreach ($categories as $categorie) { ?>
                                <li class="dropdown-item d-flex align-items-center gap-2 py-2">
                                    <?= anchor('Visiteur/lister_les_produits_par_categorie/' . $categorie["NOCATEGORIE"], $categorie["LIBELLE"]); ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-primary px-2" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        Nos marques
                    </a>
                    <div class="dropdown-menu dropdown-menu-dark border-0 pt-0 mx-0 rounded-3 shadow overflow-hidden" style="width: 280px">
                        <ul class="list-unstyled mb-0">
                            <?php foreach ($marques as $marque) { ?>
                                <li class="dropdown-item d-flex align-items-center gap-2 py-2">
                                    <?= anchor('Visiteur/lister_les_produits_parmarque/' . $marque["NOMARQUE"], $marque["NOM"]); ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            </ul>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="post" action="<?php echo site_url('Visiteur/lister_les_produits') ?>">
                    <input class="form-control form-control-dark" type="text" name="search" id="search" placeholder="Rechercher un jeu">
            </form>

            <div class="text-end d-flex flex-row">
            <?php if ($session->get('statut') == 2) { ?>
                <div class="bg-danger rounded-pill div-admin mx-2">
                    <p class="admin">Administrateur</p>
                </div>
                <?php } ?>
            <?php if ($session->get('statut') == 3) { ?>
                <div class="bg-danger rounded-pill div-admin mx-2">
                    <p class="admin">SuperAdministrateur</p>
                </div>
                <?php } ?>
                <?php if (is_null($session->get('statut'))) { ?>
                    <button type="button" class="btn btn-primary text-light btn-sm me-2">
                        <a class="dropdown-item" href="<?php echo site_url('Visiteur/se_connecter') ?>">Se connecter</a>
                    </button>
                    <button type="button" class="btn btn-sm btn-primary">
                        <a class="dropdown-item" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">S'inscrire</a>
                    </button>
                    <?php } else { ?>
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
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
                            <button type="button" class="btn btn-outline-light me-2">
                                <a class="dropdown-item" href="<?php echo site_url('Visiteur/se_connecter') ?>">Se connecter</a>
                            </button>
                            <button type="button" class="btn btn-warning">
                                <a class="dropdown-item" href="<?php echo site_url('Visiteur/s_enregistrer') ?>">S'inscrire</a>
                            </button>
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
        </div>
        <?php if ($nb > 0) { ?>
            <li class="nav-item list-unstyled mx-2">
                <a href="<?php echo site_url('Visiteur/afficher_panier') ?>" class="text-primary ft">
                <button class="btn btn-primary btn-sm d-flex flex-row">
                    <i class="bi bi-bag"></i>
                    <span><?= $nb ?></span>
                </button>
                </a>
            </li>
        <?php } ?>
        </div>
    </div>
</header>