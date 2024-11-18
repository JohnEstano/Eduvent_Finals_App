<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentIdAndRoleToUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
          
            $table->string('student_id')->nullable()->after('id');
            
            
            $table->string('role')->default('student')->after('student_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
          
            $table->dropColumn('student_id');
            $table->dropColumn('role');
        });
    }
}

