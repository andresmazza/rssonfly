<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Andres Mazza <andres.mazza@gmail.com>
 */
interface ICarCrawler extends ICarCrawler {

    public function setYear($year);

    public function getYear();

    public function setKm($km);

    public function getKm();

    public function setType($type);

    public function getType();
}

?>
