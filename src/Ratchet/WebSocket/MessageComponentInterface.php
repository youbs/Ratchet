<?php
namespace Ratchet\WebSocket;
use Ratchet\ComponentInterface;

/**
 * @todo Figure out what to do about MessageInterface...
 *       It may be hosted in the new RFC6455 repository
 *       How can this be done without a circular dependency
 *       or creating too many objects for a single connection?
 */
interface MessageComponentInterface extends ComponentInterface, MessageCallableInterface {
}
