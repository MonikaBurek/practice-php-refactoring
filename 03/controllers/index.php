<?php

use Core\App;
use Core\Database;
use Core\Exceptions\QueryException;
use Core\QueryBuilderSimple;
use Core\QueryExecutor;
use Core\QueryValidator;

$qEx = new QueryExecutor(App::resolve(Database::class));
$builder = new QueryBuilderSimple(new QueryValidator(), $qEx);

try {
//    /**  SELECT  */
//    $result = $builder
//        ->table('users')
//        ->select()
//        ->limit(8)
//        ->where('id','=','100')
//        ->get();
    /**  DELETE WITHOUT WHERE */
$result = $builder
    ->table('users')
    ->delete()
    ->get();
}  catch (QueryException $e) {
    echo "Błąd zapytania: " . $e->getMessage();

}



//dd($result);