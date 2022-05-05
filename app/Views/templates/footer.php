<div class="container-fluid bg-grey mx-0 mt-5 sticky-lg-bottom">
    <footer class="column px-1 py-3 mt-1 border-top">
        <div class="d-flex flex-column">
            <div class="col d-flex align-items-center justify-content-center flex-column text-center">
                <h5 class="text-muted">Lettre d'information</h5>
                <p class="text-muted">Abonnez-vous à notre lettre d'information pour ne rien rater</p>
                <?= form_open('Visiteur/abonne') ?>
                <div class="form-floating mb-3 d-flex flex-row">
                    <input type="mail" class="form-control form-size" method="post" id="floatingInput" placeholder="Votre mail" value="<?= set_value('email') ?>">
                    <label for="floatingInput">E-mail</label>
                    <button class="btn color btn-sm m-3" type="submit">
                        <i class="far fa-paper-plane"></i>
                    </button>
                </div>
                <?= form_close() ?>
            </div>
            <div class="d-flex flex-row">

                <div class="col d-flex align-items-center justify-content-center">
                    <p class="text-muted txt-footer">© 2022 | ChopesGames - Julian | <a href="assets/mentionsLegales.pdf" target="blank">Mentions légales</a> </p>
                </div>
                <div class="col d-flex align-items-center justify-content-center flex-column">
                    <h5 class="text-muted">Nous contacter</h5>
                    <div class="d-flex flex-column text-center">
                        <i class="bi bi-map i-foot"></i>
                        <a href="https://www.google.fr/maps/place/Lyc%C3%A9e+Rabelais/@48.5042205,-2.7503218,17z/data=!4m13!1m7!3m6!1s0x480e1d185a2011d3:0xca3c59f0bff91073!2s8+Rue+Rabelais,+22000+Saint-Brieuc!3b1!8m2!3d48.5042205!4d-2.7481331!3m4!1s0x480e1d18e9d8109d:0x739b07353bbf2d23!8m2!3d48.5042841!4d-2.7468056" class="nav-link p-0 text-muted">8 Rue Rabelais, 22000 - Saint-Brieuc</a>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <i class="bi bi-envelope-heart i-foot"></i>
                        <a href='mailto:master@chopesgames.com' class="nav-link p-0 text-muted">master@chopesgames.com</a>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <i class="bi bi-telephone i-foot"></i>
                        <a href="telto:0296000000" class="nav-link p-0 text-muted">02 96 00 00 00</a>
                    </div>
                </div>
                <div class="col d-flex align-items-center justify-content-center flex-column">
                    <h5 class="text-muted">Nous suivre</h5>
                    <div class="d-flex flex-column text-center p-1">
                        <a href="https://www.facebook.com/ChopesGamesShop" class="nav-link p-0 text-muted">
                            <i class="bi bi-facebook i-fb"></i>
                            Facebook
                        </a>
                    </div>
                    <div class="d-flex flex-column text-center p-1">
                        <a href="https://www.twitter.com/ChopesGamesShop" class="nav-link p-0 text-muted">
                            <i class="bi bi-twitter i-tw"></i>
                            Twitter
                        </a>
                    </div>
                    <div class="d-flex flex-column text-center p-1">
                        <a href="https://www.Instagram.com/ChopesGamesShop" class="nav-link p-0 text-muted">
                            <i class="bi bi-instagram i-in"></i>
                            Instagram
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?= base_url('assets/js/loader.js')?>"></script>
</body>
</html>