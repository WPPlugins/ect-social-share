<?php
$sSQL = "SELECT cartProdID,p.pName,pn.imageSrc FROM cart as c inner join products as p on p.pID=c.cartProdID inner join productimages as pn on pn.imageProduct=p.pID WHERE c.cartOrderID='" . escape_string($ordID) . "'";

$result=ect_query($sSQL);

$rs=ect_fetch_assoc($result);

echo do_shortcode('[ect_socialshare pname="'.$rs['pName'].'" pimg="'.$rs['imageSrc'].'"]');
?>