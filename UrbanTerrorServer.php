<?php
/**
 * Author: Abu Ashraf Masnun
 * URL: http://masnun.me
 */


class UrbanTerrorServer
{
    private $host;
    private $port;
    private $queryMessage = "\377\377\377\377getstatus";

    public function __construct($host, $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function getStatus()
    {
        $response = $this->_getRawResponse();
        $lines = explode("\n", $response);
        $serverData = explode("\\", $lines[1]);


        $serverConfigs = array();
        for ($i = 1; $i < count($serverData); $i = $i + 2) {
            $key = strtolower(trim($serverData[$i]));
            $val = trim($serverData[$i + 1]);
            $serverConfigs[$key] = $val;
        }

        $players = array();
        for ($i = 2; $i < count($lines); $i++) {

            if (!empty($lines[$i])) {

                $playerInfo = explode(' ', $lines[$i]);

                $name = "";
                for ($j = 2; $j < count($playerInfo); $j++) {
                    $name .= " {$playerInfo[$j]}";
                }

                $players[] = array(
                    "name" => str_replace('"', '', $name),
                    "score" => $playerInfo[0],
                    "ping" => $playerInfo[1]

                );
            }
        }

        $data = array(
            'server_configs' => $serverConfigs,
            'players' => $players
        );


        return $data;
    }

    private function _getRawResponse()
    {
        // Create UDP Socket
        if (!($sock = socket_create(AF_INET, SOCK_DGRAM, 0))) {
            throw new Exception(socket_strerror(socket_last_error()));
        }


        // Send the status query
        if (!socket_sendto($sock, $this->queryMessage, strlen($this->queryMessage), 0, $this->host, $this->port)) {
            throw new Exception(socket_strerror(socket_last_error()));
        }

        //Now receive reply from server and return it
        if (socket_recv($sock, $reply, 2045, MSG_WAITALL) === FALSE) {
            throw new Exception(socket_strerror(socket_last_error()));
        } else {
            return $reply;
        }

    }


}