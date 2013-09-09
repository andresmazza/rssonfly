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


/**
 * IConnector
 *
 * @category   Api
 * @package    DynamicSitemap
 * @subpackage Api
 * @author     Rodrigo Garcia <rodrigo@rgnu.com.ar>
 * @license    http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link       http://www.rgnu.com.ar/
 */
interface IConnector
{

    /**
     * Send a query that 'doesnt return results' (INSERT, UPDATE, DELETE).
     *
     * @param string $query A SQL query. The query string should not
     *   end with a semicolon.
     *
     * @throws MysqlConnectionException
     * @uses MysqlConnection::_query()
     * @uses MysqlConnection::_buildResult()
     * 
     * @return bool True on success, False otherwise
     */

    public function exec($query);



    /**
     * Send a query that returns results (SELECT).
     *
     * @param string $query A SQL query. The query string should 
     *  not end with a semicolon.
     *
     * @throws MysqlConnectionException
     * @uses MysqlConnection::_query()
     * @uses MysqlConnection::_buildResult()
     * 
     * @return bool True on success, False otherwise 
     */
    public function query($query);

}
