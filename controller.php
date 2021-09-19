<?php

    require_once($_SERVER['DOCUMENT_ROOT']."/CProducts.php");
    $CPRODUCTS = new CProducts();

    $productsList = $CPRODUCTS->select_products(10);

    if ($_POST['q_edit']) { $CPRODUCTS->quantity(); }
    elseif ($_POST['hid']) { $CPRODUCTS->hid(); }

?>