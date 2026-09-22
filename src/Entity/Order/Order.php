<?php

declare(strict_types=1);

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Order as BaseOrder;
use Sylius\MolliePlugin\Entity\AbandonedEmailOrderTrait;
use Sylius\MolliePlugin\Entity\MolliePaymentIdOrderTrait;
use Sylius\MolliePlugin\Entity\OrderInterface;
use Sylius\MolliePlugin\Entity\QRCodeOrderTrait;
use Sylius\MolliePlugin\Entity\RecurringOrderTrait;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_order')]
class Order extends BaseOrder implements OrderInterface
{
    use MolliePaymentIdOrderTrait;
    use QRCodeOrderTrait;
    use RecurringOrderTrait;
    use AbandonedEmailOrderTrait;

    public const ADMIN_NOTE_MAX_LENGTH = 500;

    #[ORM\Column(name: 'admin_note', type: 'string', length: 500, nullable: true)]
    #[Assert\Length(max: self::ADMIN_NOTE_MAX_LENGTH, groups: ['sylius_admin_note'])]
    #[Groups(['sylius:admin:order:index', 'sylius:admin:order:show'])]
    protected ?string $adminNote = null;

    public function getAdminNote(): ?string
    {
        return $this->adminNote;
    }

    public function setAdminNote(?string $adminNote): void
    {
        $this->adminNote = '' === $adminNote ? null : $adminNote;
    }
}
