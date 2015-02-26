<?php

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vader = DB::table('users')->insert([
            'username'   => 'admin',
            'email'      => 'admin@mistminds.com',
            'password'   => Hash::make('Kdu!48O'),
            'first_name' => 'Test',
            'last_name'  => 'User',
			'role' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
			'last_logged_in_time' => new DateTime(), 
			'total_visits' => 0,
			'is_deleted' => 0,
			'is_banned' => 0,
			'remember_token' => null,
			'confirmed' => 1,
			'confirmation_code' => null
			
        ]);

        /*DB::table('users')->insert([
            'username'   => 'goodsidesoldier',
            'email'      => 'lightwalker@rebels.com',
            'password'   => Hash::make('hesnotmydad'),
            'first_name' => 'Luke',
            'last_name'  => 'Skywalker',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('users')->insert([
            'username'   => 'greendemon',
            'email'      => 'dancingsmallman@rebels.com',
            'password'   => Hash::make('yodaIam'),
            'first_name' => 'Yoda',
            'last_name'  => 'Unknown',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);*/
    }

}