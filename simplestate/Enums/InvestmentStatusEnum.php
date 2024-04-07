<?php declare(strict_types=1);

namespace SimpleState\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Approved()
 * @method static static Rejected()
 * @method static static Finished()
 */
final class InvestmentStatusEnum extends Enum
{
    const PENDING  = 'pending';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';
    const FINISHED = 'finished';
}
