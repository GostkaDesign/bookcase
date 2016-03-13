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
include('BookSearcher.class.php');

$googleBook = new BookSearcher();

// Exemple de recherche par mot clés //
$livres = $googleBook->getBooksByKeyword('hommes entre eux');

echo '<h1>Example de recherche</h1>';
for ($i=0; $i<count($livres); $i++) {
	echo 'Livre ' . ($i+1) . '<br />';
	echo '<pre>';
		print_r($livres[$i]);
		echo 'tutu:'.$livres[$i]['titre'];
	echo '</pre><br />';
}

// Exemple de recherche par ISBN //
echo '<h1>Example de recherche par ISBN</h1>';
// $isbn = 2844272592;
$isbn = 9782757829356;
$livre = $googleBook->getBookByISBN(''.$isbn.'');

echo 'Livre ('.$isbn.')<br />';
echo '<pre>';
	print_r($livre);
echo '</pre><br />';

?>


</body>
</html>