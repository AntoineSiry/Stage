
<!DOCTYPE html>
<?php
require_once('simple_html_dom.php');
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="CSS.css">
<head>
    <meta charset = "utf-8">
    <title><h1>Recherche de films</h1></title>
    <div class="text-center">
    <h1>Recherche de films</h1>
    </div>
</head>
<div class="container">
    <br/>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <form action="affichage.php" method="POST" class="card card-sm">
                <div class="card-body row no-gutters align-items-center">
                    <div class="col-auto">
                        <i class="fas fa-search h4 text-body"></i>
                    </div>
                    <!--end of col-->
                    <div class="col">
                        <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Rechercher un film..." name="film" id="film">
                    </div>
                    <!--end of col-->
                    <div class="col-auto">
                        <button class="btn btn-lg btn-success" type="submit">Rechercher</button>
                    </div>
                    <!--end of col-->
                </div>
            </form>
        </div>
        <!--end of col-->
    </div>
</div>
<?php
$url = "http://www.allocine.fr/films";
$html = file_get_html($url); // On récupére l'html de la page mit en paramètre

$genres = array(); // Initialisation d'un tableau nommé "genres"
$i = 0; // Initialisation à 0 de la variable i
// On récupère les genres dans la partie filtres de la page Allociné.fr :
foreach ($html->find('ul.filter-entity-word[data-name="Par genres"] li.filter-entity-item') as $u) { // Dans la balise ul qui a pour classe "filter-entity-word" et pour data-name "Par genres pour chaque li qui a pour classe "filter-entity-item" faire ce qui suit
    if ($u->find('a.item-content', 0) != null) { // Si le contenu de la balise a qui a pour classe "item-content" est différent de null alors on fait ce qui suit
        $genres[$i] = $u->find('a.item-content', 0)->plaintext; // On stock dans le tableau le texte brut contenu dans la balise a qui a pour classe "item-content"
        $i++; // On ajoute 1 à la variable i
    }
}

$les_genres = ""; // On initialise la variable gen
$i = 0;
// on récupère les données de chaque film de la page :
foreach ($html->find('li.mdl') as $a) { // Pour chaque film faire ce qui suit
    foreach ($a->find('div.meta-body', 0)->find('span') as $elem) { // Pour chaque balise span contenu dans la div qui a pour classe "meta-body" on fait ce qui suit
        foreach ($genres as $g) { // On parcourt le tableau contenant tous les genres
            if ($elem->plaintext == $g) { // Si le genre du film est égal au genre du tableau alors on le stock dans la variable "les_genres"
                $les_genres .= $elem->plaintext . " ";
            }
        }
    }

    if ($a->find('a.meta-title-link', 0) != null && $a->find('div.meta-body', 0) != null && $a->find('div.meta-body', 0) != null && $a->find('div.meta-body', 0)->find('span.date', 0) != null) {
        $allocine[$i] = array('Titre' => $a->find('a.meta-title-link', 0)->plaintext,
            'Genre' => $les_genres,
            'Date de sortie' => $a->find('div.meta-body', 0)->find('span.date', 0)->plaintext,
            'Réalisateur' => $a->find('div.meta-body', 0)->find('a.blue-link', 0)->plaintext); // Stockage du titre, du genre, de la date de sortie et du réalisateur du film dans un tableau
        $i++;
    }
    $les_genres = ""; // On re-initialise la variable les_genres
}

$html->clear();
?>
