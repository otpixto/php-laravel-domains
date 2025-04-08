<?php

namespace App\Enums;

enum DomainRestrictionType: string {
	case IP = 'ip';
	
	case USER_AGENT = 'user_agent';


	public static function values(): array
	{
		return array_column(self::cases(), 'value');
	}

	public function label(): string
	{
		return match($this) {
			self::IP => 'IP Address',
			self::USER_AGENT => 'User Agent',
		};
	}
}