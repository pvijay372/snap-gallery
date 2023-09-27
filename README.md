SnapGallery

Step 1: clone repo
Step 2: composer install
Step 3: npm install
Step 4: npm run dev
Step 5: setup db and edit in .env file (copy .env from .env.example)
Step 6: php artisan migrate
Step 7: php artisan storage:link
Step 8: php artisan serve



Project Description:

The main idea behind this app is to allow people to create collections of photos. Users can make collections, upload photos in those collections and all the collections will be publicly visible on the homepage.

1. Users can create a collection by providing an email id and name of the collection
2. Authentication is not required, you can simply link the collections with the email id which the users will provide at the time of making a collection
3. Next step is to be able to upload photos in the collection (number of photos each collection can have should be configurable and the size of each file should be configurable)
4. All the collections will be publicly visible on the homepage
5. Now the main task is to be able to allow only the owner of the collection to be able to edit the collection (you can think of your own way to implement this, show your creativity)
6. Data should be stored in a DB
7. Design is not required, just keep it simple
8. Use of vue.js will be a plus point for you
9. Multi-lingual support will be a plus
10. Make a public repo on GitHub to share your code with us (This is required)