<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CommentFormType;
use App\Entity\Comment;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('homepage.html.twig', [
            'home' => 'home',
        ]);
    }
    /**
     * @Route("/blog", name="blog")
     */
    public function blog()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Article::class);

        $articles = $repo->findAll();


        return $this->render('blog.html.twig', [
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/service", name="service")
     */
    public function service()
    {

        return $this->render('service.html.twig', [
            'service' => 'services',
        ]);
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {

        return $this->render('contact.html.twig', [
            'contact' => 'Contact',
        ]);
    }
    /**
     * @Route("/team", name="team")
     */
    public function team()
    {

        return $this->render('team.html.twig', [
            'team' => 'Team',
        ]);
    }

    /**
     * @Route ("/blog/{slug}", name="article")
     * @param Request $request
     * @param string $slug
     * @return Response
     */
    public function article(Request $request, $slug)
    {
        $commentForm = $this->createForm(CommentFormType::class);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment = $commentForm->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();



        }

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Article::class);
        $articles = $repo->findOneBy(array('slug' => $slug));

        $com = $em->getRepository(Comment::class);
        $comments = $com->findAll();



        return $this->render('show.html.twig', [
            'commentForm' => $commentForm->createView(),
            'article' => $articles,
            'comments' => $comments,
        ]);
    }

    // createFoundException check php doc
}
