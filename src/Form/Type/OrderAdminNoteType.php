<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Order\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

final class OrderAdminNoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('adminNote', TextareaType::class, [
            'label' => false,
            'required' => false,
            'empty_data' => null,
            'help' => 'app.ui.admin_note_help',
            'constraints' => [
                new Length(max: Order::ADMIN_NOTE_MAX_LENGTH, groups: ['sylius_admin_note']),
            ],
            'attr' => [
                'maxlength' => Order::ADMIN_NOTE_MAX_LENGTH,
                'rows' => 4,
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
            'validation_groups' => ['sylius_admin_note'],
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'app_admin_order_note';
    }
}
