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

        $role_admin = Role::create(['name' => 'administrator']);

        $role_general = Role::create(['name' => 'general']);

        $admin =User::create([
            'company_id' => $company->id,
            'name' => 'Alliq Aji',
            'npk' => '000075',
            'email' => 'alliq@aiia.co.id',
            'password' => bcrypt('secret'),
        ]);
        $admin->assignRole($role_admin);


        $users = [
            [
                'company_id' => $company->id,
                'name' => 'Windika Fajar P.',
                'npk' => '000572',
                'email' => 'qcpainting@aiia.co.id',
                'password' => bcrypt('aiia'),
            ],
            [
                'company_id' => $company->id,
                'name' => 'Eko Purnomo',
                'npk' => '000305',
                'email' => 'eko@aiia.co.id',
                'password' => bcrypt('aiia'),
            ],
            [
                'company_id' => $company->id,
                'name' => 'Aditya Teddy Marsha',
                'npk' => '000074',
                'email' => 'teddy@aiia.co.id',
                'password' => bcrypt('aiia'),
            ],

            [
                'company_id' => $company->id,
                'name' => 'Rio Ibrahim N.',
                'npk' => '000549',
                'email' => 'rio.nasution@aiia.co.id',
                'password' => bcrypt('aiia'),
            ],


        ];
        
        foreach($users as $user)
        {
            $new_user = User::create($user);
            $new_user->assignRole($role_general);
        }
    }
}
