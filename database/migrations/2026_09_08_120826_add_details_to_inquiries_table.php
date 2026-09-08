<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('country', 100)->nullable()->after('phone');
            $table->integer('travelers_count')->nullable()->after('package_id');
            $table->date('preferred_date')->nullable()->after('travelers_count');
            $table->enum('status', ['new', 'contacted', 'in_progress', 'completed', 'cancelled'])->default('new')->after('is_read');
            $table->string('source', 50)->nullable()->after('status');
            $table->text('admin_notes')->nullable()->after('source');
        });
    }

    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn(['country', 'travelers_count', 'preferred_date', 'status', 'source', 'admin_notes']);
        });
    }
};
