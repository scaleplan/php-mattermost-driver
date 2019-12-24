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

/**
 * Class ChannelModel
 */
class ChannelModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/channels';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createChannel(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createDirectMessageChannel(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/direct', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createGroupMessageChannel(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/group', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getChannelsListByIds($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/ids', $requestOptions);
    }

    /**
     * @param $channelId
     *
     * @return ResponseInterface
     */
    public function getChannel($channelId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $channelId);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateChannel($channelId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $channelId, $requestOptions);
    }

    /**
     * @param $channelId
     *
     * @return ResponseInterface
     */
    public function deleteChannel($channelId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $channelId);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function patchChannel($channelId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $channelId . '/patch', $requestOptions);
    }

    /**
     * @param       $channelId
     *
     * @return ResponseInterface
     */
    public function restoreChannel($channelId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $channelId . '/restore');
    }

    /**
     * @param $channelId
     *
     * @return ResponseInterface
     */
    public function getChannelStatistics($channelId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $channelId . '/stats');
    }

    /**
     * @param $channelId
     *
     * @return ResponseInterface
     */
    public function getChannelsPinnedPosts($channelId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $channelId . '/pinned');
    }

    /**
     * @param $teamId
     * @param $channelName
     *
     * @return ResponseInterface
     */
    public function getChannelByName($teamId, $channelName) : ResponseInterface
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/name/' . $channelName);
    }

    /**
     * @param $teamName
     * @param $channelName
     *
     * @return ResponseInterface
     */
    public function getChannelByNameAndTeamName($teamName, $channelName) : ResponseInterface
    {
        return $this->client->get(TeamModel::$endpoint . '/name/' . $teamName . self::$endpoint . '/name/' . $channelName);
    }

    /**
     * @param $channelId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getChannelMembers($channelId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $channelId . '/members', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function addUser($channelId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $channelId . '/members', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getChannelMembersByIds($channelId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $channelId . '/members/ids', $requestOptions);
    }

    /**
     * @param $channelId
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function getChannelMember($channelId, $userId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $channelId . '/members/' . $userId);
    }

    /**
     * @param $channelId
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function removeUserFromChannel($channelId, $userId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $channelId . '/members/' . $userId);
    }

    /**
     * @param       $channelId
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateChannelRoles($channelId, $userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $channelId . '/members/' . $userId . '/roles', $requestOptions);
    }

    /**
     * @param       $channelId
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateChannelNotifications($channelId, $userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $channelId . '/members/' . $userId . '/notify_props', $requestOptions);
    }

    /**
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function viewChannel($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/members/' . $userId . '/view', $requestOptions);
    }

    /**
     * @param $userId
     * @param $teamId
     *
     * @return ResponseInterface
     */
    public function getChannelMembersForTheUser($userId, $teamId) : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/' . TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/members');
    }

    /**
     * @param $userId
     * @param $teamId
     *
     * @return ResponseInterface
     */
    public function getChannelsForUser($userId, $teamId) : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . '/' . TeamModel::$endpoint . '/' . $teamId . self::$endpoint);
    }

    /**
     * @param $userId
     * @param $channelId
     *
     * @return ResponseInterface
     */
    public function getUnreadMessages($userId, $channelId) : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . self::$endpoint . '/' . $channelId . '/unread');
    }

    /**
     * @param $channelId
     *
     * @return ResponseInterface
     */
    public function convertChannelFromPublicToPrivate($channelId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $channelId . '/convert');
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getPublicChannels($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . self::$endpoint, $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getDeletedChannels($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/deleted', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function autocompleteChannels($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/autocomplete', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function autocompleteChannelsForSearch($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/search_autocomplete', $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function searchChannels($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/search', $requestOptions);
    }
}
