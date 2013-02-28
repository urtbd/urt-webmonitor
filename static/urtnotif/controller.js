/**
 * Author: Abu Ashraf Masnun
 * URL: http://masnun.me
 */

function UrbanTerrorController($scope, $http) {
    $scope.server_list = [];

    for (x in configured_server_list) {
        var server_data = configured_server_list[x];
        var data = {"host": server_data['host'], "port": server_data['port'], "id": x};

        $http.post("urt.php", $.param(data), { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}})
            .success(function (response) {
                var server = {
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

