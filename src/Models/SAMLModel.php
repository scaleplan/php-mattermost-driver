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
 * Class SAMLModel
 */
class SAMLModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/saml';

    /**
     * @return ResponseInterface
     */
    public function getMetadata() : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/metadata');
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function uploadIDPCertificate(array $requestOptions) : ResponseInterface
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['certificate']);

        return $this->client->post(self::$endpoint . '/certificate/idp', $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @return ResponseInterface
     */
    public function removeIDPCertificate() : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/certificate/idp');
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function uploadPublicCertificate(array $requestOptions) : ResponseInterface
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['certificate']);

        return $this->client->post(self::$endpoint . '/certificate/public', $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @return ResponseInterface
     */
    public function removePublicCertificate() : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/certificate/public');
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function uploadPrivateCertificate(array $requestOptions) : ResponseInterface
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['certificate']);

        return $this->client->post(self::$endpoint . '/certificate/private', $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @return ResponseInterface
     */
    public function removePrivateCertificate() : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/certificate/private');
    }

    /**
     * @return ResponseInterface
     */
    public function getCertificateStatus() : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/certificate/status');
    }
}
