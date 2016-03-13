<!DOCTYPE html>
<meta http-equiv="Content-Language" content="fr" />
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="fr"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="fr"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="fr"><![endif]-->
<!--[if (IE 9)]><html class="no-js ie9" lang="fr"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="fr-FR"> <!--<![endif]-->
<head>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>BookCase</title>   

<meta name="description" content="" /> 

</head>
<body>

<h1>BookCase</h1>
<?php

$isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';
// ou si vous préférez hardcodé
 // $isbn = '0061234001';
 $titre='twilight';
 // $isbn = '978-2-253-19498-9';
 // $isbn = '9782253194989';
 // $isbn = '9782234069978';
 $isbn = '9782266230919'; // la nuit des temps
 $isbn = '9782757829356'; // hommes entre eux
 // $isbn = '9782070461448'; // le liseur de6h27
 

 
 //Source :http://vincent-lecomte.blogspot.fr/2014/04/web-recherche-dun-livre-avec-google.html
//q=hommes+entre+eux          //Mettre entre parenthese les argument 
//q=fleurs+inauthor:keyes”    // permettra d’obtenir la liste des ouvrages qui correspondent à la recherche du tag “fleurs” et qui sont écrits par Keyes.
 //q=isbn:XXXXXXXXXXXXX
 //HTTPRequête” dans Windev, on obtient un code HTTP “200” (signifiant “OK”)
 //Résultat au format JSON
//totalItems : cet attribut nous indique combien d’attributs “items” sont présents. Cela permet de savoir combien d’éléments correspondent à notre recherche et surtout à déterminer le nombre d’éléments sur lequel on va boucler.
//items : contient l’ensemble des ouvrages avec les éléments de base (titre, auteur, codes ISBN, identifiant, etc). Le champ “id” peut être récupéré pour afficher les informations détaillées d’un livre avec une autre requête GET.

$request = 'https://www.googleapis.com/books/v1/volumes?country=FR&q=isbn:' . $isbn; 
// $request = 'https://www.googleapis.com/books/v1/volumes?country=FR&q=titre:' . $titre;  
$response = file_get_contents($request);
$results = json_decode($response);
// var_dump($results);
print_r(file_get_contents($request));

  
if($results->totalItems > 0){
   // avec de la chance, ce sera le 1er trouvé
   $book = $results->items[0];

   $infos['isbn'] = $book->volumeInfo->industryIdentifiers[0]->identifier;
   $infos['id'] = $book->id;
   // $infos['titre'] = $book->volumeInfo->title;
   // $infos['auteur'] = $book->volumeInfo->authors[0];
   // $infos['langue'] = $book->volumeInfo->language;
   // $infos['publication'] = $book->volumeInfo->publishedDate;
   // $infos['pages'] = $book->volumeInfo->pageCount;
   // $infos['description'] = $book->volumeInfo->description;
   // $infos['categories'] = $book->volumeInfo->categories[0];
   // $infos['price'] = $book->saleInfo->listPrice->amount.' '.$book->saleInfo->listPrice->currencyCode;
   $infos['price'] = '';
   
   // print_r($book->saleInfo);
   echo '<hr>';
   echo $infos['id'];
   echo '<hr>';
   print_r(file_get_contents("https://www.googleapis.com/books/v1/volumes/".$infos['id']));
  
   if( isset($book->volumeInfo->imageLinks) ){
       $infos['image'] = str_replace('&edge=curl', '', $book->volumeInfo->imageLinks->thumbnail);
   }

   // print_r($infos);
   echo '<hr>';
   $result = '<br>';
   // $result .= '<span style="color:gray;">Isbn:</span> '.$infos['isbn'].'<br>';
   // $result .= '<span style="color:gray;">Titre:</span> '.$infos['titre'].'<br>';
   // $result .= '<span style="color:gray;">Auteur:</span> '.$infos['auteur'].'<br>';
   // $result .= '<span style="color:gray;">Langue:</span> '.$infos['langue'].'<br>';
   // $result .= '<span style="color:gray;">Categories:</span> '.$infos['categories'].'<br>';
   // $result .= '<span style="color:gray;">Publication:</span> '.$infos['publication'].'<br>';
   // $result .= '<span style="color:gray;">Pages:</span> '.$infos['pages'].'<br>';
   // $result .= '<span style="color:gray;">Image:</span> '.$infos['image'].'<br>';
   // $result .= '<span style="color:gray;">Prix:</span> '.$infos['price'].'<br>';
   // $result .= '<span style="color:gray;">Description:</span> '.$infos['description'].'<br>';
   // echo '<img src="'.$infos['image'].'">';
   // echo $result;
}
else{
   echo 'Livre introuvable';
}

?>

<hr>

</body>
</html>