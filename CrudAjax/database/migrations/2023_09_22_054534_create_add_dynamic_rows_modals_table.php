<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddDynamicRowsModalsTable extends Migration
{
    
    public function up()
    {
        Schema::create('add_dynamic_rows_modals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('add_dynamic_rows_modals');
    }
}
