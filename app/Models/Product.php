<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
		use HasFactory;

		protected $fillable = [
			'name',
			'category_Id',
			'size',
			'height',
			'height_unit_id',
			'weight',
			'weight_unit_id',
			'qty',
			'delivery_zone',
			'delivery_address',
		];
}
