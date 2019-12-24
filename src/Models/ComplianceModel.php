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
 * Class ComplianceModel
 */
class ComplianceModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/compliance';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createReport(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/reports', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getReports(array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/reports', $requestOptions);
    }

    /**
     * @param $reportId
     *
     * @return ResponseInterface
     */
    public function getReport($reportId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/reports/' . $reportId);
    }

    /**
     * @param       $reportId
     *
     * @return ResponseInterface
     */
    public function downloadReport($reportId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/reports/' . $reportId . '/download');
    }
}
