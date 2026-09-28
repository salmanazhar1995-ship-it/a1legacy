<?php

namespace App\Support;

class SectionTypes
{
    /**
     * @return array<string, array{label: string, description: string, view: string, fields: array<int, string>, items: bool}>
     */
    public static function all(): array
    {
        return [
            'hero' => self::definition('Hero', 'A prominent page introduction with optional buttons and imagery.', 'hero', ['eyebrow', 'heading', 'body', 'buttons', 'images', 'layout'], false),
            'content' => self::definition('Standard Content', 'A flexible heading and content block for general page copy.', 'content', ['eyebrow', 'heading', 'body', 'buttons', 'images', 'layout'], false),
            'rich_text' => self::definition('Rich Content', 'Long-form formatted content with headings, lists, links and tables.', 'rich-text', ['eyebrow', 'heading', 'body', 'layout'], false),
            'split_content' => self::definition('Content + Image', 'Two-column content with the image shown beside the copy.', 'split-content', ['eyebrow', 'heading', 'body', 'buttons', 'images', 'layout'], false),
            'image_content' => self::definition('Image + Content', 'Two-column content with the image leading the copy.', 'split-content', ['eyebrow', 'heading', 'body', 'buttons', 'images', 'layout'], false),
            'cards_grid' => self::definition('Cards Grid', 'A responsive group of cards with images, titles and descriptions.', 'cards-grid', ['eyebrow', 'heading', 'body', 'columns', 'theme'], true),
            'feature_grid' => self::definition('Features Grid', 'Show benefits or services as reusable feature cards.', 'feature-grid', ['eyebrow', 'heading', 'body', 'columns', 'theme'], true),
            'features_grid' => self::definition('Features Grid', 'Show benefits or services as reusable feature cards.', 'feature-grid', ['eyebrow', 'heading', 'body', 'columns', 'theme'], true),
            'stats' => self::definition('Stats', 'Display important values and labels in a responsive grid.', 'stats', ['eyebrow', 'heading', 'body', 'columns', 'theme'], true),
            'cta' => self::definition('Call to Action', 'A focused message with one or two action buttons.', 'cta', ['eyebrow', 'heading', 'body', 'buttons', 'images', 'theme'], false),
            'faq' => self::definition('FAQ', 'An expandable list of questions and answers.', 'faq', ['eyebrow', 'heading', 'body', 'theme'], true),
            'logo_strip' => self::definition('Logo Strip', 'A row of company names or linked logo images.', 'logo-strip', ['eyebrow', 'heading', 'body', 'theme'], true),
            'gallery_grid' => self::definition('Gallery Grid', 'A responsive grid of linked images and captions.', 'gallery-grid', ['eyebrow', 'heading', 'body', 'columns', 'theme'], true),
            'video' => self::definition('Video Section', 'Embed an approved hosted video with supporting content.', 'video', ['eyebrow', 'heading', 'body', 'buttons', 'images', 'video', 'layout'], false),
            'testimonials' => self::definition('Testimonials', 'Quote cards with names, roles and optional images.', 'testimonials', ['eyebrow', 'heading', 'body', 'columns', 'theme'], true),
            'pricing' => self::definition('Pricing', 'Pricing or package cards with features and links.', 'pricing', ['eyebrow', 'heading', 'body', 'columns', 'theme'], true),
            'contact' => self::definition('Contact Form', 'The existing contact form and contact details.', 'contact', ['eyebrow', 'heading', 'body', 'theme'], false),
            'changelog' => self::definition('Changelog', 'A dated list of product or company updates.', 'changelog', ['eyebrow', 'heading', 'body', 'theme'], true),
            'business_showcase' => self::definition('Industry Showcase', 'Interactive industries managed by the dedicated Industries module.', 'business-showcase', ['eyebrow', 'heading', 'body', 'theme'], false),
            'client_stories' => self::definition('Client Story Cards', 'Approved client stories managed by the dedicated module.', 'client-stories', ['eyebrow', 'heading', 'body', 'theme'], false),
            'gallery_showcase' => self::definition('Gallery Showcase', 'Featured work managed by the dedicated Gallery module.', 'gallery-showcase', ['eyebrow', 'heading', 'body', 'theme'], false),
            'custom_content' => self::definition('Custom Content', 'A flexible formatted content block with optional imagery and buttons.', 'content', ['eyebrow', 'heading', 'body', 'buttons', 'images', 'layout', 'theme'], false),
            'html_section' => self::definition('HTML Upload', 'Render a self-contained uploaded HTML file as a page section.', 'html-section', ['theme'], false),
        ];
    }

    /** @return array<int, string> */
    public static function keys(): array
    {
        return array_keys(self::all());
    }

    /** @return array{label: string, description: string, view: string, fields: array<int, string>, items: bool}|null */
    public static function find(string $type): ?array
    {
        return self::all()[$type] ?? null;
    }

    public static function viewFor(string $type): ?string
    {
        $view = self::find($type)['view'] ?? null;

        return is_string($view) ? $view : null;
    }

    /**
     * @param  array<int, string>  $fields
     * @return array{label: string, description: string, view: string, fields: array<int, string>, items: bool}
     */
    private static function definition(string $label, string $description, string $view, array $fields, bool $items): array
    {
        return compact('label', 'description', 'view', 'fields', 'items');
    }
}
