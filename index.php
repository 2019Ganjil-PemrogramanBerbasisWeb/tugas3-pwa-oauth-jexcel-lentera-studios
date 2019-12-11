<html>
    <head>
        <title>Twibbon.in</title>
        <link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="manifest" href="manifest.json">
        <meta name="description" content="Pasang Twibbon ILITS Anda">
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            // This is the "Offline page" service worker

            // Add this below content to your HTML page, or add the js file to your page at the very top to register service worker

            // Check compatibility for the browser we're running this in
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('swork.js', {scope: './'})
                        .then((reg) => {
                        console.log('Service worker registered.', reg);
                        });
                });
            } else{
                console.log("Active service worker found, no need to register");
            }
        </script>
    </head>
    <body>
        <div class="row no-gutters">
            <div id="left" class="col-6">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col-4">
                        <img src="img/hero.svg" alt="" style="text-align: center;">
                    </div>
                </div>
            </div>
            <div id="right" class="col-6">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col-8">
                        <button class="add-button">Install</button>
                        <form action="place.php" method="POST" enctype="multipart/form-data">
                            <input type="file" name="gambarUser" id="gambarUser">
                            <input type="submit" value="Twib" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>