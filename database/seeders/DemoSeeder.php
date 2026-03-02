<?php

namespace Database\Seeders;

use App\Enums\InvoiceStatus;
use App\Enums\MeetingStatus;
use App\Enums\PostStatus;
use App\Enums\ProjectStatus;
use App\Enums\ProposalStatus;
use App\Models\Category;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Meeting;
use App\Models\Milestone;
use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectUpdate;
use App\Models\Proposal;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        // Blog
        $categories = collect([
            ['name' => 'Laravel', 'slug' => 'laravel', 'description' => 'All things Laravel framework'],
            ['name' => 'AI & Machine Learning', 'slug' => 'ai-ml', 'description' => 'Artificial intelligence and ML topics'],
            ['name' => 'DevOps', 'slug' => 'devops', 'description' => 'Deployment, CI/CD and infrastructure'],
            ['name' => 'Career', 'slug' => 'career', 'description' => 'Career advice and growth'],
        ])->map(fn ($c) => Category::create($c));

        $tags = collect(['PHP', 'Laravel', 'AI', 'API', 'Docker', 'Testing', 'Architecture', 'Livewire'])
            ->map(fn ($name) => Tag::create(['name' => $name, 'slug' => str($name)->slug()->toString()]));

        $posts = collect([
            ['title' => 'Building AI-Powered Features with Laravel', 'slug' => 'building-ai-powered-features-with-laravel', 'excerpt' => 'Learn how to integrate OpenAI and LangChain into your Laravel applications for intelligent automation.', 'content' => '<h2>Introduction</h2><p>AI is transforming how we build web applications. In this post, I\'ll walk you through integrating AI-powered features into a Laravel application using OpenAI\'s API and LangChain.</p><h2>Setting Up</h2><p>First, install the OpenAI PHP client...</p><p>The key is to think about AI as a tool that enhances your existing workflows, not replaces them.</p>', 'status' => PostStatus::Published, 'published_at' => now()->subDays(3), 'category_id' => $categories[1]->id],
            ['title' => 'Scaling Laravel Applications: A Production Guide', 'slug' => 'scaling-laravel-applications-production-guide', 'excerpt' => 'From zero to millions of requests — practical strategies for scaling Laravel in production.', 'content' => '<h2>The Scaling Journey</h2><p>When your Laravel application starts getting serious traffic, you need a strategy. Here\'s what I\'ve learned from scaling applications serving millions of requests.</p><h2>Database Optimization</h2><p>Start with your queries. Use Laravel\'s query log to identify slow queries...</p>', 'status' => PostStatus::Published, 'published_at' => now()->subDays(7), 'category_id' => $categories[0]->id],
            ['title' => 'Why Every Developer Should Learn System Design', 'slug' => 'why-every-developer-should-learn-system-design', 'excerpt' => 'System design isn\'t just for interviews — it\'s the skill that separates good developers from great ones.', 'content' => '<h2>Beyond Code</h2><p>Writing code is only part of software engineering. Understanding how systems work together at scale is what makes the difference.</p>', 'status' => PostStatus::Published, 'published_at' => now()->subDays(14), 'category_id' => $categories[3]->id],
            ['title' => 'Docker for Laravel Developers (Draft)', 'slug' => 'docker-for-laravel-developers', 'excerpt' => 'A comprehensive guide to containerizing your Laravel apps.', 'content' => '<p>Work in progress...</p>', 'status' => PostStatus::Draft, 'published_at' => null, 'category_id' => $categories[2]->id],
        ])->map(fn ($p) => Post::create([...$p, 'user_id' => $user->id]));

        $posts[0]->tags()->attach([$tags[2]->id, $tags[1]->id, $tags[3]->id]);
        $posts[1]->tags()->attach([$tags[0]->id, $tags[1]->id, $tags[6]->id]);
        $posts[2]->tags()->attach([$tags[6]->id]);
        $posts[3]->tags()->attach([$tags[4]->id, $tags[1]->id]);

        // Clients
        $clients = collect([
            ['name' => 'Sarah Chen', 'email' => 'sarah@techvault.io', 'phone' => '+1 415-555-0142', 'company' => 'TechVault Inc.', 'notes' => 'CTO, needs AI integration for their SaaS platform'],
            ['name' => 'Marcus Johnson', 'email' => 'marcus@greenleaf.co', 'phone' => '+44 20 7946 0958', 'company' => 'GreenLeaf Commerce', 'notes' => 'E-commerce startup, Series A funded'],
            ['name' => 'Amara Obi', 'email' => 'amara@beautyspace.ng', 'phone' => '+234 801 234 5678', 'company' => 'BeautySpace', 'notes' => 'Beauty booking platform, expanding to 3 new markets'],
        ])->map(fn ($c) => Client::create($c));

        // Projects
        $projects = collect([
            ['title' => 'TechVault AI Dashboard', 'description' => 'Build an AI-powered analytics dashboard with predictive insights and automated reporting for TechVault\'s SaaS platform.', 'client_id' => $clients[0]->id, 'status' => ProjectStatus::InProgress, 'start_date' => now()->subMonths(1), 'end_date' => now()->addMonths(2), 'budget' => 25000],
            ['title' => 'GreenLeaf E-Commerce Platform', 'description' => 'Full e-commerce rebuild with Laravel, Livewire, and payment integrations for the UK and EU markets.', 'client_id' => $clients[1]->id, 'status' => ProjectStatus::InProgress, 'start_date' => now()->subWeeks(3), 'end_date' => now()->addMonths(4), 'budget' => 45000],
            ['title' => 'BeautySpace Mobile API', 'description' => 'RESTful API for the BeautySpace mobile app — booking, payments, and provider management.', 'client_id' => $clients[2]->id, 'status' => ProjectStatus::Planning, 'start_date' => now()->addWeeks(2), 'end_date' => now()->addMonths(3), 'budget' => 18000],
            ['title' => 'TechVault Data Migration', 'description' => 'Migrate legacy data from MySQL to PostgreSQL with zero downtime.', 'client_id' => $clients[0]->id, 'status' => ProjectStatus::Completed, 'start_date' => now()->subMonths(4), 'end_date' => now()->subMonths(2), 'budget' => 8000],
        ])->map(fn ($p) => Project::create([...$p, 'user_id' => $user->id]));

        // Milestones for TechVault AI Dashboard
        Milestone::create(['project_id' => $projects[0]->id, 'title' => 'Requirements & Architecture', 'description' => 'Finalize requirements and system architecture', 'due_date' => now()->subWeeks(3), 'completed_at' => now()->subWeeks(3), 'sort_order' => 1]);
        Milestone::create(['project_id' => $projects[0]->id, 'title' => 'AI Model Integration', 'description' => 'Connect OpenAI models and build prediction pipeline', 'due_date' => now()->subWeeks(1), 'completed_at' => now()->subDays(5), 'sort_order' => 2]);
        Milestone::create(['project_id' => $projects[0]->id, 'title' => 'Dashboard UI', 'description' => 'Build interactive charts and reporting UI', 'due_date' => now()->addWeeks(2), 'completed_at' => null, 'sort_order' => 3]);
        Milestone::create(['project_id' => $projects[0]->id, 'title' => 'Testing & Deployment', 'description' => 'Integration tests and production deployment', 'due_date' => now()->addMonths(2), 'completed_at' => null, 'sort_order' => 4]);

        // Meetings
        Meeting::create(['project_id' => $projects[0]->id, 'title' => 'Sprint Review — Week 4', 'description' => 'Review AI model accuracy and dashboard progress', 'scheduled_at' => now()->addDays(2)->setHour(14), 'duration_minutes' => 45, 'location' => 'Google Meet', 'status' => MeetingStatus::Scheduled]);
        Meeting::create(['project_id' => $projects[1]->id, 'title' => 'Payment Gateway Integration Call', 'description' => 'Discuss Stripe Connect setup for marketplace', 'scheduled_at' => now()->addDays(4)->setHour(10), 'duration_minutes' => 30, 'location' => 'Zoom', 'status' => MeetingStatus::Scheduled]);
        Meeting::create(['project_id' => $projects[0]->id, 'title' => 'Kickoff Meeting', 'scheduled_at' => now()->subMonths(1), 'duration_minutes' => 60, 'location' => 'Google Meet', 'notes' => 'Aligned on requirements and timeline.', 'status' => MeetingStatus::Completed]);
        Meeting::create(['project_id' => $projects[2]->id, 'title' => 'API Specification Review', 'scheduled_at' => now()->addWeeks(2)->setHour(11), 'duration_minutes' => 60, 'location' => 'Google Meet', 'status' => MeetingStatus::Scheduled]);

        // Proposals
        Proposal::create(['project_id' => $projects[2]->id, 'title' => 'BeautySpace Mobile API — Technical Proposal', 'content' => '<h2>Scope</h2><p>RESTful API with 25+ endpoints for booking, user management, payments, and analytics.</p><h2>Timeline</h2><p>3 months from kickoff to production deployment.</p>', 'amount' => 18000, 'status' => ProposalStatus::Sent, 'sent_at' => now()->subDays(3), 'valid_until' => now()->addDays(14)]);

        // Project Updates
        ProjectUpdate::create(['project_id' => $projects[0]->id, 'title' => 'AI Model Integration Complete', 'content' => '<p>Great news — the AI prediction models are now integrated and achieving 94% accuracy on test data. Moving on to dashboard UI next week.</p>', 'sent_to_client' => true, 'sent_at' => now()->subDays(5)]);
        ProjectUpdate::create(['project_id' => $projects[1]->id, 'title' => 'Database Schema Finalized', 'content' => '<p>The e-commerce database schema has been finalized with support for multi-currency and EU VAT calculations.</p>', 'sent_to_client' => false]);

        // Invoices
        $inv1 = Invoice::create(['invoice_number' => 'INV-202603-001', 'client_id' => $clients[0]->id, 'project_id' => $projects[0]->id, 'user_id' => $user->id, 'status' => InvoiceStatus::Paid, 'issue_date' => now()->subMonths(1), 'due_date' => now()->subDays(1), 'tax_rate' => 0, 'paid_at' => now()->subWeeks(2)]);
        InvoiceItem::create(['invoice_id' => $inv1->id, 'description' => 'Requirements & Architecture Phase', 'quantity' => 1, 'unit_price' => 5000]);
        InvoiceItem::create(['invoice_id' => $inv1->id, 'description' => 'AI Model Research & Integration', 'quantity' => 1, 'unit_price' => 8000]);
        $inv1->calculateTotals();

        $inv2 = Invoice::create(['invoice_number' => 'INV-202603-002', 'client_id' => $clients[1]->id, 'project_id' => $projects[1]->id, 'user_id' => $user->id, 'status' => InvoiceStatus::Sent, 'issue_date' => now()->subWeeks(1), 'due_date' => now()->addWeeks(3), 'tax_rate' => 20]);
        InvoiceItem::create(['invoice_id' => $inv2->id, 'description' => 'E-Commerce Platform — Phase 1 (Database & Auth)', 'quantity' => 1, 'unit_price' => 12000]);
        InvoiceItem::create(['invoice_id' => $inv2->id, 'description' => 'Payment Gateway Integration', 'quantity' => 1, 'unit_price' => 5000]);
        $inv2->calculateTotals();

        $inv3 = Invoice::create(['invoice_number' => 'INV-202602-001', 'client_id' => $clients[0]->id, 'project_id' => $projects[3]->id, 'user_id' => $user->id, 'status' => InvoiceStatus::Overdue, 'issue_date' => now()->subMonths(2), 'due_date' => now()->subWeeks(3), 'tax_rate' => 0]);
        InvoiceItem::create(['invoice_id' => $inv3->id, 'description' => 'Data Migration — Full Project', 'quantity' => 1, 'unit_price' => 8000]);
        $inv3->calculateTotals();
    }
}
