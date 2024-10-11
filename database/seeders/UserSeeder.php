<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            if($i<1){
                User::create(
                    [
                        'fullname'=>"HelloWorld".$i,
                        'email'=>"helloworld".$i."@gmail.com",
                        'password'=>"123456789",
                        'phone'=>"012345678".$i,
                        'avatar'=>"",
                        'status'=>"1",
                        'role'=> "manager"
                    ]
                );
            }
            else if($i>=1 && $i<= 4){
                User::create(
                    [
                        'fullname'=>"HelloWorld".$i,
                        'email'=>"helloworld".$i."@gmail.com",
                        'password'=>"123456789",
                        'phone'=>"012345678".$i,
                        'avatar'=>"",
                        'status'=>"1",
                        'role'=> "admin"
                    ]
                );
            }
            else{
                User::create(
                    [
                        'fullname'=>"HelloWorld".$i,
                        'email'=>"helloworld".$i."@gmail.com",
                        'password'=>"123456789",
                        'phone'=>"012345678".$i,
                        'avatar'=>"",
                        'status'=>"1",
                        'role'=> "guest"
                    ]
                );
            }
            
        }
    }
}
