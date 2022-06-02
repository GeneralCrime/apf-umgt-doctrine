<?php

namespace GeneralCrime\Apf\Umgt\Doctrine\Entity;

use GeneralCrime\Apf\Umgt\Doctrine\Traits\ApfTimestamps;
use GeneralCrime\Apf\Umgt\Doctrine\Repository\AppProxyTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppProxyTypeRepository::class)
 * @ORM\Table(name="ent_appproxytype")
 */
class AppProxyType
{
    use ApfTimestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="AppProxyTypeID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, name="AppObjectName")
     */
    private $appObjectName;

    /**
     * @ORM\ManyToMany(targetEntity=AppProxy::class, mappedBy="appProxyTypes")
     */
    private $appProxies;

    /**
     * @ORM\ManyToMany(targetEntity=Application::class, mappedBy="appProxyTypes")
     */
    private $applications;

    public function __construct()
    {
        $this->appProxies   = new ArrayCollection();
        $this->applications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAppObjectName(): ?string
    {
        return $this->appObjectName;
    }

    public function setAppObjectName(string $appObjectName): self
    {
        $this->appObjectName = $appObjectName;

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
            $appProxy->addAppProxyType($this);
        }

        return $this;
    }

    public function removeAppProxy(AppProxy $appProxy): self
    {
        if ($this->appProxies->removeElement($appProxy)) {
            $appProxy->removeAppProxyType($this);
        }

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
            $application->addAppProxyType($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            $application->removeAppProxyType($this);
        }

        return $this;
    }
}
