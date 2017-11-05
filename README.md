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
    $optionsProvider = [];
    
    $storeClient = new StoreClient($clientCnpj, $name, $optionsProvider);
    
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
    $domain = 'http://<domain-for-application>';
    
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

