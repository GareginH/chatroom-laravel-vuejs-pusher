# chatroom-laravel-vuejs-pusher
Web application for creating real time chat rooms with registered users.
I made this project just for fun, there is alot of room for new functionality, imagination is the limit.

How to get this running?
(I am assuming you are familiar with laravel and have used npm & composer commands before.)

1. Download the project.
2. Create a pusher account (pusher.com).
3. Open .env file and fill in your DB info.
Example.
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chatroom
DB_USERNAME=root
DB_PASSWORD=""

4. Fill in the pusher info aswell, you can get it from your dashboard on pusher.com  
   PUSHER_APP_ID=""  
   PUSHER_APP_KEY=""  
   PUSHER_APP_SECRET=""  
   PUSHER_APP_CLUSTER=""  
5. Go to resources/js/components/chatroom.vue and edit the following  
let pusher = new Pusher('CHANGE THIS', {  
    cluster: 'eu',  
    forceTLS: true  
});  
let channel = pusher.subscribe('CHANGE THIS');  
You can get the necessary info from pusher dashboard Getting started section.  

6. Run "npm install".
7. Run "composer install".
8. Run "php artisan storage:link".
9. Run "php artisan migrate".
10. Run "npm run watch".
11. Run "php artisan serve".  



