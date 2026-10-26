<?php

namespace App\Support;

final class ProductCatalog
{
    /**
     * @return array<string, array{id: string, name: string, category: string, price: float, image: string, description: string}>
     */
    public static function all(): array
    {
        return [
            'grapes' => [
                'id' => 'grapes',
                'name' => 'Anggur Segar',
                'category' => 'Buah',
                'price' => 4.99,
                'image' => 'fruite-item-5.jpg',
                'description' => 'Anggur segar pilihan dengan rasa manis alami, cocok dinikmati kapan saja.',
            ],
            'raspberries' => [
                'id' => 'raspberries',
                'name' => 'Raspberry',
                'category' => 'Buah',
                'price' => 5.49,
                'image' => 'fruite-item-2.jpg',
                'description' => 'Raspberry pilihan yang segar dan kaya rasa untuk camilan sehat keluarga.',
            ],
            'apricots' => [
                'id' => 'apricots',
                'name' => 'Aprikot',
                'category' => 'Buah',
                'price' => 3.99,
                'image' => 'fruite-item-4.jpg',
                'description' => 'Aprikot matang dengan tekstur lembut dan rasa manis yang menyegarkan.',
            ],
            'broccoli' => [
                'id' => 'broccoli',
                'name' => 'Brokoli Organik',
                'category' => 'Sayur',
                'price' => 3.35,
                'image' => 'vegetable-item-2.jpg',
                'description' => 'Brokoli segar yang kaya nutrisi, dipilih langsung untuk menjaga kualitasnya.',
            ],
            'banana' => [
                'id' => 'banana',
                'name' => 'Pisang',
                'category' => 'Buah',
                'price' => 2.99,
                'image' => 'vegetable-item-3.png',
                'description' => 'Pisang matang dengan rasa manis alami, cocok untuk sarapan dan camilan.',
            ],
            'potatoes' => [
                'id' => 'potatoes',
                'name' => 'Kentang',
                'category' => 'Sayur',
                'price' => 2.49,
                'image' => 'vegetable-item-5.jpg',
                'description' => 'Kentang berkualitas untuk melengkapi berbagai hidangan rumahan.',
            ],
        ];
    }

    /**
     * @return array{id: string, name: string, category: string, price: float, image: string, description: string}|null
     */
    public static function find(string $id): ?array
    {
        return self::all()[$id] ?? null;
    }
}
