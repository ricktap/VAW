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
                    <a href="#" id="run" class="btn btn-success" role="button">Run</a>
                    <span id="running"></span>

                    <hr />

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
            var queueElements = 0;

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
