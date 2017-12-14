<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentLocationRepository")
 */
class StudentLocation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $longitude;

    public function getId()
    {
        return $this->id;
    }

    public function getPostCode()
    {
        return $this->postcode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setPostCode($postcode)
    {
        $this->postcode = $postcode;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }
}
