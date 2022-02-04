</main>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class='container-fluid '>

        <div class="col-md-3 col-sm-6">
            <img class="navbar-brand" style="height:64px;" src="<?= base_url() . '/assets/images/logo.jpg' ?>" alt="Logo">
            <a href="<?php echo site_url('Visiteur/flux_rss') ?>">
                <img class="navbar-brand" style="height:60px;" src="<?= base_url() . '/assets/images/rss.png' ?>" width="60">
            </a>
            <BR>© Adrien Lorin, 2020 - D. Boucard and co
        </div>
        <div class="col-md-3 col-sm-6">
            <h4>Nous contacter</h4>
            <a href='https://www.google.fr/maps/place/Lyc%C3%A9e+Rabelais/@48.5042205,-2.7503218,17z/data=!4m13!1m7!3m6!1s0x480e1d185a2011d3:0xca3c59f0bff91073!2s8+Rue+Rabelais,+22000+Saint-Brieuc!3b1!8m2!3d48.5042205!4d-2.7481331!3m4!1s0x480e1d18e9d8109d:0x739b07353bbf2d23!8m2!3d48.5042841!4d-2.7468056'><i class="fas fa-map-marker-alt"></i> 8 Rue Rabelais, 22000 Saint-Brieuc</a>
            <a href='mailto:master@chopesgames.com'><i class="fas fa-envelope"></i> master@chopesgames.com</a>
            <a href="#"><i class="fas fa-phone"></i> 02 96 00 00 00</a><br />
        </div>
        <div class="col-md-3 col-sm-6">
            <h4>Nous suivre</h4>
            <a href="https://www.facebook.com/ChopesGamesShop"><i class="fab fa-facebook-square"></i> Facebook</a>
            <a href="https://www.twitter.com/ChopesGamesShop"><i class="fab fa-twitter-square"></i> Twitter</a>
            <a href="https://www.Instagram.com/ChopesGamesShop"><i class="fab fa-instagram"></i> Instagram</a><br />
        </div>

        <div class="col-md-3 col-sm-6">
            <h4>Lettre d'information</h4>
            <p>Abonnez-vous à notre lettre d'information pour ne rien rater</p>
            <?= form_open('Visiteur/abonne') ?>
            <input type="mail" placeholder="Votre mail" method="post" name="email" value="<?= set_value('email') ?>">
            <input class="btn bg-success" type="submit" name="submit" value="S'abonner">
            <?= form_close() ?>
        </div>

    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>