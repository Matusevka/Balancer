<?php
namespace App\Form\Type;



use App\Entity\Processes;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Process\Process;

class ProcessesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add( child: 'name', type: TextType::class);
        $builder->add( child: 'count_process', type: NumberType::class);
        $builder->add( child: 'memory', type: NumberType::class);
        $builder->add('save', SubmitType::class, ['label' => 'Сохранить']);
        $builder->add('reset', ResetType::class, ['label' => 'Отмена']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Processes::class,
        ]);
    }

}