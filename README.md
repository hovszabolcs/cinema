## Installation ##

- Install Docker with Docker Compose

- Rename .env.example to .env.
    - ```mv .env.example .env```
- Build and run docker containers:
    - ```docker compose build```
    - ```docker compose up -d```
- Enter container of the app:
  - ```docker exec -it cinema-laravel.test-1 sh```
  - ```composer install```
- Exit from container
- ```sail up -d```
- You have to install npm lte latest outside (sorry for this but laravel sail)
- ```cd frontend```
- ```npm install```
- ```npm run dev```
- You can start the react project the link

- `User: test@example.com`
- `Password: password`

You can try API on http://localhost/api/v1/documentation
