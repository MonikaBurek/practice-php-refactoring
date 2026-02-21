<?php

use Core\App;
use Core\Database;
use Core\QueryBuilderSimple;
use Core\QueryExecutor;
use Core\QueryValidator;

$qEx = new QueryExecutor(App::resolve(Database::class));
$builder = new QueryBuilderSimple(new QueryValidator(), $qEx);

/**  SELECT  */
//$result = $builder
//    ->table('users')
//    ->select()
//    ->limit(8)
////->where('id','=','60')
//    ->get();
//dd($result);

/**  INSERT  */
//$result = $builder
//    ->table('users')
//    ->insert(['name' => 'Kamil' ,'email' => 'kamil22test@wp.pl','password' => 'password'])
//    ->get();

/**  DELETE  */
//$result = $builder
//    ->table('users')
//    ->delete()
//    ->where('id','=','60')
//    ->get();

/**  DELETE WITHOUT WHERE */
//$result = $builder
//    ->table('users')
//    ->delete()
//    ->get();

/**  UPDATE */
//$result = $builder
//    ->table('users')
//    ->update(['name' => 'Test2' ,'email' => 'testUpdatea2@wp.pl'])
//    ->where('id','=','99')
//    ->get();

/**  UPDATE WITHOUT WHERE */
//$result = $builder
//    ->table('users')
//    ->update(['name' => 'Test2' ,'email' => 'testUpdatea2@wp.pl'])
//    ->get();

//dd($result);

$builder->reset();