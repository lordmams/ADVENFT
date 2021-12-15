<?php
namespace App\Controller\Supporting;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;


trait ControllerTrait
{
    
       public function __construct(
      
        private EntityManagerInterface $em,
    ) { }

    public function convertTime(string $date): DateTimeInterface{
        $newDate = DateTime::createFromFormat('Y-m-d H:i:s',$date);
        return $newDate;
    }

    public function addAndSave($entity){   
         $this->em->persist($entity);
         $this->em->flush();
    }

    public function deleteAndSave($entity){ 
       
          $this->em->remove($entity);
          $this->em->flush();
    }
}