<?php
namespace Ratchet;
use Ratchet\ConnectionInterface;
use Ratchet\Server\DataComponentInterface;
use Ratchet\WebSocket\WsServerInterface;
use Ratchet\Wamp\WampServerInterface;

class NullComponent implements DataComponentInterface, WsServerInterface, WampServerInterface {
    public function onOpen(ConnectionInterface $conn) {}

// TODO: Implement the interface and `use` the MessageInterface (when it's finalized)
//    public function onMessage(ConnectionInterface $msg, MessageInterface $data);

    public function onData(ConnectionInterface $conn, $chunk) {}

    public function onClose(ConnectionInterface $conn) {}

    public function onError(ConnectionInterface $conn, \Exception $e) {}

    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {}

    public function onSubscribe(ConnectionInterface $conn, $topic) {}

    public function onUnSubscribe(ConnectionInterface $conn, $topic) {}

    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude = array(), array $eligible = array()) {}

    public function getSubProtocols() {
        return array();
    }
}
