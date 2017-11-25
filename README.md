# Softsend


## Instalação

Em seu arquivo composer.json adicione ao "require":

```php
    "require": {
        "softcomtecnologia/softsend-client": "*",
    },
```

## Exemplo de Uso

### Obtendo suas Credenciais


```php
    $clientCnpj = '<your-cnpj>';
    $name = '<you-app-name>';
    $options = [
        'cpf_cnpj'      => '<your-cpf_cpnj>',
        'nome'          => '<your-nome>',       //exemplo, razão social da empresa
        'nome_envio'    => '<your-nome_envio>', //facultativo
    ];
    
    $storeClient = new StoreClient($options);
    
    $response = $storeClient->support();
    
    echo $response;
    /* json response
      {
          "code":1,
          "message":"OK",
          "human":"Sucesso",
          "data":{
              "client_id":"v2eFDOO7gl56Y1C9vfF7bi56.d8gYXoX.voHSqsa",
              "client_secret":"Lb94cPejcZGA.XkrpIs8S4UqB1GqfOdiw1jZVYol8mBo96uGBMVyg9efMm13",
              "device_id":"<id-yout-device>",
              "device_name":"<you-app-name>"
          },
          "meta":[]
      }
    */
```

### Autenticação para Acesso a Aplicação

#### Obtendo Url para Acesso

```php
    $clientId = 'v2eFDOO7gl56Y1C9vfF7bi56.d8gYXoX.voHSqsa';
    $clientSecret = 'Lb94cPejcZGA.XkrpIs8S4UqB1GqfOdiw1jZVYol8mBo96uGBMVyg9efMm13';
    $domain = 'http://<domain-for-application>';//facultativo
    
    $autentication = new AutenticationClient($clientId, $clientSecret, $domain);
    
    //optional
    $autentication->responseType(SoftsendConfigs::RESPONSE_TYPE_ARRAY);
    
    $response = $autentication->support();
    
    print_r($response);
    /* array response
        [
            "code" => 1,
            "message" => "OK",
            "human" => "Sucesso",
            "data" => [
              "url" => "http://<domain-for-application>/oauth/token?token=f0bd4ed91d0b956be5906a867858a87a8141283e",
              "redirect" => true,
            ]
            "meta" => []
        ]
    */
```

#### Redirecionando

Com a url de acesso, pode-se realizar o redirecionamento da seguinte forma:

```php

    if (isset($response['data']['url'])) {
        header("Location: {$response['data']['url']}");
        exit;
    }
    
```

### Envios

#### Email

Para o envio de email deve-se informar o tipo (type) que deseja enviar. 
Cada tipo pode e deve ter suas regras, segue abaixo dois exemplos um para Aniversario e outro para Recuperação de Senha:

* Exemplo Aniversário

```php

    $clientId = 'w9KKB5E_PFdzF1aM-bEL.BJNw-yTnovUFn53.pJe';
    $clientSecret = '5uOuxxzuS-SIT9aMmGd1-C9Jr-XXnONjabYj6WlXbgdURD6aEgoLsOxTVuBz';
    $envios = [
        'type' => 'ANIVERSARIO',
        [
            'nome'  => '<Nome do Usuário>',
            'data'  => '01/10/1998',
            'email' => 'email-destinatario@host.com',
        ],
        //...
    ];

    $support = new SendEmail($envios, $clientId, $clientSecret);
    
    //optional
    $autentication->responseType(SoftsendConfigs::RESPONSE_TYPE_ARRAY);
    
    $response = $support->support();
    print_r($response);
    /* array response
        [
            "code" => 1,
            "message" => "OK",
            "human" => "Sucesso",
            "data" => [
              "Email enviado com sucesso!"
            ]
            "meta" => []
        ]
    */

```

* Exemplo Recuperação de Senha

```php

    $clientId = 'w9KKB5E_PFdzF1aM-bEL.BJNw-yTnovUFn53.pJe';
    $clientSecret = '5uOuxxzuS-SIT9aMmGd1-C9Jr-XXnONjabYj6WlXbgdURD6aEgoLsOxTVuBz';
    $envios = [
        'type' => 'ENVIO_SENHA',
        [
            'nome'  => '<Nome do Usuário>',
            'email' => 'email-destinatario@host.com',
            'recuperar_senha' => '<token-da-senha>'
        ],
        //...
    ];

    $support = new SendEmail($envios, $clientId, $clientSecret);
    
    //optional
    $autentication->responseType(SoftsendConfigs::RESPONSE_TYPE_ARRAY);
    
    $response = $support->support();
    
    print_r($response);
    /* array response
        [
            "code" => 1,
            "message" => "OK",
            "human" => "Sucesso",
            "data" => [
              "Email enviado com sucesso!"
            ]
            "meta" => []
        ]
    */

```


#### SMS

Para o envio de sms deve-se informar o tipo (type) que deseja enviar. 
Cada tipo pode e deve ter suas regras, segue abaixo dois exemplos um para Aniversario e outro para Cobrança:

* Exemplo Aniversário

```php

    $clientId = 'w9KKB5E_PFdzF1aM-bEL.BJNw-yTnovUFn53.pJe';
    $clientSecret = '5uOuxxzuS-SIT9aMmGd1-C9Jr-XXnONjabYj6WlXbgdURD6aEgoLsOxTVuBz';
    $envios = [
        'type' => 'ANIVERSARIO',
        [
            'nome'  => '<Nome do Usuário>',
            'fone' => '<numero-com-ddd>',
        ],
        //...
    ];

    $support = new SendSms($envios, $clientId, $clientSecret);
    
    //optional
    $autentication->responseType(SoftsendConfigs::RESPONSE_TYPE_ARRAY);
    
    $response = $support->support();
    print_r($response);
    /* array response
        [
            "code" => 1,
            "message" => "OK",
            "human" => "Sucesso",
            "data" => [
              "Enviados 10/10. Não enviados 0"
            ]
            "meta" => []
        ]
    */

```

* Exemplo Cobrança

```php

    $clientId = 'w9KKB5E_PFdzF1aM-bEL.BJNw-yTnovUFn53.pJe';
    $clientSecret = '5uOuxxzuS-SIT9aMmGd1-C9Jr-XXnONjabYj6WlXbgdURD6aEgoLsOxTVuBz';
    $envios = [
        'type' => 'COBRANCA',
        [
            'nome'  => '<Nome do Usuário>',
            'fone' => '<numero-com-ddd>',
        ],
        //...
    ];

    $support = new SendSms($envios, $clientId, $clientSecret);
    
    //optional
    $autentication->responseType(SoftsendConfigs::RESPONSE_TYPE_ARRAY);
    
    $response = $support->support();
    print_r($response);
    /* array response
        [
            "code" => 1,
            "message" => "OK",
            "human" => "Sucesso",
            "data" => [
              "Enviados 10/10. Não enviados 0"
            ]
            "meta" => []
        ]
    */

```

