<?php

namespace GeneralCrime\Apf\Umgt\Doctrine\Entity;

use GeneralCrime\Apf\Umgt\Doctrine\Traits\ApfTimestamps;
use GeneralCrime\Apf\Umgt\Doctrine\Repository\UserRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="ent_user")
 */
class User implements UserInterface
{
    use ApfTimestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="UserID")
     */
    private $UserID;

    /**
     * @ORM\Column(type="string", length=100, unique=true, name="EMail")
     */
    private $email;


    private $roles = [];

    /**
     * @ORM\Column(type="string", length=100, name="DisplayName")
     */
    private $DisplayName;

    /**
     * @ORM\Column(type="string", length=100, name="FirstName")
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=100, name="LastName")
     */
    private $LastName;

    /**
     * @ORM\Column(type="string", length=100, name="StreetName")
     */
    private $StreetName;

    /**
     * @ORM\Column(type="string", length=100, name="StreetNumber")
     */
    private $StreetNumber;

    /**
     * @ORM\Column(type="string", length=100, name="ZIPCode")
     */
    private $ZIPCode;

    /**
     * @ORM\Column(type="string", length=100, name="Phone")
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=100, name="Mobile")
     */
    private $Mobile;

    /**
     * @ORM\Column(type="string", length=100, name="Username")
     */
    private $Username;

    /**
     * @ORM\Column(type="string", length=100, name="Password")
     */
    private $Password;

    /**
     * @ORM\Column(type="string", length=50, name="DynamicSalt")
     */
    private $DynamicSalt;

    /**
     * @ORM\Column(type="string", length=50, name="LoveCharakter")
     */
    private $LoveCharakter;

    /**
     * @ORM\Column(type="date", name="Birthday")
     */
    private $Birthday;

    /**
     * @ORM\Column(type="text", name="Quote")
     */
    private $Quote;

    /**
     * @ORM\Column(type="datetime", name="LastLogin")
     */
    private $LastLogin;

    /**
     * @ORM\Column(type="string", length=6, name="Gender")
     */
    private $Gender;

    /**
     * @ORM\ManyToMany(targetEntity="Role", mappedBy="users")
     */
    private $roles2;

    /**
     * @ORM\ManyToMany(targetEntity=AppProxy::class, mappedBy="users")
     */
    private $appProxies;

    /**
     * @ORM\ManyToMany(targetEntity=Group::class, mappedBy="users")
     */
    private $groups;

    /**
     * @ORM\ManyToMany(targetEntity=AuthToken::class, inversedBy="users")
     * @ORM\JoinTable(name="ass_user2authtoken",
     *      joinColumns={@ORM\JoinColumn(name="Source_UserID", referencedColumnName="UserID")}
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_AuthTokenID", referencedColumnName="AuthTokenID")},
     *     )
     */
    private $authtokens;

    /**
     * @ORM\ManyToMany(targetEntity=Application::class, mappedBy="user")
     */
    private $applications;

    public function __construct()
    {
        $this->roles2       = new ArrayCollection();
        $this->appProxies   = new ArrayCollection();
        $this->groups       = new ArrayCollection();
        $this->authtokens   = new ArrayCollection();
        $this->applications = new ArrayCollection();
    }

    public function getUserID(): ?int
    {
        return $this->UserID;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->DisplayName;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        $roles[] = 'ROLE_ADMIN';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * This method can be removed in Symfony 6.0 - is not needed for apps that do not check user passwords.
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return null;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    /**
     * This method can be removed in Symfony 6.0 - is not needed for apps that do not check user passwords.
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDisplayName(): ?string
    {
        return $this->DisplayName;
    }

    public function setDisplayName(string $DisplayName): self
    {
        $this->DisplayName = $DisplayName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getStreetName(): ?string
    {
        return $this->StreetName;
    }

    public function setStreetName(string $StreetName): self
    {
        $this->StreetName = $StreetName;

        return $this;
    }

    public function getStreetNumber(): ?string
    {
        return $this->StreetNumber;
    }

    public function setStreetNumber(string $StreetNumber): self
    {
        $this->StreetNumber = $StreetNumber;

        return $this;
    }

    public function getZIPCode(): ?string
    {
        return $this->ZIPCode;
    }

    public function setZIPCode(string $ZIPCode): self
    {
        $this->ZIPCode = $ZIPCode;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->Mobile;
    }

    public function setMobile(string $Mobile): self
    {
        $this->Mobile = $Mobile;

        return $this;
    }

    public function getDynamicSalt(): ?string
    {
        return $this->DynamicSalt;
    }

    public function setDynamicSalt(string $DynamicSalt): self
    {
        $this->DynamicSalt = $DynamicSalt;

        return $this;
    }

    public function getLoveCharakter(): ?string
    {
        return $this->LoveCharakter;
    }

    public function setLoveCharakter(string $LoveCharakter): self
    {
        $this->LoveCharakter = $LoveCharakter;

        return $this;
    }

    public function getBirthday(): ?DateTimeInterface
    {
        return $this->Birthday;
    }

    public function setBirthday(DateTimeInterface $Birthday): self
    {
        $this->Birthday = $Birthday;

        return $this;
    }

    public function getQuote(): ?string
    {
        return $this->Quote;
    }

    public function setQuote(string $Quote): self
    {
        $this->Quote = $Quote;

        return $this;
    }

    public function getLastLogin(): ?DateTimeInterface
    {
        return $this->LastLogin;
    }

    public function setLastLogin(DateTimeInterface $LastLogin): self
    {
        $this->LastLogin = $LastLogin;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoles2(): Collection
    {
        return $this->roles2;
    }

    public function addRoles2(Role $roles2): self
    {
        if (!$this->roles2->contains($roles2)) {
            $this->roles2[] = $roles2;
            $roles2->addUser($this);
        }

        return $this;
    }

    public function removeRoles2(Role $roles2): self
    {
        if ($this->roles2->removeElement($roles2)) {
            $roles2->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, AppProxy>
     */
    public function getAppProxies(): Collection
    {
        return $this->appProxies;
    }

    public function addAppProxy(AppProxy $appProxy): self
    {
        if (!$this->appProxies->contains($appProxy)) {
            $this->appProxies[] = $appProxy;
            $appProxy->addUser($this);
        }

        return $this;
    }

    public function removeAppProxy(AppProxy $appProxy): self
    {
        if ($this->appProxies->removeElement($appProxy)) {
            $appProxy->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
            $group->addUser($this);
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        if ($this->groups->removeElement($group)) {
            $group->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, AuthToken>
     */
    public function getAuthtokens(): Collection
    {
        return $this->authtokens;
    }

    public function addAuthtoken(AuthToken $authtoken): self
    {
        if (!$this->authtokens->contains($authtoken)) {
            $this->authtokens[] = $authtoken;
        }

        return $this;
    }

    public function removeAuthtoken(AuthToken $authtoken): self
    {
        $this->authtokens->removeElement($authtoken);

        return $this;
    }

    /**
     * @return Collection<int, Application>
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->addUser($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            $application->removeUser($this);
        }

        return $this;
    }
}
