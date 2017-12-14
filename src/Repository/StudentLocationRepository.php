<?php

namespace App\Repository;

use App\Entity\StudentLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class StudentLocationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StudentLocation::class);
    }

    public function createXMLMarkers()
    {
        $markers = $this->createQueryBuilder('m')
        ->select('m.latitude, m.longitude')
        ->getQuery()
        ->getResult();

        $dom = new \DOMDocument();
        $xml = 'xml/marker.xml';
        $dom->load($xml);

        $node = $dom->documentElement;
        $markers = $dom->getElementsByTagName('marker');

        $count = $node->childNodes->length;

        if($count > 0){
          for($i = 0; $i < $count; $i++){
            $node->removeChild($node->childNodes->item(0));
          }
        }

        $parnode = $dom->appendChild($node);

        foreach ($markers as $element) {
          $node = $dom->createElement('marker');
          $newnode = $parnode->appendChild($node);
          $newnode->setAttribute('lat', $element['latitude']);
          $newnode->setAttribute('lng', $element['longitude']);
        }
        $dom->save($xml);
    }

    public function geocoder($adress)
    {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false&key=AIzaSyA9-WuX91A9deldsoOBLcdZ4m9yXWM65Rg";

        $urlAdress = urlencode(utf8_encode($adress));
        $query = sprintf($url, $urlAdress);
        $resp_json = file_get_contents($query);
        $resp = json_decode($resp_json, true);

        if ($resp['status'] == 'OK') {
            $latitude = $resp['results'][0]['geometry']['location']['lat'];
            $longitude = $resp['results'][0]['geometry']['location']['lng'];

            if ($latitude && $longitude) {
                $add = array();
                array_push(
                    $add,
                    $latitude,
                    $longitude
                );
                return $add;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


}
