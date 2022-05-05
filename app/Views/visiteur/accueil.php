<h2 class='titrepage my-3 text-white'><?= $TitreDeLaPage ?></h2>
<div class="d-flex justify-content-center">
    <div class="container d-flex flex-row p-2" style="justify-content: space-around;">
        <div class="categorie accueil">
            <h3 class="color">Nos catégories : </h3>
            <?php foreach ($categories as $categorie) {
                echo '<h6 class="txt-cat">' . anchor('Visiteur/lister_les_produits_par_categorie/' . $categorie["NOCATEGORIE"], $categorie["LIBELLE"]) . '</h6>'; ?><?php } ?>
        </div>
        <div id="carouselExampleControls" style="width: 271px;height:377px;" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <?php $countcarousel = 0;
                foreach ($vitrines as $vitrine) : $countcarousel++; ?>
                    <li data-target="#carouselExampleIndicators" <?php if ($countcarousel === 1) : ?> data-slide-to="0" class="active" <?php else : ?> data-slide-to="<?php echo $countcarousel - 1 ?>" <?php endif ?>></li>
                <?php endforeach; ?>
            </ol>
            <div class="carousel-inner">
                <?php $count = 0;
                $indicators = '';
                foreach ($vitrines as $vitrine) :
                    $count++;
                    if ($count === 1) {
                        $class = 'active';
                    } else {
                        $class = '';
                    } ?>
                    <div class="carousel-item <?php echo $class; ?>" data-bs-interval="1000">
                        <a href="<?= base_url() . '/Visiteur/voir_un_produit/' . $vitrine["NOPRODUIT"] ?>">
                            <?= img_class($vitrine["NOMIMAGE"] . '.jpg', $vitrine["LIBELLE"], 'd-block'); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
            </div>
        </div>
        <div class="marque accueil">
            <h3 class="color"> Nos marques : </h3>
            <?php foreach ($marques as $marque) {
                echo '<h6 class="txt-marque">' . anchor('Visiteur/lister_les_produits_parmarque/' . $marque["NOMARQUE"], $marque["NOM"]) . '</h6>'; ?><?php } ?>
        </div>
    </div>
</div>