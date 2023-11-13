<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Modules\Profile\Entities\Profile;
use Modules\Auth\Entities\User;
use Modules\Auth\Entities\Role;
use Modules\Auth\Entities\Permission;
class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateLaratrustTables();

        $config = Config::get('laratrust_seeder.roles_structure');

        if ($config === null) {
            $this->command->error("The configuration has not been published. Did you run `php artisan vendor:publish --tag=\"laratrust-seeder\"`");
            $this->command->line('');
            return false;
        }

        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {//$config->this is from file laratrust_seeder in config foler in role_structure -> this arr contains on all roles 

            // Create a new role
            $role = Role::firstOrCreate([
                'name' => $key,//name is role 
                'display_name' => ucwords(str_replace('_', ' ', $key)),//like super_admin will be in db : Super Admin
                'description' => ucwords(str_replace('_', ' ', $key))
            ]);
            $permissions = [];//create_user,read_user,update_user,delete_user

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {

                foreach (explode(',', $value) as $p => $perm) {

                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = Permission::firstOrCreate([
                        'name' => $module . '_' . $permissionValue,//to became like this : create_user,read_user,update_user,delete_user
                        'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                }
            }

            // Attach all permissions to the role **** to put these per:create_user,read_user,update_user,delete_user into this role like super_admin
            $role->permissions()->sync($permissions);

        // if (Config::get('laratrust_seeder.create_users')) {
        //     if($key=='superadmin'){
        //         $num=1;
        //     }else if($key=='admin'){
        //         $num=2;
        //     }else if($key=='user'){
        //         $num=3;
        //     }else if($key=='doctor'){
        //         $num=4;
        //     }
        //         $this->command->info("Creating '{$key}' user");
        //         // // Create default user for each role
        //         $user = User::create([
        //             'full_name' => ucwords(str_replace('_', ' ', $key)),
        //             'country_id'=>63,
        //             'phone_no' => '111211540'.$num,                    
        //             'email' => $key.'@gmail'.'.com',
        //             'password' => 'password',


        //         ]);
        //         $user->attachRole($role);
        //     }
        
        
        
    }
    
        if (Config::get('laratrust_seeder.create_users')) {
            $this->command->info("Creating '{superadmin}'");
            // Create default user for each role
            $superadmin= User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.superadmin'))),
                'country_id'=>63,
                'phone_no' => '1112115401',                    
                'email' => 'superadmin'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $rolesuperadmin=Role::where(['name'=>'superadmin'])->first();
            $superadmin->attachRole($rolesuperadmin);

            $this->command->info("Creating '{admin}'");
            // Create default user for each role
            $admin = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.admin'))),
                'country_id'=>63,
                'phone_no' => '1112115402',                    
                'email' => 'admin'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roleadmin=Role::where(['name'=>'admin'])->first();
            $admin->attachRole($roleadmin);

            //users
            $this->command->info("Creating '{alaa}'");
            // Create default user for each role
            $user1 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.alaa'))),
                'country_id'=>63,
                'phone_no' => '1112115403',                    
                'email' => 'alaa'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roleuser1=Role::where(['name'=>'user'])->first();
            $user1->attachRole($roleuser1);


            $this->command->info("Creating '{Mahmod}'");
            // Create default user for each role
            $user2 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.mahmod'))),
                'country_id'=>63,
                'phone_no' => '1112115404',                    
                'email' => 'Mahmod'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roleuser2=Role::where(['name'=>'user'])->first();
            $user2->attachRole($roleuser2);

            $this->command->info("Creating '{ali}'");
            // Create default user for each role
            $user3 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.ali'))),
                'country_id'=>63,
                'phone_no' => '1112115405',                    
                'email' => 'ali'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roleuser3=Role::where(['name'=>'user'])->first();
            $user3->attachRole($roleuser3);

            $this->command->info("Creating '{ahmed}'");
            // Create default user for each role
            $user4 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.ahmed'))),
                'country_id'=>63,
                'phone_no' => '1112115406',                    
                'email' => 'ahmed'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roleuser4=Role::where(['name'=>'user'])->first();
            $user4->attachRole($roleuser4);

            //doctors
            $this->command->info("Creating '{Dr. Drake Boeson}'");
            // Create default user for each role
            $doctor1 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.Dr. Drake Boeson'))),
                'country_id'=>63,
                'phone_no' => '1112115407',                    
                'email' => 'drake'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor1=Role::where(['name'=>'doctor'])->first();
            $doctor1->attachRole($roledoctor1);

            $this->command->info("Creating '{Dr. Jenny Watson}'");
            // Create default user for each role
            $doctor2 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr. Jenny Watson'))),
                'country_id'=>63,
                'phone_no' => '1112115408',                    
                'email' => 'jenny'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor2=Role::where(['name'=>'doctor'])->first();
            $doctor2->attachRole($roledoctor2);

            $this->command->info("Creating '{Dr. Maria Foose}'");
            // Create default user for each role
            $doctor3 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr. Maria Foose'))),
                'country_id'=>63,
                'phone_no' => '1112115409',                    
                'email' => 'maria'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor3=Role::where(['name'=>'doctor'])->first();
            $doctor3->attachRole($roledoctor3);

            $this->command->info("Creating '{Mahmod}'");
            // Create default user for each role
            $doctor4 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.mahmod'))),
                'country_id'=>63,
                'phone_no' => '1112115410',                    
                'email' => 'dr-mahmod'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor4=Role::where(['name'=>'doctor'])->first();
            $doctor4->attachRole($roledoctor4);

            $this->command->info("Creating '{Alaa}'");
            // Create default user for each role
            $doctor5 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.Alaa'))),
                'country_id'=>63,
                'phone_no' => '1112115411',                    
                'email' => 'dr-alaa'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor5=Role::where(['name'=>'doctor'])->first();
            $doctor5->attachRole($roledoctor5);



            $this->command->info("Creating '{omar}'");
            // Create default user for each role
            $doctor6 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.omar'))),
                'country_id'=>63,
                'phone_no' => '1112115500',                    
                'email' => 'dr-omar'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor6=Role::where(['name'=>'doctor'])->first();
            $doctor6->attachRole($roledoctor6);

            $this->command->info("Creating '{amjad}'");
            // Create default user for each role
            $doctor7 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.amjad'))),
                'country_id'=>63,
                'phone_no' => '1112115501',                    
                'email' => 'dr-amjad'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor7=Role::where(['name'=>'doctor'])->first();
            $doctor7->attachRole($roledoctor7);

            $this->command->info("Creating '{sabah}'");
            // Create default user for each role
            $doctor8 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.sabah'))),
                'country_id'=>63,
                'phone_no' => '1112115502',                    
                'email' => 'dr-sabah'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor8=Role::where(['name'=>'doctor'])->first();
            $doctor8->attachRole($roledoctor8);


            $this->command->info("Creating '{deema}'");
            // Create default user for each role
            $doctor9 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.deema'))),
                'country_id'=>63,
                'phone_no' => '1112115503',                    
                'email' => 'dr-deema'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor9=Role::where(['name'=>'doctor'])->first();
            $doctor9->attachRole($roledoctor9);

            $this->command->info("Creating '{abdelmajeed}'");
            // Create default user for each role
            $doctor10 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.abdelmajeed'))),
                'country_id'=>63,
                'phone_no' => '1112115504',                    
                'email' => 'dr-abdelmajeed'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor10=Role::where(['name'=>'doctor'])->first();
            $doctor10->attachRole($roledoctor10);

            $this->command->info("Creating '{hammouda}'");
            // Create default user for each role
            $doctor11 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.hammouda'))),
                'country_id'=>63,
                'phone_no' => '1112115505',                    
                'email' => 'dr-hammouda'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor11=Role::where(['name'=>'doctor'])->first();
            $doctor11->attachRole($roledoctor11);

            $this->command->info("Creating '{mohamed}'");
            // Create default user for each role
            $doctor12 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.mohamed'))),
                'country_id'=>63,
                'phone_no' => '1112115506',                    
                'email' => 'dr-mohamed'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor12=Role::where(['name'=>'doctor'])->first();
            $doctor12->attachRole($roledoctor12);



            $this->command->info("Creating '{tarek}'");
            // Create default user for each role
            $doctor13 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.tarek'))),
                'country_id'=>63,
                'phone_no' => '1112115507',                    
                'email' => 'dr-tarek'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor13=Role::where(['name'=>'doctor'])->first();
            $doctor13->attachRole($roledoctor13);

            $this->command->info("Creating '{mostafa}'");
            // Create default user for each role
            $doctor14 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.mostafa'))),
                'country_id'=>63,
                'phone_no' => '1112115508',                    
                'email' => 'dr-mostafa'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor14=Role::where(['name'=>'doctor'])->first();
            $doctor14->attachRole($roledoctor14);

            $this->command->info("Creating '{malek}'");
            // Create default user for each role
            $doctor15 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.malek'))),
                'country_id'=>63,
                'phone_no' => '1112115509',                    
                'email' => 'dr-malek'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor15=Role::where(['name'=>'doctor'])->first();
            $doctor15->attachRole($roledoctor15);


            $this->command->info("Creating '{mariam}'");
            // Create default user for each role
            $doctor16 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.mariam'))),
                'country_id'=>63,
                'phone_no' => '1112115600',                    
                'email' => 'dr-mariam'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor16=Role::where(['name'=>'doctor'])->first();
            $doctor16->attachRole($roledoctor16);

            $this->command->info("Creating '{yazen}'");
            // Create default user for each role
            $doctor17 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.yazen'))),
                'country_id'=>63,
                'phone_no' => '1112115601',                    
                'email' => 'dr-yazen'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor17=Role::where(['name'=>'doctor'])->first();
            $doctor17->attachRole($roledoctor17);

            $this->command->info("Creating '{noor}'");
            // Create default user for each role
            $doctor18 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.noor'))),
                'country_id'=>63,
                'phone_no' => '1112115602',                    
                'email' => 'dr-noor'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor18=Role::where(['name'=>'doctor'])->first();
            $doctor18->attachRole($roledoctor18);

            $this->command->info("Creating '{fedaa}'");
            // Create default user for each role
            $doctor19 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.fedaa'))),
                'country_id'=>63,
                'phone_no' => '1112115701',                    
                'email' => 'dr-fedaa'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor19=Role::where(['name'=>'doctor'])->first();
            $doctor19->attachRole($roledoctor19);

            $this->command->info("Creating '{eman}'");
            // Create default user for each role
            $doctor20 = User::create([
                'full_name' => ucwords(str_replace('_', ' ', trans('modules/users/seeders.dr.eman'))),
                'country_id'=>63,
                'phone_no' => '1112115702',                    
                'email' => 'dr-eman'.'@gmail'.'.com',
                'password' => 'password',
            ]);
            $roledoctor20=Role::where(['name'=>'doctor'])->first();
            $doctor20->attachRole($roledoctor20);
        }
  
      
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return  void
     */
    public function truncateLaratrustTables()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        Schema::disableForeignKeyConstraints();

        DB::table('permission_role')->truncate();
        DB::table('role_user')->truncate();

        if (Config::get('laratrust_seeder.truncate_tables')) {
            DB::table('roles')->truncate();
            DB::table('permissions')->truncate();
            
            if (Config::get('laratrust_seeder.create_users')) {
                $usersTable = (new User)->getTable();
                DB::table($usersTable)->truncate();
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
