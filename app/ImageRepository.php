<?php

namespace App;

use Illuminate\Support\Collection;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Intervention\Image\Exception\NotFoundException;
use Illuminate\Contracts\Cache\Repository as Cache;

class ImageRepository
{
    /**
     * ImagesRepository constructor.
     *
     * @param Finder $finder
     * @param Cache $cache
     */
    public function __construct(Finder $finder, Cache $cache)
    {
        $this->finder = $finder;
        $this->cache = $cache;
    }

    /**
     * Find files in folder
     *
     * @param string $path Path to find files
     * @param int $depth
     *
     * @return array|SplFileInfo[]
     */
    public function find(string $path, int $depth = 0) : array
    {
        $this->finder->files()->in($path);
        $this->finder->depth('== ' . $depth);

        return iterator_to_array($this->finder->files());
    }

    /**
     * Get all images
     *
     * @return Collection
     *
     * @throws NotFoundException
     */
    public function all() : Collection
    {
        return $this->cache->remember('files', 60, function () {

            $files = $this->find(storage_path('app/images'));

            if (count($files) === 0) {
                throw new NotFoundException('Images not found. Add more images to storage');
            }

            return collect(array_map(function (SplFileInfo $file) {
                return Image::make($file);
            }, $files));
        });
    }

    /**
     * Get random image from collection
     *
     * @return Image
     */
    public function random() : Image
    {
        return $this->all()->random();
    }
}
