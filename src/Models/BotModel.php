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

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BotModel
 */
class BotModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/bots';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createBot(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getBots(array $requestOptions = []) : ResponseInterface
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param       $botUserId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function patchBot($botUserId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $botUserId, $requestOptions);
    }

    /**
     * @param       $botUserId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getBot($botUserId, array $requestOptions = []) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $botUserId, $requestOptions);
    }

    /**
     * @param $botUserId
     *
     * @return ResponseInterface
     */
    public function disableBot($botUserId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $botUserId . '/disable');
    }

    /**
     * @param $botUserId
     *
     * @return ResponseInterface
     */
    public function enableBot($botUserId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $botUserId . '/enable');
    }

    /**
     * @param $botUserId
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function assignBotToUser($botUserId, $userId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $botUserId . '/assign/' . $userId);
    }

    /**
     * @param $botUserId
     *
     * @return ResponseInterface
     */
    public function getBotIcon($botUserId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $botUserId . '/icon');
    }

    /**
     * @param $botUserId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function setBotIcon($botUserId, array $requestOptions) : ResponseInterface
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['image']);

        return $this->client->post(self::$endpoint . '/' . $botUserId . '/icon', $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @param $botUserId
     *
     * @return ResponseInterface
     */
    public function deleteBotIcon($botUserId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $botUserId . '/icon');
    }
}
