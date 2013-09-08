<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Andres Mazza <andres.mazza@gmail.com>
 */
interface IItemPage {
    public function node();
    public function url();
    public function title();
    public function year();
    public function price();
    public function km();   
}

?>
