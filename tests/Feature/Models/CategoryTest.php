<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @test
     */
    public function insert_one_registry()
    {
        Category::factory()->create();
        $category = Category::all();
        $this->assertCount(1, $category);
        $categoryKeys = array_keys($category->first()->getAttributes());
        $this->assertEqualsCanonicalizing(
            [
                'id',
                'name',
                'description',
                'is_active',
                'created_at',
                'updated_at',
                'deleted_at'
            ],
            $categoryKeys
        );
    }

    /**
     * @test
     */
    public function create_category()
    {
        $category = Category::create([
            'name' => 'teste1'
        ]);

        $category->refresh();

        $this->assertEquals('teste1', $category->name);
        $this->assertNull($category->description);
        $this->assertTrue((bool)$category->is_active);

        $category = Category::create([
            'name' => 'teste1',
            'description' => 'test_description'
        ]);

        $this->assertEquals('test_description', $category->description);

        $category = Category::create([
            'name' => 'teste1',
            'is_active' => false
        ]);

        $this->assertFalse($category->is_active);
    }

    /**
     * @test
     */
    public function update_category()
    {
        $category = Category::factory()->create([
            'description' => 'test_description',
            'is_active' => false
        ]);

        $data = [
            'name' => 'test_name_updated',
            'description' => 'test_description_updated',
            'is_active' => true
        ];

        $category->update($data);

        foreach ($data as $key => $value) {
            $this->assertEquals($value, $category->{$key});
        }

    }

    /**
     * @test
     */
    public function delete_category()
    {
        $category = Category::factory()->create([
            'description' => 'test_description_del',
            'is_active' => false
        ]);


        $category->delete();

        $this->assertSoftDeleted('categories', [
            'description' => 'test_description_del'
        ]);

    }

    /**
     * @test
     */
    public function uuid_category_generate()
    {
        $category = Category::factory()->create();
        $this->assertNotEmpty($category->id);
        $this->assertEquals(36, strlen($category->id));

        $id = 'uuid_teste1';
        $category = Category::factory()->create(['id' => $id]);
        $this->assertEquals($category->id, $id);


    }





}
