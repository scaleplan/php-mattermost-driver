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
 * Class JobModel
 */
class JobModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/jobs';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getJobs(array $requestOptions = []) : ResponseInterface
    {
        return $this->client->get(self::$endpoint, $requestOptions, RequestOptions::QUERY);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createJob(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param $jobId
     *
     * @return ResponseInterface
     */
    public function getJob($jobId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $jobId);
    }

    /**
     * @param $jobId
     *
     * @return ResponseInterface
     */
    public function deleteJob($jobId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $jobId . '/cancel');
    }

    /**
     * @param       $type
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getJobsOfType($type, array $requestOptions = []) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/type/' . $type, $requestOptions);
    }
}
