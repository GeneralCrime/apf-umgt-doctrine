<?php

namespace GeneralCrime\Apf\Umgt\Doctrine\Entity;

use GeneralCrime\Apf\Umgt\Doctrine\Traits\ApfTimestamps;
use GeneralCrime\Apf\Umgt\Doctrine\Repository\AuthTokenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuthTokenRepository::class)
 * @ORM\Table(name="ent_authtoken")
 */
class AuthToken
{
    use ApfTimestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="AuthTokenID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, name="Token")
     */
    private $token;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="authtokens")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

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
            $user->addAuthtoken($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeAuthtoken($this);
        }

        return $this;
    }
}
