<?php


namespace App\Exceptions;

use Exception;

class UnAuthorizedUserException extends Exception
{

    /**
     * UnAuthorizedUserException constructor.
     */
    public function render()
    {
        return ['error' => 'Permission denied.'];
    }
}
