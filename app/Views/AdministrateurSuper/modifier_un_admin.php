<div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 container  my-5">
                    <br>
                    <h2 class="text-primary"><?php echo $TitreDeLaPage ?></h2>
                    <?php if ($TitreDeLaPage == 'Corriger votre formulaire') echo service('validation')->listErrors();
                    ?>
                    <?= form_open('AdministrateurSuper/modifier_un_admin/'.$admin['id'],[],['id'=>$admin['id']]);?>
                    <label class="text-primary" for="identifiant">Identifiant : </label>
                    <input class="form-control" type="input" name="identifiant" value="<?= $admin['IDENTIFIANT'] ?>" /><br />
                    <label class="text-primary" for="motdepasse">Mot de passe : </label>
                    <input class="form-control" type="input" name="motdepasse" value="<?php echo set_value('motdepasse'); ?>" /><br />
                    <label class="text-primary" for="email">Email : </label>
                    <input class="form-control" type="input" name="email" value="<?= $admin['EMAIL'] ?>" /><br />
                    <input class="btn btn-primary btn-md" type="submit" name="submit" value="Valider les modifications" />
                    <?= form_close()?>
                </div>
            </div>
        </div>
    </div>
</div>