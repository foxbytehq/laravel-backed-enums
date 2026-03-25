<?php

namespace Workbench\App\Enums;

use Foxbytehq\LaravelBackedEnums\BackedEnum;
use Foxbytehq\LaravelBackedEnums\IsBackedEnum;

enum IntEnum: int implements BackedEnum
{
    use IsBackedEnum;

    /**
     * Add your Enums below using.
     * e.g. case Standard = 0;
     */

}
