<?php

namespace SimonMarcelLinden\Mediable\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use \Illuminate\Http\Response;

use Exception;
use Illuminate\Support\Facades\Storage;

abstract class MediaController extends Controller {
	/**
	 * Specifies the model to use.
	 *
	 * @var array
	 */
	protected $model = null;

	public function __construct() {
		if ($this->model == null) {
			throw new Exception('Unable to load model. Specifies the model to use.');
		}
	}

	public function upload(Request $request) {
		return app($this->model)->store($request);
	}

	public function show($id) {
		try {
			$media = app($this->model)->where('id', '=', $id)->firstOrFail();
			$file =  Storage::disk('public')->get($media->url);
			$type = $media->mimes; // || File::mimeType($media->url);
			return (new Response($file, 200))
					->header('Content-Type', $type);
		} catch (Exception $exception) {
			return $exception->getMessage();
		}
	}

	public function delete($id) {
		return app($this->model)->remove($id);
	}
}
