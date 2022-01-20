<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <style>
        body { background: #000; color: #999; font-family: monospace, sans-serif; }
        h1, h2 { color: #ccc; }
        .randomness { cursor: pointer; font-weight: bold; color: #0a0; }
        .randomness:hover { color: #0c0; }
        .errors { color: #a00; }
    </style>
</head>
<body>

    <noscript>This app needs JavaScript to work.</noscript>


    <h1>random-api</h1>
    <p>
        Work in progress.
        <a data-uikey="apiEndpointPath">Endpoint is here</a>.
    </p>

    <h2>Randomness</h2>
    <p>
        Random value of the moment. Click to refresh:
    </p>
    <p>
        <span data-uikey="randomness">...</span>
    </p>
    <p data-uikey="errors"></p>

    <hr>

    <script src="./lib/main.js" type="module"></script>
</body>
</html>
