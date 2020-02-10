<?php

namespace App\Controller;

use App\Entity\Ijsrecept;
use App\Form\IjsreceptType;
use App\Repository\IjsreceptRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

///**
// *
// * @IsGranted({"ROLE_ADMIN", "ROLE_SYSTEM"})
// *
// * @Route("/admin" name="admin_")
// */

/**
 * Class AdminController
 * @package App\Controller
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/ijsrecept/", name="ijsrecept_index", methods={"GET"})
     */
    public function indexIjsReceptAction(IjsreceptRepository $ijsreceptRepository): Response
    {
        return $this->render('admin/ijsrecept/index.html.twig', [
            'ijsrecepts' => $ijsreceptRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ijsrecept/new", name="ijsrecept_new", methods={"GET","POST"})
     */
    public function newIjsReceptAction(Request $request): Response
    {
        $ijsrecept = new Ijsrecept();
        $form = $this->createForm(IjsreceptType::class, $ijsrecept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ijsrecept);
            $entityManager->flush();

            return $this->redirectToRoute('admin_ijsrecept_index');
        }

        return $this->render('admin/ijsrecept/new.html.twig', [
            'ijsrecept' => $ijsrecept,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ijsrecept/{id}", name="ijsrecept_show", methods={"GET"})
     */
    public function showIjsReceptAction(Ijsrecept $ijsrecept): Response
    {
        return $this->render('admin/ijsrecept/show.html.twig', [
            'ijsrecept' => $ijsrecept,
        ]);
    }

    /**
     * @Route("/ijsrecept/{id}/edit", name="ijsrecept_edit", methods={"GET","POST"})
     */
    public function editIjsReceptAction(Request $request, Ijsrecept $ijsrecept): Response
    {
        $form = $this->createForm(IjsreceptType::class, $ijsrecept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_ijsrecept_index');
        }

        return $this->render('admin/ijsrecept/edit.html.twig', [
            'ijsrecept' => $ijsrecept,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ijsrecept/{id}", name="ijsrecept_delete", methods={"DELETE"})
     */
    public function deleteIjsReceptAction(Request $request, Ijsrecept $ijsrecept): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ijsrecept->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ijsrecept);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_ijsrecept_index');
    }
}
