<?php

namespace Theutz\Unite\Commands;

use Illuminate\Console\Command;
use Theutz\Unite\Collections\UnitsCollection;

class GenerateLangFiles extends Command
{
    protected $signature = 'unite:generate-lang-files';

    protected $description = 'Generate language files for the package itself';

    public function handle(UnitsCollection $units)
    {
        $this->comment('Generating unite::units language file');

        $this->line('Collecting language data');
        $lang = $units->toLang();
        $raw = var_export(value: $lang, return: true);
        $data = collect($raw)
            ->prepend("<?php\n\nreturn ")
            ->push(';')
            ->all();

        $filename = __DIR__ . '/../../resources/lang/en/units.php';

        $this->line("Printing translations to '{$filename}'");
        file_put_contents($filename, $data);

        $this->line('Formatting translations...');
        `vendor/bin/pint $filename`;

        $out = require $filename;
        assert($out == $lang, 'Printed language data does not match...');

        $this->info('Langauge files successfully generated!');
    }
}
