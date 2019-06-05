<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Donneur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends AbstractController
{
       /**
     * @Route("/register", name="api_register", methods={"POST"})
     */
     public function register(UserPasswordEncoderInterface $passwordEncoder, Request $request)
     {
          $serializer = $this->get('serializer');
          $em = $this->getDoctrine()->getManager();
          $body=$request->getContent();
          $data=json_decode($body);
         
          //$u=$em->getRepository(User::class)->findAll();
          
         $user = $em->getRepository(User::class)->findOneBy(["email"=>$data->user->email]);
          $errors = [];
          if(!$user){
               $user=new User();
               $donneur=new Donneur();
               $serializer->deserialize($body,Donneur::class,'json',['object_to_populate'=> $donneur,'groups'=>['donneurUpdate']]);
               $serializer->deserialize(json_encode($data->user),User::class,'json',['object_to_populate'=> $user,'groups'=>['groupUpdate']]);
               $encodedPassword = $passwordEncoder->encodePassword($user,$data->user->password);
               if(strlen($encodedPassword) < 6)
               {
                   $errors[] = "Password should be at least 6 characters.";
               }
               if(!$errors)
               {
                    try{
                         $user->setPassword($encodedPassword);
                         $user->setIsActive(true);
                         $user->setRoles(['ROLE_USER']);
                         $em->persist($user);
                         $donneur->setUser($user);
                         $em->persist($donneur);
                         $em->flush();
                         return $this->json([
                          'user' => $user
                         ]);
                    }catch(UniqueConstraintViolationException $e){
                         $errors[] = "The email provided already has an account!";
                    }
                    /*catch(\Exception $e)
                    {
                         $errors[] = "Unable to save new user at this time.";
                    }*/
                    
               }
               
          }
           return $this->json([
           'errors' => $errors
          ], 400);
     }

     
     /**
      * @Route("/login", name="api_login", methods={"POST"})
      */
      public function login(Request $request,UserPasswordEncoderInterface $encoder)
      {
           $serializer = $this->get('serializer');
           $em = $this->getDoctrine()->getManager();
           $body=$request->getContent();
           $data=json_decode($body);
           if(isset($data->email) && isset($data->password)){
                $user= $user = $em->getRepository(User::class)->findOneBy(["email"=>$data->email]);
                //$encoded = $encoder->encodePassword($user, $user->getPassword());
                if(!$user){
                     return new Response(
                         'email doesnt exists',
                         Response::HTTP_UNAUTHORIZED,
                         array('Content-type' => 'application/json')
                     );
               }
                $salt = $user->getSalt();
                if(!$encoder->isPasswordValid($user, $data->password, $salt)) {
                    return new Response(
                        'email or Password not valid.',
                        Response::HTTP_UNAUTHORIZED,
                        array('Content-type' => 'application/json')
                    );
                } 
                $token = md5(uniqid("",true));
                $user->setApiToken($token);
                $em->persist($user);
                $em->flush();
                $serialise=$serializer->serialize($user,'json',['groups'=>'read']);
               return new Response($serialise,200,['Content-Type'=>'application/json']);
 
           }
           
      }

      /**
     * @Route("/getUser", name="user")
     */
    public function showUser(){
     $serializer = $this->get('serializer');
     $em = $this->getDoctrine()->getManager();
     $user=$em->getRepository(User::class)->findAll();
     $serialise=$serializer->serialize($user,'json',['groups'=>'read']);
     return new Response($serialise,200,['Content-Type'=>'application/json']);
 }

}
