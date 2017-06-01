<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 6/1/2017
 * Time: 12:52 PM
 */

namespace App\Exceptions;


use Exception;

class IdDoesntExistException extends \Exception
{
    private $id;
    private $type;

    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }


}