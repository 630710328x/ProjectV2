<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Tree</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
</head>
<body>
    <header>
        <h1>Family Tree</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="family_tree.php" class="active">Family Tree</a></li>
            </ul>
        </nav>
    </header>
    <div id="controls">
        <label for="tableSelect">Select Table: </label>
        <select id="tableSelect" name="tableSelect" aria-label="Select Family Table">
            <option value="ratanakosin">Ratanakosin</option>
            <option value="lanchang">Lanchang</option>
            <option value="sukothai">Sukothai</option>
            <option value="kamenravak">Kamenravak</option>
            <option value="funan">Funan</option>
            <option value="srivichai">Srivichai</option>
            <option value="tampornling">Tampornling</option>
            <option value="janela">Janela</option>
        </select>
    </div>
    <div id="loading" style="display:none;">Loading...</div>
    <div id="tree" aria-live="polite"></div>
    <div id="error" role="alert" style="display:none; color:red;"></div>

    <script src="scripts.js"></script>
</body>
</html>
