# OAuth2.0-eeyes

标签（空格分隔）： Provider OAuth2.0 eeyes-net php

---

 - 这是一个基于 thephpleague/oauth2.0-client 的 OAuth2.0 客户端 Provider 

 - 其中主要的配置内容已经为e瞳网用户账户中心的 OAuth2.0 服务器进行了配置，在使用时，请新建好配置文件以备引用。


----------

 1. 安装
    请使用 composer 来安装

    composer require sxxuz/oauth2-eeyes

 2. 使用
    使用方法与 League/OAuth2.0-Client 基本相同
    用法示例

认证流程

$provider = new Eeyes([

            'clientID'      => 'Your App ID Here,

            'clientSecret'  => 'Your App Secret Here',

            'redirectUri'   => 'Your Callback Url Here',

        ]);



        if(!isset($_GET['code']))

        {

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

        } elseif (!null == $provider->getState() || $provider->getState() !== $_SESSION['oauth2state']) {

            unset($_SESSION['oauth2state']);

            exit('Invalid State');

        } else {

            $token = $provider->getAccessToken('authorization_code',[

               'code' => $request->get('code'),

            ]);



            try {

                $user = $provider->getResourceOwner($token);


            } catch (Exception $exception) {

                exit($exception->getMessage());

            }

        }

