<div class="container d-flex justify-content-center align-items-center">
<main class="form-signin d-flex justify-content-center align-items-center">
<?php echo form_open('Visiteur/se_connecter') ?>
    <h1 class="h3 mb-3 fw-normal text-center text-white"><?php echo $TitreDeLaPage ?></h1>
    <?PHP if ($TitreDeLaPage == 'Corriger votre formulaire') echo service('validation')->listErrors(); ?>

    <div class="form-floating">
    <input class="form-control" type="text" name="txtMail" value="<?php echo set_value('txtMail') ?>" />
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
    <input class="form-control" type="password" name="txtMdp" id="mdp" value="<?php echo set_value('txtMdp'); ?>" />
      <label for="floatingPassword">Mot de passe</label>
      <input type="checkbox" class="text-center text-white" onclick="Affichermasquermdp()"> Afficher le mot de passe
    </div>
    <input type="submit" name="submit" class="btn btn-primary btn-md mt-3 text-center" value="Soumettre">  
    <?php form_close()?>
</main>
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