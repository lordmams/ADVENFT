<?php
namespace App\Controller\Supporting;

use DateTime;
use DateTimeInterface;


trait ControllerTrait
{

    public function convertTime(string $date): DateTimeInterface{
        $newDate = DateTime::createFromFormat('Y-m-d H:i:s',$date);
        return $newDate;
    }

    public function addAndSave($entity){   
        $em = $this->getDoctrine()->getManager(); 
        $em->persist($entity);
        $em->flush();
    }

    public function deleteAndSave($entity){ 
        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();
    }
}