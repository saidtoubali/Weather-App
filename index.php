<html>
    <head>
        <title>Weather App</title>
        <link rel="icon" type="image/png" href="weather app icon.png">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="container">
            <h1>A Moroccan Weather App from Said</h1>
            <form method="POST">
                <label for="city">Choose a city</label>
                <select name="city" id="city">
                    <option value="Casablanca">Casablanca</option>
                    <option value="Agadir">Agadir</option>
                    <option value="Khouribga">Khouribga</option>
                    <option value="Rabat">Rabat</option>
                    <option value="Oujda">Oujda</option>
                    <option value="Tangier">Tangier</option>
                    <option value="Taroudant">Taroudant</option>
                    <option value="Fes">Fes</option>
                    <option value="Sale">Sale</option>
                    <option value="Meknes">Meknes</option>
                    <option value="Kenitra">Kenitra</option>
                </select>
                <button type="submit" name="getweather">Get Temperature</button>
            </form>
            <div id="result">
                <?php
                if (isset($_POST['getweather'])) {
                    $city = $_POST['city'];
                    $apiKey = 'Your_API_Key';
                    $url = "https://api.openweathermap.org/data/2.5/weather?q=$city,MA&appid=$apiKey&units=metric";

                    $request = curl_init();
                    curl_setopt($request, CURLOPT_URL, $url);
                    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($request);
                    curl_close($request);

                    if ($response) {
                        $data = json_decode($response, false);

                        if (isset($data->main->temp)) {
                            $temp = $data->main->temp;
                            $description = $data->weather[0]->description;
                            $max_temp = $data->main->temp_max;
                            $min_temp = $data->main->temp_min;
                            $feel_like = $data->main->feels_like;
                            $pressure = $data->main->pressure;

                            echo "<p>The temperature in $city is {$temp}°C but you will fell like it {$feel_like}°C
                             with {$description}.
                             The pressure is {$pressure}Pa.
                             The max temperature will be {$max_temp}°C and 
                             the minimum temperature wil be {$min_temp}°C .</p>";

                        } else {
                            echo "<p>Could not retrieve temperature data for $city. Please try again.</p>";
                        }
                    } else {
                        echo "<p>Error: Could not connect to the API. Please check your connection or API key.</p>";
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
