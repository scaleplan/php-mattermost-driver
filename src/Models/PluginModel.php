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
 * Class PluginModel
 */
class PluginModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/plugins';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function uploadPlugin(array $requestOptions) : ResponseInterface
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['plugin']);

        return $this->client->post(self::$endpoint, $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @return ResponseInterface
     */
    public function getPlugins() : ResponseInterface
    {
        return $this->client->get(self::$endpoint);
    }

    /**
     * @param $pluginId
     *
     * @return ResponseInterface
     */
    public function removePlugin($pluginId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $pluginId);
    }

    /**
     * @param $pluginId
     *
     * @return ResponseInterface
     */
    public function activePlugin($pluginId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $pluginId . '/activate');
    }

    /**
     * @param $pluginId
     *
     * @return ResponseInterface
     */
    public function deactivePlugin($pluginId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $pluginId . '/deactivate');
    }

    /**
     * @return ResponseInterface
     */
    public function getWebappPlugins() : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/webapp');
    }
}
