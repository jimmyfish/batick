<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Bybit-logo.png/1597px-Bybit-logo.png?20211115153121" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## TL;DR

**Bybit** is a popular cryptocurrency derivatives exchange that allows users to trade futures contracts, perpetual contracts, and other cryptocurrency-based financial products. While the platform is known for its advanced trading tools and features, many users may want to test their trading strategies before risking real money. That's where a sandbox environment app comes in.

A sandbox environment app for Bybit would be a platform that allows users to simulate trading in a virtual environment without using real funds. This type of app would be ideal for new traders who are still learning the ins and outs of trading cryptocurrency, as well as experienced traders who want to test new strategies before risking real money.

The sandbox environment would replicate the features and functionality of the real Bybit platform, allowing users to place orders, manage positions, and track their profits and losses in real-time. The app would provide access to all of the trading tools and features available on the Bybit platform, including charts, order books, and market data, so that users can test their strategies in a realistic trading environment.

One of the key benefits of using a sandbox environment app for Bybit is that users can experiment with different trading strategies and risk management techniques without putting their own money on the line. This can help traders identify potential weaknesses in their strategies and refine their approach before they start trading with real funds.

The app could also include educational resources and tutorials to help users learn more about cryptocurrency trading and the specific features of the Bybit platform. This would be especially useful for new traders who are just getting started in the world of cryptocurrency trading.

In addition to providing a safe and secure environment for users to test their trading strategies, a sandbox environment app for Bybit could also offer other benefits, such as:

- Real-time market data and news updates to help traders stay informed about the latest trends and developments in the cryptocurrency markets.
- Advanced charting tools and technical analysis indicators to help traders identify trends and make more informed trading decisions.
- Integration with third-party trading bots and tools to help automate trading strategies and improve efficiency.

Overall, a sandbox environment app for Bybit would be a valuable tool for traders of all skill levels who want to test their trading strategies in a risk-free environment. With access to real-time market data, advanced trading tools, and educational resources, users can improve their trading skills and make more informed decisions when they start trading with real funds.

## How to run this bad boy?

### Prerequisites

Before you can run this app, you'll need to have the following installed on your machine:

- PHP (version 7.4 or higher)
- Composer
- Node.js
- NPM
- MySQL
- A VPN client *10 out of 10 highly recommended for ID*

### Installation

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/jimmyfish/batick.git
   ```

2. Install the app's dependencies using Composer and NPM:

   ```bash
   composer install
   npm install
   ```

3. Copy the `.env.example` file and rename it to `.env`. Update the file with your database credentials:

   ```yaml
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your-database-name
   DB_USERNAME=your-database-username
   DB_PASSWORD=your-database-password
   ```

4. Generate a new application key:

   ```bash
   php artisan key:generate
   ```

5. Compile Tailwind CSS by running the following command:

   ```bash
   npm run dev
   ```

6. Run the app's database migrations:

   ```bash
   php artisan migrate
   ```
### Running the App

Before running the app, you'll need to switch on your VPN client and connect to a server in the desired country. This is important because some features of the app may be restricted in certain regions.

To run the app, use the following command:

```
php artisan serve
```

This will start a local development server at `http://localhost:8000`. You can access the app by navigating to this URL in your web browser.

### Conclusion

That's it! You should now have a working Laravel app with Tailwind CSS and a MySQL database. Remember to switch on your VPN client before running the app to ensure that all features are available. If you run into any issues, please refer to the Laravel documentation or consult the official documentation for Tailwind CSS or MySQL.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

This sandbox supposed to be private work but you can treat it as an open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
