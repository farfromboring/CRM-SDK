<?php
namespace CRM_SDK\SharedObjects\User;

use CRM_SDK\ResponseObjects\Authentication\Session;
use CRM_SDK\SharedObjects\Company\Company;
use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\DateAddedTrait;
use CRM_SDK\Traits\IDTrait;

class AbstractUser implements UserInterface, APIObjectInterface
{
    use APIObjectTrait;

    use IDTrait;
    use DateAddedTrait;

    /** @var string|null */
    private $fname;
    /** @var string|null */
    private $lname;
    /** @var string|null */
    private $email;
    /** @var string|null */
    private $jobTitle;
    /** @var string|null (MM/DD) */
    private $birthday;

    /** @var string|null */
    private $password;

    /** @var Company|null */
    private $company;

    /** @var Session|null */
    private $session;

    /**
     * @param array $results
     * @return mixed
     * @throws \Exception
     */
    public function populateFromAPIResults(array $results)
    {
        $this->setId((int) $results['id']);
        $this->setFname($results['fname']);
        $this->setLname($results['lname']);
        $this->setEmail($results['email']);
        $this->setJobTitle($results['job_title']);
        $this->setBirthday($results['birthday']);
        $this->setDateAdded(($results['date_added'] ? new \DateTime($results['date_added']) : null));

        if( !empty($results['company']) ) {
            $this->setCompany(Company::create()->populateFromAPIResults($results['company']));
        }

        if( !empty($results['session']) )
        {
            $this->setSession(Session::create()->populateFromAPIResults($results['session']));
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'=>$this->getId(),
            'fname'=>$this->getFname(),
            'lname'=>$this->getLname(),
            'email'=>$this->getEmail(),
            'job_title'=>$this->getJobTitle(),
            'birthday'=>$this->getBirthday(),
            'password'=>$this->getPassword(),
            'company'=>($this->getCompany() ? $this->getCompany()->toArray() : null)
        ];
    }

    /**
     * @return Session|null
     */
    public function getSession(): ?Session
    {
        return $this->session;
    }

    /**
     * @param Session|null $session
     * @return mixed
     */
    public function setSession(?Session $session)
    {
        $this->session = $session;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFname(): ?string
    {
        return $this->fname;
    }

    /**
     * @param string|null $fname
     * @return UserInterface
     */
    public function setFname(?string $fname)
    {
        $this->fname = $fname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLname(): ?string
    {
        return $this->lname;
    }

    /**
     * @param string|null $lname
     * @return UserInterface
     */
    public function setLname(?string $lname)
    {
        $this->lname = $lname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return UserInterface
     */
    public function setEmail(?string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    /**
     * @param string|null $jobTitle
     * @return UserInterface
     */
    public function setJobTitle(?string $jobTitle)
    {
        $this->jobTitle = $jobTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @param string|null $birthday
     * @return UserInterface
     */
    public function setBirthday(?string $birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return Company|null
     */
    public function getCompany(): ?Company
    {
        return $this->company;
    }

    /**
     * @param Company|null $company
     * @return UserInterface
     */
    public function setCompany(?Company $company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return UserInterface
     */
    public function setPassword(?string $password)
    {
        $this->password = $password;
        return $this;
    }
}