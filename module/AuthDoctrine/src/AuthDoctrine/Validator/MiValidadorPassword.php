<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 26/03/2016
 * Time: 04:27 AM
 */
namespace AuthDoctrine\Validator;

use Zend\Debug\Debug;
use Zend\Validator\AbstractValidator;

class MiValidadorPassword extends AbstractValidator
{
    const LENGTH = 'length';
    const UPPER  = 'upper';
    const LOWER  = 'lower';
    const DIGIT  = 'digit';

    protected $messageTemplates = array(
    self::LENGTH => "El campo '%value%' debe contener al menos 8 caracteres",
    self::UPPER  => "El campo '%value%' debe contener al menos una letra mayúscula",
    self::LOWER  => "El campo '%value%' debe contener al menos una letra minuscula",
    self::DIGIT  => "El campo '%value%' debe contener al menos un numero"

);

    public function isValid($value)
{
    $this->setValue($value);

    //Debug::dump($value);

    $isValid = true;

    if (strlen($value) < 8) {
        $this->error(self::LENGTH);
        $isValid = false;
    }

    if (!preg_match('/[A-Z]/', $value)) {
        $this->error(self::UPPER);
        $isValid = false;
    }

    if (!preg_match('/[a-z]/', $value)) {
        $this->error(self::LOWER);
        $isValid = false;
    }

    if (!preg_match('/\d/', $value)) {
        $this->error(self::DIGIT);
        $isValid = false;
    }

    return $isValid;
}
}