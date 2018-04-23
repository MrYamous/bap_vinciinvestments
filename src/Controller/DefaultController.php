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
        /*$em = $this->getDoctrine()->getManager();
        $i = 0;
        while ($i < 10000) {
            $articles = new Article();
            $articles
                ->setTitle('yeyeye')
                ->setSlug('article')
                ->setContent('COntent lolololo')
                ->setExcerpt('resume');

            $em->persist($articles);
            if (0 === $i % 500){
                $em->flush();
            }
            $i++;
        }*/
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Article::class);

        $articles = $repo->findAll();


        return $this->render('homepage.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route ("/article/{slug}", name="article")
     * @param string $slug
     */
    public function article(string $slug)
    {
        $this->render('article.html.twig', [
            'article' => $article,
        ]);
    }

    // createFoundException check php doc
}
