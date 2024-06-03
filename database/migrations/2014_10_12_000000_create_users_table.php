<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_token')->default(\Ramsey\Uuid\Uuid::uuid4()->toString());
            $table->string('username');
            $table->string('name');
            $table->string('telepon')->unique();
            $table->string('email')->unique();
            $table->string('alamat');
            $table->string('role');
            $table->datetime('last_login')->default(now());
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
