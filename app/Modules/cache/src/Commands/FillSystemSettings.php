<?php

namespace App\Modules\cache\src\Commands;

use App\Modules\cache\src\Models\SystemSetting;
use Illuminate\Console\Command;

class FillSystemSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills system settings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SystemSetting::create([
            'key' => 'BigKey',
            'value' => 'LongValue'
        ]);

        SystemSetting::create([
            'key' => 'SmallKey',
            'value' => 'ShortValue'
        ]);

        SystemSetting::create([
            'key' => 'NormalKey',
            'value' => 'MediumValue'
        ]);

        return 0;
    }
}
