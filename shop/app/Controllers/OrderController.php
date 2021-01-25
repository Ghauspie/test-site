<?php

namespace App\Controllers;

use App\Models\Order;

class OrderController extends CoreController
{
    public function list()
    {
        $this->show('order/list');
    }

    public function update()
    {
        
        //  $reset=New Order;
        //$reset=$reset->reset();

            // 1. On récupère la catégorie concernée dans la BDD => on récupère un objet
            // 2. On alimente cet objet avec les données mises à jour
            // 3. On met à jour dans la BDD
            foreach ($_POST['emplacement'] as $numberHomeOrder => $categoryId) {
                $Id=$categoryId;
                $home_order=$numberHomeOrder;
                // On récupère la catégorie courante (dans la BDD)
                $home_order+=1;
                //dump($home_order, $Id);
                $Order = Order::find($Id);
                // On met à jour les propriétés de l'instance.
                $Order->getId(intval($Id,10));
                $Order->setHome_order($home_order);
                dump($Order);
                // on met a jours les données sur la BDD
                $ok = $Order->update();
                if ($ok) {
                    // Si la sauvegarde a fonctionné, on redirige vers la liste des catégories.
                   echo 'sauvegarde done';
                   header('Location: /category/list');
                    
                }
                else {
                    // Sinon, on ajoute un message d'erreur à la page actuelle, et on laisse
                    // l'utilisateur retenter la création.
                    echo 'La sauvegarde a échoué';
                }
                }
    
            
            
    }
}
