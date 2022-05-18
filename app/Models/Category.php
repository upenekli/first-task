<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

use Kalnoy\Nestedset\NodeTrait;

class Category extends Model implements HasMedia
{
    use HasFactory, NodeTrait, InteractsWithMedia;
    
    protected $fillable = [
        'title'
    ];

    

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('thumbnail')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumbnail')
                    ->fit(Manipulations::FIT_CROP, 300, 300)
                    ->nonQueued();
            });
        $this
            ->addMediaCollection('gallery')
            ->onlyKeepLatest(3)
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('gallery')
                    ->crop(Manipulations::CROP_CENTER, 1024, 1024)
                    ->nonQueued();
            });
    }
}
