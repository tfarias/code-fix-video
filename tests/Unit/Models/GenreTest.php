<?php

namespace Tests\Unit\Models;

use App\Models\Genre;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\TestCase;

class GenreTest extends TestCase
{

    /**
     *
     * @test
     */
    public function fillable_struct_exists()
    {
        $genre = new Genre();
        $this->assertEquals(['id', 'name', 'is_active'], $genre->getFillable());
    }

    /**
     *
     * @test
     */
    public function autoincrement_is_false()
    {
        $genre = new Genre();
        $this->assertFalse($genre->incrementing);
    }

    /**
     *
     * @test
     */
    public function if_use_traits()
    {

        $traits = [
            HasFactory::class,
            SoftDeletes::class,
            Uuid::class
        ];

        $genreTraits = array_keys(class_uses(Genre::class));
        $this->assertEquals($traits, $genreTraits);
    }

    /**
     *
     * @test
     */
    public function casts_struct_exists()
    {
        $casts = ['id' => 'string', 'deleted_at' => 'datetime','is_active' => 'boolean'];
        $genre = new Genre();

        $this->assertEquals($casts, $genre->getCasts());
    }

    /**
     *
     * @test
     */
    public function dates_struct()
    {
        $dates = ['created_at', 'updated_at','deleted_at'];
        $genre = new Genre();
        $genreDates = $genre->getDates();
        foreach ($dates as $date){
            $this->assertContains($date, $genreDates);
        }
        $this->assertCount(count($dates), $genreDates);

    }
}
