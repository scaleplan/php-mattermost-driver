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

use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class TeamModel
 */
class TeamModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/teams';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createTeam(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getTeams(array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param $teamId
     *
     * @return ResponseInterface
     */
    public function getTeam($teamId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $teamId);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateTeam($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $teamId, $requestOptions);
    }

    /**
     * @param $teamId
     *
     * @return ResponseInterface
     */
    public function deleteTeam($teamId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $teamId . '?permanent=true');
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function patchTeam($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $teamId . '/patch', $requestOptions);
    }

    /**
     * @param $teamName
     *
     * @return ResponseInterface
     */
    public function getTeamByName($teamName) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/name/' . $teamName);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function searchTeams(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/search', $requestOptions);
    }

    /**
     * @param $teamName
     *
     * @return ResponseInterface
     */
    public function checkTeamExists($teamName) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/name/' . $teamName . '/exists');
    }

    /**
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function getUserTeams($userId) : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams');
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getTeamMembers($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/members', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function addUser($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/members', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function addUserFromInvite(array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/members/invite', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function addMultipleUsers($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/members/batch', $requestOptions);
    }

    /**
     * @param $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getTeamMembersForUser($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams/members', $requestOptions);
    }

    /**
     * @param $teamId
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function getTeamMember($teamId, $userId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/members/' . $userId);
    }

    /**
     * @param       $teamId
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function removeUser($teamId, $userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $teamId . '/members/' . $userId, $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getTeamMembersByIds($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/members/ids', $requestOptions);
    }

    /**
     * @param $teamId
     *
     * @return ResponseInterface
     */
    public function getTeamStats($teamId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/stats');
    }

    /**
     * @param $teamId
     * @param $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateTeamMemberRoles($teamId, $userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/members/' . $userId . '/roles', $requestOptions);
    }

    /**
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function getUserTotalUnreadMessagesFromTeams($userId) : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams/unread');
    }

    /**
     * @param $userId
     * @param $teamId
     *
     * @return ResponseInterface
     */
    public function getUserTotalUnreadMessagesFromTeam($userId, $teamId) : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/teams/' . $teamId . '/unread');
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function inviteUsersByEmail($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/invite/email', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function importTeamFromOtherApplication($teamId, array $requestOptions) : ResponseInterface
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['file', 'filesize', 'importFrom']);

        return $this->client->post(self::$endpoint . '/' . $teamId . '/import', $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @param $teamId
     *
     * @return ResponseInterface
     */
    public function getInviteInfoForTeam($teamId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/invite/' . $teamId);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getPublicChannels($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/channels', $requestOptions);
    }

    /**
     * @param $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getDeletedChannels($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $teamId . '/channels/deleted', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function searchChannels($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $teamId . '/channels/search', $requestOptions);
    }
}
