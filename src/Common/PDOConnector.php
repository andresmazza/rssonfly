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
 * PHP version 5.3
 *
 * @category  SEO-Labs
 * @package   DynamicSitemap
 * 
 * @author    Rodrigo Garcia <rodrigo@rgnu.com.ar>
 * @copyright 2011 OLXOB
 * @license   http://olx.com/ OLX
 * @link      http://olx.com/
 */
namespace DynamicSitemap\Common;

/**
 * SQLConnector
 *
 * @category   DynamicSitemap
 * @package    Module
 * @subpackage DynamicSitemapCommon
 *
 * @author     Hugo Gomez Mac Gregor <hugogmg@gmail.com>
 * @copyright  2013 OLX
 * @license    http://olx.com/ OLX
 * @link       http://olx.com/
 */
class PDOConnector implements \DynamicSitemap\Api\Service\IConnector
{
       
    private $_pdo = null;
   
    /**
     * Constructor
     *
     * @param string $dsn Argument to connecto to DB
     *
     * @return void
     */
    public function __construct($dsn, $username=null, $passwd=null, $options=array())
    {
        if (is_null($dsn)) {
            throw new \InvalidArgumentException('DSN argument missing');
        }
        
        try {            
            //set Instance of PDO with dsn string
            $this->initPDOInstance($dsn, $username, $passwd, $options);                      
        } catch (\PDOException $e) {
            // Print PDOException message
            throw new PDOConnectorException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
    /**
     * Send a query that 'doesnt return results' (INSERT, UPDATE, DELETE).
     *
     * @param string $query A SQL query. The query string should not
     *   end with a semicolon.
     *
     * @return bool True on success, False otherwise
     *
     * @throws PDOConnectorException
     */

    public function exec($query)
    {
        try {
            return $this->getPDOInstance()->exec($query);
        } catch (\PDOException $e) {
            throw new PDOConnectorException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Send a query that returns results (SELECT).
     *
     * @param string $query A SQL query. The query string should 
     *  not end with a semicolon.
     *
     * @return bool True on success, False otherwise
     *
     * @throws PDOConnectorException
     */
    public function query($query)
    {
        try {        
            $results = $this->getPDOInstance()->query($query);
            return $results->fetchAll();
        } catch (\PDOException $e) {
            throw new PDOConnectorException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
    /**
     * getter PDO 
     * 
     * @return PDO 
     */
    public function getPDOInstance()
    {
        return $this->_pdo;
    }

    /**
     * Initialize PDO instance
     * 
     * @param string $dsn dsn
     * 
     * @return void
     */
    public function initPDOInstance($dsn, $username=null, $passwd=null, $options=array())
    {
        $pdo = new \PDO($dsn, $username, $passwd, $options);
        // Set errormode to exceptions
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
        // Set default fetch mode
        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        
        $this->_pdo = $pdo;
    }
}



/**
 * PDOConnectorException
 *
 * @category   DynamicSitemap
 * @package    Module
 * @subpackage DynamicSitemapCommon
 *
 * @author     Andres Mazza <andres.mazza@gmail.com>
 * @copyright  2013 OLX
 * @license    http://olx.com/ OLX
 * @link       http://olx.com/
 */

class PDOConnectorException extends \Exception
{
    /**
     * Cast Exception to String
     *
     * @return string String representation of Exception
     */
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}


