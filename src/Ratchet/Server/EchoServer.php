<?php
namespace Ratchet\Server;
use Ratchet\ConnectionInterface;

/**
 * A simple Ratchet application that will reply to all messages with the message it received
 */
class EchoServer implements DataComponentInterface {
    public function onOpen(ConnectionInterface $conn) {
    }

    public function onData(ConnectionInterface $from, $chunk) {
        $from->send($chunk);
    }

    public function onClose(ConnectionInterface $conn) {
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}
