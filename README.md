<p align="center"><img src="https://raw.githubusercontent.com/wearehalcyon/neutrino/main/public/favicon.png" alt="Neutrino CMS" width="120" height="120"></p>

### Actual version:
- 0.5.1 (BETA)

## About Neutrino CMS

Neutrino CMS: An innovative content management system built on the powerful Laravel Framework. Neutrino CMS offers:

- <strong>An intuitive interface</strong> for easy management of your content.
- <strong>High performance and reliability</strong>, thanks to the use of modern Laravel technologies.
- <strong>Flexibility and scalability</strong>: easily customizable and extensible features to meet any of your business needs.
- <strong>Comprehensive functionality</strong>: including form submission and management, theme creation support, and much more.

With Neutrino CMS, creating and managing websites becomes simpler and more efficient!

## Requirements

- PHP 8.0 or higher
- Apache/Nginx server
- Node 18 or higher

## License

The Neutrino CMS is open-sourced software licensed under the [GPL-3.0 license](https://github.com/wearehalcyon/neutrino?tab=GPL-3.0-1-ov-file#readme).

## INSTALLATION:

#### Step 1:
Clone Neutrino to your device

<code>git clone git@github.com:wearehalcyon/neutrino.git project-name</code>

<i>PS. Index directory should be "/public".</i>

#### Step 2:
- Set up <strong>.env</strong> file (Copy from <strong>.env.example</strong> or create manualy).
- Set base64 app code: <code>php artisan key:generate</code>.
- Set database connection.
- <strong>Optional:</strong> set DB_SOCKET if needed.
- Import tables from <strong>database.sql</strong> file.

#### Step 3:

Run composer

<code>composer update</code>

#### Step 4:

Run npm commands (minimum node version is 18^)

<code>npm install</code>

<code>npm run build</code>

#### Step 5:

Generate App key

<code>php artisan key:generate</code>

#### Step 6:

Login to dashboard with base credentials
<br>
<strong>Login: </strong><i>admin@admin.com</i>
<br>
<strong>Password: </strong><i>Administrator</i>

<hr>

Enjoy! :)
<br>
And don't forget to change your Administrator credentials!
