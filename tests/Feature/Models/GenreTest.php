<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use App\Models\Genre;
use Tests\TestCase;

class GenreTest extends TestCase
{
    /**
     * @test
     */
    public function insert_one_registry()
    {
        Genre::factory()->create();
        $genre = Genre::all();
        $this->assertCount(1, $genre);
        $genreKeys = array_keys($genre->first()->getAttributes());
        $this->assertEqualsCanonicalizing(
            [
                'id',
                'name',
                'is_active',
                'created_at',
                'updated_at',
                'deleted_at'
            ],
            $genreKeys
        );
    }

    /**
     * @test
     */
    public function create_genre()
    {
        $genre = Genre::create([
            'name' => 'teste_genre'
        ]);

        $genre->refresh();

        $this->assertEquals('teste_genre', $genre->name);
        $this->assertTrue($genre->is_active);

        $genre = Genre::create([
            'name' => 'teste1'
        ]);

        $this->assertEquals('teste1', $genre->name);

        $genre = Category::create([
            'name' => 'teste1',
            'is_active' => false
        ]);

        $this->assertFalse($genre->is_active);
    }

    /**
     * @test
     */
    public function update_genre()
    {
        $genre = Genre::factory()->create([
            'name' => 'test_name',
            'is_active' => false
        ]);

        $data = [
            'name' => 'test_name_updated',
            'is_active' => true
        ];

        $genre->update($data);

        foreach ($data as $key => $value) {
            $this->assertEquals($value, $genre->{$key});
        }

    }

    /**
     * @test
     */
    public function delete_genre()
    {
        $genre = Genre::factory()->create([
            'name' => 'test_description_del',
            'is_active' => false
        ]);


        $genre->delete();

        $this->assertSoftDeleted('genres', [
            'name' => 'test_description_del'
        ]);

    }

    /**
     * @test
     */
    public function uuid_genre_generate()
    {
        $genre = Genre::factory()->create();
        $this->assertNotEmpty($genre->id);

        $id = 'uuid_teste1';
        $genre = Genre::factory()->create(['id' => $id]);
        $this->assertEquals($genre->id, $id);

    }





}
