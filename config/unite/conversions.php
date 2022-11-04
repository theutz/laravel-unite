<?php

use Theutz\Unite\Definitions\Conversion;

return [
    new Conversion('g', 'oz', '0.0352739907'),
    new Conversion('oz', 'g', '2.83495e1'),
    new Conversion('C', 'F', '(from * (9/5)) + 32'),
    new Conversion('F', 'C', '(from - 32) * (9/5)'),
];
