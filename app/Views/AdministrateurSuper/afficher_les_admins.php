<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="container col-md-5 m-5">
            <h5 class="text-white">Lister les Administrateurs</h5>
            <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-white">Identifiant</th>
                    <th class="text-white">Options</th>
                </tr>
            </thead>
                <?php
                    foreach ($admins as $admin) {
                        $id = $admin['id'];
                        $identifiant = $admin['IDENTIFIANT']; 
                        $mail = $admin['EMAIL'] ;?>
                    <tr class="text-white">
                        <td class="text-white"><?= $identifiant; ?></td>
                        <th class="text-white"><a class="text-white" href="<?= base_url('AdministrateurSuper/modifier_un_admin/'.$id)?>"><button class="text-white btn btn-sm btn-warning">Modifier</button></a></th>
                        <th class="text-white"><a class="text-white" href="<?= base_url('AdministrateurSuper/supprimer_un_admin/'.$id)?>"><button class="text-white btn btn-sm btn-danger">Supprimer</button></a></th>
                    </tr>
                <?php } ?>
            
            </table>
        </div>
    </div>
</div>