To use the Symfony Mailer package with Laravel 11 for sending emails from your localhost, follow these steps:

## Step 1: Install Symfony Mailer
First, you need to install the Symfony Mailer package. Run the following command in your Laravel project's root directory:
```bash
composer require symfony/mailer
```
## Step 2: Configure Your Environment
Update the .env file in your Laravel project with the necessary mail configuration details. If you are working locally, you might use a service like Mailtrap for testing, or configure it to use SMTP directly. Below is an example configuration:

```env
MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="your-email@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

If using Mailtrap for testing purposes:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="your-email@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## Step 3: Create a Mailable Class
Generate a mailable class using the Artisan command:

```bash
php artisan make:mail TestMail
```
This will create a TestMail class in the App\Mail directory. Open the newly created TestMail.php file and modify it as needed:

```php
<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function build()
    {
        return $this->from('your-email@example.com')
                    ->subject('Test Email')
                    ->view('emails.test');
    }
}
```
## Step 4: Create an Email View
Create a simple Blade view for your email content. You can create a new view file in resources/views/emails/test.blade.php:

```blade
<!-- resources/views/emails/test.blade.php -->
    <!DOCTYPE html>
    <html>
    <head>
        <title>Test Email</title>
    </head>
    <body>
        <h1>Hello, this is a test email!</h1>
        <p>This email was sent using Symfony Mailer in Laravel 11.</p>
    </body>
    </html>
```
## Step 5: Send the Email
In one of your controllers or routes, use the Mail facade to send an email:
```php
    use App\Mail\TestMail;
    use Illuminate\Support\Facades\Mail;
    
    Route::get('/send-mail', function () {
        Mail::to('recipient@example.com')->send(new TestMail());
        return 'Email sent successfully!';
    });
```
## Step 6: Test the Email
Run your Laravel application using php artisan serve and visit http://localhost:8000/send-mail. This should trigger the email to be sent to the specified recipient.

Notes:
Ensure your mail server (like SMTP) runs locally on the specified port.
If using Mailtrap, replace the placeholders in the .env file with your Mailtrap credentials.
This setup should allow you to send emails from your localhost using Laravel 11 with Symfony Mailer.
