<?php

namespace App\Controller;

use App\Entity\Persons;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/{_locale}",
     *     defaults={"_locale"="fr"},
     *     name="home",
     *     requirements={
     *         "_locale"="en|fr|pt|it"
     * })
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/contact/{_locale}",
     *     defaults={"_locale"="fr"},
     *     name="contact",
     *     requirements={
     *         "_locale"="en|fr|pt|it"
     * })
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contact(){
        return $this->render('home/contact.html.twig');
    }

    /**
     * @Route("/user/view/{id}/{_locale}",
     *     defaults={"_locale"="fr"},
     *     name="view_profile",
     *     requirements={
     *         "_locale"="en|fr|pt|it"
     * })
     * @Route("/admin/view/{id}/{_locale}",
     *     defaults={"_locale"="fr"},
     *     name="view_profile",
     *     requirements={
     *         "_locale"="en|fr|pt|it"
     * })
     */
    public function viewPerson(Persons $person){

        return $this->render('view/profile.html.twig', [
            'person' => $person
        ]);
    }
}
