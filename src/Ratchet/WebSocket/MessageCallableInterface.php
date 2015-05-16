<?php
namespace Ratchet\WebSocket;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\Version\MessageInterface;

interface MessageCallableInterface {
    public function onMessage(ConnectionInterface $conn, MessageInterface $msg);
}