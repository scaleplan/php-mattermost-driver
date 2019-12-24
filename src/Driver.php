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

namespace Scaleplan\Mattermost;

use GuzzleHttp\Psr7\Response;
use Pimple\Container;
use Psr\Http\Message\ResponseInterface;
use Scaleplan\Mattermost\Models\BotModel;
use Scaleplan\Mattermost\Models\BrandModel;
use Scaleplan\Mattermost\Models\ChannelModel;
use Scaleplan\Mattermost\Models\ClusterModel;
use Scaleplan\Mattermost\Models\CommandModel;
use Scaleplan\Mattermost\Models\ComplianceModel;
use Scaleplan\Mattermost\Models\DataRetentionModel;
use Scaleplan\Mattermost\Models\ElasticsearchModel;
use Scaleplan\Mattermost\Models\EmojiModel;
use Scaleplan\Mattermost\Models\FileModel;
use Scaleplan\Mattermost\Models\JobModel;
use Scaleplan\Mattermost\Models\LDAPModel;
use Scaleplan\Mattermost\Models\OAuthModel;
use Scaleplan\Mattermost\Models\PluginModel;
use Scaleplan\Mattermost\Models\PostModel;
use Scaleplan\Mattermost\Models\PreferenceModel;
use Scaleplan\Mattermost\Models\ReactionModel;
use Scaleplan\Mattermost\Models\RoleModel;
use Scaleplan\Mattermost\Models\SAMLModel;
use Scaleplan\Mattermost\Models\SchemeModel;
use Scaleplan\Mattermost\Models\SystemModel;
use Scaleplan\Mattermost\Models\TeamModel;
use Scaleplan\Mattermost\Models\UserModel;
use Scaleplan\Mattermost\Models\WebhookModel;

/**
 * Class Driver
 *
 * @package Scaleplan\Mattermost
 */
class Driver
{
    /**
     * Default options of the Driver
     *
     * @var array
     */
    private $defaultOptions = [
        'scheme'   => 'https',
        'basePath' => '/api/v4',
        'url'      => 'localhost',
        'login_id' => null,
        'password' => null,
        'token'    => null,
    ];

    /**
     * @var Container
     */
    private $container;

    /**
     * @var array
     */
    private $models = [];

    /**
     * Driver constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $driverOptions = $this->defaultOptions;

        if (isset($container['driver'])) {
            $driverOptions = array_merge($driverOptions, $container['driver']);
        }

        $container['driver'] = $driverOptions;
        $container['client'] = new Client($container);

        $this->container = $container;
    }

    /**
     * @return ResponseInterface
     */
    public function authenticate() : ResponseInterface
    {
        $driverOptions = $this->container['driver'];

        if (isset($driverOptions['token'])) {

            $this->container['client']->setToken($driverOptions['token']);
            $response = $this->getUserModel()->getAuthenticatedUser();

        } else if (isset($driverOptions['login_id'], $driverOptions['password'])) {

            $response = $this->getUserModel()->loginToUserAccount([
                'login_id' => $driverOptions['login_id'],
                'password' => $driverOptions['password'],
            ]);

            if ($response->getStatusCode() === 200) {
                $token = $response->getHeader('Token')[0];
                $this->container['client']->setToken($token);
            }

        } else {

            $response = new Response(401, [], json_encode([
                'id'             => 'missing.credentials.',
                'message'        => 'You must provide a login_id and password or a valid token.',
                'detailed_error' => '',
                'request_id'     => '',
                'status_code'    => 401,
            ]));

        }

        return $response;
    }

    /**
     * @param $className
     *
     * @return mixed
     */
    private function getModel($className)
    {
        if (!isset($this->models[$className])) {
            $this->models[$className] = new $className($this->container['client']);
        }

        return $this->models[$className];
    }

    /**
     * @return UserModel
     */
    public function getUserModel() : UserModel
    {
        return $this->getModel(UserModel::class);
    }

    /**
     * @return TeamModel
     */
    public function getTeamModel() : TeamModel
    {
        return $this->getModel(TeamModel::class);
    }

    /**
     * @return ChannelModel
     */
    public function getChannelModel() : ChannelModel
    {
        return $this->getModel(ChannelModel::class);
    }

    /**
     * @return PostModel
     */
    public function getPostModel() : PostModel
    {
        return $this->getModel(PostModel::class);
    }

    /**
     * @return FileModel
     */
    public function getFileModel() : FileModel
    {
        return $this->getModel(FileModel::class);
    }

    /**
     * @param $userId
     *
     * @return PreferenceModel
     */
    public function getPreferenceModel($userId) : PreferenceModel
    {
        if (!isset($this->models[PreferenceModel::class])) {
            $this->models[PreferenceModel::class] = new PreferenceModel($this->container['client'], $userId);
        }

        return $this->models[PreferenceModel::class];
    }

    /**
     * @return WebhookModel
     */
    public function getWebhookModel() : WebhookModel
    {
        return $this->getModel(WebhookModel::class);
    }

    /**
     * @return SystemModel
     */
    public function getSystemModel() : SystemModel
    {
        return $this->getModel(SystemModel::class);
    }

    /**
     * @return ComplianceModel
     */
    public function getComplianceModel() : ComplianceModel
    {
        return $this->getModel(ComplianceModel::class);
    }

    /**
     * @return CommandModel
     */
    public function getCommandModel() : CommandModel
    {
        return $this->getModel(CommandModel::class);
    }

    /**
     * @return ClusterModel
     */
    public function getClusterModel() : ClusterModel
    {
        return $this->getModel(ClusterModel::class);
    }

    /**
     * @return BrandModel
     */
    public function getBrandModel() : BrandModel
    {
        return $this->getModel(BrandModel::class);
    }

    /**
     * @return LDAPModel
     */
    public function getLDAPModel() : LDAPModel
    {
        return $this->getModel(LDAPModel::class);
    }

    /**
     * @return OAuthModel
     */
    public function getOAuthModel() : OAuthModel
    {
        return $this->getModel(OAuthModel::class);
    }

    /**
     * @return SAMLModel
     */
    public function getSAMLModel() : SAMLModel
    {
        return $this->getModel(SAMLModel::class);
    }

    /**
     * @return ElasticsearchModel
     */
    public function getElasticsearchModel() : ElasticsearchModel
    {
        return $this->getModel(ElasticsearchModel::class);
    }

    /**
     * @return EmojiModel
     */
    public function getEmojiModel() : EmojiModel
    {
        return $this->getModel(EmojiModel::class);
    }

    /**
     * @return ReactionModel
     */
    public function getReactionModel() : ReactionModel
    {
        return $this->getModel(ReactionModel::class);
    }

    /**
     * @return DataRetentionModel
     */
    public function getDataRetentionModel() : DataRetentionModel
    {
        return $this->getModel(DataRetentionModel::class);
    }

    /**
     * @return JobModel
     */
    public function getJobModel() : JobModel
    {
        return $this->getModel(JobModel::class);
    }

    /**
     * @return PluginModel
     */
    public function getPluginModel() : PluginModel
    {
        return $this->getModel(PluginModel::class);
    }

    /**
     * @return RoleModel
     */
    public function getRoleModel() : RoleModel
    {
        return $this->getModel(RoleModel::class);
    }

    /**
     * @return SchemeModel
     */
    public function getSchemeModel() : SchemeModel
    {
        return $this->getModel(SchemeModel::class);
    }

    /**
     * @return BotModel
     */
    public function getBotModel() : BotModel
    {
        return $this->getModel(BotModel::class);
    }
}
