<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <a href="#" id="run" class="btn btn-success" role="button">Run</a>
                    <span id="running"></span>
                </div>
                <div class="col-xs-10">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                            60%
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12">

                    <table id="baggages" class="table">
                        <thead>
                            <tr>
                                <th>PassengerId</th>
                                <th>Bordkartennummer</th>
                                <th>Name</th>
                                <th>Geschlecht</th>
                                <th>Gepäckstücke</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('/js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/socket.io.js') }}"></script>

        <script type="text/javascript">
            var counter = 0;

            var socket = io('http://localhost:3000');
            socket.on("baggage-channel:App\\Events\\BaggageCreated", function(msg) {
                $("#baggages tbody").append(
                    "<tr>" +
                    "<td>" + msg.data.Id + "</td>" +
                    "<td>" + msg.data.Bordkartennummer + "</td>" +
                    "<td>" + msg.data.Vorname + " " + msg.data.Nachname + "</td>" +
                    "<td>" + msg.data.Geschlecht + "</td>" +
                    "<td>" + msg.data.baggages.length + "</td>" +
                    "</tr>"
                );
            });

            $("#run").on("click", function() {
                $("#running").text("Running...");
                $.post("/run", function() {
                    $("#running").text("");
                });
            });

        </script>

    </body>
</html>
