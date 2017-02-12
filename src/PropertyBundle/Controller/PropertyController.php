<?php

namespace PropertyBundle\Controller;

use PropertyBundle\Entity\Property;
use PropertyBundle\Entity\property_picture;
use PropertyBundle\Form\PictureForm;
use PropertyBundle\Form\PropertyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends Controller
{
    public function addAction(Request $request)
    {
        $property = new Property();
        $form = $this->CreateForm(PropertyType::class,$property);
        $form->handleRequest($request);
        $pic_array = array();
        if($form->isValid() ){
            $user = $this->getUser();
            $em=$this->getDoctrine()->getManager();
            $files = $form->get('imagesPath')->getData();
            foreach ($files as $fl) {
                $name = $fl->getClientOriginalName();
                $dir = __DIR__.'/../../../web/images/uploads';
                $fl->move($dir, $name) ;
                array_push($pic_array, "../../../web/images/uploads/".$name);
            }
            $property->setHost($user);
            $property->setImagesPath($pic_array);
            $em->persist($property);
            $em->flush();
            return $this->redirectToRoute('property_mylistpage');
        }
        return $this->render('PropertyBundle:Property:add.html.twig', array('form'=>$form->createView(),'user'=>$this->getUser()));
    }

    public function updateAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $logement = $em->getRepository("PropertyBundle:Property")->find($id);
        $pic_array = $logement->getImagesPath();
        $form = $this->CreateForm(PropertyType::class,$logement);
        $form->handleRequest($request);
        if($form->isValid() ){
            $em=$this->getDoctrine()->getManager();
            $files = $form->get('imagesPath')->getData();
            foreach ($files as $fl) {
                $name = $fl->getClientOriginalName();
                $dir = __DIR__.'/../../../web/images/uploads';
                $fl->move($dir, $name) ;
                array_push($pic_array, "../../../web/images/uploads/".$name);
            }
            $logement->setImagesPath($pic_array);
            $em->persist($logement);
            $em->flush();
            return $this->redirectToRoute('property_mylistpage');
        }
        return $this->render('PropertyBundle:Property:add.html.twig', array('form'=>$form->createView()));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $logement = $em->getRepository("PropertyBundle:Property")->find($id);
        $em->remove($logement);
        $em->flush();
        return $this->redirectToRoute('property_mylistpage');
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $logement = $em->getRepository("PropertyBundle:Property")->findBy(array('host'=> $this->getUser()));
       // var_dump(unserialize($logement));
        return $this->render("PropertyBundle:Property:list.html.twig",array('logements'=>$logement,'user'=>$this->getUser()));
    }

    public function getPropertyAction($id) {
        $em = $this->getDoctrine()->getManager();
        $logement = $em->getRepository("PropertyBundle:Property")->find($id);
        return $this->render("PropertyBundle:Property:detail.html.twig",array('logement'=>$logement,'user'=>$this->getUser()));
    }

    public function reportAction($id){
        $em = $this->getDoctrine()->getManager();
        $logement = $em->getRepository("PropertyBundle:Property")->find($id);
        $logement->setReported(true);
        $em->persist($logement);
        $em->flush();
        return $this->redirectToRoute('property_detailProp',array('id'=>$id));
    }

    public function allRoomAction(){
        $em = $this->getDoctrine()->getManager();
        $logement = $em->getRepository("PropertyBundle:Property")->findAll();
        return $this->render("PropertyBundle:Property:allroom.html.twig",array('logement'=>$logement,'user'=>$this->getUser()));
    }

}
