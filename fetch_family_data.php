<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$host = 'localhost';
$db = 'postgres';  // Replace with your actual database name
$user = 'postgres'; // Replace with your actual database username
$pass = 'root'; // Replace with your actual database password

// Function to handle and output errors as JSON
function handle_error($message) {
    header('Content-Type: application/json');
    echo json_encode(['error' => $message]);
    exit;
}

// Connect to PostgreSQL
$conn = pg_connect("host=$host dbname=$db user=$user password=$pass");
if (!$conn) {
    handle_error('Connection failed: ' . pg_last_error());
}

// Get the table name from the request and validate it
$table = isset($_GET['table']) ? pg_escape_string($_GET['table']) : 'ratanakosin';

// List of allowed table names
$allowed_tables = ['ratanakosin', 'lanchang', 'sukothai', 'kamenravak', 'funan', 'srivichai', 
                    'tampornling', 'janela', 'hripunchai', 'lanna', 'panakorn', 'lavo', 'ayuttaya'];

if (!in_array($table, $allowed_tables)) {
    handle_error('Invalid table name');
}

// Function to fetch data from a specified table
function fetch_family_data($conn, $table) {
    // Fetch family data from the specified table
    $query = "SELECT id, parent_id, name, relationship, birth, death, img, tags, monarch, wife, child, father, mother, urlking FROM public.$table";
    $result = pg_query($conn, $query);

    if (!$result) {
        handle_error('Query failed: ' . pg_last_error());
    }

    $family = [];
    while ($row = pg_fetch_assoc($result)) {
        // Ensure that tags is returned as an array
        if (isset($row['tags'])) {
            $row['tags'] = explode(',', trim($row['tags'], '{}'));
        }
        $family[] = $row;
    }

    return $family;
}

// Fetch the family data
$family = fetch_family_data($conn, $table);
pg_close($conn);

// Encode data to JSON
header('Content-Type: application/json');
echo json_encode($family);
?>
