<?php

require_once '../vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
$url = 'http://autos.demotores.com.ar/autos-usados-ford-ecosport/vtZ1QQmoZ1827QQnZ0QQkmZ25000+100000QQvgZlist';
//$url = 'http://autos.demotores.com.ar/autos-usados-ford-ecosport-capital-federal/vtZ1QQmoZ1827QQreZ25QQnZ0QQkmZ25000+100000QQvgZlist';
//$url = '../demotores.html';
$crawler = $client->request('GET', $url);
//$html = file_get_contents($url);
//$crawler = new Crawler();
//$crawler->addContent($html);
//print_r($crawler->filter('div#listados-v2 > ul.list-view')->html());exit;
$page = 1;

$db = new PDO('sqlite:/home/sanbox/rssonfly/data.sqlite');
$c = 1;
while ($crawler) {

    $crawler->filter('div#listados-v2 > ul.list-view > li.article')->each(function($node, $i)use ($db, &$c) {

                $title = trim($node->filter('div.rowItem > h2 > a')->text());
                $url = trim($node->filter('div.rowItem > h2 > a')->attr('href'));
                $img = trim($node->filter('div.rowItem img')->attr('src'));

                $year = trim($node->filter('div.rowItem p.anio')->text());
                $km = trim($node->filter('div.rowItem p.km')->text());
                $km = str_replace(" Km", "", $km);
                $km = str_replace(".", "", $km);


                $price = trim($node->filter('div.rowItem p.precio')->text());
                $price = str_replace("$", "", $price);
                $price = str_replace(".", "", $price);

                $location = trim($node->filter('div.rowItem div.ubicacion')->text());

                $phone = "";
                $desc = ""; //desc of product
                $type = ""; //gasoline type
                printf("\n\n%d) %s\n %s\n %s $%s y:%s km:%s km\n %s %s type:%s %s\n", $c, $title, $url, $img, $price, $year, $km, $location, $phone, $type, $desc);

                $c++;
                $insert = "INSERT INTO item (url, title, desc, year, price, km, location, phone, img ,type, createdAt) 
                VALUES (:url, :title, :desc, :year, :price, :km, :location, :phone, :img , :type, date('now'))";

                $stmt = $db->prepare($insert);

                // Bind parameters to statement variables
                $stmt->bindParam(':url', $url);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':desc', $desc);
                $stmt->bindParam(':year', $year);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':km', $km);
                $stmt->bindParam(':location', $location);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':img', $img);
                $stmt->bindParam(':type', $type);
                $stmt->execute();
            });

    try {
        $crawler->filter('a.sig')->text();
    $link = $crawler->selectLink('Siguiente');
    }
     catch (Exception $e) {
       exit(0);
     }

    if (count($link)) {
        sleep(5);
        $crawler = $client->click($link->link());
    } else {
        $crawler = null;
    }
}
