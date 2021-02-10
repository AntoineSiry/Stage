<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$url = "http://www.allocine.fr/recherche/?q=".$_POST['film']."" ;
$remplacement = "%20" ;
$url = str_replace( " ", $remplacement, $url ) ;
$html = file_get_contents( $url );
echo $html;

?>






