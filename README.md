# Thumbnail

Thumbnail Can Use To Create Image Thumbnail In Laravel.

## Installation

```bash
composer require mro/thumbnail
```
Add the following code to providers in config/app.php
```bash
Mro\Thumbnail\ThumbnailServiceProvider::class,
```
Add the following code to aliases in config/app.php
```bash
'Thumbnail'=>Mro\Thumbnail\ThumbnailFacade::class,
```
## Usage

```python
 public function store(Request $request)
    {
        # create function arguments: create($_FILES['image'],$quality,$newWidth,newHeight);
        # the defaults are $quality=100 & $newWidth=300 & newHeight=300.
        # files will be upload in "public/uploads/thumbnails/" directory.
        $image=\Thumbnail::create($request->image,100,200,200);
        Post::create([
            'image'=>$image,
        ]);

    }
```

## Contributing
I hope that will be usefull for you.

## License
[MIT](https://choosealicense.com/licenses/mit/)
