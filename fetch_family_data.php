<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start output buffering to prevent any output before JSON
ob_start();

// Database connection details
$host = 'localhost';
$db = 'postgres';
$user = 'postgres';
$pass = 'root';

// Function to handle and output errors as JSON
function handle_error($message)
{
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
$allowed_tables = [
    'ratanakosin',
    'lanchang',
    'sukothai',
    'kamenravak',
    'funan',
    'srivichai',
    'tampornling',
    'janela',
    'hripunchai',
    'lanna',
    'panakorn',
    'lavo',
    'ayuttaya',
    'cotraboon'
];

if (!in_array($table, $allowed_tables)) {
    handle_error('Invalid table name');
}

// Function to fetch data from a specified table
function fetch_family_data($conn, $table)
{
    $query = "SELECT id, parent_id, name, relationship, birth, death, img, tags, monarch, wife, child, father, mother, urlking, ppid, reignstart, reignend, gender, latitude, longitude FROM public.$table";
    $result = pg_query($conn, $query);

    if (!$result) {
        handle_error('Query failed: ' . pg_last_error());
    }

    $family = [];
    while ($row = pg_fetch_assoc($result)) {
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

// Output JSON, ensure no other output comes before this
header('Content-Type: application/json');
ob_end_clean(); // Clear the output buffer to remove any preceding content
echo json_encode($family);
?>