<?php

declare(strict_types=1);

namespace App\Twig\Components\Admin\Order;

use App\Entity\Order\Order;
use App\Form\Type\OrderAdminNoteType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent(name: 'app_admin:order:admin_note', template: 'admin/order/show/content/sections/admin_note.html.twig')]
final class AdminNoteFormComponent
{
    public Order $order;

    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly UrlGeneratorInterface $urlGenerator,
    ) {
    }

    #[ExposeInTemplate('form')]
    public function getForm(): FormView
    {
        $form = $this->formFactory->create(OrderAdminNoteType::class, $this->order, [
            'action' => $this->urlGenerator->generate('app_admin_order_update_admin_note', [
                'id' => $this->order->getId(),
            ]),
            'method' => 'POST',
        ]);

        return $form->createView();
    }
}
