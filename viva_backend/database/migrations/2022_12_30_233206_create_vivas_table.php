<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vivas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('pname');
            $table->year('year');
            $table->string('prname');
            $table->decimal('prmark',4,2);
            $table->string('sname');
            $table->decimal('smark',4,2);
            $table->string('ename');
            $table->decimal('emark',4,2);
            $table->string('s1name');
            $table->string('s2name')->nullable();
            $table->string('s3name')->nullable();
            $table->string('code')->unique();
            $table->timestamps();
          
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vivas');
    }
};
