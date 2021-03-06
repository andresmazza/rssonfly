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
 * IModel
 *
 * @category Api
 * @package  DynamicSitemap
 * @author   Rodrigo Garcia <rodrigo@rgnu.com.ar>
 * @license  http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link     http://www.rgnu.com.ar/
 */
interface IModel
{
    /**
     * getId
     *
     * @return mixin id
     */
    public function getId();

    /**
     * setId
     *
     * @param mixin $id id to set
     *
     * @return void
     */
    public function setId($id);
}
