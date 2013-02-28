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
        $data = explode("\\",$lines[1]);

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