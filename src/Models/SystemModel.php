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
 * Class SystemModel
 */
class SystemModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/system';

    /**
     * @return ResponseInterface
     */
    public function pingServer() : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/ping');
    }

    /**
     * @return ResponseInterface
     */
    public function recycleDatabaseConnections() : ResponseInterface
    {
        $customEndpoint = '/database';
        return $this->client->post($customEndpoint . '/recycle');
    }

    /**
     * @return ResponseInterface
     */
    public function sendTestEmail() : ResponseInterface
    {
        $customEndpoint = '/email';
        return $this->client->post($customEndpoint . '/test');
    }

    /**
     * @return ResponseInterface
     */
    public function getConfiguration() : ResponseInterface
    {
        $customEndpoint = '/config';
        return $this->client->get($customEndpoint);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateConfiguration(array $requestOptions) : ResponseInterface
    {
        $customEndpoint = '/config';
        return $this->client->put($customEndpoint, $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function reloadConfiguration() : ResponseInterface
    {
        $customEndpoint = '/config';
        return $this->client->post($customEndpoint . '/reload');
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getClientConfiguration(array $requestOptions) : ResponseInterface
    {
        $customEndpoint = '/config';
        return $this->client->get($customEndpoint . '/client', $requestOptions);
    }

    /**
     * @param $requestOptions
     *
     * @return ResponseInterface
     */
    public function getClientLicense(array $requestOptions) : ResponseInterface
    {
        $customEndpoint = '/license';
        return $this->client->get($customEndpoint . '/client', $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function removeLicenseFile() : ResponseInterface
    {
        $customEndpoint = '/license';
        return $this->client->delete($customEndpoint);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function uploadLicenseFile(array $requestOptions) : ResponseInterface
    {
        $customEndpoint = '/license';
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['license']);

        return $this->client->post($customEndpoint, $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getAudits(array $requestOptions) : ResponseInterface
    {
        $customEndpoint = '/audits';
        return $this->client->get($customEndpoint, $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function invalidateAllCaches() : ResponseInterface
    {
        $customEndpoint = '/caches';
        return $this->client->post($customEndpoint . '/invalidate');
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getLogs(array $requestOptions) : ResponseInterface
    {
        $customEndpoint = '/logs';
        return $this->client->get($customEndpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function addLogMessage(array $requestOptions) : ResponseInterface
    {
        $customEndpoint = '/logs';
        return $this->client->post($customEndpoint, $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function getWebRtcToken() : ResponseInterface
    {
        $customEndpoint = '/webrtc';
        return $this->client->get($customEndpoint . '/token');
    }

    /**
     * @return ResponseInterface
     */
    public function getAnalytics() : ResponseInterface
    {
        $customEndpoint = '/analytics';
        return $this->client->get($customEndpoint . '/old');
    }
}
