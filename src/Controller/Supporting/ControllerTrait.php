<?php
namespace App\Controller\Supporting;

use DateTime;
use DateTimeInterface;
use Doctrine\Persistence\ManagerRegistry;


trait ControllerTrait
{

    public function convertTime(ManagerRegistry $doctrine, string $date): DateTimeInterface{
        $newDate = DateTime::createFromFormat('Y-m-d H:i:s',$date);
        return $newDate;
    }

    public function addAndSave(ManagerRegistry $doctrine, $entity){
        $em = $doctrine->getManager();
        $em->persist($entity);
        $em->flush();
    }

    public function deleteAndSave(ManagerRegistry $doctrine, $entity){
        $em = $doctrine->getManager();
        $em->remove($entity);
        $em->flush();
    }
}