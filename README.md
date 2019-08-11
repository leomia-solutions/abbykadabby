# Fresh Tomatoes

## Getting Started

Docmentation will need to be filled out, but this should help get you started.

This project uses docker images and containers, so the first step will be to get you set up with that.

Go to the [docker installation page](https://docs.docker.com/docker-for-mac/install/) and install docker to your local machine.

It also helps to have Captain installed, which helps you to easily verify that your containers are installed properly, and running. You can get a copy [here](https://getcaptain.co/).

Once you have docker set up, go to your project root and run `make build && make up && make db-migrate && make db-seed`. This will build your local docker containers and ensure that your database is primed for development.

That's it! Good luck!
