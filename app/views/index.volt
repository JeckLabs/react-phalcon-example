<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>
        
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->url->get('img/favicon.ico')?>"/>
    </head>
    <body style="width: 600px; margin: 0 auto;">

        <div id="app"></div>

        {{ react_component('HelloButton', {"name": "Evgeniy", "variant": "contained", "color": "primary"}) }}
        <hr>
        {{ react_component('HelloButton', {"name": "Igor", "variant": "contained", "color": "secondary"}) }}
        <hr>
        {{ react_component('SimpleCard') }}

        <script src="/dist/app.bundle.js"></script>

        </div>
    </body>
</html>
