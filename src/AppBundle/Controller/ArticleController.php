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


class ArticleController extends Controller
{


    private function display_articles($message = '')
    {
      $articles = $this->getDoctrine()
          ->getRepository('AppBundle:Articles')
          ->findAll();

      $comments = $this->getDoctrine()
          ->getRepository('AppBundle:Comments')
          ->findAll();

      $user_id = $this->get('session')->get('user_id');


      return $this->render('lcb/article.html.php', array('message' => $message, 'articles' => $articles, 'comments' => $comments, 'user_id' => $user_id));
    }


    /**
     * @Route("/articles", name="articles")
     */
    public function articlesAction()
    {
        return $this->display_articles();

    }




    // 3
    /**
     * @Route("/create_article", name="create_article")
     */
    public function create_articleAction()
    {
        $article = new Articles;
        $categories_id = $_POST['tbCategories_id'];
        $text = $_POST['tbText'];
        $title = $_POST['tbTitle'];
        $user_id = $this->get('session')->get('user_id');

        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('AppBundle:Categories')->find($categories_id);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Users')->find($user_id);

        $article->setCategories_id($categorie);
        $article->setText($text);
        $article->setTitle($title);
        $article->setUsers_id($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();

        $this->addFlash(
          'notice',
          'article Added'
        );

        return $this->display_articles("Article is created.");
    }





    // 5
    /**
     * @Route("/update_article", name="update_article")
     */
    public function update_articleAction()
    {
        $id_articles = $_POST['article_id'];
        $categories_id = $_POST['tbCategories_id'];
        $text = $_POST['tbText'];
        $title = $_POST['tbTitle'];
        $user_id = $this->get('session')->get('user_id');

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Articles')->find($id_articles);
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('AppBundle:Categories')->find($categories_id);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Users')->find($user_id);

        $article->setCategories_id($categorie);
        $article->setText($text);
        $article->setTitle($title);
        $article->setUsers_id($user);

        $em->flush();

        $this->addFlash(
          'notice',
          'article Added'
        );

        return $this->display_articles("Article is updated.");

    }




    /**
     * @Route("/create_comment", name="create_comment")
     */
    public function create_commentAction()
    {
        $comment = new Comments;
        $title = $_POST['tbTitle'];
        $text = $_POST['tbText'];
        $article_id = $_POST['article_id'];
        $user_id = $this->get('session')->get('user_id');

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Articles')->find($article_id);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Users')->find($user_id);

        $comment->setTitle($title);
        $comment->setText($text);
        $comment->setArticles_id($article);
        $comment->setUsers_id($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        $this->addFlash(
          'notice',
          'Comment Added'
        );

        return $this->display_articles("Comment is created.");
    }




    /**
     * @Route("/update_comment", name="update_comment")
     */
    public function update_commentAction()
    {
        $id_comment = $_POST['comment_id'];
        $title = $_POST['tbTitle'];
        $text = $_POST['tbText'];
        $article_id = $_POST['article_id'];
        $user_id = $this->get('session')->get('user_id');

        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('AppBundle:Comments')->find($id_comment);
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Articles')->find($article_id);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:Users')->find($user_id);

        $comment->setTitle($title);
        $comment->setText($text);
        $comment->setArticles_id($article);
        $comment->setUsers_id($user);

        $em->flush();

        $this->addFlash(
          'notice',
          'article Added'
        );

        return $this->display_articles("Comment is updated.");

    }


    /**
     * @Route("/delete_article", name="delete_article")
     */
    public function delete_articleAction()
    {



        $article_id = $_POST['article_id'];

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Articles')->find($article_id);

        $em->remove($article);
        $em->flush();

        $this->addFlash(
          'notice',
          'Article deleted'
        );

        return $this->display_articles("Article is deleted.");

    }



    /**
     * @Route("/delete_comment", name="delete_comment")
     */
    public function delete_commentAction()
    {
        $comment_id = $_POST['comment_id'];

        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('AppBundle:Comments')->find($comment_id);

        $em->remove($comment);
        $em->flush();

        $this->addFlash(
          'notice',
          'comment deleted'
        );

        return $this->display_articles("Comment is deleted.");

    }








}
