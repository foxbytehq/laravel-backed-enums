<?php

namespace Workbench\App\Enums;

use Foxbytehq\LaravelBackedEnums\BackedEnum;
use Foxbytehq\LaravelBackedEnums\IsBackedEnum;

enum StringEnum: string implements BackedEnum
{
    use IsBackedEnum;

    /**
     * Add your Enums below using.
     * e.g. case Standard = 'standard';
     */

}
