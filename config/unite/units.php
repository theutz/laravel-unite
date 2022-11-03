<?php

use Illuminate\Support\Facades\File;

return collect(File::files(__DIR__.'/units'))
    ->flatMap(fn ($f) => require $f->getPathname())
    ->all();
