<?php ?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            font-size: 1em;
        }

        .ui-draggable, .ui-droppable {
            background-position: top;
        }

    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $( function() {


            $( "#birds" ).autocomplete({
                source: "search.php",
                minLength: 2,

            });
        } );
    </script>
</head>
<body>

<div class="ui-widget">
    <label for="birds">Birds: </label>
    <input id="birds">
</div>




</body>
</html>