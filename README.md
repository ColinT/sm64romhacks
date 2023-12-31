# sm64romhacks

These files serve for the revamped version of [sm64romhacks.com](https://www.sm64romhacks.com). This revamp has the following but is not limited to these functionalities:
- Login System via Discord Oauth2 protocol
- A News system to be up to date with the events of the community!
- Easier maintenance of data possible via buttons (Add, Edit and Delete) and forms coupled with a MySQL Database
- User profiles (Authornames are connected to IDs)
- Multiple tags per patch now possible

A usage of these files is permitted for contribution and improving the system with the consent of the author (Me).
Last Updated: 2023-12-24

## Running Locally on Windows

Install and setup prerequisites, start your MySQL Server Docker Container, then run the command:
```
php -S localhost:8000 -c .
```
You can then visit the website at `localhost:8000` in your browser.

### Prerequisites

#### PHP

Download PHP from: https://windows.php.net/download/

Unzip and add the folder containing `php.exe` to your `PATH`.

#### Docker and MySQL

##### WSL 2 for Docker

Install WSL2 with the command:
```
wsl --install
```
You may have to enable virtualization through your BIOS. After doing so, disable and reenable Windows Features > Virtual Machine Platform, then try installing WSL2 again.

##### Docker

Install Docker Desktop: https://www.docker.com/products/docker-desktop/

##### MySQL Server

Open Docker Desktop and add the official MySQL Docker Image: https://hub.docker.com/_/mysql

You can also search `mysql` in the search bar.

Create a MySQL Docker Container assigning ports: `3306` and `33060`. Enter an environment variable value for `MYSQL_ROOT_PASSWORD`. It is recommended to also enter values for `MYSQL_USER` and `MYSQL_PASSWORD` which will be the username and password for an automatically generated user.

##### MySQL Client

Download MySQL Shell: https://dev.mysql.com/downloads/shell/

After downloading, use the client to create a database and grant permissions to your user:

```
mysql -u root -p
Enter password: <root password>

CREATE DATABASE IF NOT EXISTS <database name>

GRANT ALL ON <database name>.* TO '<username>'@'%';
```

### Environment Variables

#### .env File

Create a `.env` file in the project root directory. See the commented example in `.env.example`.

#### Composer and Dotenv

Install Composer: https://getcomposer.org/doc/00-intro.md#installation-windows

Navigate to the project root then run the command:
```
composer update
```
This will install the `Dotenv` dependency and subdependencies.
