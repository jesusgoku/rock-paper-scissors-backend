# Rock, Paper and Scissors - Backend

## Setup for development

```
cp .env.example .env
# Complete .env file with environment info
# For generate an APP_KEY run: docker-compose run app ./artisan key:generate
docker-compose up -d
# Open your browser on: http://localhost:3000
```

## API Documentation

See API specification on  `/openapi.yml`

## Notes

Some notes about project implementation:

- There is no test for the application due to lack of time
- Model apps are simple and functional, although improvable

## TODO

- Tests
- Posibility for change game rules

## Related projects

- [Rock, Paper and Scissors - Frontend](https://github.com/jesusgoku/rock-paper-scissors-frontend)
