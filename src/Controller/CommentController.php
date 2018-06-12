<?php
/**
 * Created by PhpStorm.
 * User: iPwne
 * Date: 11/06/2018
 * Time: 18:13
 */

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Comment;
use App\Entity\Article;
use App\Entity\User;
use App\Form\CommentFormType;

class CommentController extends Controller
{
    /**
     * @Route("/blog/{slug}", name="article")
     * @param Request $request
     * @param $slug
     * @return Response
     */
    public function showComment(Request $request, $slug)
    {
        /*// just setup a fresh $task object (remove the dummy data)
        $comment = new Comment();

        $form = $this->createFormBuilder($comment)
            ->add('task', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Add Comment'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $comment = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

        }

        return $this->render('show.html.twig', array(
            'form' => $form->createView(),
        ));
        /*$commentForm = $this->createForm(CommentFormType::class);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $commentForm->getData();

            $comment = new Comment();
            $comment
                ->setComment($data['comment']);

            $em->persist($comment);
            $em->flush();

        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Article::class);

        $articles = $repo->findOneBy(array('slug' => $slug));

        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findBy(array('article_slug' => $slug), array('created' => 'DESC'));

        return $this->render('show.html.twig', [
            'commentForm' => $commentForm->createView(),
            'article' => $articles,
            'comments' => $comments,

        ]);*/

    }
}

/*$em = $this->getDoctrine()->getManager();
$repo = $em->getRepository(Article::class);

$articles = $repo->findOneBy(array('slug' => $slug));

$commentForm = $this->createForm('App\Form\CommentFormType');
$commentForm->handleRequest($request);


$comment = $commentForm->getData();

if ($commentForm->isSubmitted() && $commentForm->isValid()) {
    $comment->setArticle_slug($slug);

    $em = $this->getDoctrine()->getManager();
    $em->persist($comment);
    $em->flush();

    $this->addFlash('success', 'Commentaire envoyé !');
}


$comments = $this->getDoctrine()
    ->getRepository(Comment::class)
    ->findBy(array('article_slug' => $slug), array('created' => 'DESC'));

return $this->render('show.html.twig', [
    'article' => $articles,
    'comments' => $comments,
    'commentForm' $commentForm->createView(),
        ]); */