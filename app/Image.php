<?php

namespace App;

use Intervention\Image\Constraint;
use Intervention\Image\ImageManager;
use \Intervention\Image\Image as InterventionImage;
use Symfony\Component\Finder\SplFileInfo;

class Image
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $pathname;

    /**
     * @var string
     */
    private $extension;

    /**
     * Image constructor.
     *
     * @param string $filename
     * @param string $path
     * @param string $pathname
     * @param string $extension
     */
    public function __construct(string $filename, string $path, string $pathname, string $extension)
    {
        $this->path = $path;
        $this->filename = $filename;
        $this->pathname = $pathname;
        $this->extension = $extension;
    }

    /**
     * Create image from SplFileInfo
     *
     * @param SplFileInfo $file
     * @return static
     */
    public static function make(SplFileInfo $file)
    {
        return new static(
            $file->getFilename(),
            $file->getPath(),
            $file->getPathname(),
            $file->getExtension()
        );
    }

    /**
     * Resize image
     *
     * @param null|integer $width
     * @param null|integer $height
     *
     * @return Image
     */
    public function resize($width = null, $height = null) : Image
    {
        if (is_null($width) && is_null($height)) {
            return $this;
        }

        $manager = new ImageManager();
        $image = $manager->make($this->pathname);

        list($resizedImagePath, $resizedImagePathname) = $this->makePaths($image, $width, $height);

        $this->pathname = $resizedImagePathname;
        $this->path = $resizedImagePath;

        if ($width && $height) {
            $image->fit($width, $height, function(Constraint $constraint) {
                $constraint->upsize();
            })->save($resizedImagePathname);

            return $this;
        }

        $image->resize($width, $height, function (Constraint $constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($resizedImagePathname);

        return $this;
    }

    /**
     * Get image contents
     *
     * @return string
     */
    public function getContents() : string
    {
        return file_get_contents($this->pathname);
    }

    /**
     * Get image extension
     *
     * @return string
     */
    public function getExtension() : string
    {
        return $this->extension;
    }

    /**
     * Make directory for resized image
     *
     * @param InterventionImage $image
     * @param mixed $width
     * @param mixed $height
     * @return array
     */
    private function makePaths(InterventionImage $image, $width, $height = null) : array
    {
        $folder = "{$width}x{$height}";
        $resizedImagePath = storage_path("app/images/$folder");

        if (!is_dir($resizedImagePath)) {
            mkdir($resizedImagePath);
        }

        $resizedImagePathname = $resizedImagePath . "/" . $image->filename . '.' . $image->extension;

        return [$resizedImagePath, $resizedImagePathname];
    }
}
