<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author andres
 */
interface IItemCrawler {

    public function getUrlPage();

    public function setUrlPage($urlPage);

    public function setItemResultsCollection();

    public function getTitle();

    public function setTitle($title);

    public function setImage($img);

    public function getImage();
    
    public function setPrice();
    
    public function getPrice();
}

?>
