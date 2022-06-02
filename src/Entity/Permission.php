<?php

namespace GeneralCrime\Apf\Umgt\Doctrine\Entity;

use GeneralCrime\Apf\Umgt\Doctrine\Traits\ApfTimestamps;
use GeneralCrime\Apf\Umgt\Doctrine\Repository\PermissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PermissionRepository::class)
 * @ORM\Table(name="ent_permission")
 */
class Permission
{
    use ApfTimestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="PermissionID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, name="DisplayName")
     */
    private $displayName;

    /**
     * @ORM\Column(type="string", length=100, name="Name")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, name="Value")
     */
    private $value;

    /**
     * @ORM\ManyToMany(targetEntity=role::class, mappedBy="permissions")
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity=Application::class, mappedBy="permissions")
     */
    private $applications;

    public function __construct()
    {
        $this->roles        = new ArrayCollection();
        $this->applications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Collection<int, role>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
            $role->addPermission($this);
        }

        return $this;
    }

    public function removeRole(role $role): self
    {
        if ($this->roles->removeElement($role)) {
            $role->removePermission($this);
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
            $application->addPermission($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            $application->removePermission($this);
        }

        return $this;
    }
}
