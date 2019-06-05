<?php

namespace App\Controller;
use App\Entity\Prelevement;
use App\Entity\Donneur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

    
class PrelevementController extends AbstractController
{

     /**
     * @Route("/addP", name="pre_add", methods={"POST"})
     */
    public function addPre(Request $request){
        $serializer = $this->get('serializer');
        $pre = new Prelevement();
        $em = $this->getDoctrine()->getManager();
        $body=$request->getContent();
        $data=json_decode($body);
        //var_dump($data->date);
        $serializer->deserialize($body,Prelevement::class,'json',['object_to_populate'=> $pre,'groups'=>['preUpdate']]);
        if(isset($data->donneur)){
            $donneur=$em->getRepository(Donneur::class)->find($data->donneur->id);
            $pre->setDonneur($donneur);
        }
        $em->persist($pre);
        $em->flush();
        $serialise=$serializer->serialize($pre,'json',['groups'=>'groupPre']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

     /**
     * @Route("/getPre/{id}", name="getPre")
     */
    public function getPrelevementOfDonneur($id){
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();
       $prelevement=$em->getRepository(Prelevement::class)->find($id);
       $serialise=$serializer->serialize($prelevement,'json',['groups'=>'groupPre']);
       return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

     /**
     * @Route("/getAllPre", name="allP")
     */
    public function getAllPre(){
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();
       $pre=$em->getRepository(Prelevement::class)->findAll();
       //$visites=[];
        $serialise=$serializer->serialize($pre,'json',['groups'=>'groupPre']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

     /**
     * @Route("/deleteP/{id}", name="p")
     */
    public function deleteP($id){

        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository(Prelevement::class)->find($id);
        if ($p){
            $em->remove($p);
            $em->flush();
            return new JsonResponse(['message'=>"supprimé"], 200);
        }
        return new JsonResponse(['message'=>"non untrouvable"], 404);
    
    }
}
