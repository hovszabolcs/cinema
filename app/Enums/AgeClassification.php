<?php

namespace App\Enums;

enum AgeClassification: int
{
    use EnumBase;
    case AGE12 = 12;
    case AGE16 = 16;
    case AGE18 = 18;
}

