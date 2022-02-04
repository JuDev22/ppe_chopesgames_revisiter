<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="container col-md-5">
            <h5>Lister les Administrateurs</h5>
            <table class="table table-hover">
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Options</th>
                </tr>
            </thead>
                <?php
                    foreach ($admins as $admin) {
                        $id = $admin['id'];
                        $identifiant = $admin['IDENTIFIANT']; 
                        $mail = $admin['EMAIL'] ;?>
                    <tr>
                        <td><?= $identifiant; ?></td>
                        <th><a href="<?= base_url('AdministrateurSuper/modifier_un_admin/'.$id)?>"><button>Modifier</button></a></th>
                        <th><a href="<?= base_url('AdministrateurSuper/supprimer_un_admin/'.$id)?>"><button>Supprimer</button></a></th>
                    </tr>
                <?php } ?>
            
            </table>
        </div>
    </div>
</div>