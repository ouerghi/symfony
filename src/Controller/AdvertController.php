<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdvertController
 * @package App\Controller
 * @Route("/advert")
 */
class AdvertController extends AbstractController
{

    /**
     * @Route("/{page}", name="advert_index", requirements={"page" = "\d+"}, defaults={"page" = 1})
     */
    public function index($page)
    {
        if ($page < 1) {

            throw $this->createNotFoundException('Page "'.$page.'" inexistante.');
        }

        return $this->render('Advert/index.html.twig');
    }

    /**
     * @Route("/view/{id}", name="advert_view", requirements={"id" = "\d+"})
     * @param $id
     * @return Response
     */
    public function view($id) {
        return $this->render('Advert/view.html.twig', [
            'id' => $id,
        ]);
    }

    /**
     * @Route("/add", name="advert_add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {

            $this->addFlash('notice', 'Annonce bien enregistrée.');

            return $this->redirectToRoute('oc_advert_view', ['id' => 5]);
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('Advert/add.html.twig');
    }

    /**
     * @Route("/edit/{id}", name="advert_edit", requirements={"id" = "\d+"})
     * @param $id
     */
    public function edit($id)
    {
    }

    /**
     * @Route("/delete/{id}", name="advert_delete", requirements={"id" = "\d+"})
     * @param $id
     */
    public function delete($id)
    {
    }
    /**
     * @Route("/view/{year}/{slug}.{format}", name="oc_advert_view_slug")
     * @param $slug
     * @param $year
     * @param $format
     * @return Response
     */
    public function viewSlug($slug, $year, $format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
    slug '".$slug."', créée en ".$year." et au format ".$format."."
        );
    }
}
