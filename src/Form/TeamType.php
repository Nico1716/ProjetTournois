<?php

namespace App\Form;

use App\Entity\Player;
use App\Entity\Ranking;
use App\Entity\Team;
use App\Entity\Tournament;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('team_name')
            ->add('teams', EntityType::class, [
                'class' => Tournament::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('ranking', EntityType::class, [
                'class' => Ranking::class,
                'choice_label' => 'id',
            ])
            ->add('player', EntityType::class, [
                'class' => Player::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
