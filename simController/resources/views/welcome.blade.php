<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul id="baggages">

                    </ul>
                    <div id="running"></div>


                    <a href="#" id="run" class="btn btn-success" role="button">Run</a>



                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('/js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/socket.io.js') }}"></script>

        <script type="text/javascript">
            var socket = io('http://localhost:3000');
            socket.on("baggage-channel:App\\Events\\BaggageCreated", function(msg) {
                $("#baggages").append("li", msg.data.id);
                //console.log("Incomming: " + msg);
            });

            $("#run").on("click", function() {
                $("#running").text("Running...");
                $.post("/run", function() {
                    $("#running").text("Completed...");
                });
            });

        </script>

    </body>
</html>
