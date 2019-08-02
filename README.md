# Laravel-Project
hướng dẫn sử dụng
git clone https://github.com/quyenhn/Laravel-Project.git
sau khi clone, cd tới thu mục chứa project chạy terminal : composer install
cp .env.example .env
php artisan key:generate
mở .env dien tt db:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your db name
DB_USERNAME=your db username
DB_PASSWORD=your db password
sau do : php artisan migrate
tiep theo: npm install 
			npm run dev
sau do bat 2 terminal: 1 chay php artisan serve
						1 chay node server.js