<?php

use App\Core\App;
use App\Core\Database;
use App\Services\AuthService;

$heading = 'Notes';
$currentUser = (new AuthService())->getAuthenticatedUser();

$queryParams = [
    'user' => $currentUser['id'],
];

$statement = 'SELECT * FROM notes where user_id = :user '; // write a sql query

try {
    $db = App::resolve(Database::class);
    $connection = $db->query($statement, $queryParams);
    $notes = $connection->get();
} catch (Exception $e) {
    die($e->getMessage());
}

return view('notes/index', compact('heading', 'notes'));
