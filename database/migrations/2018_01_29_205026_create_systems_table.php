<?php
use Illuminate\Support\Facades\Schema; use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class CreateSystemsTable extends Migration { public function up() { Schema::create('systems', function (Blueprint $sp2e26b5) { $sp2e26b5->increments('id'); $sp2e26b5->string('name', 100)->unique(); $sp2e26b5->longText('value')->nullable(); $sp2e26b5->timestamps(); }); } public function down() { Schema::dropIfExists('systems'); } }