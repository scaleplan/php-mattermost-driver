<?php
declare(strict_types=1);

/**
 * This Driver is based entirely on official documentation of the Mattermost Web
 * Services API and you can extend it by following the directives of the documentation.
 *
 * For the full copyright and license information, please read the LICENSE.txt
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/gnello/php-mattermost-driver/contributors
 *
 * God bless this mess.
 *
 * @author Luca Agnello <luca@gnello.com>
 * @link https://api.mattermost.com/
 */

namespace Scaleplan\Mattermost\Models;

use Psr\Http\Message\ResponseInterface;
use Scaleplan\Mattermost\Client;

/**
 * Class PreferenceModel
 */
class PreferenceModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/preferences';

    /**
     * @var string
     */
    private $userId;

    /**
     * PreferenceModel constructor.
     *
     * @param Client $client
     * @param        $userId
     */
    public function __construct(Client $client, $userId)
    {
        parent::__construct($client);
        $this->userId = $userId;
    }

    /**
     * @return ResponseInterface
     */
    public function getUserPreference() : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $this->userId . '/preferences');
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function saveUserPreferences(array $requestOptions) : ResponseInterface
    {
        return $this->client->put(UserModel::$endpoint . '/' . $this->userId . '/preferences', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function deleteUserPreferences(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(UserModel::$endpoint . '/' . $this->userId . '/preferences/delete', $requestOptions);
    }

    /**
     * @param $category
     *
     * @return ResponseInterface
     */
    public function listUserPreferences($category) : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $this->userId . '/preferences/' . $category);
    }

    /**
     * @param $category
     * @param $preferenceName
     *
     * @return ResponseInterface
     */
    public function getSpecificUserPreference($category, $preferenceName) : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $this->userId . '/preferences/' . $category . '/name/' . $preferenceName);
    }

}
