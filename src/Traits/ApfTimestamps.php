<?php

namespace GeneralCrime\Apf\Umgt\Doctrine\Traits;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait ApfTimestamps
{
    /**
     * @ORM\Column(type="datetime", name="CreationTimestamp")
     */
    private $CreationTimestamp;

    /**
     * @ORM\Column(type="datetime", name="ModificationTimestamp")
     */
    private $ModificationTimestamp;

    /**
     * @return DateTimeInterface
     */
    public function getCreationTimestamp(): DateTimeInterface
    {
        return $this->CreationTimestamp;
    }

    /**
     * @return DateTimeInterface
     */
    public function getModificationTimestamp(): DateTimeInterface
    {
        return $this->ModificationTimestamp;
    }
}