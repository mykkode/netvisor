<?php
/**
 * Created by PhpStorm.
 * User: trifu
 * Date: 28.10.2018
 * Time: 01:14
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Class Locations
 * @ORM\Entity
 * @ORM\Table(name="locations")
 */
class Location
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var Device[]|PersistentCollection|ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Device", mappedBy="locations")
     */
    private $devices;

    /**
     * Location constructor.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->devices = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Location
     */
    public function setName(string $name): Location
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getDevices()
    {
        return $this->devices;
    }

    /**
     * @param ArrayCollection $devices
     * @return Location
     */
    public function setDevices($devices): Location
    {
        $this->devices = $devices;
        return $this;
    }
}