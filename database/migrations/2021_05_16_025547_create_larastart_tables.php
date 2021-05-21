<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLarastartTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create(config('larahper.database.users_table'), function (Blueprint $table) {
            $table->increments('id');

            // 用户名登录 用户名
            $table->string('username', 190)->unique();
            $table->string('password', 60);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            // 手机号登录
            $table->string('phone', 255)->unique(); // 手机号
            $table->string('openid', 255)->unique(); // openid
            $table->rememberToken();

            $table->string('name');
            $table->string('avatar')->nullable();
            $table->integer('gender')->default(0); // 性别
            $table->string('country', 20)->nullable(); // 国家
            $table->string('province', 20)->nullable(); // 省份
            $table->string('city', 20)->nullable(); // 城市
            $table->text('avatar_url')->nullable(); // 头像

            $table->timestamps();
        });

        // 角色表
        Schema::create(config('larahper.database.roles_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->timestamps();
        });

        // 权限表
        Schema::create(config('larahper.database.permissions_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('slug', 50)->unique();
            $table->string('http_method')->nullable();
            $table->text('http_path')->nullable();
            $table->timestamps();
        });

        // 角色<=>用户 表
        Schema::create(config('larahper.database.role_users_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('user_id');
            $table->index(['role_id', 'user_id']);
            $table->timestamps();
        });

        // 角色<=>权限
        Schema::create(config('larahper.database.role_permissions_table'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');
            $table->index(['role_id', 'permission_id']);
            $table->timestamps();
        });

        // 用户<=>权限
        Schema::create(config('larahper.database.user_permissions_table'), function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('permission_id');
            $table->index(['user_id', 'permission_id']);
            $table->timestamps();
        });

        // 操作日志
        Schema::create(config('larahper.database.operation_log_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip');
            $table->text('input');
            $table->index('user_id');
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
        Schema::dropIfExists(config('larahper.database.users_table'));
        Schema::dropIfExists(config('larahper.database.roles_table'));
        Schema::dropIfExists(config('larahper.database.permissions_table'));
        Schema::dropIfExists(config('larahper.database.user_permissions_table'));
        Schema::dropIfExists(config('larahper.database.role_users_table'));
        Schema::dropIfExists(config('larahper.database.role_permissions_table'));

        Schema::dropIfExists(config('larahper.database.operation_log_table'));

    }
}
