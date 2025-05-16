<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('home_contents', function (Blueprint $table) {
            if (!Schema::hasColumn('home_contents', 'logos')) {
                $table->json('logos')->nullable()->after('whatsapp');
            }

            // Adicione outros campos aqui se necessário
        });
    }

    public function down(): void
    {
        Schema::table('home_contents', function (Blueprint $table) {
            $table->dropColumn('logos');
        });
    }
};
