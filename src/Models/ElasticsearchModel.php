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
 * Class ElasticsearchModel
 */
class ElasticsearchModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/elasticsearch';

    /**
     * @return ResponseInterface
     */
    public function testElasticsearchConfiguration() : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/test');
    }

    /**
     * @return ResponseInterface
     */
    public function purgeAllElasticsearchIndexes() : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/purge_indexes');
    }
}
