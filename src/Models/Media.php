<?php

namespace SimonMarcelLinden\Mediable\Models;

use SimonMarcelLinden\Mediable\Traits\Mediable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @template TKey of array-key
 * @template TValue
 */
abstract class Media extends Model{
	use Mediable, SoftDeletes;

	/**
	* The table associated with the model.
	*
	* @var string
	*/
	protected $table = 'media';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['url', 'mimes'];

	/**
     * The attributes that should be mutated to dates.
     * scratchcode.io
     * @var array
     */
    protected $dates = [ 'deleted_at' ];

	/**
	 * The rules that are defined the rule for upload.
	 *
	 * @var array
	 */
	protected $rules = [
		'media' 	=> 'required',
		'media.*' 	=> 'mimes:*',
	];

	/**
	 * The rules that are defined the rule for upload.
	 *
	 * @var array
	 */
	protected $messages = [
		'media' 	=> 'Media file is required',
		'media.*' 	=> 'A mime type is required'
	];

	/**
	 * The attribute that defines the base path for store media.
	 *
	 * @var array
	 */
	protected $basePath = 'media';
}
