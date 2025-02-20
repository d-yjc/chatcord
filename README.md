<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Chatcord

Chatcord is a messaging platform connecting people like a cord through chats. Powered by Laravel Sail 11.x and Vite.

### ⚙️ Installation

1. **Clone the repository**
`git clone https://github.com/your-username/chatcord.git`
`cd chatcord`

2. **Install dependencies**
`composer install npm install`

3. **Set up environment variables**
`cp .env.example .env` 
`php artisan key:generate`


4. **Run the application**
#### Start Laravel Sail 
`php artisan migrate`
 #### Run database migrations 
`/vendor/bin/sail up -d `
 #### Compile frontend assets
`npm run dev`

5. **Access the app**  
Open your browser and visit:  
👉 `http://localhost`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
