<?php

namespace App\Controller;
use App\Entity\Donneur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DonneurController extends AbstractController
{
   

    /**
     * @Route("/Show", name="donneurShow")
     */
    public function showDonneur(){
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();
        $donneurs=$em->getRepository(Donneur::class)->findAll();
        $serialise=$serializer->serialize($donneurs,'json',['groups'=>'group2']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

    /**
     * @Route("/getDonneur/{id}", name="getDonneur")
     */
    public function getDonneur($id){
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();
       $donneur=$em->getRepository(Donneur::class)->find($id);
        $serialise=$serializer->serialize($donneur,'json',['groups'=>'group2']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

     /**
     * @Route("/deleteD/{id}", name="d")
     */
    public function deleteD($id){

        $em = $this->getDoctrine()->getManager();
        $d = $em->getRepository(Donneur::class)->find($id);
        if ($d){
            $em->remove($d);
            $em->flush();
            return new JsonResponse(['message'=>"supprimé"], 200);
        }
        return new JsonResponse(['message'=>"non untrouvable"], 404);
    
    }
}
