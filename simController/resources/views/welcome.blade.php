<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />

    </head>
    <body>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-xs-2">
                    <a href="#" id="run" class="btn btn-success" role="button">Run</a>
                    <span id="running"></span>
                </div>
                <div class="col-xs-10">
                    <div class="progress">
                        <div id="queue-progress" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                            0%
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
            var _counter = 0;
            var _total = 0;

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
                _counter++;
                setProgressValue(Math.round((_counter/_total) * 100));
            });

            $("#run").on("click", function() {
                $("#running").text("Running...");
                $.post("/run", function() {
                    $("#running").text("");
                }).done(function(data) {
                    _total = data;
                    console.log(data.length);
                });
                //setProgressValue(60);
            });

            function setProgressValue(_progressVal) {
                var _queueProgress = $("#queue-progress");
                _queueProgress.css("width", _progressVal+"%");
                _queueProgress.text(_progressVal+"%");
                _queueProgress.attr("aria-valuenow", _progressVal);
            }

        </script>

    </body>
</html>
