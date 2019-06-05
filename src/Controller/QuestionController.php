<?php

namespace App\Controller;
use App\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionController extends AbstractController
{
      /**
     * @Route("/addQ", name="question", methods={"POST"})
     */
    public function addQuestion(Request $request){
        
        $serializer = $this->get('serializer');
        $question = $serializer->deserialize($request->getContent(),Question::class,'json',['groups'=>'addQ']);
        $em = $this->getDoctrine()->getManager();
        /*if(isset($data->reponse)){
            $reponse = $em->getRepository(Reponse::class)->find($data->reponse->id);
            if($donneur){
                $question->setRepnose($reponse);
            }
        }
        if(isset($data->visite)){
            $visite = $em->getRepository(Visite::class)->find($data->visite->id);
            if($visite){
                $question->setVisite($visite);
            }
        }        */
        $em->persist($question);
        $em->flush();
        $serialise=$serializer->serialize($question,'json',['groups'=>'afficheQ']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

     /**
     * @Route("/getQuestion/{id}", name="getQ")
     */
    public function getQuestion($id){
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();
       $question=$em->getRepository(Question::class)->find($id);
        $serialise=$serializer->serialize($question,'json',['groups'=>'afficheQ']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

     /**
     * @Route("/getAll", name="allQ")
     */
    public function showQ(){
        $serializer = $this->get('serializer');
        $em = $this->getDoctrine()->getManager();
       $question=$em->getRepository(Question::class)->findAll();
       //$visites=[];
        $serialise=$serializer->serialize($question,'json',['groups'=>'afficheQ']);
        return new Response($serialise,200,['Content-Type'=>'application/json']);
    }

     /**
     * @Route("/deleteQ/{id}", name="Q")
     */
    public function deleteQ($id){

        $em = $this->getDoctrine()->getManager();
        $q = $em->getRepository(Question::class)->find($id);
        if ($q){
            $em->remove($q);
            $em->flush();
            return new JsonResponse(['message'=>"supprimé"], 200);
        }
        return new JsonResponse(['message'=>"non untrouvable"], 404);
    
    }
}
