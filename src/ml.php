<?php

require_once '../vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
$url = 'http://autos.mercadolibre.com.ar/ford/ecosport/ford-ecosport_DisplayType_LF_PciaId_Capital-Federal_kilometers_50000-100000';
//$url = 'test2.html';
$crawler = $client->request('GET', $url);
//$html = file_get_contents($url);
//$crawler = new Crawler();
//$crawler->addContent($html);
    
$page = 1;

$db = new PDO('sqlite:/home/sanbox/rssonfly/data.sqlite');
$c=1;
while ($crawler) {

    $crawler->filter('ol#searchResults > li.list-view-item')->each(function($node, $i)use ($db,&$c) {
                $title = trim($node->filter('h3.list-view-item-title')->text());
                $url = trim($node->filter('a')->attr('href'));
                $img = trim($node->filter('a > img')->attr('title'));

                $year = trim($node->filter('ul.classified-details > li.classified-details-first-item')->text());
                $km = trim($node->filter('ul.classified-details > li.classified-details-item')->text());
                $km = str_replace(" km","",$km);
                $km = str_replace(".","",$km);
                
                
                $price = trim($node->filter('p.price-info > span.price-info-cost > strong.ch-price')->text());
                $price = str_replace("$","",$price);
                $price = str_replace(".","",$price);
                
                try {
                    $location = trim($node->filter('ul.extra-info > li.extra-info-location')->text());

                    $phone = trim($node->filter('ul.extra-info > li.extra-info-phone')->text());
                } catch (Exception $e) {
                    $location = "";
                    $phone = "";
                }
              
                printf("\n\n%d) %s\n %s\n %s $%s y:%s km:%s km\n %s %s\n", $c,$title, $url, $img, $price, $year, $km, $location, $phone);
  $c++;
                $insert = "INSERT INTO item2 (url, desc, year, price, km, location, phone, img) 
                VALUES (:url, :desc, :year, :price, :km, :location, :phone, :img)";

                $stmt = $db->prepare($insert);

                // Bind parameters to statement variables
                $stmt->bindParam(':url', $url);
                $stmt->bindParam(':desc', $title);
                $stmt->bindParam(':year', $year);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':km', $km);
                $stmt->bindParam(':location', $location);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':img', $img);
                $stmt->execute();
            });

    $link = $crawler->selectLink('Siguiente >');

    
    if (count($link)) {
        sleep(5);
        $crawler = $client->click($link->link());
           
    } else {
        $crawler = null;
    }
}