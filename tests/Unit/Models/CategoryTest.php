<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{


    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass(); // TODO: Change the autogenerated stub
    }

    /**
     *
     * @test
     */
    public function fillable_struct_exists()
    {
        $category = new Category();
        $this->assertEquals(['name', 'description', 'is_active'], $category->getFillable());
    }

    /**
     *
     * @test
     */
    public function autoincrement_is_false()
    {
        $category = new Category();
        $this->assertFalse($category->incrementing);
    }

    /**
     *
     * @test
     */
    public function if_use_traits()
    {

        $traits = [
            HasFactory::class,
            Uuid::class,
            SoftDeletes::class
        ];

        $categoryTraits = array_keys(class_uses(Category::class));
        $this->assertEquals($traits, $categoryTraits);
    }

    /**
     *
     * @test
     */
    public function casts_struct_exists()
    {
        $casts = ['id' => 'string', 'deleted_at' => 'datetime','is_active' => 'boolean'];
        $category = new Category();

        $this->assertEquals($casts, $category->getCasts());
    }

    /**
     *
     * @test
     */
    public function dates_struct()
    {
        $dates = ['created_at', 'updated_at','deleted_at'];
        $category = new Category();
        $categoryDates = $category->getDates();
        foreach ($dates as $date){
            $this->assertContains($date, $categoryDates);
        }
        $this->assertCount(count($dates), $categoryDates);

    }
}
