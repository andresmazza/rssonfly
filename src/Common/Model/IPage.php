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
 * @category Api
 * @package  DynamicSitemap
 * @author   Rodrigo Garcia <rodrigo@rgnu.com.ar>
 * @license  http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link     http://www.rgnu.com.ar/
 */

namespace DynamicSitemap\Api\Model;

/**
 * IPage
 *
 * @category Api
 * @package  DynamicSitemap
 * @author   Rodrigo Garcia <rodrigo@rgnu.com.ar>
 * @license  http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link     http://www.rgnu.com.ar/
 */
interface IPage extends IPersistentModel
{
    /**
     * getUrl
     *
     * @return string url
     */
    public function getUrl();

    /**
     * setUrl
     *
     * @param string $url url to set
     *
     * @return void
     */
    public function setUrl($url);

    /**
     * getUpdatedAt
     *
     * @return timestamp Date of updated
     */
    public function getUpdatedAt();

    /**
     * setUpdatedAt
     *
     * @param timestamp $date timestamp
     *
     * @return void
     */
    public function setUpdatedAt($date);

    /**
     * getType
     *
     * @return string type of url
     */
    public function getType();

    /**
     * setType
     *
     * @param string $type Type of url
     *
     * @return void
     */
    public function setType($type);

    /**
     * getCountryId
     *
     * @return integer country Id
     */
    public function getCountryId();

    /**
     * setCountryd
     *
     * @param integer $countryId country Id
     *
     * @return void
     */
    public function setCountryId($countryId);
}
