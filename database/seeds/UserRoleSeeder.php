<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Models\Kas;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::create([
            'company_name' => 'DKM Al Mustaqillin',
            'address' => 'PT Aisin Indonesia Automotive, Jln Harapan VIII Lot LL No 9-10, KIIC, Karawang',
            'telp' => '02678643131',
        ]);

        $admin =User::create([
            'company_id' => $company->id,
            'name' => 'Alliq Aji',
            'npk' => '000075',
            'email' => 'alliq@aiia.co.id',
            'password' => bcrypt('aiia'),
        ]);

        $user = User::create([
            'company_id' => $company->id,
            'name' => 'Fajar',
            'npk' => '000700',
            'email' => 'fajar@aiia.co.id',
            'password' => bcrypt('aiia'),
        ]);

        $role_admin = Role::create(['name' => 'administrator']);

        $role_general = Role::create(['name' => 'general']);

        $admin->assignRole($role_admin);
        $user->assignRole($role_general);
    }
}
