<div>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="col-md-12 container">
                    <br>
                    <h2 class="text-primary"><?php echo $TitreDeLaPage ?></h2>
                    <?php if ($TitreDeLaPage == 'Corriger votre formulaire') echo service('validation')->listErrors();
                    echo form_open('AdministrateurSuper/lettre_information');
                    ?>
                    <br>
                    

                    <label class="text-primary" for="objet">Objet :</label>
                    <input class="form-control" type="input" name="objet" value="<?php echo set_value('objet'); ?>" /><br />

                    
                    <label class="text-primary" for="titre">Titre :</label>
                    <input class="form-control" type="input" name="titre" value="<?php echo set_value('titre'); ?>" /><br />
                    
                    <label class="text-primary" for="message">Message :</label>
                    <textarea class="form-control" type="input" class="form-control" name="message" value="<?php echo set_value('message'); ?>"></textarea><br />
                    
                    <input class="btn btn-primary btn-md" type="submit" name="submit" value="Envoyer" />
                    <?= form_close()?>
                </div>
            </div>
        </div>
    </div>
</div>