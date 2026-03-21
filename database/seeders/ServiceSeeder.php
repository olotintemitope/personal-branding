<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Strategy Session',
                'description' => 'Unstick a hard problem in 60 minutes. Walk away with a clear architecture plan, AI feasibility verdict, and concrete next steps.',
                'prices' => ['USD' => 150, 'NGN' => 150000, 'EUR' => 140, 'GBP' => 120, 'CAD' => 200, 'AUD' => 230],
                'price_unit' => 'per hour',
                'features' => ['1-on-1 technical consultation', 'Architecture review & recommendations', 'AI feasibility assessment', 'Written summary & action items'],
                'cta_label' => 'Book a Session',
                'is_featured' => false,
                'sort_order' => 1,
            ],
            [
                'title' => 'Full Build',
                'description' => 'You describe the product. I ship it. Complete end-to-end build — architecture, development, testing, deployment, and 30 days of post-launch support.',
                'prices' => ['USD' => 5000, 'NGN' => 5000000, 'EUR' => 4700, 'GBP' => 4000, 'CAD' => 6800, 'AUD' => 7700],
                'price_unit' => 'per project',
                'badge' => 'Most Popular',
                'features' => ['Full project scoping & planning', 'Design, development & testing', 'Deployment & CI/CD setup', '30-day post-launch support', 'Source code & documentation'],
                'cta_label' => 'Start a Project',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Ongoing Partnership',
                'description' => 'Like having a senior engineer on your team — without the overhead. Dedicated hours, priority scheduling, and unused hours roll over.',
                'prices' => ['USD' => 3000, 'NGN' => 3000000, 'EUR' => 2800, 'GBP' => 2400, 'CAD' => 4100, 'AUD' => 4600],
                'price_unit' => 'per month · 20 hrs',
                'features' => ['20 hours of dedicated dev time', 'Priority response & scheduling', 'Weekly progress updates', 'Rollover unused hours'],
                'cta_label' => 'Get Started',
                'is_featured' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
    }
}
