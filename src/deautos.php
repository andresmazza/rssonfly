<?php

require_once '../vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
//$url = 'http://deautos.com.ar/autos-usados-ford-ecosport-capital-federal/VTYY1WWMAYY371WWMOYY2664WWVKYY10000-100000WWPVYY19688';
$url = '../deautos2.html';
//$crawler = $client->request('GET', $url);

$html = file_get_contents($url);
$crawler = new Crawler();
$crawler->addContent($html);

$page = 1;

$db = new PDO('sqlite:/home/sanbox/rssonfly/data.sqlite');
$c = 1;
while ($crawler) {

    $crawler->filter('div.lisavisos > div.avisosp')->each(function($node, $i)use ($db, &$c) {
                preg_match('/src="(.*)"/', trim($node->filter('div.fotocar > div.pic')->html()), $matches);
                $img = $matches[1];

                $title = trim($node->filter('div.avisotabs > div.avisodet > div.tabs_txt1 > h2')->text());
                $url = trim($node->filter('div.avisotabs > div.avisodet > div.tabs_txt1 > h2 > a')->attr('href'));

                $year = trim($node->filter('div.avisotabs > div+div+div')->text());

                $km = trim($node->filter('div.avisotabs > div.tabs_txt')->text());
                $km = str_replace("km", "", $km);
                $km = str_replace(".", "", $km);


                $price = trim($node->filter('div.avisotabs > div.tab_price')->text());
                $price = str_replace("$", "", $price);
                $price = str_replace(".", "", $price);

                try {
                    $location = trim($node->filter('div.avisotabs > div.tabs_txt2')->text());
                } catch (Exception $e) {
                    $location = "";
                }


                $phone = "";


                $desc = ""; //desc of product
                //  $type = ""; //gasoline 
                $type = trim($node->filter('div.avisotabs > div+div+div+div')->text());
                printf("\n\n%d) %s\n %s\n %s $%s y:%s km:%s km\n %s %s type:%s\n", $c, $title, $url, $img, $price, $year, $km, $location, $phone, $type);
                $c++;
                $insert = "INSERT INTO item 
                    (url, title, desc, year, price, km, location, phone, img , type,createdAt) 
                VALUES 
                (:url, :title, :desc, :year, :price, :km, :location, :phone, :img ,:type, date('now'))";

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
                //   $stmt->execute();
                //   exit(0);
            });



    $crawler->filter('div.lisavisos > div.avisop')->each(function($node, $i)use ($db, &$c) {

                preg_match('/src="(.*)"/', trim($node->filter('div.fotocar > div.pic')->html()), $matches);
                $img = $matches[1];

                $title = trim($node->filter('div.avisotabs > div.avisodet > div.tabs_txt1 > h2')->text());
                $url = trim($node->filter('div.avisotabs > div.avisodet > div.tabs_txt1 > h2 > a')->attr('href'));

                $year = trim($node->filter('div.avisotabs > div+div+div')->text());

                $km = trim($node->filter('div.avisotabs > div.tabs_txt')->text());
                $km = str_replace("km", "", $km);
                $km = str_replace(".", "", $km);


                $price = trim($node->filter('div.avisotabs > div.tab_price')->text());
                $price = str_replace("$", "", $price);
                $price = str_replace(".", "", $price);

                try {
                    $location = trim($node->filter('div.avisotabs > div.tabs_txt2')->text());
                } catch (Exception $e) {
                    $location = "";
                }


                $phone = "";


                $desc = ""; //desc of product
                //  $type = ""; //gasoline 
                $type = trim($node->filter('div.avisotabs > div+div+div+div')->text());
                printf("\n\n%d) %s\n %s\n %s $%s y:%s km:%s km\n %s %s type:%s\n", $c, $title, $url, $img, $price, $year, $km, $location, $phone, $type);
                $c++;
                $insert = "INSERT INTO item 
                    (url, title, desc, year, price, km, location, phone, img , type,createdAt) 
                VALUES 
                (:url, :title, :desc, :year, :price, :km, :location, :phone, :img ,:type, date('now'))";

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
            });


    $crawler->filter('div.lisavisos > div.avisosimple')->each(function($node, $i)use ($db, &$c) {

                preg_match('/src="(.*)"/', trim($node->filter('div.fotocar > div.pic')->html()), $matches);
                $img = $matches[1];

                $title = trim($node->filter('div.tabs_txt1_simple')->text());
                $url = trim($node->filter('div.tabs_txt1_simple > a')->attr('href'));

                $year = trim($node->filter('div.avisotabsimple > div+div+div')->text());

                $km = trim($node->filter('div.avisotabsimple > div.tabs_txt')->text());
                $km = str_replace("km", "", $km);
                $km = str_replace(".", "", $km);

                $price = trim($node->filter('div.avisotabsimple > div.tab_price')->text());
                $price = str_replace("$", "", $price);
                $price = str_replace(".", "", $price);

                $location = "";
                $phone = "";
                $desc = ""; //desc of product
                //  $type = ""; //gasoline 
                $type = trim($node->filter('div.avisotabsimple > div+div+div+div')->text());


                printf("\n\n%d) %s\n %s\n %s $%s y:%s km:%s km\n %s %s type:%s\n", $c, $title, $url, $img, $price, $year, $km, $location, $phone, $type);
                $c++;
                $insert = "INSERT INTO item 
                    (url, title, desc, year, price, km, location, phone, img , type,createdAt) 
                VALUES 
                (:url, :title, :desc, :year, :price, :km, :location, :phone, :img ,:type, date('now'))";

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
            });





    $link = $crawler->selectLink('Siguiente');


    if (count($link)) {
        sleep(5);
        $crawler = $client->click($link->link());
    } else {
        $crawler = null;
    }
}
