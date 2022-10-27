<?php

namespace Theutz\Unite\Commands;

use Illuminate\Console\Command;
use Theutz\Unite\Collections\UnitsCollection;

class GenerateLangFiles extends Command
{
    const LANG_DIR = __DIR__ . '/../../resources/lang/en/';

    protected $signature = 'unite:generate-lang-files';

    protected $description = 'Generate language files for the package itself';


    public function handle(UnitsCollection $units)
    {
        $this->comment('Generating unite::units language file');

        $this->line("Generate units file...");
        $this->printArrayToLangFile("units", $units->getSymbolToNameMap());

        $this->line("Generate symbols file...");
        $this->printArrayToLangFile("symbols", $units->getNamesToSymbolMap());

        $this->info('Langauge files successfully generated!');
    }

    private function prepDataToPrint(array $data): array
    {
        return collect(var_export(value: $data, return: true))
            ->prepend("<?php\n\nreturn ")
            ->push(';')
            ->all();
    }

    private function printArrayToLangFile(string $filename, array $data): void
    {
        $content = $this->prepDataToPrint($data);
        $filename = self::LANG_DIR . $filename . '.php';

        file_put_contents($filename, $content);

        `vendor/bin/pint $filename`;

        $output = require $filename;

        assert($output == $data, "Printed language data does not match prepared data.");
    }
}
