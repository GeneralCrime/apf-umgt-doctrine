<?php

namespace GeneralCrime\Apf\Umgt\Doctrine\Entity;

use GeneralCrime\Apf\Umgt\Doctrine\Traits\ApfTimestamps;
use GeneralCrime\Apf\Umgt\Doctrine\Repository\AppProxyTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppProxyTypeRepository::class)
 * @ORM\Table(name="ent_appproxy")
 */
class AppProxy
{
    use ApfTimestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="AppProxyID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, name="AppObjectName")
     */
    private $appObjectId;

    /**
     * @ORM\Column(type="boolean", name="ReadPermission")
     */
    private $readPermission;

    /**
     * @ORM\Column(type="boolean", name="WritePermission")
     */
    private $writePermission;

    /**
     * @ORM\Column(type="boolean", name="LinkPermission")
     */
    private $linkPermission;

    /**
     * @ORM\Column(type="boolean", name="DeletePermission")
     */
    private $deletePermission;

    /**
     * @ORM\ManyToMany(targetEntity="AppProxyType", inversedBy="appProxies")
     * @ORM\JoinTable(name="ass_appproxy2appproxytype",
     *      joinColumns={@ORM\JoinColumn(name="Source_AppProxyID", referencedColumnName="AppProxyID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_AppProxyTypeID", referencedColumnName="AppProxyTypeID")}
     *     )
     */
    private $appProxyTypes;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="appProxies")
     * @ORM\JoinTable(name="ass_appproxy2user",
     *      joinColumns={@ORM\JoinColumn(name="Source_AppProxyID", referencedColumnName="AppProxyID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_UserID", referencedColumnName="UserID")}
     *     )
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=Application::class, mappedBy="appProxies")
     */
    private $applications;

    public function __construct()
    {
        $this->appProxyTypes = new ArrayCollection();
        $this->users         = new ArrayCollection();
        $this->applications  = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppObjectId(): ?int
    {
        return $this->appObjectId;
    }

    public function setAppObjectId(int $appObjectId): self
    {
        $this->appObjectId = $appObjectId;

        return $this;
    }

    public function isReadPermission(): ?bool
    {
        return $this->readPermission;
    }

    public function setReadPermission(bool $readPermission): self
    {
        $this->readPermission = $readPermission;

        return $this;
    }

    public function isWritePermission(): ?bool
    {
        return $this->writePermission;
    }

    public function setWritePermission(bool $writePermission): self
    {
        $this->writePermission = $writePermission;

        return $this;
    }

    public function isLinkPermission(): ?bool
    {
        return $this->linkPermission;
    }

    public function setLinkPermission(bool $linkPermission): self
    {
        $this->linkPermission = $linkPermission;

        return $this;
    }

    public function isDeletePermission(): ?bool
    {
        return $this->deletePermission;
    }

    public function setDeletePermission(bool $deletePermission): self
    {
        $this->deletePermission = $deletePermission;

        return $this;
    }

    /**
     * @return Collection<int, AppProxyType>
     */
    public function getAppProxyTypes(): Collection
    {
        return $this->appProxyTypes;
    }

    public function addAppProxyType(AppProxyType $appProxyType): self
    {
        if (!$this->appProxyTypes->contains($appProxyType)) {
            $this->appProxyTypes[] = $appProxyType;
        }

        return $this;
    }

    public function removeAppProxyType(AppProxyType $appProxyType): self
    {
        $this->appProxyTypes->removeElement($appProxyType);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

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
            $application->addAppProxy($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            $application->removeAppProxy($this);
        }

        return $this;
    }
}
