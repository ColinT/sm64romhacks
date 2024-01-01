# sm64romhacks

These files serve for the revamped version of [sm64romhacks.com](https://www.sm64romhacks.com). This revamp has the following but is not limited to these functionalities:
- Login System via Discord Oauth2 protocol
- A News system to be up to date with the events of the community!
- Easier maintenance of data possible via buttons (Add, Edit and Delete) and forms coupled with a MySQL Database
- User profiles (Authornames are connected to IDs)
- Multiple tags per patch now possible

A usage of these files is permitted for contribution and improving the system with the consent of the author (Me).
Last Updated: 2023-12-24

### Prerequisites

#### PHP and MySQL

Download XAMPP from here: https://www.apachefriends.org/
XAMPP is an apache package available for windows, linux and mac containing various tools required for this project such as php + apache and sql.

#### Apache Configuration

Most included files assume the project is placed on the document root of the webserver ```Your/Path/To/XAMPP/htdocs```. If you wish to use a different directory as the root you need to change apaches config file.
For this go to: ```Your/Path/To/XAMPP/apache/conf/httpd.conf``` and search for ```DocumentRoot``` and the ```Directory``` declarations, replace the path with your desired path.

#### Setting Up MySQL

You will need to have a dedicated db user to get this running, create one by executing the following steps:

1. Start XAMPP Control-panel and start Apache and MySQL
2. Open your Browser of choice and navigate to ```localhost/phpmyadmin```
3. Switch to the tab ```User Accounts```
4. Scroll down and click on ```Create User Account```
5. Set your User up here, be sure you grant all global privileges 
6. Press Go 

You will also need to setup a database (without any tables):

1. Navigate to ```localhost/phpmyadmin```
2. Switch to the ```Databases``` Tab.
3. Create a database with the name of your choice.

#### Setting Up the config file

This Project comes with a config file, consisting of the most important constants. You will need to adjust this file:

1. Open the file ```/_includes/config.php```
2. Adjust the configs as follows:
    Replace `YOUR_DB_HOST` with your db server adress. If running this locally, enter `localhost`
    Replace `YOUR_DB_USER` with the User Account you created earlier.
    Replace `YOUR_DB_PASS` with the Password of thr User Account you created earlier.
    Replace `YOUR_DB_Name` with the name if the Database you created earlier.

#### Twitch and Discord API

This Project makes use of the Twitch and Discord API for the streams page and the login system. To Run this locally you will need to get the corresponding keys:

##### Twitch API keys

1. Head over to https://dev.twitch.tv, login with your Twitch Account and then head to your Console (Tab at the top)
2. Register your application. For this: Enter an unique name, set the OAuth redirect URL to http://localhost, select Website Integration as the Category and Confidential as Client Type.
3. Press on Create.
4. Click on ```manage``` on the application you just created.
5. Copy the Client ID, replace ```YOUR_TWITCH_CLIENT_ID``` with your Client ID in the config.php file.
6. Generate a new Secret. Replace ```YOUR_TWITCH_CLIENT_SECRET``` with your Client Secret in the config.php file. Do not share these keys with anyone, ever.

##### Discord API Keys

1. Head over to https://discord.com/developers/docs/intro and click on ```Applications``` in the top left corner. Create a new application and accept the Terms Of Service.
2. Click on the OAuth2 Tab. Copy the Client ID and replace it with ```YOUR_DISCORD_CLIENT_ID``` in the config.php file.
3. Generate a Client Secret and replace it with ```YOUR_DISCORD_CLIENT_SECRET``` in the config.php file. Do not share these keys with anyone.
4. Add A Redirect URI. This must be the same URL as specified in the config.php file as ```DISCORD_REDIRECT_URI```.
5. Head over to the URL Generator. Tick the scopes ```identify```, ```email``` and ```connections```.
6. Scroll down and select the Redirect URI we specified earlier.
7. Copy the generated URL and replace it with the Link in the ```/login/init-oauth.php``` defined variable.
