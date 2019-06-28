<?php
namespace CRM_SDK\SharedObjects\User;

use CRM_SDK\SharedObjects\Company\Company;

interface UserInterface
{
    /**
     * @return string|null
     */
    public function getFname(): ?string;

    /**
     * @param string|null $fname
     */
    public function setFname(?string $fname);

    /**
     * @return string|null
     */
    public function getLname(): ?string;

    /**
     * @param string|null $lname
     */
    public function setLname(?string $lname);

    /**
     * @return string|null
     */
    public function getEmail(): ?string;

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email);

    /**
     * @return string|null
     */
    public function getJobTitle(): ?string;

    /**
     * @param string|null $jobTitle
     */
    public function setJobTitle(?string $jobTitle);

    /**
     * @return string|null
     */
    public function getBirthday(): ?string;

    /**
     * @param string|null $birthday
     */
    public function setBirthday(?string $birthday);

    /**
     * @return Company|null
     */
    public function getCompany(): ?Company;

    /**
     * @param Company|null $company
     */
    public function setCompany(?Company $company);

    /**
     * @return string|null
     */
    public function getPassword(): ?string;

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password);
}