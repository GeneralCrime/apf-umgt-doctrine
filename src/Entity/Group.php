<?php

namespace GeneralCrime\Apf\Umgt\Doctrine\Entity;

use GeneralCrime\Apf\Umgt\Doctrine\Traits\ApfTimestamps;
use GeneralCrime\Apf\Umgt\Doctrine\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="ent_group")
 */
class Group
{
    use ApfTimestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="GroupID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, name="DisplayName")
     */
    private $displayName;

    /**
     * @ORM\Column(type="text", name="Description")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Role", mappedBy="groups")
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="groups")
     * @ORM\JoinTable(name="ass_group2user",
     *      joinColumns={@ORM\JoinColumn(name="Source_GroupID", referencedColumnName="GroupID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_UserID", referencedColumnName="UserID")}
     *     )
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=Application::class, mappedBy="groups")
     */
    private $applications;

    public function __construct()
    {
        $this->roles        = new ArrayCollection();
        $this->users        = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
            $role->addGroup($this);
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->removeElement($role)) {
            $role->removeGroup($this);
        }

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
            $application->addGroup($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            $application->removeGroup($this);
        }

        return $this;
    }
}
