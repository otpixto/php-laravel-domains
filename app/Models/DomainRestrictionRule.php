<?php

namespace App\Models;

use App\Enums\DomainRestrictionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainRestrictionRule extends Model
{
	use HasFactory;

	protected $fillable = [
		'domain_id',
		'type',
		'value',
		'description'
	];

	protected $casts = [
		'type' => DomainRestrictionType::class,
	];

	public function domain(): BelongsTo
	{
		return $this->belongsTo(Domain::class);
	}
}
