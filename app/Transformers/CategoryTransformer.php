<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Category;

class CategoryTransformer extends TransformerAbstract
{    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        if (isset($category['children'])) {
            $item = [
                'id' => (int) $category->id,
                'title' => $category->title,
                'parent_id' => (int) $category->parent_id,
                'media' => [
                    'thumbnail' => $category->getMedia('thumbnail'),
                    'gallery' => $category->getMedia('gallery')
                ]
            ];

            foreach ($category->children as $key => $value) {
                $item['children'][] = $this->transform($value);
            }

            return $item;
        }
        else {
            return [
                'id' => (int) $category->id,
                'title' => $category->title,
                'parent_id' => (int) $category->parent_id,
                'media' => [
                    'thumbnail' => $category->getMedia('thumbnail'),
                    'gallery' => $category->getMedia('gallery')
                ]
            ];
        }
    }
}
