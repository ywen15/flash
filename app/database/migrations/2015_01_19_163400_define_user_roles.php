<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefineUserRoles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$superadmin = array('name' => 'Master', 'permissions' => '{"superadmin":1,"admin":1,"billing":1,"representative":1}');
		$admin = array('name' => 'Admin', 'permissions' => '{admin":1,"representative":1}');
		$representative = array('name' => 'Representative', 'permissions' => '{"representative":1}');
		DB::table('groups')->insert(array($superadmin, $admin, $representative));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
