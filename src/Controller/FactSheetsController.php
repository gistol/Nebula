<?php
namespace App\Controller;


use App\Form\FactSheetsType;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use App\Entity\FactSheets;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Brand controller.
 *
 * @Route("/api")
 */
class FactSheetsController extends FOSRestController
{
    /**
     * Lists all Articles.
     * @FOSRest\Get("/facts")
     */
    public function getFacts()
    {
        $repository = $this->getDoctrine()->getRepository(FactSheets::class);

        // query for a single Product by its primary key (usually "id")
        $data = $repository->findAll();

        $view = View::create($data);
        $view->setFormat('json');

        // Gestion de la réponse
        return $this->handleView($view);
    }

    /**
     * Lists one Article.
     * @Route("/facts/{id}", name="facts_id", methods={"GET"}, requirements={"id"="\d+"})
     *
     */
    public function getOneFact($id)
    {
        $repository = $this->getDoctrine()->getRepository(FactSheets::class);
        $data = $repository->find($id);

        if ($data === null) {
            $view = View::create($data, Response::HTTP_NOT_FOUND , []);
        } else {
            $view = View::create($data, Response::HTTP_OK , []);
        }
        $view->setFormat('json');
        return $this->handleView($view);
    }

    /**
     * Create Article.
     * @FOSRest\Post("/facts")
     *
     */
    public function PostFactsAction(Request $request)
    {
        $data = new FactSheets();
        $form = $this->createForm(FactSheetsType::class, $data);
        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            $view = View::create($data, Response::HTTP_CREATED , []);
        } else {
            $view = View::create($form, Response::HTTP_BAD_REQUEST , []);
        }
        $view->setFormat('json');
        return $this->handleView($view);
    }
}
