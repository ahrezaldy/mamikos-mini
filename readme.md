# mamikos-mini

### Installation
1. Set up your web & database server.
3. Clone this repo to your server / local machine.
```
git clone https://github.com/ahrezaldy/mamikos-mini.git
```
3. Execute
```
Composer install
```
4. Rename file `.env.example` to `.env` and edit based on your server setting.
```
. . .
APP_URL=http://localhost:8000
. . .
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mamikos
DB_USERNAME=mamikos
DB_PASSWORD=mamikos
. . .
```
5. Execute
```
php artisan key:generate
```
and make sure `APP_KEY` in `.env` file has value.

6. Execute
```
php artisan migrate:refresh --seed
```
7. (Optional) Execute
```
php artisan serve
```
if no web server provided. If this step is done, base URL will be `http://localhost:8000`

### User & Auth
There will be 3 default user provided.
1. Admin/Owner
```
username: admin
password: secret
```
Have 1 room with ID `1`.

2. Regular User
```
username: user
password: secret
```
3. Premium User
```
username: pro
password: secret
```
The API require `Basic Auth` method. To access available API, use provided `username` & `password` above.

### Endpoint
1. GET /api/rooms
- Endpoint to get all rooms which availability more than 0.
- Support sort by price / availability (?sort_by=...)
- Support search by name & city (?name=...&city=...)
- Support search by price range (?price=...-...)
2. GET /api/rooms/{id}
- Endpoint to get one room detail
3. POST /api/rooms
- Endpoint to create one new room. Required fields: `name`, `city`, `price`, `availability`.
4. PUT /api/rooms/{id} or PATCH /rooms/{id}
- Endpoint to update some/all field(s) of one room. Available fields: `name`, `city`, `price`, `availability`.
5. DELETE /api/rooms/{id}
- Endpoint to delete one room.
6. POST /api/rooms/book/{id}
- Endpoint to booking one room.
- Room availability will be decrease by 1.
- User's credit will be decrease by 5.

### Page
1. /reset_all_credits
- Used to reset user's credit, except Admin/Owner.

### Drawbacks
1. No timed request to reset credits every month. Manually hit given URL above to reset user's credits

### Time to Finish: ~6 hours
