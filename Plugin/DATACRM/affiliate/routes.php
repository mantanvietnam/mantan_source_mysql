<?php
    global $routesPlugin;

    // api 
    $routesPlugin['book-online']= 'affiliate/view/home/order/bookOnline.php';
    $routesPlugin['affiliaterLogin']= 'affiliate/view/home/user/affiliaterLogin.php';
    $routesPlugin['affiliaterLogout']= 'affiliate/view/home/user/affiliaterLogout.php';
    $routesPlugin['affiliaterAccount']= 'affiliate/view/home/user/affiliaterAccount.php';
    $routesPlugin['affiliaterChangePass']= 'affiliate/view/home/user/affiliaterChangePass.php';

    $routesPlugin['listOrderAffiliater']= 'affiliate/view/home/order/listOrderAffiliater.php';
    $routesPlugin['listTransactionAffiliater']= 'affiliate/view/home/order/listTransactionAffiliater.php';

?>