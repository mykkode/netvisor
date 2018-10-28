<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Node.
 * @ORM\Entity
 * @ORM\Table(name="nodes")
 */
class Node
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Device
     * @ORM\ManyToOne(targetEntity="App\Entity\Device")
     * @ORM\JoinColumn(name="device_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $device;

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="App\Entity\Location")
     * @ORM\JoinColumn(name="location_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $location;

    /**
     * Node constructor.
     * @param Device $device
     * @param Location $location
     */
    public function __construct(Device $device, Location $location)
    {
        $this->device = $device;
        $this->location = $location;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Device
     */
    public function getDevice(): Device
    {
        return $this->device;
    }

    /**
     * @param Device $device
     *
     * @return Node
     */
    public function setDevice(Device $device): Node
    {
        $this->device = $device;

        return $this;
    }

    /**
     * @return Location
     */
    public function getLocation(): Location
    {
        return $this->location;
    }

    /**
     * @param Location $location
     *
     * @return Node
     */
    public function setLocation(Location $location): Node
    {
        $this->location = $location;

        return $this;
    }
}