<?php

namespace App\Controller;
use App\Entity\Technicien;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


    /**
     * @Route("/technicien", name="technicien")
     */
class TechnicienController extends AbstractController
{

     /**
     * @Route("/addTech", name="tech_add", methods={"POST"})
     */
    public function addTech(Request $request){
        $serializer = $this->get('serializer');
        $tech = new Technicien();
        $em = $this->getDoctrine()->getManager();
        $body=$request->getContent();
        $data=json_decode($body);
        $serializer->deserialize($body,Technicien::class,'json',['object_to_populate'=> $tech,'groups'=>['techUpdate']]);
        $em->persist($tech);
        $em->flush();
        $serialise=$serializer->serialize($tech,'json',['groups'=>'tech']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

}
