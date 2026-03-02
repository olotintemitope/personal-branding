<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Currency: string implements HasLabel
{
    case USD = 'USD';
    case NGN = 'NGN';
    case EUR = 'EUR';
    case GBP = 'GBP';
    case CAD = 'CAD';
    case AUD = 'AUD';
    case ZAR = 'ZAR';
    case GHS = 'GHS';
    case KES = 'KES';

    public function getLabel(): string
    {
        return match ($this) {
            self::USD => 'USD ($)',
            self::NGN => 'NGN (₦)',
            self::EUR => 'EUR (€)',
            self::GBP => 'GBP (£)',
            self::CAD => 'CAD (C$)',
            self::AUD => 'AUD (A$)',
            self::ZAR => 'ZAR (R)',
            self::GHS => 'GHS (₵)',
            self::KES => 'KES (KSh)',
        };
    }

    public function symbol(): string
    {
        return match ($this) {
            self::USD => '$',
            self::NGN => '₦',
            self::EUR => '€',
            self::GBP => '£',
            self::CAD => 'C$',
            self::AUD => 'A$',
            self::ZAR => 'R',
            self::GHS => '₵',
            self::KES => 'KSh',
        };
    }

    public function format(float $amount): string
    {
        return $this->symbol() . number_format($amount, 2);
    }

    public function locale(): string
    {
        return match ($this) {
            self::USD => 'en_US',
            self::NGN => 'en_NG',
            self::EUR => 'de_DE',
            self::GBP => 'en_GB',
            self::CAD => 'en_CA',
            self::AUD => 'en_AU',
            self::ZAR => 'en_ZA',
            self::GHS => 'en_GH',
            self::KES => 'en_KE',
        };
    }
}
