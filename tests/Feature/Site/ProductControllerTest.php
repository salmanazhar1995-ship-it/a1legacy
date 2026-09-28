<?php

namespace Tests\Feature\Site;

use App\Models\Page;
use App\Models\Product;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_products_page_renders_active_products_and_hides_inactive_products(): void
    {
        Page::factory()->create(['slug' => 'products', 'title' => 'Products']);
        Product::factory()->create(['title' => 'Active Voice Agent', 'is_active' => true]);
        Product::factory()->create(['title' => 'Retired Voice Agent', 'is_active' => false]);

        $this->get(route('products'))
            ->assertOk()
            ->assertViewIs('pages.products')
            ->assertSee('Active Voice Agent')
            ->assertDontSee('Retired Voice Agent');
    }
}
