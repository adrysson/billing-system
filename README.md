# Billing System
Sistema simples de cobrança feito com Laravel e utilizando uma arquitetura limpa.

## Instruções de instalação
1. Clone o projeto:
```
git clone git@github.com:adrysson/billing-system.git
```
2. Copie o arquivo de exemplo das variáveis de ambiente:
```
cp .env.example .env
```
3. Se necessário, personalize as variáveis de ambiente do projeto no arquivo copiado;
4. Suba os containers da aplicação:
```
docker-compose up -d
```
5. Instale as dependências:
```
docker-compose exec laravel.test composer install
```
6. Gere a chave do Laravel:
```
docker-compose exec laravel.test php artisan key:generate
```
7. Execute as migrations para criar as tabelas no banco:
```
docker-compose exec laravel.test php artisan migrate
```
8. A aplicação estará disponível no ambiente local na porta especificada na variável de ambiente "APP_PORT". Caso a variável não exista, será utilizada a porta 80.

## Endpoints
Na raiz do projeto está uma collection do postman que pode ser importada para realizar o teste dos endpoints de importação das dívidas e do webhook de recebimento do pagamento.

## Envio de notificação de cobrança
Para testar o envio da notificação de cobrança manualmente é necessário executar o comando:
```
docker-compose exec laravel.test php artisan debts:notify
```
Para testar o envio da notificação de cobrança através do agendamento, sendo realizado a cada minuto, é necessário executar o comando:
```
docker-compose exec laravel.test php artisan schedule:work
```

## Testes
Para executar os testes unitários e de integração da aplicação é necessário executar o comando:
```
docker-compose exec laravel.test php artisan test
```
