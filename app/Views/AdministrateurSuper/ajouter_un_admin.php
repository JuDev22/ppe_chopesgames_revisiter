<div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 container form-con my-5">
                    <br>
                    <h2 class="text-primary"><?php echo $TitreDeLaPage ?></h2>
                    <?php if ($TitreDeLaPage == 'Corriger votre formulaire') echo service('validation')->listErrors();
                    echo form_open_multipart('AdministrateurSuper/ajouter_un_admin');
                    ?>
                    <label class="text-primary" for="identifiant">Identifiant : </label>
                    <input class="form-control" type="input" name="identifiant" value="<?php echo set_value('identifiant'); ?>" /><br />
                    
                    <label class="text-primary" for="motdepasse">Mot de passe : </label>
                    <input class="form-control" type="input" name="motdepasse" value="<?php echo set_value('motdepasse'); ?>" /><br />
                    <label class="text-primary" for="email">Email : </label>
                    <input class="form-control" type="input" name="email" value="<?php echo set_value('email'); ?>" /><br />
                    <input class="btn btn-primary btn-md" type="submit" name="submit" value="Ajouter un admin" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>