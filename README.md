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

_请务必保证重定向地址正确，即保证重定向返回后会执行getUser_

```php

        // 创建一个Eeyes对象

        $eeyesClient = new Eeyes([

            'clientId'      => 'Your App ID Here',

            'clientSecret'  => 'Your App Secret Here',

            'redirectUri'   => 'Your Callback Url Here',

            'scope'	        => [
                'scope1',
                'scope2',
                'scope3'
            ]

        ]);

        // 使用getUser方法获取用户的信息，登录、验证过程均会自动完成

        $user = $eeyesClient->getUser();

```

## 获取用户信息
    当获取到 Token 后，使用 Token 来取得用户信息

```php

        // 假设之前已经执行过$user = $eeyesClient->getUser();
        
        // 获取用户的NetID

        $username = $user['username'];

        // 获取用户的姓名

        $name = $user['name'];
```

## License
The MIT License(MIT). Please see [License File](https://github.com/XuZhixuan/oauth2-eeyes/blob/master/LICENSE) for more information.
