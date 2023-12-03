<?php

// Load Laravel's environment
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Item; // Update with your model namespace

// Define a route for the GET endpoint
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/api/items') {
    // Fetch data from the database using Eloquent
    $items = Item::all()->toArray(); // Retrieves all items from the 'items' table and converts to array

    // Set the response headers to return JSON
    header('Content-Type: application/json');
    
    // Return the fetched data as JSON
    echo json_encode($items);
    exit;
} else {
    // Handle other routes or requests (if needed)
    http_response_code(404); // Return a 404 status for routes other than /api/items
    echo json_encode(['error' => 'Route not found']);
    exit;
}