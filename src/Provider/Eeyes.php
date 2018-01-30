<?php
namespace sxxuz\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class Eeyes extends AbstractProvider
{
    use BearerAuthorizationTrait;

    /**
    * 域名
    *
    * @var string
    */
    public $domain = 'https://account.eeyes.net/';

    /**
    * API域名
    *
    * @var string
    */
    public $apiDomain = 'https://account.eeyes.net/api/';

    /**
    * 获取授权地址以开始授权流程
    *
    * @return string
    */
    public function getBaseAuthorizationUrl()
    {
        return $this->domain.'oauth/authorize';
    }

    /**
     * 获取 access_token 地址以取得 token
     *
     * @param array $param
     * @return string
     */
    public function getBaseAccessTokenUrl(array $param)
    {
        return $this->domain.'oauth/token';
    }

    /**
    * 获取用户详细信息地址
    *
    * @param AccessToken $token
    * @return string
    */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return $this->apiDomain.'user';
    }

    /**
    * 获取基础授权范围
    * 这里应该填写最基础的授权范围而不是全部授权
    *
    * @return array
    */
    protected function getDefaultScopes()
    {
        return [];
    }

    /**
    * 检查服务提供者是否出现错误
    *
    * @throws IdentityProviderException
    * @param ResponseInterface $response
    * @param array $data Parsed response data
    * @return void
    */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if ($response->getStatusCode() >= 400) {
            throw new IdentityProviderException(
                $data['message'] ?: $response->getReasonPhrase(),
                $response->getStatusCode(),
                $response
            );
        } elseif (isset($data['error'])) {
            throw new IdentityProviderException();
        }
    }

    /**
    * 由成功的用户信息请求返回值生成新的用户对象
    *
    * @param array $response
    * @param AccessToken $token
    * @return EeyesResourcesOwner
    */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new EeyesResourceOwner($response);
    }
}
