# Linx Bank

Implemenntação do desafio proposto

## Instalação

### Via github

#### Requisitos
- PHP 7.4
- Composer
- Mysql 5.7
- Extensão PHP OpenSSL
- Extensão PHP PDO
- Extensão PHP Mbstring

#### Passos 
- Clonar repositório

- Rodar composer install no projeto

- Copiar .env.example para .env substituindo credencias de bando de dados

- Rodar migrations: 
``` php artisan migrate:fresh --seed ```

## Utilização endpoints

Existe o arquivo teste-api.json que é um arquivo para ser utilizado no Insomnia para teste da api.

### Endpoints disponíveis

#### [GET] /api/v1/users
Lista todos os usuários. 

Exemplo resposta: 

```json
[
  {
    "id": 1,
    "name": "usuario 01",
    "cpf": "12345678910",
    "born_at": "2020-01-10",
    "created_at": "2020-10-13T17:31:11.000000Z",
    "updated_at": "2020-10-13T17:31:11.000000Z"
  },
  {
    "id": 2,
    "name": "usuario 02",
    "cpf": "12345678911",
    "born_at": "2020-01-10",
    "created_at": "2020-10-13T17:31:54.000000Z",
    "updated_at": "2020-10-13T17:31:54.000000Z"
  },
  {
    "id": 3,
    "name": "usuario 03",
    "cpf": "12345678912",
    "born_at": "2020-01-10",
    "created_at": "2020-10-13T17:31:59.000000Z",
    "updated_at": "2020-10-13T17:31:59.000000Z"
  }
]
```

### [GET] /ap1/v1/users/{id}
Retorna dados de um usuário
Códigos de resposta: [ 200, 404, 500]

Exemplos de resposta
```json
{
  "id": 1,
  "name": "usuario 01",
  "cpf": "12345678910",
  "born_at": "2020-01-10",
  "created_at": "2020-10-13T17:31:11.000000Z",
  "updated_at": "2020-10-13T17:31:11.000000Z"
}
```
#### [POST] /api/v1/users
Cria um novo usuário
Códigos de resposta: [ 201, 422, 500]

Parâmetros:
```json
{
  "name": "usuario 03",
  "cpf": "12345678912",
  "born_at": "2020-01-10"
}
```
Exemplo de resposta
```json
{
  "name": "usuario 03",
  "cpf": "12345678912",
  "born_at": "2020-01-10",
  "updated_at": "2020-10-13T17:31:59.000000Z",
  "created_at": "2020-10-13T17:31:59.000000Z",
  "id": 3
}
```
#### [POST] /api/v1/users/{userId}/accounts/savings
Cria uma nova conta do tipo poupança para usuário informado
Códigos de resposta: [ 201, 422, 500]

Parametros: 
```json
{
	"initial_balance": 3000
}
```
Exemplos de resposta

```json
{
  "id": 74,
  "user_id": 1,
  "account_type_id": 2,
  "balance": 3000,
  "enabled": 1,
  "disabled_at": null,
  "created_at": "2020-10-13T05:47:19.000000Z",
  "updated_at": "2020-10-13T05:47:20.000000Z"
}
```

#### [POST] /api/v1/users/{userId}/accounts/checking
Cria uma nova conta do tipo conta-corrent para usuário informado

Códigos de resposta: [ 201, 422, 500]

Parametros: 
```json
{
	"initial_balance": 3000
}
```
Exemplos de resposta

```json
{
  "id": 74,
  "user_id": 1,
  "account_type_id": 1,
  "balance": 3000,
  "enabled": 1,
  "disabled_at": null,
  "created_at": "2020-10-13T05:47:19.000000Z",
  "updated_at": "2020-10-13T05:47:20.000000Z"
}
```
#### [POST] /api/v1/users/{id}/accounts/{accountId}/deposit
Faz um depósito na conta do usuário informados

Códigos de resposta: [ 201, 422, 500]

Parâmetros:
```json
{
  "amount": 100
}
```

Exemplos de resposta 
```json
{
  "id": 3,
  "user_id": 1,
  "user_account_id": 2,
  "transacted_amount": 100,
  "used_banknotes": {
    "100":{"units":1,"total":100},
    "50":{"units":0,"total":0},
    "20":{"units":0,"total":0}},
  "updated_at": "2020-10-13T18:01:49.000000Z",
  "created_at": "2020-10-13T18:01:49.000000Z",
  "account": {
    "id": 2,
    "user_id": 1,
    "account_type_id": 2,
    "balance": 3100,
    "enabled": 1,
    "disabled_at": null,
    "created_at": "2020-10-13T18:01:29.000000Z",
    "updated_at": "2020-10-13T18:01:49.000000Z"
  }
}
```

#### [POST] /api/v1/users/{id}/accounts/{accountId}/withdraw
Faz um saque na conta do usuário informados

Códigos de resposta: [ 201, 422, 500]

Parâmetros:
```json
{
  "amount": 100
}
```

Exemplos de resposta 
```json
{
  "id": 4,
  "user_id": 1,
  "user_account_id": 2,
  "transacted_amount": -100,
  "used_banknotes": {
    "100":{"units":1,"total":100},
    "50":{"units":0,"total":0},
    "20":{"units":0,"total":0}},
  "updated_at": "2020-10-13T18:01:49.000000Z",
  "created_at": "2020-10-13T18:01:49.000000Z",
  "account": {
    "id": 2,
    "user_id": 1,
    "account_type_id": 2,
    "balance": 3000,
    "enabled": 1,
    "disabled_at": null,
    "created_at": "2020-10-13T18:01:29.000000Z",
    "updated_at": "2020-10-13T18:01:49.000000Z"
  }
}
```