<?php

namespace App\Controller;

use App\Entity\Works;
use App\Entity\Processes;
use App\Form\Type\WorksType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class WorksController extends AbstractController 
{
    //Загрузка списка work машин
    public function index(ManagerRegistry $doctrine): Response
    {        
        $works = $doctrine->getRepository(persistentObject: Works::class)->findAll();
        return $this->render( 'Works/index.html.twig', ['works' => $works]);
    }

    public function remove(ManagerRegistry $doctrine, int $id)
    {
        $processes = $doctrine->getRepository(persistentObject: Processes::class)->findBy(['work' => $id]);
        if(empty($processes))
        {
            $work = $doctrine->getRepository(persistentObject: Works::class)->find($id);
            $doctrine->getManager()->remove($work);
            $doctrine->getManager()->flush();
            $this->addFlash('success', 'Машина удалена');
        }
        else
        {
            $this->addFlash('error', 'Машину удалить нельзя, так как в ней есть процессы');
        }

        return $this->redirectToRoute('index');
    }

    //Выбор машины из списка
    public function carpressed(ManagerRegistry $doctrine, int $id): Response
    {
        $processes = $doctrine->getRepository(persistentObject: Processes::class)->findBy(['work' => $id]);
        return $this->render('Processes/index.html.twig',[
            'processes' => $processes
        ]);
    }

    //Добавение work машины, создание формы
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $works = new Works();
        $form = $this->createForm(WorksType::class, $works, [
            'action' => $this->generateUrl('add'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $work = $form->getData();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($work);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }
        return $this->renderForm('Works/add.html.twig', ['form' => $form]);
    }

}