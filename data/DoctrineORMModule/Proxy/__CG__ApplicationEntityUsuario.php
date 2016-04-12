<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Usuario extends \Application\Entity\Usuario implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getUsrId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["usrId"];
        }
        $this->__load();
        return parent::getUsrId();
    }

    public function setUsrName($usrName)
    {
        $this->__load();
        return parent::setUsrName($usrName);
    }

    public function getUsrName()
    {
        $this->__load();
        return parent::getUsrName();
    }

    public function setUsrPassword($usrPassword)
    {
        $this->__load();
        return parent::setUsrPassword($usrPassword);
    }

    public function getUsrPassword()
    {
        $this->__load();
        return parent::getUsrPassword();
    }

    public function setUsrEmail($usrEmail)
    {
        $this->__load();
        return parent::setUsrEmail($usrEmail);
    }

    public function getUsrEmail()
    {
        $this->__load();
        return parent::getUsrEmail();
    }

    public function setUsrlId($usrlId)
    {
        $this->__load();
        return parent::setUsrlId($usrlId);
    }

    public function getUsrlId()
    {
        $this->__load();
        return parent::getUsrlId();
    }

    public function setLngId($lngId)
    {
        $this->__load();
        return parent::setLngId($lngId);
    }

    public function getLngId()
    {
        $this->__load();
        return parent::getLngId();
    }

    public function setUsrActive($usrActive)
    {
        $this->__load();
        return parent::setUsrActive($usrActive);
    }

    public function getUsrActive()
    {
        $this->__load();
        return parent::getUsrActive();
    }

    public function setUsrQuestion($usrQuestion)
    {
        $this->__load();
        return parent::setUsrQuestion($usrQuestion);
    }

    public function getUsrQuestion()
    {
        $this->__load();
        return parent::getUsrQuestion();
    }

    public function setUsrAnswer($usrAnswer)
    {
        $this->__load();
        return parent::setUsrAnswer($usrAnswer);
    }

    public function getUsrAnswer()
    {
        $this->__load();
        return parent::getUsrAnswer();
    }

    public function setUsrPicture($usrPicture)
    {
        $this->__load();
        return parent::setUsrPicture($usrPicture);
    }

    public function getUsrPicture()
    {
        $this->__load();
        return parent::getUsrPicture();
    }

    public function setUsrPasswordSalt($usrPasswordSalt)
    {
        $this->__load();
        return parent::setUsrPasswordSalt($usrPasswordSalt);
    }

    public function getUsrPasswordSalt()
    {
        $this->__load();
        return parent::getUsrPasswordSalt();
    }

    public function setUsrRegistrationDate($usrRegistrationDate)
    {
        $this->__load();
        return parent::setUsrRegistrationDate($usrRegistrationDate);
    }

    public function getUsrRegistrationDate()
    {
        $this->__load();
        return parent::getUsrRegistrationDate();
    }

    public function setUsrRegistrationToken($usrRegistrationToken)
    {
        $this->__load();
        return parent::setUsrRegistrationToken($usrRegistrationToken);
    }

    public function getUsrRegistrationToken()
    {
        $this->__load();
        return parent::getUsrRegistrationToken();
    }

    public function setUsrEmailConfirmed($usrEmailConfirmed)
    {
        $this->__load();
        return parent::setUsrEmailConfirmed($usrEmailConfirmed);
    }

    public function getUsrEmailConfirmed()
    {
        $this->__load();
        return parent::getUsrEmailConfirmed();
    }

    public function setUsrIdPersona($usrIdPersona)
    {
    	$this->__load();
    	return parent::setUsrIdPersona($usrIdPersona);
    }
    
    public function getUsrIdPersona()
    {
    	$this->__load();
    	return parent::getUsrIdPersona();
    }
    
    public function setUsrItem($usrItem)
    {
    	$this->__load();
    	return parent::setUsrItem($usrItem);
    }
    
    public function getUsrItem()
    {
    	$this->__load();
    	return parent::getUsrItem();
    }

    public function __sleep()
    {
        return array('__isInitialized__', 'usrId', 'usrName', 'usrPassword', 'usrEmail', 'usrlId', 'lngId', 'usrActive', 'usrQuestion', 'usrAnswer', 'usrPicture', 'usrPasswordSalt', 'usrRegistrationDate', 'usrRegistrationToken', 'usrEmailConfirmed', 'usrIdPersona', 'usrItem');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
	/* (non-PHPdoc)
	 * @see \Doctrine\Common\Proxy\Proxy::__setInitialized()
	 */
	public function __setInitialized($initialized) {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see \Doctrine\Common\Proxy\Proxy::__setInitializer()
	 */
	public function __setInitializer(\Closure $initializer = null) {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see \Doctrine\Common\Proxy\Proxy::__getInitializer()
	 */
	public function __getInitializer() {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see \Doctrine\Common\Proxy\Proxy::__setCloner()
	 */
	public function __setCloner(\Closure $cloner = null) {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see \Doctrine\Common\Proxy\Proxy::__getCloner()
	 */
	public function __getCloner() {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties()
	 */
	public function __getLazyProperties() {
		// TODO Auto-generated method stub
		
	}

}