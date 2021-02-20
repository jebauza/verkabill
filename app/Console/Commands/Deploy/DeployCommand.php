<?php

namespace App\Console\Commands\Deploy;

use App\Models\Voucher;
use Illuminate\Console\Command;
use App\Models\IdentificationType;
use Illuminate\Support\Facades\Artisan;

class DeployCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'launch:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This script is launched every time it is deployed.';

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
        Artisan::call('migrate');

        $this->createUpdateIdentificationTypes();
        $this->createUpdateVouchers();

        $this->info('Scripts launched successfully');
    }

    private function createUpdateIdentificationTypes() {

        $identificationTypes = config('verkabill.identification_types');

        try {
            foreach ($identificationTypes as $type) {
                IdentificationType::updateOrCreate(
                    ['code' => $type['code']],
                    ['name' => $type['name'], 'abbreviation' => $type['abbreviation']]
                );
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return;
        }

        $this->info('Updated identification types');
    }

    private function createUpdateVouchers() {

        $vouchers = config('verkabill.vouchers');

        try {
            foreach ($vouchers as $v) {
                Voucher::updateOrCreate(
                    ['code' => $v['code']],
                    ['name' => $v['name']]
                );
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return;
        }

        $this->info('Updated vouchers');
    }
}
