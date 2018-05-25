<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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
     * @param string $slug
     * @return Response
     */
    public function article(string $slug)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Article::class);

        $articles = $repo->findOneBy(array('slug' => $slug));
        return $this->render('show.html.twig', [
            'article' => $articles,
        ]);
    }

    // createFoundException check php doc
}
