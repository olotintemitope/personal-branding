<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ProjectType: string implements HasColor, HasIcon, HasLabel
{
    case WebApp = 'web_app';
    case MobileApp = 'mobile_app';
    case DataAnalytics = 'data_analytics';
    case AiAgents = 'ai_agents';
    case ApiIntegration = 'api_integration';
    case ECommerce = 'e_commerce';
    case Other = 'other';

    public function getLabel(): string
    {
        return match ($this) {
            self::WebApp => 'Web Application',
            self::MobileApp => 'Mobile Application',
            self::DataAnalytics => 'Data Analytics',
            self::AiAgents => 'AI Agents',
            self::ApiIntegration => 'API Integration',
            self::ECommerce => 'E-Commerce',
            self::Other => 'Other',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::WebApp => 'primary',
            self::MobileApp => 'success',
            self::DataAnalytics => 'info',
            self::AiAgents => 'warning',
            self::ApiIntegration => 'gray',
            self::ECommerce => 'danger',
            self::Other => 'gray',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::WebApp => 'heroicon-o-globe-alt',
            self::MobileApp => 'heroicon-o-device-phone-mobile',
            self::DataAnalytics => 'heroicon-o-chart-bar',
            self::AiAgents => 'heroicon-o-cpu-chip',
            self::ApiIntegration => 'heroicon-o-arrows-right-left',
            self::ECommerce => 'heroicon-o-shopping-cart',
            self::Other => 'heroicon-o-squares-2x2',
        };
    }
}
