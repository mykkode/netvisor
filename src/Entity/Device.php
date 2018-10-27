<?php
/**
 * Created by PhpStorm.
 * User: trifu
 * Date: 28.10.2018
 * Time: 01:26
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Class Device
 * @ORM\Entity
 * @ORM\Table(name="devices")
 */
class Device
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
     * @var Location[]|ArrayCollection|PersistentCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Location", inversedBy="devices")
     * @ORM\JoinTable(name="devices_locations")
     */
    private $locations;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $qr_code;

    /**
     * Device constructor.
     */
    public function __construct()
    {
        $this->locations = new ArrayCollection();
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
     * @return Device
     */
    public function setName(string $name): Device
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param ArrayCollection $locations
     * @return Device
     */
    public function setLocations(ArrayCollection $locations): Device
    {
        $this->locations = $locations;
        return $this;
    }

    /**
     * @return string
     */
    public function getQrCode(): string
    {
        return $this->qr_code;
    }

    /**
     * @param string $qr_code
     * @return Device
     */
    public function setQrCode(string $qr_code): Device
    {
        $this->qr_code = $qr_code;
        return $this;
    }


}