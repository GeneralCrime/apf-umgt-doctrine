<?php

namespace GeneralCrime\Apf\Umgt\Doctrine\Entity;

use GeneralCrime\Apf\Umgt\Doctrine\Traits\ApfTimestamps;
use GeneralCrime\Apf\Umgt\Doctrine\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoleRepository::class)
 * @ORM\Table(name="ent_role")
 */
class Role
{
    use ApfTimestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="RoleID")
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
     * @ORM\ManyToMany(targetEntity="User", inversedBy="roles2")
     * @ORM\JoinTable(name="ass_role2user",
     *      joinColumns={@ORM\JoinColumn(name="Source_RoleID", referencedColumnName="RoleID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_UserID", referencedColumnName="UserID")}
     *     )
     */
    private $users;


    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="roles")
     * @ORM\JoinTable(name="ass_role2group",
     *      joinColumns={@ORM\JoinColumn(name="Source_RoleID", referencedColumnName="RoleID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_GroupID", referencedColumnName="GroupID")}
     *     )
     */
    private $groups;

    /**
     * @ORM\ManyToMany(targetEntity=Permission::class, inversedBy="roles")
     * @ORM\JoinTable(name="ass_role2permission",
     *      joinColumns={@ORM\JoinColumn(name="Source_RoleID", referencedColumnName="RoleID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_PermissionID", referencedColumnName="PermissionID")}
     *     )
     */
    private $permissions;

    /**
     * @ORM\ManyToMany(targetEntity=Application::class, mappedBy="roles")
     */
    private $applications;

    public function __construct()
    {
        $this->users        = new ArrayCollection();
        $this->groups       = new ArrayCollection();
        $this->permissions  = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        $this->groups->removeElement($group);

        return $this;
    }

    /**
     * @return Collection<int, Permission>
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(Permission $permission): self
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions[] = $permission;
        }

        return $this;
    }

    public function removePermission(Permission $permission): self
    {
        $this->permissions->removeElement($permission);

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
            $application->addRole($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            $application->removeRole($this);
        }

        return $this;
    }
}
