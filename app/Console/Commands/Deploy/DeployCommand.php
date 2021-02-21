<?php

namespace App\Console\Commands\Deploy;

use App\Models\Role;
use App\Models\Voucher;
use Illuminate\Console\Command;
use App\Models\IdentificationType;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

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
        $this->optimizeApp();

        $this->createUpdatePermissions();
        $this->createUpdateIdentificationTypes();
        $this->createUpdateVouchers();

        $this->info('Scripts launched successfully');
    }

    private function optimizeApp() {

        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('clear-compiled');

            if (config('app.env') == 'production') {
                // composer install --optimize-autoloader --no-dev
                Artisan::call('optimize');
                Artisan::call('config:cache');
                Artisan::call('route:cache');
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return;
        }

        $this->info('Ready app optimization');
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
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return;
        }

        $this->info('Updated vouchers');
    }

    private function createUpdatePermissions() {

        $permissions = config('verkabill.permissions');
        $arrayPermissions = [];

        foreach ($permissions as $p) {
            $p = Permission::updateOrCreate(
                ['name' => $p['name']],
                ['display_name' => $p['display_name'], 'guard_name' => $p['guard_name']]
            );
            $arrayPermissions[] = $p['name'];
        }
        $deletePermissions = Permission::whereNotIn('name', $arrayPermissions)->pluck('id');
        Permission::destroy($deletePermissions);

        $role = Role::updateOrCreate(['name' => 'Super Admin'], ['guard_name' => 'api']);
        $role->syncPermissions($arrayPermissions);

        /* if(!$user_admin = User::where('username','jebauza')->first()) {
            $user_admin = factory(User::class)->create([
                    'email' => 'jebauza@gmail.com',
                    'firstname' => 'Jorge',
                    'secondname' => 'Ernesto',
                    'lastname' => 'Bauza Becerra',
                    'username' => 'jebauza',
                    'password' => Hash::make('password'),
                ]);
        }

        $user_admin->assignRole($role->name); */
    }
}
