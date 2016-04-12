<?php

namespace AuthDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
// added by Stoyan
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation; // !!!! Absolutely neccessary

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AuthDoctrine\Entity\Repository\UsuarioRepository")
 * @Annotation\Name("usuario")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Usuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="usr_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="usuario_usr_id_seq", allocationSize=1, initialValue=1)
     * @Annotation\Exclude()
     */
    private $usrId;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_name", type="string", length=250, nullable=false)
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Usuario:"})
     */
    private $usrName;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_password", type="string", length=250, nullable=false)
     * @Annotation\Attributes({"type":"password"})
     * @Annotation\Options({"label":"Clave:"})
     */
    private $usrPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_email", type="string", length=100, nullable=false)
     * @Annotation\Type("Zend\Form\Element\Email")
     * @Annotation\Options({"label":"Your email address:"})
     */
    private $usrEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="usrl_id", type="integer", nullable=true)
     * @Annotation\Type("Zend\Form\Element\Select")
     * @Annotation\Options({
     * "label":"User Role:",
     * "value_options":{ "0":"Select Role", "1":"Public", "2": "Member"}})
     */
    private $usrlId;

    /**
     * @var integer
     *
     * @ORM\Column(name="lng_id", type="integer", nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Language Id:"})
     */
    private $lngId;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_active", type="string", nullable=false)
     * @Annotation\Type("Zend\Form\Element\Radio")
     * @Annotation\Options({
     * "label":"User Active:",
     * "value_options":{"1":"Yes", "0":"No"}})
     */
    private $usrActive;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_question", type="string", length=250, nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"User Question:"})
     */
    private $usrQuestion;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_answer", type="string", length=250, nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"User Answer:"})
     */
    private $usrAnswer;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_picture", type="string", length=255, nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"User Picture:"})
     */
    private $usrPicture;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_password_salt", type="string", length=100, nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Password Salt:"})
     */
    private $usrPasswordSalt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="usr_registration_date", type="datetime", nullable=true)
     * @Annotation\Attributes({"type":"datetime","min":"2010-01-01T00:00:00Z","max":"2020-01-01T00:00:00Z","step":"1"})
     * @Annotation\Options({"label":"Registration Date:", "format":"Y-m-d\TH:iP"})
     */
    private $usrRegistrationDate; // = '2013-07-30 00:00:00'; // new \DateTime() - coses synatx error

    /**
     * @var string
     *
     * @ORM\Column(name="usr_registration_token", type="string", length=100, nullable=true)
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Registration Token:"})
     */
    private $usrRegistrationToken;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_email_confirmed", type="string", nullable=false)
     * @Annotation\Type("Zend\Form\Element\Radio")
     * @Annotation\Options({
     * "label":"User confirmed email:",
     * "value_options":{"1":"Yes", "0":"No"}})
     */
    private $usrEmailConfirmed;


    public function __construct()
    {
        $this->usrRegistrationDate = new \DateTime();
    }



    /**
     * Get usrId
     *
     * @return integer 
     */
    public function getUsrId()
    {
        return $this->usrId;
    }

    /**
     * Set usrName
     *
     * @param string $usrName
     * @return Usuario
     */
    public function setUsrName($usrName)
    {
        $this->usrName = $usrName;
    
        return $this;
    }

    /**
     * Get usrName
     *
     * @return string 
     */
    public function getUsrName()
    {
        return $this->usrName;
    }

    /**
     * Set usrPassword
     *
     * @param string $usrPassword
     * @return Usuario
     */
    public function setUsrPassword($usrPassword)
    {
        $this->usrPassword = $usrPassword;
    
        return $this;
    }

    /**
     * Get usrPassword
     *
     * @return string 
     */
    public function getUsrPassword()
    {
        return $this->usrPassword;
    }

    /**
     * Set usrEmail
     *
     * @param string $usrEmail
     * @return Usuario
     */
    public function setUsrEmail($usrEmail)
    {
        $this->usrEmail = $usrEmail;
    
        return $this;
    }

    /**
     * Get usrEmail
     *
     * @return string 
     */
    public function getUsrEmail()
    {
        return $this->usrEmail;
    }

    /**
     * Set usrlId
     *
     * @param integer $usrlId
     * @return Usuario
     */
    public function setUsrlId($usrlId)
    {
        $this->usrlId = $usrlId;
    
        return $this;
    }

    /**
     * Get usrlId
     *
     * @return integer 
     */
    public function getUsrlId()
    {
        return $this->usrlId;
    }

    /**
     * Set lngId
     *
     * @param integer $lngId
     * @return Usuario
     */
    public function setLngId($lngId)
    {
        $this->lngId = $lngId;
    
        return $this;
    }

    /**
     * Get lngId
     *
     * @return integer 
     */
    public function getLngId()
    {
        return $this->lngId;
    }

    /**
     * Set usrActive
     *
     * @param string $usrActive
     * @return Usuario
     */
    public function setUsrActive($usrActive)
    {
        $this->usrActive = $usrActive;
    
        return $this;
    }

    /**
     * Get usrActive
     *
     * @return string 
     */
    public function getUsrActive()
    {
        return $this->usrActive;
    }

    /**
     * Set usrQuestion
     *
     * @param string $usrQuestion
     * @return Usuario
     */
    public function setUsrQuestion($usrQuestion)
    {
        $this->usrQuestion = $usrQuestion;
    
        return $this;
    }

    /**
     * Get usrQuestion
     *
     * @return string 
     */
    public function getUsrQuestion()
    {
        return $this->usrQuestion;
    }

    /**
     * Set usrAnswer
     *
     * @param string $usrAnswer
     * @return Usuario
     */
    public function setUsrAnswer($usrAnswer)
    {
        $this->usrAnswer = $usrAnswer;
    
        return $this;
    }

    /**
     * Get usrAnswer
     *
     * @return string 
     */
    public function getUsrAnswer()
    {
        return $this->usrAnswer;
    }

    /**
     * Set usrPicture
     *
     * @param string $usrPicture
     * @return Usuario
     */
    public function setUsrPicture($usrPicture)
    {
        $this->usrPicture = $usrPicture;
    
        return $this;
    }

    /**
     * Get usrPicture
     *
     * @return string 
     */
    public function getUsrPicture()
    {
        return $this->usrPicture;
    }

    /**
     * Set usrPasswordSalt
     *
     * @param string $usrPasswordSalt
     * @return Usuario
     */
    public function setUsrPasswordSalt($usrPasswordSalt)
    {
        $this->usrPasswordSalt = $usrPasswordSalt;
    
        return $this;
    }

    /**
     * Get usrPasswordSalt
     *
     * @return string 
     */
    public function getUsrPasswordSalt()
    {
        return $this->usrPasswordSalt;
    }

    /**
     * Set usrRegistrationDate
     *
     * @param \DateTime $usrRegistrationDate
     * @return Usuario
     */
    public function setUsrRegistrationDate($usrRegistrationDate)
    {
        $this->usrRegistrationDate = $usrRegistrationDate;
    
        return $this;
    }

    /**
     * Get usrRegistrationDate
     *
     * @return \DateTime 
     */
    public function getUsrRegistrationDate()
    {
        return $this->usrRegistrationDate;
    }

    /**
     * Set usrRegistrationToken
     *
     * @param string $usrRegistrationToken
     * @return Usuario
     */
    public function setUsrRegistrationToken($usrRegistrationToken)
    {
        $this->usrRegistrationToken = $usrRegistrationToken;
    
        return $this;
    }

    /**
     * Get usrRegistrationToken
     *
     * @return string 
     */
    public function getUsrRegistrationToken()
    {
        return $this->usrRegistrationToken;
    }

    /**
     * Set usrEmailConfirmed
     *
     * @param string $usrEmailConfirmed
     * @return Usuario
     */
    public function setUsrEmailConfirmed($usrEmailConfirmed)
    {
        $this->usrEmailConfirmed = $usrEmailConfirmed;
    
        return $this;
    }

    /**
     * Get usrEmailConfirmed
     *
     * @return string 
     */
    public function getUsrEmailConfirmed()
    {
        return $this->usrEmailConfirmed;
    }
}