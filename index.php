<?php
/**
 * Author: Abu Ashraf Masnun
 * URL: http://masnun.me
 */

require_once 'config.php';

?>
<!DOCTYPE html>
<html lang="en" ng-app>
<head>
    <title>Urban Terror Server Monitor</title>

    <script type="text/javascript">
        configured_server_list = <?php echo json_encode($servers); ?>;
    </script>

    <link href="static/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="static/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="static/urtnotif/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="static/urtnotif/angular.min.js" type="text/javascript"></script>
    <script src="static/urtnotif/controller.js" type="text/javascript"></script>

    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }

        p.user a {
            color: #adff2f;
        }

    </style>


</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand">Urban Terror Server Monitor</a>


        </div>
    </div>
</div>

<div class="container" ng-controller="UrbanTerrorController">
    <div class="row">
        <div class="span12" ng-repeat="server in server_list">
            <h1>{{ server.name }}</h1>
            <br/>
            <span class="label label-inverse">Map</span> {{ server.configs.mapname }} &nbsp; &nbsp;
            <span class="label label-inverse">Host</span> {{ server.host }} &nbsp; &nbsp;
            <span class="label label-inverse">Port</span> {{ server.port }} &nbsp; &nbsp;
            <br/><br/>
            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Ping</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="player in server.players">
                    <td>{{ player.name }}</td>
                    <td>{{ player.score }}</td>
                    <td>{{ player.ping }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>