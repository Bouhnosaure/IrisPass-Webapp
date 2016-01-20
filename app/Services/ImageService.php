<?php namespace App\Services;

use App\Http\Requests\ImageRequest;
use Intervention\Image\Facades\Image;

class ImageService
{
    /**
     * @var directory
     */
    protected $directory;

    private $originalImageName;


    /**
     * handle of upload and process of image
     * @param $folder
     * @param ImageRequest $request
     * @return string
     */
    public function processTo($folder, ImageRequest $request)
    {
        $this->directory = storage_path() . '/app/images/' . $folder;

        //set the name
        $this->originalImageName = 'original-' . md5(microtime()) . '.' . $request->file('image')->getClientOriginalExtension();

        //upload and save
        $this->store($request->file('image'));

        ///crop image
        $filename = $this->crop($request->get('crop_options'));
        return $folder . $filename;
    }


    /**
     * after upload, move to folder
     * @param $file
     */
    public function store($file)
    {
        $file->move($this->directory, $this->originalImageName);
    }

    /**
     * crop with parameters and return name of image
     * @param $json
     * @return string
     */
    public function crop($json)
    {
        $options = json_decode($json);
        $filename = md5(microtime()) . '.jpg';

        $image = Image::make($this->directory . $this->originalImageName);
        $image->crop(intval($options->width), intval($options->height), intval($options->x), intval($options->y));
        $image->save($this->directory . $filename);

        return $filename;
    }
}
