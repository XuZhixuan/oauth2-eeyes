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
    * 使用session时的前缀
    *
    * @var string
    */
    const SESSION_HEAD = 'eeyes_';

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
    * 权限列表
    *
    * @var array
    */
    public $scope = [];

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
    * 将存入Eeyes中的scope转换为scope字符串
    *
    * @return string scopes
    */
    protected function getDefaultScopes()
    {
        return implode($this->getScopeSeparator(), $this->scope);
    }

    /**
     * 返回scope的分隔符，默认为空格
     *
     * @return string Scope separator, defaults to ' '
     */
    protected function getScopeSeparator()
    {
        return ' ';
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

    /**
     * 获取用户信息
     * 
     * @return array 用户的主要信息，包括NetID和姓名
     * 
     * @throws Exception
     */
    public function getUser()
    {
        // 系统函数，启动session
        if (PHP_SESSION_ACTIVE != session_status()) {
            session_start();
        }

        // 获取$response，可能重定向或exit
        if (isset($_SESSION[self::SESSION_HEAD . 'authorization'])) {
            // 若Session中已经有了authorization，则直接从Session中取出$response
            $response = $_SESSION[self::SESSION_HEAD . 'authorization'];
        } else {
            if (empty($_GET['code'])) {
                // 未登录状态跳转到授权URL
                $this->redirectToAuthorizationUrl();
            } else {
                // 检查state是否正确，不正确则直接exit
                self::checkState();
                // 向OAuth服务器请求获取用户信息
                $response = $this->getAccessToken('authorization_code',[
                    'code' => $_GET['code'],
                ]);
            }
        }

        // 获取用户信息
        $user = $this->getResourceOwner($response);
        // 返回必要信息
        return [
            'username' => $user->getUsername(),
            'name'     => $user->getName(),
        ];
    }

    /**
     * 重定向到授权URL
     */
    private function redirectToAuthorizationUrl()
    {
        // 获取跳转的URL
        $url = $this->getAuthorizationUrl();
        // 将state记录到Session
        $_SESSION[self::SESSION_HEAD . 'state'] = $this->getState();
        // 重定向并退出php
        header('Location: '.$url);
        exit(0);
    }

    /**
     * 检查State是否正确
     * 正确时无返回值
     * 不正确时退出并显示Invalid State
     */
    private static function checkState()
    {
        // 以下几个if可以写成一行，但是就太难识别了

        // 检查URL中是否有state
        if (empty($_GET['state'])) {
            self::exitInvalidState();
        }

        // 检查Session中是否存有state
        if (!isset($_SESSION[self::SESSION_HEAD . 'state'])) {
            self::exitInvalidState();
        }

        // 检查state是否一致
        if ($_GET['state'] !== $_SESSION[self::SESSION_HEAD . 'state']) {
            self::exitInvalidState();
        }
    }

    /**
     * 退出并显示Invalid State
     */
    private static function exitInvalidState()
    {
        // 清除Session并退出
        if(isset($_SESSION[self::SESSION_HEAD . 'state'])) {
            unset($_SESSION[self::SESSION_HEAD . 'state']);
        }
        exit('Invalid State');
    }
}
