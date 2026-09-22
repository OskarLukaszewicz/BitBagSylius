<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Order\Order;
use App\Form\Type\OrderAdminNoteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class UpdateOrderAdminNoteController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route(
        path: '/%sylius_admin.path_name%/orders/{id}/admin-note',
        name: 'app_admin_order_update_admin_note',
        methods: ['POST'],
    )]
    #[IsGranted('ROLE_ADMINISTRATION_ACCESS')]
    public function __invoke(Request $request, Order $order): Response
    {
        $form = $this->createForm(OrderAdminNoteType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addFlash('success', 'app.admin_note.updated');
        } else {
            $this->addFlash('error', 'app.admin_note.update_error');
        }

        return $this->redirectToRoute('sylius_admin_order_show', ['id' => $order->getId()]);
    }
}
