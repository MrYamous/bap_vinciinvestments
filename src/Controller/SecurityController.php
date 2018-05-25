<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserLoginFormType;
use App\Form\UserRegistrationFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/register", name="register")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $registrationForm = $this->createForm(UserRegistrationFormType::class);
        $registrationForm->handleRequest($request);

        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $registrationForm->getData();

            $user = new User();
            $user
                ->setUsername($data['username'])
                ->setEmail($data['email'])
                ->setPlainPassword($data['password']);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        // ['registrationForm' => $registrationForm] === compact($registrationForm)
        return $this->render('security/register.html.twig', [
            'registrationForm' => $registrationForm->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @param AuthenticationUtils $authUtils
     * @return Response
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();
        $loginForm = $this->createForm(UserLoginFormType::class);

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'loginForm' => $loginForm->createView(),
            'bodyClass' => 'login',
        ));
    }
}
