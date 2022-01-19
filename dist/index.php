<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>random-api</title>
</head>
<body>

    <!-- index page just shows one random value. help and stuff on other pages. -->


    <p class="splash-value"></p>

    <script>
        function randomArrayItem(arr) {
            return arr[Math.floor(Math.random() * arr.length)]
        }


        const APP = {
            conf: {
                tables: [
                    'primes',
                    'names',
                ],
            },

            main() {
                this.updateSplashValue()
            },

            apiRequest(request, callback) {
                fetch(`./api.php?r=${request}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not OK')
                    }
                    return response.json()
                })
                .then(data => {
                    console.log('apiRequest data:', data)
                    this.setSplashValue(data)
                })
                .catch(error => {
                    console.error('apiRequest error:', error)
                })
            },

            updateSplashValue() {
                this.apiRequest(randomArrayItem(this.conf.tables), 'setSplashValue')
            },

            setSplashValue(responseData) {
                let e = document.querySelector('.splash-value')
                e.innerHTML = responseData.data.val
            },

        }


        APP.main()
    </script>

</body>
</html>
