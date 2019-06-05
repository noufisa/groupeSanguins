<?php

namespace App\Controller;
use App\Entity\Visite;
use App\Entity\Medecin;
use App\Entity\Donneur;
use App\Entity\Reponse;
use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
     * @Route("/visite")
     */
class VisiteController extends AbstractController
{
    
     /**
     * @Route("/Show", name="VisiteShow")
     */
    public function showVisite(){
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();
       $visites=$em->getRepository(Visite::class)->findAll();
       //$visites=[];
        $serialise=$serializer->serialize($visites,'json',['groups'=>'groupVisite']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

     /**
     * @Route("/deleteV/{id}", name="visite_delete", methods={"DELETE"})
     */
    public function deleteVisite(Visite $visite)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($visite);
        $em->flush();
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
      /**
     * @Route("/addV", name="add", methods={"POST"})
     */
    public function addVisite(){
        $serializer = $this->get('serializer');
        
       
        $em = $this->getDoctrine()->getManager();
        if ($data->id == 0){
            $visite=new Visite();
            $serializer->deserialize($request->getContent(),Visite::class,'json',['groups'=>'visiteUpdate']);
        }else{
            $visite = $em->getRepository(Visite::class)->find($data->id);
        }
        if(isset($data->donneur)){
            $donneur = $em->getRepository(Donneur::class)->find($data->donneur->id);
            if($donneur){
                $visite->setDonneur($donneur);
            }
        }
        if(isset($data->medecin)){
            $medecin = $em->getRepository(Medecin::class)->find($data->medecin->id);
            if($medecin){
                $visite->setMedecin($medecin);
            }
        }
        if (isset($data->questions)){
            foreach ($data->questions as $item) {
                if ($item->id == 0) {
                    $q = new Question();
                } else {
                    $q = $em->getRepository(Question::class)->find($item->id);
                }
    
                $ser->deserialize(json_encode($item), Question::class, 'json', ["object_to_populate" => $q, "groups" => ["addQ"]]);
    
                if (isset($item->reponse)) {
                    $reponse = $em->getRepository(Reponse::class)->find($item->reponse->id);
                    if ($reponse) {
                        $q->setReponse($reponse);
                    }
                }
                $q->setVisite($visite);
                $em->persist($q);
            }
            $em->persist($visite);
            $em->flush();
        }
        $var = $ser->serialize($mv, 'json' ,["groups" => ["groupVisite"]]);
        return new Response($var , 200, array("Content-Type"=>"application/json"));
    }
    

}
