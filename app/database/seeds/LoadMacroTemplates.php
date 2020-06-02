<?php

use Illuminate\Database\Seeder;
use App\MacroTemplate;

class LoadMacroTemplates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
$code = <<<EOF
module.exports = function(channel: LineChannel, cell: LineCell, flow: LineFlow) {
    return new Promise(async function(resolve, reject) {
    });
}
EOF;
      MacroTemplate::create([
        'title' => 'Blank',
        'code' => $code
      ]);

    }
}
