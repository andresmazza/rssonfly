<?php

require_once '../vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
$url = 'http://capitalfederal-gba.olx.com.ar/nf/autos-cat-378/ford%2Beco%2Bsport';
//$url = 'http://autos.demotores.com.ar/autos-usados-ford-ecosport-capital-federal/vtZ1QQmoZ1827QQreZ25QQnZ0QQkmZ25000+100000QQvgZlist';
//$url = '../olx.html';
$crawler = $client->request('GET', $url);
//$html = file_get_contents($url);
//$crawler = new Crawler();
//$crawler->addContent($html);
//print_r($crawler->filter('div#listados-v2 > ul.list-view')->html());exit;
$page = 1;

  
$db = new PDO('sqlite:/home/sanbox/rssonfly/data.sqlite');
$c = 1;
while ($crawler) {

    $crawler->filter('div#itemListContent > div.the-list > div.li')->each(function($node, $i)use ($db, &$c) {

                $title = trim($node->filter('div.second-column-container  > h3 > a')->text());
                $url = trim($node->filter('div.second-column-container  > h3 > a')->attr('href'));
                $img = $node->filter('div.c-1 > div.cropit  a.pics-lnk img')->attr('title');
                preg_match('/http:\/\/(.*)\" width/', trim($node->filter('div.c-1 > div.cropit  a.pics-lnk')->html()), $matches);
                $img = "http://" . trim($matches[1]);

                preg_match('/.*:(.*)/', trim($node->filter('div.c-4 > span')->text()), $matches);
                $year = trim($matches[1]);

                try {
                    $km = trim($node->filter('div.c-4 > span+span+span+span')->text());
                    preg_match('/(.*)\n/', $km, $matches);
                    $km = trim($matches[0]);
                    $km = str_replace(".", "", $km);
                } catch (Exception $exc) {
                    $km = "";
                }


                $price = trim($node->filter('div.third-column-container')->text());
                $price = str_replace("$", "", $price);
                $price = str_replace(".", "", $price);

                $location = trim($node->filter('span.itemlistinginfo')->text());
                $location = trim(str_replace("Autos -", "", $location));
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
                //  $stmt->execute();
            });

    try {
      //  $crawler->filter('a.ui-next')->text();
        $link = $crawler->selectLink('a.ui-next');
    } catch (Exception $e) {
        exit(0);
    }

    if (count($link)) {
        sleep(5);
        $crawler = $client->click($link->link());
    } else {
        $crawler = null;
    }
}
