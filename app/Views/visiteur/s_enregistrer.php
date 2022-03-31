<div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 container">
                    <?= form_open('client/droit_a_loubli') ?>
                    <input type="submit" name="submit" class="btn bg-warning" value="Droit à l'oubli">
                    <?= form_close() ?>
                    <?php echo form_open('Visiteur/s_enregistrer') ?>
                    <br>
                    <h3 class="text-center text-primary"><?php echo $TitreDeLaPage ?></h3>
                    <?PHP if ($TitreDeLaPage == 'Corriger votre formulaire') echo service('validation')->listErrors();
                    if (!isset($txtNom)) $txtNom = '';
                    if (!isset($txtPrenom)) $txtPrenom = '';
                    if (!isset($txtAdresse)) $txtAdresse = '';
                    if (!isset($txtVille)) $txtVille = '';
                    if (!isset($txtCP)) $txtCP = '';
                    if (!isset($txtEmail)) $txtEmail = ''; ?>
                    <!-- <div class="container m-3"> -->
                        <!-- <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div> -->
                    <!-- </div> -->
                    <label for="txtNom" class="text-primary">Nom</label>
                    <input class="form-control" type="input" name="txtNom" value="<?php echo strip_tags(set_value('txtNom', $txtNom)); ?>" />

                    <label for="txtPrenom" class="text-primary">Prénom</label><br>
                    <input class="form-control" type="input" name="txtPrenom" value="<?php echo strip_tags(set_value('txtPrenom', $txtPrenom)); ?>" />

                    <label for="txtAdresse" class="text-primary">Adresse</label><br>
                    <input class="form-control" type="input" name="txtAdresse" value="<?php echo strip_tags(set_value('txtAdresse', $txtAdresse)); ?>" />

                    <label for="txtVille" class="text-primary">Ville</label><br>
                    <input class="form-control" type="input" name="txtVille" value="<?php echo strip_tags(set_value('txtVille', $txtVille)); ?>" />

                    <label for="txtCP" class="text-primary">Code Postal</label><br>
                    <input class="form-control" type="input" name="txtCP" value="<?php echo strip_tags(set_value('txtCP', $txtCP)); ?>" />

                    <label for="txtEmail" class="text-primary">Email</label><br>
                    <input class="form-control" type="input" name="txtEmail" value="<?php echo strip_tags(set_value('txtEmail', $txtEmail)); ?>" />

                    <label for="txtMdp" class="text-primary">Mot de passe</label><br>
                    <input class="form-control" type="password" name="txtMdp" id="mdp" value="<?php echo strip_tags(set_value('txtMdp')); ?>" />


                    <input type="submit" name="submit" class="btn btn-primary btn-md" value="Valider">
                    <div class="text-primary right">
                        <a class="btn btn-primary" href="<?php echo site_url('Visiteur/se_connecter') ?>">Se connecter</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script language=javascript>
    function Affichermasquermdp() {
        var x = document.getElementById("mdp");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>