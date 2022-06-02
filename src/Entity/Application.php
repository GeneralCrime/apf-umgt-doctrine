<?php

namespace GeneralCrime\Apf\Umgt\Doctrine\Entity;

use GeneralCrime\Apf\Umgt\Doctrine\Traits\ApfTimestamps;
use GeneralCrime\Apf\Umgt\Doctrine\Repository\ApplicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApplicationRepository::class)
 * @ORM\Table(name="ent_application")
 */
class Application
{
    use ApfTimestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="ApplicationID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, name="DisplayName")
     */
    private $displayName;

    /**
     * @ORM\ManyToMany(targetEntity=AppProxy::class, inversedBy="applications")
     * @ORM\JoinTable(name="cmp_application2appproxy",
     *      joinColumns={@ORM\JoinColumn(name="Sorce_ApplicationID", referencedColumnName="ApplicationID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_AppProxyID", referencedColumnName="AppProxyID")}
     *     )
     */
    private $appProxies;

    /**
     * @ORM\ManyToMany(targetEntity=AppProxyType::class, inversedBy="applications")
     * @ORM\JoinTable(name="cmp_application2appproxytype",
     *      joinColumns={@ORM\JoinColumn(name="Sorce_ApplicationID", referencedColumnName="ApplicationID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_AppProxyTypeID", referencedColumnName="AppProxyTypeID")}
     *     )
     */
    private $appProxyTypes;

    /**
     * @ORM\ManyToMany(targetEntity=Group::class, inversedBy="applications")
     * @ORM\JoinTable(name="cmp_application2appproxy",
     *      joinColumns={@ORM\JoinColumn(name="Sorce_ApplicationID", referencedColumnName="ApplicationID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_GroupID", referencedColumnName="GroupID")}
     *     )
     */
    private $groups;

    /**
     * @ORM\ManyToMany(targetEntity=Permission::class, inversedBy="applications")
     * @ORM\JoinTable(name="cmp_application2appproxy",
     *      joinColumns={@ORM\JoinColumn(name="Sorce_ApplicationID", referencedColumnName="ApplicationID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_PermissionID", referencedColumnName="PermissionID")}
     *     )
     */
    private $permissions;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, inversedBy="applications")
     * @ORM\JoinTable(name="cmp_application2appproxy",
     *      joinColumns={@ORM\JoinColumn(name="Sorce_ApplicationID", referencedColumnName="ApplicationID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_RoleID", referencedColumnName="RoleID")}
     *     )
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="applications")
     * @ORM\JoinTable(name="cmp_application2appproxy",
     *      joinColumns={@ORM\JoinColumn(name="Sorce_ApplicationID", referencedColumnName="ApplicationID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="Target_UserID", referencedColumnName="UserID")}
     *     )
     */
    private $user;

    public function __construct()
    {
        $this->appProxies    = new ArrayCollection();
        $this->appProxyTypes = new ArrayCollection();
        $this->groups        = new ArrayCollection();
        $this->permissions   = new ArrayCollection();
        $this->roles         = new ArrayCollection();
        $this->user          = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeAppProxy(AppProxy $appProxy): self
    {
        $this->appProxies->removeElement($appProxy);

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
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        $this->roles->removeElement($role);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }
}
