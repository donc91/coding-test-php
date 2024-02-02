## Get Started

This guide will walk you through the steps needed to get this project up and running on your local machine.

### Prerequisites

Before you begin, ensure you have the following installed:

- Docker
- Docker Compose

### Building the Docker Environment

Build and start the containers:

```
docker-compose up -d --build
```

### Installing Dependencies

```
docker-compose exec app sh
composer install
```

### Database Setup

Set up the database:

```
bin/cake migrations migrate
```

### Accessing the Application

The application should now be accessible at http://localhost:34251

## How to check

### Authentication

TODO: pls summarize how to check "Authentication" behavior

Setup the user seed:
```
bin/cake migrations seed
```
Access to applicatoin at http://localhost:34251

Login with list of accounts bellow:
test1@email.com / 12345678a
test2@email.com / 12345678a
test3@email.com / 12345678a

### Article Management

TODO: pls summarize how to check "Article Management" behavior

After login, user has been redirect to list article, then user can view, edit, delete, like article

### Like Feature

TODO: pls summarize how to check "Like Feature" bahavior
