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
 * Class SchemeModel
 */
class SchemeModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/schemes';

    /**
     * @return ResponseInterface
     */
    public function getSchemes() : ResponseInterface
    {
        return $this->client->get(self::$endpoint);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createScheme(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param $schemeId
     *
     * @return ResponseInterface
     */
    public function getScheme($schemeId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $schemeId);
    }

    /**
     * @param $schemeId
     *
     * @return ResponseInterface
     */
    public function deleteScheme($schemeId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $schemeId);
    }

    /**
     * @param       $schemeId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function patchScheme($schemeId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $schemeId . '/patch', $requestOptions);
    }

    /**
     * @param       $schemeId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getTeamsOfScheme($schemeId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $schemeId . '/teams', $requestOptions);
    }

    /**
     * @param       $schemeId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getChannelsOfScheme($schemeId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $schemeId . '/channels', $requestOptions);
    }
}
