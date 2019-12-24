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
 * Class CommandModel
 */
class CommandModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/commands';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createCommand(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function listCommandsForTeam(array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param $teamId
     *
     * @return ResponseInterface
     */
    public function listAutocompleteCommands($teamId) : ResponseInterface
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . '/commands/autocomplete');
    }

    /**
     * @param       $commandId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateCommand($commandId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $commandId, $requestOptions);
    }

    /**
     * @param $commandId
     *
     * @return ResponseInterface
     */
    public function deleteCommand($commandId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $commandId);
    }

    /**
     * @param $commandId
     *
     * @return ResponseInterface
     */
    public function generateNewToken($commandId) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $commandId . '/regen_token');
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function executeCommand(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/execute', $requestOptions);
    }
}
