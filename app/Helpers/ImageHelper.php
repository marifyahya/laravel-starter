<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use File;
use Image;

class ImageHelper {
	public $path, $dimensions;

	public function __construct() {
		$this->path = storage_path('app/public/images');
		$this->dimensions = ['160', '500'];
		$this->makeDirectory($this->path);
	}

	protected function makeDirectory($path) {
		if (!File::isDirectory($path)) {
            File::makeDirectory($path);
		}
	}

	public function upload($file, $folder = null, $dimensions = null) {	
		if ($dimensions != null) {
			$this->dimensions = $dimensions;
		}

		if ($folder != null) {
			$this->path = $this->path . '/' . $folder;
			$this->makeDirectory($this->path);
		}

		$fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->extension();
        Image::make($file)->save($this->path . '/' . $fileName);

        foreach ($this->dimensions as $row) {
            $canvas = Image::canvas($row, $row);
            $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
                $constraint->aspectRatio();
            });

            if (!File::isDirectory($this->path . '/' . $row)) {
                File::makeDirectory($this->path . '/' . $row);
            }

            $canvas->insert($resizeImage, 'center');
			$canvas->save($this->path . '/' . $row . '/' . $fileName);
		}
		
		return collect([
			'name' => $fileName,
			'dimensions' => implode('|', $this->dimensions),
			'path' => $this->path
		]);
	}

	public function remove($fileName, $folder = null, $dimensions = null) {	
		if ($dimensions != null) {
			$this->dimensions = $dimensions;
		}

		if ($folder != null) {
			$this->path = $this->path . '/' . $folder;
		}

		$this->removeFile($this->path . '/' . $fileName);
        foreach ($this->dimensions as $row) {
			$this->removeFile($this->path . '/' . $row . '/' . $fileName);
		}

		return;
	}

	private function removeFile($pathFile) {
		if (file_exists($pathFile)) {
			unlink($pathFile);
		}
	}
}
