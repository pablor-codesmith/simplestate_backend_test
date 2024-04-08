<?php declare(strict_types=1);

namespace SimpleState\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DebinStatusEnum extends Enum
{
    const COMPLETED = 'COMPLETED';
    const CANCELED = 'CANCELED';
    const IN_PROGRESS = 'IN_PROGRESS';
    const AWAITING_CONFIRMATION = 'AWAITING_CONFIRMATION';
}
