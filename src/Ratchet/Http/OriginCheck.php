<?php
namespace Ratchet\Http;
use Guzzle\Http\Message\RequestInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\DataComponentInterface;
use Guzzle\Http\Message\Response;

/**
 * A middleware to ensure JavaScript clients connecting are from the expected domain.
 * This protects other websites from open WebSocket connections to your application.
 * Note: This can be spoofed from non-web browser clients
 */
class OriginCheck implements HttpServerInterface {
    /**
     * @var \Ratchet\Server\DataComponentInterface
     */
    protected $_component;

    public $allowedOrigins = array();

    /**
     * @param \Ratchet\Server\DataComponentInterface $component Component/Application to decorate
     * @param array                                  $allowed An array of allowed domains that are allowed to connect from
     * @todo Shouldn't the first parameter by an HttpServerInterface???
     * @note See above
     */
    public function __construct(DataComponentInterface $component, array $allowed = array()) {
        $this->_component = $component;
        $this->allowedOrigins += $allowed;
    }

    /**
     * {@inheritdoc}
     */
    public function onOpen(ConnectionInterface $conn, RequestInterface $request = null) {
        $header = (string)$request->getHeader('Origin');
        $origin = parse_url($header, PHP_URL_HOST) ?: $header;

        if (!in_array($origin, $this->allowedOrigins)) {
            return $this->close($conn, 403);
        }

        return $this->_component->onOpen($conn, $request);
    }

    /**
     * {@inheritdoc}
     */
    function onData(ConnectionInterface $from, $chunk) {
        return $this->_component->onData($from, $chunk);
    }

    /**
     * {@inheritdoc}
     */
    function onClose(ConnectionInterface $conn) {
        return $this->_component->onClose($conn);
    }

    /**
     * {@inheritdoc}
     */
    function onError(ConnectionInterface $conn, \Exception $e) {
        return $this->_component->onError($conn, $e);
    }

    /**
     * Close a connection with an HTTP response
     * @param \Ratchet\ConnectionInterface $conn
     * @param int                          $code HTTP status code
     * @return null
     */
    protected function close(ConnectionInterface $conn, $code = 400) {
        $response = new Response($code, array(
            'X-Powered-By' => \Ratchet\VERSION
        ));

        $conn->send((string)$response);
        $conn->close();
    }
}
