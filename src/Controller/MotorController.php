<?php

namespace App\Controller;

use App\Entity\Motor;
use App\Form\MotorType;
use App\Repository\MotorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/motor")
 */
class MotorController extends AbstractController
{
    /**
     * @Route("/", name="motor_index", methods={"GET"})
     */
    public function index(MotorRepository $motorRepository): Response
    {
        return $this->render('motor/index.html.twig', [
            'motors' => $motorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="motor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $motor = new Motor();
        $form = $this->createForm(MotorType::class, $motor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($motor);
            $entityManager->flush();

            return $this->redirectToRoute('motor_index');
        }

        return $this->render('motor/new.html.twig', [
            'motor' => $motor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="motor_show", methods={"GET"})
     */
    public function show(Motor $motor): Response
    {
        return $this->render('motor/show.html.twig', [
            'motor' => $motor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="motor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Motor $motor): Response
    {
        $form = $this->createForm(MotorType::class, $motor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('motor_index', [
                'id' => $motor->getId(),
            ]);
        }

        return $this->render('motor/edit.html.twig', [
            'motor' => $motor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="motor_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Motor $motor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($motor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('motor_index');
    }
}
