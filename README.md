# commercecore

### Folder `commercecore-api`:
Backend code with Laravel. Customize database settings in `.env` and run `php artisan migrate` to create the tables, then `php artisan serve` to launch the server.

### Folder `commercecore`: 
Front-end Vue.js code. For a quick run launch it with `npm run serve`. 
Before launching, make sure the Laravel backend url in `axios.defaults.baseUrl` in `src/main.js` is correct.
