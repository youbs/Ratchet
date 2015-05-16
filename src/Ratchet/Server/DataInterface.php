<?php
namespace Ratchet\Server;
use Ratchet\ConnectionInterface;

interface DataInterface {
    /**
     * Triggered when data is sent through a connection
     * @param  \Ratchet\ConnectionInterface $from  The connection that sent the message to your application
     * @param  string                       $chunk The message received
     * @throws \Exception
     */
    function onData(ConnectionInterface $from, $chunk);
}
