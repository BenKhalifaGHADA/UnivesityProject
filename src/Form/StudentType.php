<?php

namespace App\Form;

use App\Entity\Classroom;
use App\Entity\Club;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('dateofbirth')
            ->add('clubs',EntityType::class,[
                'class'=> Club::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>true,
                'query_builder'=>function($repository){
                    return $repository->createQueryBuilder('o')->orderBy('o.name','DESC');
                }

            ])
            ->add('classroom',EntityType::class,[
                'class'=> Classroom::class,
                'choice_label'=>'branch',
                'multiple'=>false,

            ])
            ->add('add_Student',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
