<?php

namespace App\Http\Controllers;

use App\ImageRepository;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{
    /**
     * @var ImageRepository
     */
    private $images;

    /**
     * ImageController constructor.
     * @param ImageRepository $images
     */
    public function __construct(ImageRepository $images)
    {
        $this->images = $images;
    }

    /**
     * Get random image
     *
     * @param null|integer $width
     * @param null|integer $height
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function random($width = null, $height = null)
    {
        $image = $this->images->random();

        $image->resize($width, $height);

        return response($image->getContents(), 200, [
            'Content-Type' => 'image/' . $image->getExtension()
        ]);
    }
}
