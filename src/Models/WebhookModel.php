<?php
declare(strict_types=1);

/**
 * This Driver is based entirely on official documentation of the Mattermost Web
 * Services API and you can extend it by following the directives of the documentation.
 *
 * God bless this mess.
 *
 * @author Luca Agnello <luca@gnello.com>
 * @link https://api.mattermost.com/
 */

namespace Scaleplan\Mattermost\Models;

use Psr\Http\Message\ResponseInterface;

/**
 * Class WebhookModel
 */
class WebhookModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/hooks';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createIncomingWebhook(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/incoming', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function listIncomingWebhooks(array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/incoming', $requestOptions);
    }

    /**
     * @param       $hookId
     *
     * @return ResponseInterface
     */
    public function getIncomingWebhook($hookId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/incoming/' . $hookId);
    }

    /**
     * @param       $hookId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateIncomingWebhook($hookId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/incoming/' . $hookId, $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createOutgoingWebhook(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/outgoing', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function listOutgoingWebhooks(array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/outgoing', $requestOptions);
    }

    /**
     * @param       $hookId
     *
     * @return ResponseInterface
     */
    public function getOutgoingWebhook($hookId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/outgoing/' . $hookId);
    }

    /**
     * @param       $hookId
     *
     * @return ResponseInterface
     */
    public function deleteOutgoingWebhook($hookId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/outgoing/' . $hookId);
    }

    /**
     * @param       $hookId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateOutgoingWebhook($hookId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/outgoing/' . $hookId, $requestOptions);
    }

    /**
     * @param       $hookId
     *
     * @return ResponseInterface
     */
    public function regenerateTokenForOutgoingWebhook($hookId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/outgoing/' . $hookId . '/regen_token');
    }
}
