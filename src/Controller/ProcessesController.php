<?php

namespace App\Controller;

use App\Entity\Processes;
use App\Form\Type\ProcessesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Works;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class ProcessesController extends AbstractController 
{
    public function add(Request $request, ManagerRegistry $doctrine): Response
    {
        $processes = new Processes();
        $form = $this->createForm(ProcessesType::class, $processes, [
            'action' => $this->generateUrl('process_add'),
        ]);
        $form->handleRequest($request);

        $works = $doctrine->getRepository(persistentObject: Works::class)->findAll();
        $deny_work = array('work' => null, 'memory' => 0, 'process' => 0);
        foreach($works as $k => $v)
        {
            $count_process = $v->getCountProcess();
            $nucleus = $v->getNucleus();
            $memory = $v->getMemory();         

            $processes_list = $doctrine->getRepository(persistentObject: Processes::class)->findBy(['work' => $v->getId()]);
            $memory_sum = 0;
            $processes_sum = 0;
            foreach($processes_list as $k1 => $v1)
            {
                $memory_sum += $v1->getMemory();
                $processes_sum += $v1->getCountProcess();
            }
            $process_delt = ($count_process * $nucleus) - $processes_sum;
            $memory_delt = $memory - $memory_sum;
            if($deny_work['process'] < $process_delt)
            {
                $deny_work['process'] = $process_delt;
                $deny_work['memory'] = $memory_delt;
                $deny_work['work'] = $v->getId();
            }
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $processes = $form->getData();

            $work = $doctrine->getRepository(persistentObject: Works::class)->find($deny_work['work']);
            $processes->setWork($work);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($processes);
            $entityManager->flush();
            $this->addFlash('success', 'Процесс добавлен в машину '. $work->getName());
            return $this->redirectToRoute('index');
        }
        return $this->renderForm('Processes/add.html.twig', ['form' => $form]);
    }
    public function remove(ManagerRegistry $doctrine, int $id)
    {
        $process = $doctrine->getRepository(persistentObject: Processes::class)->find($id);
        //dump($processes);die;\
        //dump($process);die;
        $doctrine->getManager()->remove($process);
        $doctrine->getManager()->flush();
        $this->addFlash('success', 'Процесс удалён');
        return $this->redirectToRoute('index');
    }
}