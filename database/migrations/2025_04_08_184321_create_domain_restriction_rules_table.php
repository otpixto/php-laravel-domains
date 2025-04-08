<?php

use App\Enums\DomainRestrictionType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('domain_restriction_rules', function (Blueprint $table) {
			$table->id();
			$table->foreignId('domain_id')->constrained()->cascadeOnDelete();
			$table->string('type');
			$table->string('value');
			$table->text('description')->nullable();
			$table->timestamps();

			$table->index(['domain_id', 'type']);
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('domain_restriction_rules');
	}
};
