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
 * Class LDAPModel
 */
class LDAPModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/ldap';

    /**
     * @return ResponseInterface
     */
    public function syncWithLDAP() : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/sync');
    }

    /**
     * @return ResponseInterface
     */
    public function testLDAPConfiguration() : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/test');
    }
}
