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
 * Class EmojiModel
 */
class EmojiModel extends AbstractModel
{
    /**
     * @var string
     */
    private static $endpoint = '/emoji';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createCustomEmoji(array $requestOptions) : ResponseInterface
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['image', 'emoji']);

        return $this->client->post(self::$endpoint, $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getListOfCustomEmoji(array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param $emojiId
     *
     * @return ResponseInterface
     */
    public function getCustomEmoji($emojiId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $emojiId);
    }

    /**
     * @param $emojiId
     *
     * @return ResponseInterface
     */
    public function deleteCustomEmoji($emojiId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $emojiId);
    }

    /**
     * @param $emojiId
     *
     * @return ResponseInterface
     */
    public function getCustomEmojiImage($emojiId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $emojiId . '/image');
    }

}
