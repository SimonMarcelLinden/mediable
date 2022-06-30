<?php

namespace SimonMarcelLinden\Mediable\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use \Validator;
use \Exception;

trait Mediable {
	use Uuids;

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param mixed $rules
	 * @param mixed $messages
	 * @return mixed
	 */
	public static function validateRules(Request $request, $rules = null, $messages = null) {
		$rules 		= ($rules) ? $rules : (new static)->rules;
		$messages 	= ($messages) ? $messages : (new static)->messages;
		return Validator::make($request->all(), $rules, $messages);
	}

	/**
	 * Store and uplad new Mediafile.
	 *
	 * @param  Request $keys
	 * @return mixed
	 */
	public static function store(Request $request) {
		$validator = self::validateRules($request);

		if($validator->fails()) {
			return $validator->messages();
		}

		if ($request->hasFile('media')) {
			$file 		= $request->file('media');
			$path 		= Storage::disk('public')->put((new static)->basePath, $file);
			$mimes 		= $file->getClientmimeType();
			return parent::create(['url' => $path, 'mimes' => $mimes, ]);
		}

		return false;
	}

	/**
	 * Store and uplad new Mediafile.
	 *
	 * @param  Request $keys
	 * @return mixed
	 */
	public static function remove(String $id) {
		try {
			$media = parent::where('id', '=', $id)->firstOrFail();
			Storage::disk('public')->delete($media->url);
			return $media->delete();
		} catch (Exception $exception) {
			return $exception->getMessage();
		}
		return false;
	}

	/**
	 * Get mime type.
	 *
	 * @return string
	 */
	public function mimes() {
		if ($this->mimes) {
			return $this->mimes();
		};

		return File::mimeTyp($this->url);
	}

	/**
	 * Get url of Media.
	 *
	 * @return string
	 */
	public function url() {
		return env('APP_URL', 'http://localhost') . "/$this->id";
	}
}
