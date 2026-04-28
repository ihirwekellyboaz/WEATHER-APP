<?php
$location = $_GET["location"] ?? "kigali";
$url = "https://api.weatherapi.com/v1/current.json?key=26d14a2e275744a1a08193244261303&q=".$location."&aqi=no";

$response = @file_get_contents($url);
$data = $response ? json_decode($response, true) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title> 
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-500 to-indigo-600 min-h-screen flex items-center justify-center">

    <div   class="bg-white shadow-xl rounded-2xl p-6 w-full max-w-md text-center">
        
        <h1 class="text-2xl font-bold text-gray-800 mb-4"> Weather App</h1>

        <form action="index.php" method="get" class="flex gap-2 mb-6">
            <input 
                type="text" 
                name="location" 
                placeholder="Enter location"
                class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            <button 
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
            >
                Search
            </button>
        </form>

        <?php if ($data && isset($data["location"])): ?>
            <div class="space-y-2 text-gray-700">
                <p class="text-lg font-semibold">
                    <?= $data["location"]["name"]; ?>, <?= $data["location"]["country"]; ?>
                </p>
                <p>Region: <?= $data["location"]["region"]; ?></p>
                <p class="text-3xl font-bold text-blue-600">
                    <?= $data["current"]["temp_c"]; ?>°C
                </p>
                <p class="text-sm text-gray-500">
                    Updated: <?= $data["current"]["last_updated"]; ?>
                </p>
                    <p  style="margin-left:45%" class="text-sm text-gray-500 items-center justify-center">
                    <img src="<?= $data["current"]["condition"]["icon"]; ?>" alt="no image found">
                </p>
            </div>
        <?php else: ?>
            <p class="text-red-500">Unable to fetch weather data.</p>
        <?php endif; ?>
<p> hello </p>
    </div>

</body>
</html>
