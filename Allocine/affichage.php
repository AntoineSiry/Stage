
<link rel="stylesheet" href="CSS.css">
<?php
include_once "index.php";

$film = $_POST['film'];
$trouve = 0;
?>
<div class="text-center">
    Données tirées de  <?php 
echo '<a href="https://www.allocine.fr/films/">AlloCine</a>'; 
?>
    <h4>
        <?php
        if ($film != NULL) { // S'il y a un film de saisi alors on fait ce qui suit
            foreach ($allocine as $elem) {  // On parcourt le tableau des données récupérées du site Allociné.fr  à la recherche d'un titre composé du mot saisi
                if (stripos($elem['Titre'], $film) !== false) {  // Si le mot saisi est trouvé dans un titre, on affiche les infos du film
                    $trouve++; // On ajoute 1 à la variable trouve
                    ?>
                    <p id="inset" >
                    <?php
                    echo 'Titre : ' . $elem['Titre'] . '<br>'; // Affichage du titre
                    echo 'Genre(s) : ' . $elem['Genre'] . '<br>';
                    echo 'Date de sortie : ' . $elem['Date de sortie'] . '<br>';
                    echo 'Réalisateur : ' . $elem['Réalisateur'] . '<br>' . '<br>';
                    ?>
                    </p>
                    <?php
                }
            }

            if ($trouve == 0) { // Si la variable trouve est égal à 0 on fait ce qui suit
                echo 'Aucun film trouvé pour cette recherche';
            }
        } else { // Si aucun film n'a été saisi alors on fait ce qui suit
            echo 'Aucun titre de film saisi... Veuillez saisir un titre à rechercher';
        }
        ?>
    </h4>
</div>
