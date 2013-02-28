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

    <script type="text/javascript">
        $(document).ready(function () {
            $("a#start_mon").hide();
            $("a#stop_dn").hide();

            if (!window.webkitNotifications) {
                $("a#start_dn").hide();
            }

        })

    </script>

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
<body ng-controller="UrbanTerrorController">
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand">Urban Terror Server Monitor</a>


            <p class="pull-right">
                <a class="btn btn-success" id="start_mon" ng-click="startMonitoring()">Start Monitoring</a>
                <a class="btn btn-danger" id="stop_mon" ng-click="stopMonitoring()">Stop Monitoring</a>

                <a class="btn btn-success" id="start_dn" ng-click="startDN()">Enable Desktop Notification</a>
                <a class="btn btn-danger" id="stop_dn" ng-click="stopDN()">Disable Desktop Notification</a>
            </p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="span12">
            <div ng-repeat="server in server_list">
                <h1>{{ server.name }}</h1>
                <br/>
                <span class="label label-inverse">Map</span> {{ server.configs.mapname }} &nbsp; &nbsp;
                <span class="label label-inverse">Host</span> {{ server.host }} &nbsp; &nbsp;
                <span class="label label-inverse">Port</span> {{ server.port }} &nbsp; &nbsp;
                <a class="btn" ng-click="updateServer(server)">Update</a>
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
</div>

<br/><br/>

<footer>
    <center><a target="_blank" href="https://github.com/masnun/urtweb">Fork on Github!</a></center>
</footer>

</body>
</html>