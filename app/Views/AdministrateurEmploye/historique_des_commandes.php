
    <div>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                    <div class="container col-md-5">
                    <h4 class="text-white">Client: <?php echo $client['NOM']; echo ' '.$client['PRENOM'];?></h4> 
                    <table class="table table-hover">
                            <thead>
                                <tr>
                                
                                <th width="10%" class="text-white">Date de commande</th>
                                <th width="15%" class="text-white">Total TTC</th>
                                
                                </tr>
                            </thead>
                        <?php
                        foreach($commandes as $commande){?>
                        <tr onclick="window.location.href = '<?php echo site_url('AdministrateurEmploye/details_commande/'.$commande['NOCOMMANDE']) ?>'" class="hover">
                            <td class="text-white"><?php echo substr($commande['DATECOMMANDE'],0,10);?> </td>
                            <td class="text-white"> <?php echo $commande['TOTALTTC'].'€';?></td> </tr>
                        <?php }?></table>
                    </div>
            </div>
        </div>
    </div>
