<?php

namespace App\Shared;


use Illuminate\Support\Facades\DB;

class GlobalService
{

	private static $deliveryZone = array(
		1 => 'Demra',
		2 => 'Dhaka Cantt.',
		3 => 'Dhamrai',
		4 => 'Dhanmondi',
		5 => 'Gulshan',
		6 => 'Jatrabari',
		7 => 'Joypara',
		8 => 'Keraniganj',
		9 => 'Khilgaon',
		10 => 'Khilkhet',
		11 => 'Lalbag',
		12 => 'Mirpur',
		13 => 'Mohammadpur',
		14 => 'Motijheel',
		15 => 'Nawabganj',
		16 => 'New market',
		17 => 'Palton',
		18 => 'Ramna',
		19 => 'Sabujbag',
		20 => 'Savar',
		21 => 'Sutrapur',
		22 => 'Tejgaon',
		23 => 'Tejgaon Industrial Area',
		24 => 'Uttara'
	);
	private static $heightUnit = array(
		1 => ['id' => 1, 'unitName' => 'Inch'],
		2 => ['id' => 2, 'unitName' => 'Centimeter'],
		3 => ['id' => 3, 'unitName' => 'Meter'],
		4 => ['id' => 4, 'unitName' => 'Feet']
	);
	private static $weightUnit = array(
		1 => ['id' => 1, 'unitName' => 'Gram'],
		2 => ['id' => 2, 'unitName' => 'Kilogram'],
		3 => ['id' => 3, 'unitName' => 'Pound'],
		4 => ['id' => 4, 'unitName' => 'Ton']
	);

	private static $orderStatus = array(
		1=>['id'=>1,'statusName'=>'Requested','color'=>'primary'],
		2=>['id'=>2,'statusName'=>'On Route','color'=>'info'],
		3=>['id'=>3,'statusName'=>'Delivered','color'=>'success'],
		4=>['id'=>4,'statusName'=>'Canceled','color'=>'danger']
	);

	public static function getZoneList()
	{
		return static::$deliveryZone;
	}

	public static function getHeightUnit()
	{
		return static::$heightUnit;
	}

	public static function getWeightUnit()
	{
		return static::$weightUnit;
	}


	public static function getStatusList()
	{
		return static::$orderStatus;
	}

	public static function getLatestId($tableName)
	{
		$object = DB::table($tableName)->orderBy('id', 'DESC')->first();
		if ($object == null) return 1;
		return $object->id + 1;
	}


}