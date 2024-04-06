<?php declare(strict_types=1);

namespace SimpleState\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static invest()
 * @method static static deposit()
 * @method static static revenue()
 * @method static static coupon()
 * @method static static withdrawal()
 */
final class OperationTypeEnum extends Enum
{
    const INVEST = 'invest';
    const DEPOSIT = 'deposit';
    const REVENUE = 'revenue';
    const COUPON = 'coupon';
    const WITHDRAWAL = 'withdrawal';
}
