## Task
- Create aggregator service for conducting fake surveys
- Create a basic search form that will query the API using AJAX and display the results it receives from the backend. The searching result should be rendering to HTML table dynamically on the frontend, using reactive Vue.js.
There should be some sort of searching indicator, a spinning icon or similar.

### Main functionality of the task:

- Registration, login and logout page
- Displaying vote list in a table 
- Displaying answer of each vote
- API for request random vote from all data or auth user

### Features

- CRUD for vote and answer
- Error handling in forms

## Stack
- Back-end: PHP8, SQLite DB, Plates PHP template, Rest API
- Front-end: JQuery, AJAX, Bootstrap 5, HTML5

## System requirements:
PHP8+, PDO SQlite lib, Composer, Git

## Install on Ubuntu VPS or WSL:

1) Clone the repository: <b>sudo git clone https://github.com/spitzer77/php8_oop_engine_with_api.git </b>
2) Enter to the install directory: <b>cd php8_oop_engine_with_api</b>
3) Install Composer dependencies: <b>composer install</b>
4) Set chmod for SQLite database file:
- <b>chmod 777 -R ./database/</b>
- <b>chmod 777 -R ./database/database.sqlite</b>
5) Change PDO _dbpath_ setting to actual absolute path in <b>/Database/settings.ini.php</b>
6) Mount _DocumentRoot_ of server virtual host to /absolute/path/to/virtual/host/public/
9) Run webserver:<br>

## Run app:

- Load your virtual host in browser 
- Or use the demo at http://eclipse2.it-tele.net:8041/ with user (user1@i.ua/12345)

# API

The API return one random voting result in two mode:
- for all data 
- for specific user data

### Requests in Postman
<table>
<tr>
<td>Mode</td>
<td>Postman query</td>
</tr>
<tr>
<td>For all data</td>
<td>GET-query to <b>http://eclipse2.it-tele.net:8041/api/votes</b></td>
</tr>
<tr>
<td>For specific user data</td>
<td>Post-query to <b>http://eclipse2.it-tele.net:8041/api/votes</b><br>
Authentication procedure in Postman:<br>
- go to a tab 'Body' => tab 'form-data' or 'x-www-form-urlencoded'<br>
- create two field 'email' and 'password' for user user1@i.ua/12345<br>
- send Post request
- show received data in result tab Body > Pretty 
</td> 
</tr>
</table>

### Example of api data

- Vote without result:
<pre>
{
    "id": 100,
    "title": "Опрос без вариантов ответа",
    "status": 0,
    "votes": []
}</pre>

- Vote with result:
<pre>
{
    "id": 119,
    "title": "Ваш кандидат в президенты Украины в 2024м году?",
    "status": 0,
    "votes": [
        {
            "title": "Янукович",
            "answers_count": 100
        },
        {
            "title": "Лебигович",
            "answers_count": 200
        },
        {
            "title": "Арестович",
            "answers_count": 300
        },
    ]
}
</pre>

### API errors for request of user data
<table>
<tr>
<td>Status</td>
<td>Message</td>
</tr>
<tr>
<td>Error</td>
<td>User example@example.com does not exist</td>
</tr>
<tr>
<td>Error</td>
<td>This password incorrect</td>
</tr>
<tr>
<td>Error</td>
<td>You haven`t any personal vote</td>
</tr>
</table>