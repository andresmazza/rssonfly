<?php

/**
 * LICENSE:
 *
 * This library is free software; you can redistribute it
 * and/or modify it under the terms of the GNU Lesser General
 * Public License as published by the Free Software Foundation;
 * either version 2.1 of the License, or (at your option) any
 * later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * PHP version 5
 *
 * @category   Api
 * @package    DynamicSitemap
 * @subpackage Api
 * @author     Rodrigo Garcia <rodrigo@rgnu.com.ar>
 * @license    http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link       http://www.rgnu.com.ar/
 */

namespace DynamicSitemap\Api\Service;

use DynamicSitemap\Api\Model\IPage;

/**
 * IPageService
 *
 * @category   Api
 * @package    DynamicSitemap
 * @subpackage Api
 * @author     Rodrigo Garcia <rodrigo@rgnu.com.ar>
 * @license    http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link       http://www.rgnu.com.ar/
 */
interface IPageService extends IPersistentService
{
    /**
     * Find a page with $url
     *
     * @param string $url url
     *
     * @return IPage
     */
    public function findByUrl($url);

    /**
     * Find the records newest that $time
     *
     * @param timestamp $time time
     * @param array $args Conditions
     * 
     * @return Iterator<IPage>
     */
    public function findNewestByTime($time, $args);

    /**
     * Find the records oldest that $time
     *
     * @param timestamp $time time
     * @param array $args Conditions
     * 
     * @return Iterator<IPage>
     */
    public function findOldestByTime($time, $args);
    
    /**
     * Find the records that match with $country and are newest than $time
     * 
     * @param $countryId  Country ID
     * @param timestamp $time time
     * @param array $args Conditions
     * 
     * @return Iterator<IPage>
     */
    public function findNewestByCountryId($countryId, $time, $args);
    
    /**
     * Find the records that match with $country and are oldest than $time
     *  
     * @param $countryId  Country ID
     * @param timestamp $time time
     * @param array $args Conditions
     * 
     * @return Iterator<IPage>
     */
    public function findOldestByCountryId($countryId, $time, $args);
}
