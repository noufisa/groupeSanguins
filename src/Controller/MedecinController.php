<?php

namespace App\Controller;
use App\Entity\Medecin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

 /**
     * @Route("/medecin")
     */
class MedecinController extends AbstractController
{

     /**
     * @Route("/addM", name="Medecin_add", methods={"POST"})
     */
    public function addMedecin(Request $request){
        
        $serializer = $this->get('serializer');
        $medecin = $serializer->deserialize($request->getContent(),Medecin::class,'json',['groups'=>'group1']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($medecin);
        $em->flush();
        $serialise=$serializer->serialize($medecin,'json',['groups'=>'goup1']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }
    
    /**
     * @Route("/post/{id}", name="medecin_delete", methods={"DELETE"})
     */
    public function deleteMedecin(Medecin $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
