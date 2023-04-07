<?php

namespace Tests\Feature;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_brands_can_be_retrieved(): void
    {
        Brand::factory(5)->create();

        $response = $this->get(route('brands.index'));

        $this->assertNotEmpty($response['data']);
    }

    public function test_single_brand_can_be_retrieved(): void
    {
        $brand = Brand::factory()->create();

        $response = $this->get(route('brands.show', $brand))->assertOk();

        $this->assertSame($brand->uuid, $response['data']['uuid']);
    }

    public function test_brands_can_be_created(): void
    {
        $this->signInAsAdmin();

        $this->post(route('brands.store'), [
            'title' => 'New Brand'
        ])->assertOk();
    }

    public function test_brands_can_be_updated(): void
    {
        $this->signInAsAdmin();
        $brand = Brand::factory()->create();

        $this->put(route('brands.update', $brand), [
            'title' => $title = 'New Title'
        ])->assertOk();

        $brand->refresh();

        $this->assertSame($brand->title, $title);
    }

    public function test_brands_can_be_deleted(): void
    {
        $this->signInAsAdmin();
        $brand = Brand::factory()->create();

        $this->delete(route('brands.destroy', $brand))->assertOk();

        $this->assertDatabaseMissing(Brand::class, ['id' => $brand->id]);
    }
}
