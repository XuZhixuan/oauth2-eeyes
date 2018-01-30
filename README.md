# OAuth2.0-eeyes

标签： Provider OAuth2.0 eeyes-net php

---

 - 这是一个基于 thephpleague/oauth2.0-client 的 OAuth2.0 客户端 Provider

 - 其中主要的配置内容已经为e瞳网用户账户中心的 OAuth2.0 服务器进行了配置，在使用时，请新建好配置文件以备引用。


----------

## 安装
    请使用 composer 来安装

    composer require sxxuz/oauth2-eeyes

## 使用
    使用方法与 League/OAuth2.0-Client 基本相同


## 认证流程

```php

$provider = new Eeyes([

            'clientId'      => 'Your App ID Here,

            'clientSecret'  => 'Your App Secret Here',

            'redirectUri'   => 'Your Callback Url Here',

        ]);



        if(!isset($_GET['code']))

        {
            //判断是否存在授权码，如果没有就则请求授权
            $authorizationUrl = $provider->getBaseAuthorizationUrl().'?'.http_build_query([

                    'client_id'     => 'Your App ID Here',

                    'redirect_uri'  => 'Your App Secret Here',

                    'response_type' => 'code',

                    'scope' => implode(' ', [

                        'The Scope You Required Here',

                ]),

            ]);

            $_SESSION['oauth2state'] = $provider->getState();

            header('Location: ' . $authorizationUrl);

            exit;
        //检查由基础 Provider 设置的 state 与之前的 state 是否一样以避免 CSRF 攻击
        } elseif (!null == $provider->getState() || $provider->getState() !== $_SESSION['oauth2state']) {

            unset($_SESSION['oauth2state']);

            exit('Invalid State');

        } else {
	    try {
            //尝试通过 POST 获取用户的 Access Token （这里使用授权码模式）
            $token = $provider->getAccessToken('authorization_code',[

               'code' => $request->get('code'),

            ]);


            //可选内容：现在可以通过 Access Token 获取用户信息

                $user = $provider->getResourceOwner($token);


            } catch (Exception $exception) {

                exit($exception->getMessage());

            }

        }

```

## 获取用户信息
    当获取到 Token 后，使用 Token 来取得用户信息

```php

        $provider = new Eeyes([

            'clientId'      => 'Your App ID Here,

            'clientSecret'  => 'Your App Secret Here',

            'redirectUri'   => 'Your Callback Url Here',

        ]);

        //这里的 Token 应当是 getAccessToken 的一个实例
        $user = $provider->getResourceOwner($token);

        //通过 EeyesResourceOwner 的方法获取实例信息
        $username = $user->getUsername();
        ...
```

## License
The MIT License(MIT). Please see [License File](https://github.com/XuZhixuan/oauth2-eeyes/blob/master/LICENSE) for more information.
