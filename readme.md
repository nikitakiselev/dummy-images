# Dummy Images

This lumen app can get random dummy images from storage folder.

## Installation
```Shell
git clone https://github.com/nikitakiselev/dummy-images.git
cd dummy-images
composer install
```

Create images folder and download some dummy images to it:

```Shell
mkdir storage/app/images
```

See `routes.php` file for work urls

## Examples

**GET /random** - get random original image

**GET /random/500** - get random image, resized width 500px

**GET /random/400/200** - get random image 400x200 pixels