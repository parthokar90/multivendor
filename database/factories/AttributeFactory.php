<?php

namespace Database\Factories;
use App\Models\admin\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'attribute_type' => 'Color',
            'attribute_default' => 1,
            'created_by' => auth()->user()->id,
            'status' => 1, // password
        ];

        return [
            'attribute_type' => 'Color',
            'attribute_default' => 1,
            'created_by' => auth()->user()->id,
            'status' => 1, // password
        ];

        return [
            'attribute_type' => 'Color',
            'attribute_default' => 1,
            'created_by' => auth()->user()->id,
            'status' => 1, // password
        ];
    }
}
