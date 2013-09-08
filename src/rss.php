<?php

require_once '../vendor/autoload.php';

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
//$url = 'http://listado.mercadolibre.com.ar/deportes-extremos-kitesurf';
//$url = 'http://autos.mercadolibre.com.ar/ford/ecosport/ford-ecosport_PciaId_Capital-Federal_PriceRange_70000-80000_kilometers_50000-100000';
$url = 'test.html';
//$crawler = $client->request('GET', $url);
$html = file_get_contents($url); 
$crawler = new Crawler();
$crawler->addContent($html);

$page = 1;

while ($crawler) {

        $crawler->filter('ol#searchResults > li.article')->each(function($node, $i) {
      
	$title = trim($node->filter('h3')->text());
	$year  = trim($node->filter('ul.details > li.destaque > strong')->text());
	$price = trim($node->filter('ul.details > li.costs > span.ch-price')->text());
//	$km    = trim($node->filter('ul.details > li.destaque > strong > span')->text());
	$km    = $node->filter('ul.details li.destaque');
//	$km = $km->filterXPath('/strong/span/strong')->text();
//        $link  = $node->filter('a');
	printf("\ntitle:%s %s y:%s km:\n",$title,$price,$year);
       // printf("%02d) %s (%s) [%s]\n", $i, trim($title->text()), $link->attr('href'), substr(trim($price->text()), 0, -2));
    });
exit(0);	
    $link    = $crawler->selectLink('Siguiente >');

    if (count($link)) {
        sleep(5);
        $crawler = $client->click($link->link());

    } else {
        $crawler = null;
    }

}
