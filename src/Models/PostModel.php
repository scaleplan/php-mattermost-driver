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
 * Class PostModel
 */
class PostModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/posts';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createPost(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param $postId
     *
     * @return ResponseInterface
     */
    public function getPost($postId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $postId);
    }

    /**
     * @param $postId
     *
     * @return ResponseInterface
     */
    public function deletePost($postId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $postId);
    }

    /**
     * @param       $postId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updatePost($postId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $postId, $requestOptions);
    }

    /**
     * @param       $postId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function patchPost($postId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $postId . '/patch', $requestOptions);
    }

    /**
     * @param $postId
     *
     * @return ResponseInterface
     */
    public function getThread($postId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $postId . '/thread');
    }

    /**
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getFlaggedPosts($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(UserModel::$endpoint . '/' . $userId . self::$endpoint . '/flagged', $requestOptions);
    }

    /**
     * @param       $postId
     *
     * @return ResponseInterface
     */
    public function getFileInfoForPost($postId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $postId . '/files/info');
    }

    /**
     * @param       $channelId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getPostsForChannel($channelId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(ChannelModel::$endpoint . '/' . $channelId . self::$endpoint, $requestOptions);
    }

    /**
     * @param       $teamId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function searchForTeamPosts($teamId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(TeamModel::$endpoint . '/' . $teamId . self::$endpoint . '/search', $requestOptions);
    }

    /**
     * @param       $postId
     *
     * @return ResponseInterface
     */
    public function pinPost($postId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $postId . '/pin');
    }

    /**
     * @param       $postId
     *
     * @return ResponseInterface
     */
    public function unpinPost($postId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $postId . '/unpin');
    }

    /**
     * @param       $postId
     * @param       $actionId
     *
     * @return ResponseInterface
     */
    public function performPostAction($postId, $actionId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $postId . '/actions/' . $actionId);
    }

    /**
     * @param $postId
     *
     * @return ResponseInterface
     */
    public function getReactions($postId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $postId . '/reactions');
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createEphemeralPost(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/ephemeral', $requestOptions);
    }
}
