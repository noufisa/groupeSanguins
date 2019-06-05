<?php

namespace App\Controller;
use App\Entity\Test;
use App\Entity\Technicien;
use App\Entity\Prelevement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
     * @Route("/test")
     */
class TestController extends AbstractController
{

     /**
     * @Route("/addT", name="test_add", methods={"POST"})
     */
    public function addTest(Request $request){
        $serializer = $this->get('serializer');
        $test = new Test();
        $em = $this->getDoctrine()->getManager();
        $body=$request->getContent();
        $data=json_decode($body);
        $serializer->deserialize($body,Test::class,'json',['object_to_populate'=> $test,'groups'=>['testUpdate']]); 
        if(isset($data->technicien)){
            $technicien = $em->getRepository(Technicien::class)->find($data->technicien->id);
            if($technicien){
                $test->setTechnicien($technicien);
            }
        }
        if(isset($data->prelevement)){
            $prelevement = $em->getRepository(Prelevement::class)->find($data->prelevement->id);
            if($technicien){
                $test->setPrelevement($prelevement);
            }
        }
        $em->persist($test);
        $em->flush();
        $serialise=$serializer->serialize($test,'json',['groups'=>'groupTest']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

     /**
     * @Route("/ShowTest", name="testShow")
     */
    public function showTest(){
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();
       $tests=$em->getRepository(Test::class)->findAll();
        $serialise=$serializer->serialize($tests,'json',['groups'=>'groupTest']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

    /**
     * @Route("/Show/{id}", name="get_show")
     */
    public function getTest($id){
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();
       $tests=$em->getRepository(Test::class)->find($id);
        $serialise=$serializer->serialize($tests,'json',['groups'=>'groupTest']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }
}
