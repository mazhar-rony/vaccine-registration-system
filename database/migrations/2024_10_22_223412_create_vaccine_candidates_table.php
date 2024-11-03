<?php

use App\Constants\Status;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vaccine_candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('nid');
            $table->foreignId('vaccine_center_id')->constrained('vaccine_centers')->onDelete('cascade');
            $table->string('status')->default(Status::NOT_SCHEDULED);
            $table->date('schedule_date')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vaccine_candidates', function (Blueprint $table) {
            $table->dropForeign(['vaccine_center_id']);
            $table->dropIfExists();
        });
    }
};
