<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_User_Default_Detail AFTER INSERT ON `users` FOR EACH ROW
            BEGIN
                INSERT INTO user_details (`user_id`, `id`, `phone_no`,`age`,`birth_place`,`education`,`profession`,`workplace`,`about`, `created_at`, `updated_at`,`picture`) 
                VALUES (NEW.id, NEW.id, null, null,null,null,null,null,null,now(),null,null);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_User_Default_Detail`');
    }
};
