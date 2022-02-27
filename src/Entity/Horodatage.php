<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait Horodatage
{
    #[ORM\Column(type: 'datetime_immutable')]
    private $dateEdition;


    #[ORM\PrePersist]
    public function setDateEdition():void
    {
        $this->dateEdition = new \DateTimeImmutable();
    }

    public function getDateEdition(): ?\DateTimeImmutable
    {
        return $this->dateEdition;
    }

}