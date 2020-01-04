<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Articles;
use AppBundle\Entity\Users;
use AppBundle\Entity\Categories;
use AppBundle\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CategorieController extends Controller
{


    private function display_categories($message = '')
    {
      $categories = $this->getDoctrine()
          ->getRepository('AppBundle:Categories')
          ->findAll();

      $user_id = $this->get('session')->get('user_id');


      return $this->render('lcb/categorie.html.php', array('message' => $message, 'categories' => $categories, 'user_id' => $user_id));
    }



    /**
     * @Route("/categories", name="categories")
     */
    public function categoriesAction($message='')
    {

      return $this->display_categories();
    }


















    // 4
    /**
     * @Route("/create_categorie", name="create_categorie")
     */
    public function create_categorieAction()
    {
        $categorie = new Categories;
        $title = $_POST['tbTitle'];
        $user_id = $this->get('session')->get('user_id');

        $categorie->setTitle($title);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Users')->find($user_id);
        $categorie->setUsers_id($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->flush();

        $this->addFlash(
          'notice',
          'Categorie Added'
        );

        return $this->display_categories('Categorie is created.');
    }









    // 6
    /**
     * @Route("/update_categorie", name="update_categorie")
     */
    public function update_categorieAction()
    {
        $categorie_id = $_POST['categorie_id'];
        $title = $_POST['tbTitle'];
        $user_id = $this->get('session')->get('user_id');

        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('AppBundle:Categories')->find($categorie_id);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Users')->find($user_id);

        $categorie->setTitle($title);
        $categorie->setUsers_id($user);

        $em->flush();

        $this->addFlash(
          'notice',
          'article Added'
        );

        return $this->display_categories('Categorie is updated.');

    }


    /**
     * @Route("/delete_categorie", name="delete_categorie")
     */
    public function delete_categorieAction()
    {

        $categorie_id = $_POST['categorie_id'];


        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('AppBundle:Categories')->find($categorie_id);

        $em->remove($categorie);
        $em->flush();

        $this->addFlash(
          'notice',
          'Categorie deleted'
        );

        return $this->display_categories('Categorie is deleted. With all its articles.');
    }







}
