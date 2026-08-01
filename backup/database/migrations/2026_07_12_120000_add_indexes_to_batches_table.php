<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->index(['institute_id', 'project_id', 'created_at']);
            $table->index('status');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->index(['institute_id', 'project_id']);
            $table->index('status');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->index(['institute_id', 'project_id', 'status']);
            $table->index('created_at');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->index(['institute_id', 'status']);
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->index(['institute_id', 'student_id']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->index(['institute_id', 'invoice_id']);
        });
    }

    public function down(): void
    {
        Schema::table('batches', function (Blueprint $table) {
            $table->dropIndex(['institute_id', 'project_id', 'created_at']);
            $table->dropIndex(['status']);
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropIndex(['institute_id', 'project_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropIndex(['institute_id', 'project_id', 'status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropIndex(['institute_id', 'status']);
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropIndex(['institute_id', 'student_id']);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex(['institute_id', 'invoice_id']);
        });
    }
};
