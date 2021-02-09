# News and Events

There are two separate applications for this project. This is the first one from the following:
1. Admin application where admin users will log in to the platform and create news and events articles. (https://github.com/abhinav098/news_and_events)
2. Frontend application (Vue.js) for visitors that lists down all the news and events created by the backend. Visitors can search, filter, and sort the results based upon their search requirements. (https://github.com/abhinav098/news_and_events_listing)

Features: 

Admin application -
- User can to login to the admin app
- User can add, edit, delete events
- User can add, edit, delete news posts
- File upload for events on S3 and image upload for news on S3.

Frontend -
- Display news and events on the frontend
- Visitors can search by event name or news headline on their respective pages
- Show page for events and news resource
- News filter by months
- Visitors can sort news by date
- Visitors can filter events by month
- Event filter by location - Done

# Installation

1. Please install the dependencies after you clone the project. After that, run "npm run watch”  to compile the js and scss files. 
2. For setting up the database. Please go to the .env file and set your mysql db credentials there.
3. For image and file upload, you’ll have to setup your s3 credentials for the bucket in the .env file. 
4. For getting started, I have set up a seed file to create some data. To create the seed data, we need to run the command "php artisan db:seed” in the console and you’ll be good to go.
5. To run the server, please run "php artisan serve” and the application will be hosted on your local.
6. For registering a new user, please visit “/register” URL.

# Login
For Logging in, go to the seed file and checkout the login credentials. 
