/**
 * Author: Abu Ashraf Masnun
 * URL: http://masnun.me
 */

function UrbanTerrorController($scope, $http) {
    $scope.server_list = [];
    loadServers();
    startMonitoring();


    $scope.updateServer = function (server) {
        updateServerData(server);
    }

    $scope.startMonitoring = function () {
        startMonitoring();
        $("a#start_mon").hide();
        $("a#stop_mon").show();
    }

    $scope.stopMonitoring = function () {
        clearTimeout($scope.timer);
        $("a#stop_mon").hide();
        $("a#start_mon").show();
    }

    $scope.startDN = function () {
        enableDesktopNotifications();
    }

    $scope.stopDN = function () {
        $scope.desktop_notification = false;
        sendDesktopNotification('Urban Terror Server Monitor', 'Desktop Notification has been disabled!');
        $("a#stop_dn").hide();
        $("a#start_dn").show();
    }


    // Helpers

    function enableDesktopNotifications() {
        if (window.webkitNotifications.checkPermission() == 0) { // 0 is PERMISSION_ALLOWED
            sendDesktopNotification('Urban Terror Server Monitor', 'Desktop Notification has been enabled!');
            $scope.desktop_notification = true;
            $("a#start_dn").hide();
            $("a#stop_dn").show();
        } else {
            window.webkitNotifications.requestPermission();
        }
    }

    function sendDesktopNotification(title, message) {
        var notif = window.webkitNotifications.createNotification('', title, message);
        notif.ondisplay = function () {
            setTimeout(function () {
                notif.cancel();
            }, 5000);
        }
        notif.show();
    }

    function startMonitoring() {
        $scope.timer = setTimeout(function () {
            updateAllServers();
        }, 10000);
    }

    function updateAllServers() {
        for (x in $scope.server_list) {
            var server = $scope.server_list[x];
            updateServerData(server);
        }

        startMonitoring();
    }

    function updateServerData(server) {
        var data = {"host": server['host'], "port": server['port'], "id": server['id']};
        $http.post("status.php", $.param(data), { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}})
            .success(function (response) {
                server.players = response.data.players;
                server.configs = response.data.server_configs;
            })
    }


    function loadServers() {

        for (x in configured_server_list) {
            var server_data = configured_server_list[x];
            var data = {"host": server_data['host'], "port": server_data['port'], "id": x};

            $http.post("status.php", $.param(data), { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}})
                .success(function (response) {
                    var server_data = configured_server_list[response.id]
                    var server = {
                        'id': response['id'],
                        'name': server_data['name'],
                        'host': server_data['host'],
                        'port': server_data['port'],
                        'players': response.data.players,
                        'configs': response.data.server_configs

                    }

                    $scope.server_list.push(server);
                })


        }

    }


}

