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
 * Class OAuthModel
 */
class OAuthModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/oauth';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function registerOAuthApp(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/apps', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getOAuthApps(array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/apps', $requestOptions);
    }

    /**
     * @param $appId
     *
     * @return ResponseInterface
     */
    public function getOAuthApp($appId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/apps/' . $appId);
    }

    /**
     * @param $appId
     *
     * @return ResponseInterface
     */
    public function deleteOAuthApp($appId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/apps/' . $appId);
    }

    /**
     * @param $appId
     *
     * @return ResponseInterface
     */
    public function regenerateOAuthAppSecret($appId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/apps/' . $appId . '/regen_secret');
    }

    /**
     * @param $appId
     *
     * @return ResponseInterface
     */
    public function getOAuthAppInfo($appId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/apps/' . $appId . '/info');
    }

    /**
     * @param $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getAuthorizedOAuthApps($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/oauth/apps/authorized', $requestOptions);
    }
}
