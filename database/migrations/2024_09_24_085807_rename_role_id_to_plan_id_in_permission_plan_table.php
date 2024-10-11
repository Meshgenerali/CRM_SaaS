<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('permission_plan', function (Blueprint $table) {
        // Drop the foreign key for role_id
        //$table->dropForeign(['role_id']);
        // Rename column from role_id to plan_id
        $table->renameColumn('role_id', 'plan_id');
        // Add the new foreign key constraint
        $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permission_plan', function (Blueprint $table) {
        // Drop the foreign key for plan_id
        $table->dropForeign(['plan_id']);
        // Rename column back from plan_id to role_id
        $table->renameColumn('plan_id', 'role_id');
        // Add the foreign key for role_id again
        $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }
};
