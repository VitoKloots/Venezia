<?php

namespace App\Controller;

use App\Entity\Bestelregel;
use App\Entity\Fruit;
use App\Entity\Ijsrecept;
use App\Form\BestelregelType;
use App\Form\FruitType;
use App\Form\IjsreceptType;
use App\Repository\BestelregelRepository;
use App\Repository\FruitRepository;
use App\Repository\IjsreceptRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @IsGranted({"ROLE_ADMIN"})
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
     * @Route("/bestelregel", name="bestelregel_index", methods={"GET"})
     */
    public function indexBestelregelAction(BestelregelRepository $bestelregelRepository): Response
    {
        return $this->render('admin/bestelregel/index.html.twig', [
            'bestelregels' => $bestelregelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/fruit/new", name="fruit_new", methods={"GET","POST"})
     */
    public function newFruitAction(Request $request): Response
    {
        $fruit = new Fruit();
        $form = $this->createForm(FruitType::class, $fruit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fruit);
            $entityManager->flush();

            return $this->redirectToRoute('fruit_overzicht');
        }

        return $this->render('admin/fruit/new.html.twig', [
            'fruit' => $fruit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/fruit/{id}", name="fruit_show", methods={"GET"})
     */
    public function showFruitAction(Fruit $fruit): Response
    {
        return $this->render('admin/fruit/show.html.twig', [
            'fruit' => $fruit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fruit_edit", methods={"GET","POST"})
     */
    public function editFruitAction(Request $request, Fruit $fruit): Response
    {
        $form = $this->createForm(FruitType::class, $fruit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_fruit_index');
        }

        return $this->render('admin/fruit/edit.html.twig', [
            'fruit' => $fruit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fruit_delete", methods={"DELETE"})
     */
    public function deleteFruitAction(Request $request, Fruit $fruit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fruit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fruit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fruit_index');
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

    /**
     * @Route("/bestelregel/new", name="bestelregel_new", methods={"GET","POST"})
     */
    public function newBestelregelAction(Request $request): Response
    {
        $bestelregel = new Bestelregel();
        $form = $this->createForm(BestelregelType::class, $bestelregel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bestelregel);
            $entityManager->flush();

            return $this->redirectToRoute('admin_bestelregel_index');
        }

        return $this->render('admin/bestelregel/new.html.twig', [
            'bestelregel' => $bestelregel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/bestelregel/{id}", name="bestelregel_show", methods={"GET"})
     */
    public function showBestelregel(Bestelregel $bestelregel): Response
    {
        return $this->render('admin/bestelregel/show.html.twig', [
            'bestelregel' => $bestelregel,
        ]);
    }

    /**
     * @Route("/bestelregel/{id}/edit", name="bestelregel_edit", methods={"GET","POST"})
     */
    public function editBestelregel(Request $request, Bestelregel $bestelregel): Response
    {
        $form = $this->createForm(BestelregelType::class, $bestelregel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_bestelregel_index');
        }

        return $this->render('admin/bestelregel/edit.html.twig', [
            'bestelregel' => $bestelregel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/bestelregel/{id}", name="bestelregel_delete", methods={"DELETE"})
     */
    public function deleteBestelregel(Request $request, Bestelregel $bestelregel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bestelregel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bestelregel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_bestelregel_index');
    }
}
