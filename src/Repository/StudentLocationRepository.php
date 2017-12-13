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


}
