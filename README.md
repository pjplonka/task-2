### Run tests:
`php bin/phpunit`

### App flow:
![app_flow.jpg](doc%2Fapp_flow.jpg)

To run application use: `$bus->dispatch(new GetOrders(new Filters(Filters\Source::AMAZON)));`

### TODO
- Dockerize app
- Replace custom validator (Order ResponseValidator) to Symfony validator 
- Add code coverage for tests
- Add phpcs
- Add phpstan
- Add deptrac
- Add more tests and scenarios
- Catch and handle exceptions