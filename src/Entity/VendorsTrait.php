<?php

declare(strict_types=1);

namespace Odiseo\SyliusVendorPlugin\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait VendorsTrait
{
    #[ORM\ManyToMany(targetEntity: VendorInterface::class)]
    #[ORM\JoinTable(name: 'odiseo_vendor_channels' ]
    #[ORM\JoinColumn(name: 'channel_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'vendor_id', referencedColumnName: 'id')]
    protected Collection $vendors;

    public function __construct()
    {
        $this->vendors = new ArrayCollection();
    }

    public function getVendors(): Collection
    {
        return $this->vendors;
    }

    public function hasVendor(VendorInterface $vendor): bool
    {
        return $this->vendors->contains($vendor);
    }

    public function addVendor(VendorInterface $vendor): void
    {
        if (!$this->hasVendor($vendor)) {
            $this->vendors->add($vendor);
        }
    }

    public function removeVendor(VendorInterface $vendor): void
    {
        if ($this->hasVendor($vendor)) {
            $this->vendors->removeElement($vendor);
        }
    }
}
