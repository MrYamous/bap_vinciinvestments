<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Contact;
use App\Form\ContactFormType;
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
     * @param $request
     * @return Response
     */
    public function contact(Request $request)
    {
        $contact = new Contact();

        $contactForm = $this->createForm(ContactFormType::class);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $name = $contactForm['name']->getData();
            $email = $contactForm['email']->getData();
            $subject = $contactForm['subject']->getData();
            $message = $contactForm['message']->getData();

            $contact->setName($name);
            $contact->setEmail($email);
            $contact->setSubject($subject);
            $contact->setMessage($message);

            $m = $this->getDoctrine()->getManager();
            $m->persist($contact);
            $m->flush();

            return $this->redirectToRoute('contact');
        }
        return $this->render('contact.html.twig', [
            'contactForm' => $contactForm->createView(),
        ]);
    }

    /**
     * @Route("/team", name="team")
     */
    public
    function team()
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
        $comment = new Comment();

        $commentForm = $this->createForm(CommentFormType::class);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $message = $commentForm['content']->getData();

            $comment->setContent($message);

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('blog');

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
