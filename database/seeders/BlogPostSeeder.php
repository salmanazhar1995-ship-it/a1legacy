<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'How an AI receptionist can improve the first customer interaction',
                'slug' => 'ai-receptionist-first-customer-interaction',
                'excerpt' => 'A practical look at where an AI receptionist helps, what it should handle, and where a human handoff still matters.',
                'body' => "A missed call can become a missed opportunity. For many service businesses, the first conversation determines whether a lead books, waits, or moves on.\n\nAn AI receptionist can help by answering common questions, collecting the right details, routing urgent requests, and supporting appointment booking outside normal working hours. The goal is not to remove people from the process. The goal is to make sure every enquiry gets a useful first response.\n\nThe strongest implementations begin with a narrow scope. Start with the questions your team already answers repeatedly, define clear escalation rules, and connect the agent to the systems your staff actually use.\n\nA good AI receptionist should be transparent, predictable, and easy to hand off to a person. Measure outcomes such as answered enquiries, qualified leads, completed bookings, and the number of conversations that require human follow-up.\n\nUsed carefully, voice AI can reduce repetitive work while giving customers a faster and more consistent experience.",
                'author_name' => 'A1 Legacy',
                'published_at' => now()->subDays(10),
                'is_published' => true,
            ],
            [
                'title' => 'The difference between automation and a connected customer journey',
                'slug' => 'automation-vs-connected-customer-journey',
                'excerpt' => 'Automation is useful, but the real value appears when conversations, ownership, follow-up, and reporting work together.',
                'body' => "A single automation can save time, but disconnected automations can create a different kind of complexity. The customer receives one message from one tool, another from a different system, and your team is left reconstructing what happened.\n\nA connected customer journey starts with the full process rather than an isolated task. Where does the lead come from? Who owns the next step? What information should be captured? When should a human become involved? What happens if the customer does not respond?\n\nOnce the journey is clear, automation can support each stage. Forms can create structured records, conversations can trigger tasks, booking activity can update ownership, and follow-up can adapt based on the customer's actions.\n\nThe result is not simply more automation. It is a system where people and tools share the same context and where the next action is easier to understand.",
                'author_name' => 'A1 Legacy',
                'published_at' => now()->subDays(5),
                'is_published' => true,
            ],
            [
                'title' => 'What to plan before adding AI to your website',
                'slug' => 'plan-before-adding-ai-to-your-website',
                'excerpt' => 'Before adding a chat or voice agent, define the questions it can answer, the data it can use, and the actions it is allowed to take.',
                'body' => "Adding an AI assistant to a website is easy. Making it useful requires more thought.\n\nStart with the visitor's intent. Decide which questions the agent should answer, which requests should be captured as leads, and which topics should always be handed to a person. This prevents the assistant from becoming a generic chat box with no connection to the business.\n\nNext, review the information available to the agent. Keep approved answers current, remove conflicting content, and make sure the agent knows when it does not have enough information.\n\nFinally, define the actions the assistant can take. It may collect contact details, book a meeting, qualify an enquiry, or create a support request. Every action should have clear validation and ownership.\n\nThe best website AI experiences are not the ones that try to do everything. They are the ones that do a small number of useful things reliably and make the transition to a human easy.",
                'author_name' => 'A1 Legacy',
                'published_at' => now()->subDay(),
                'is_published' => true,
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::query()->updateOrCreate(
                ['slug' => $post['slug']],
                $post,
            );
        }
    }
}
