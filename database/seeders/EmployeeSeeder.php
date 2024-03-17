<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$table->unsignedBigInteger('manager_id')->nullable();
        //            $table->foreignId('department_id')->nullable()->constrained();
        //            $table->string('phone')->unique();
        //            $table->string('email')->unique();
        //            $table->string('password');
        //            $table->rememberToken();
        //            $table->string('first_name');
        //            $table->string('last_name');
        //            $table->string('salary');
        //            $table->string('image');
        //            $table->enum('type', ['employee', 'manager', 'admin']);
        //            $table->timestamps();
        //
        //            $table->foreign('manager_id')->on('employees')
        //                ->references('id');
        DB::table('employees')->insert([
            [
                'phone'         => '01009366465',
                'email'         => 'eslam.habsa94@gmail.com',
                'password'      => bcrypt('123123'),
                'first_name'    => 'eslam',
                'last_name'     => 'fathy',
                'salary'        => 1500,
                'type'          => 'admin',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'phone'         => '01122334455',
                'email'         => 'manager1@gmail.com',
                'password'      => bcrypt('123123'),
                'first_name'    => 'manager1',
                'last_name'     => 'manager',
                'salary'        => 1500,
                'type'          => 'manager',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'phone'         => '01122334466',
                'email'         => 'manager2@gmail.com',
                'password'      => bcrypt('123123'),
                'first_name'    => 'manager2',
                'last_name'     => 'manager',
                'salary'        => 1500,
                'type'          => 'manager',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'phone'         => '01122334477',
                'email'         => 'manager3@gmail.com',
                'password'      => bcrypt('123123'),
                'first_name'    => 'manager3',
                'last_name'     => 'manager',
                'salary'        => 1500,
                'type'          => 'manager',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
