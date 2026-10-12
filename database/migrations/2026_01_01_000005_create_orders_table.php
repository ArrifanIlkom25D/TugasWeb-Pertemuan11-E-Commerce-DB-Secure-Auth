<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->string('order_number')->unique();
            $t->unsignedBigInteger('total')->default(0);
            $t->enum('status', ['pending', 'paid', 'shipped', 'done', 'cancelled'])->default('pending');
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};
