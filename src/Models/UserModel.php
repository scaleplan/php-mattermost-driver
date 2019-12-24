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
 * Class UserEntity
 */
class UserModel extends AbstractModel
{
    /**
     * @var string
     */
    public static $endpoint = '/users';

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function loginToUserAccount(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/login', $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function logoutOfUserAccount() : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/logout');
    }

    /**
     * @return ResponseInterface
     */
    public function getAuthenticatedUser() : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/me');
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createUser(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getUsers(array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint, $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getUsersByIds(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/ids', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function searchUsers(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/search', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function autocompleteUsers(array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/autocomplete', $requestOptions);
    }

    /**
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function getUser($userId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $userId);
    }

    /**
     * @param $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateUser($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $userId, $requestOptions);
    }

    /**
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function deactivateUserAccount($userId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $userId);
    }

    /**
     * @param $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function patchUser($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $userId . '/patch', $requestOptions);
    }

    /**
     * @param $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateUserRoles($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $userId . '/roles', $requestOptions);
    }

    /**
     * @param $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateUserActive($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $userId . '/active', $requestOptions);
    }

    /**
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function getUserProfileImage($userId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $userId . '/image');
    }

    /**
     * @param $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function setUserProfileImage($userId, array $requestOptions) : ResponseInterface
    {
        $internalRequestOptions = self::buildMultipartDataOptions($requestOptions, ['image']);

        return $this->client->post(self::$endpoint . '/' . $userId . '/image', $internalRequestOptions, RequestOptions::MULTIPART);
    }

    /**
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function deleteUserProfileImage($userId) : ResponseInterface
    {
        return $this->client->delete(self::$endpoint . '/' . $userId . '/image');
    }

    /**
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function returnUserDefaultProfileImage($userId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $userId . '/image/default');
    }

    /**
     * @param $username
     *
     * @return ResponseInterface
     */
    public function getUserByUsername($username) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/username/' . $username);
    }

    /**
     * @param $requestOptions
     *
     * @return ResponseInterface
     */
    public function getUsersByUsernames(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/usernames/', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function resetPassword(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/password/reset', $requestOptions);
    }

    /**
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateUserMfa($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $userId . '/mfa', $requestOptions);
    }

    /**
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function generateMfaSecret($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $userId . '/mfa/generate', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function checkMfa(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/mfa', $requestOptions);
    }

    /**
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateUserPassword($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $userId . '/password', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function sendPasswordResetEmail(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/password/reset/send', $requestOptions);
    }

    /**
     * @param $email
     *
     * @return ResponseInterface
     */
    public function getUserByEmail($email) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/email/' . $email);
    }

    /**
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function getUserSessions($userId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $userId . '/sessions');
    }

    /**
     * @param $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function revokeUserSession($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $userId . '/sessions/revoke', $requestOptions);
    }

    /**
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function revokeAllUserSessions($userId) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $userId . '/sessions/revoke/all');
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function attachMobileDevice(array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/sessions/device', $requestOptions);
    }

    /**
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function getUserAudits($userId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $userId . '/audits');
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function verifyUserEmail(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/email/verify', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function sendVerificationEmail(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/email/verify/send', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function switchLoginMethod(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/login/switch', $requestOptions);
    }

    /**
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function createToken($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/' . $userId . '/tokens', $requestOptions);
    }

    /**
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function getTokens($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $userId . '/tokens', $requestOptions);
    }

    /**
     * @param $tokenId
     *
     * @return ResponseInterface
     */
    public function getToken($tokenId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/tokens/' . $tokenId);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function revokeToken(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/tokens/revoke', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function disablePersonalAccessToken(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/tokens/disable', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function enablePersonalAccessToken(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/tokens/enable', $requestOptions);
    }

    /**
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function searchTokens(array $requestOptions) : ResponseInterface
    {
        return $this->client->post(self::$endpoint . '/tokens/search', $requestOptions);
    }

    /**
     * @param $userId
     *
     * @return ResponseInterface
     */
    public function getUserStatus($userId) : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/' . $userId . '/status');
    }

    /**
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateUserStatus($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $userId . '/status', $requestOptions);
    }

    /**
     * @param       $userId
     * @param array $requestOptions
     *
     * @return ResponseInterface
     */
    public function updateUserAuthenticationMethod($userId, array $requestOptions) : ResponseInterface
    {
        return $this->client->put(self::$endpoint . '/' . $userId . '/auth', $requestOptions);
    }

    /**
     * @return ResponseInterface
     */
    public function getTotalCountOfUsersInTheSystem() : ResponseInterface
    {
        return $this->client->get(self::$endpoint . '/stats');
    }
}
