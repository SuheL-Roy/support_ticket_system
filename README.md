# Test Project For Software Developer(Support Ticket System)

## Overview

Design a lightweight Support Ticket System for a startup.The system should allow users to submit tickets, and admins to manage them.


## Setup Instructions

1.  **Clone the repository:**
    ```bash
    git clone <repository_url>
    cd <project_directory>
    ```

2.  **Install Composer dependencies:**
    ```bash
    composer install
    ```

3.  **Copy the `.env.example` file to `.env` and configure your database:**
    ```bash
    cp .env.example .env
    # Edit the .env file with your database credentials
    ```

4.  **Generate the application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Run database migrations and seed:**
    ```bash
    php artisan migrate:fresh --seed
    ```
9.  **Serve the application:**
    ```bash
    http://localhost/(your project folder)
    ```
10.  **Admin Login Credentials:**
    Admin Email: admin@gmail.com
    Password: 12345678
11.  **Customer Login Credentials:**
    Customer Email: customer@gmail.com
    Password: 12345678

## Accessing the Application

* **Admin Users:** Admin users can log in through the `/login` page using their credentials.
    Upon successful login, they are redirected to the Admin Panel where they can manage All Ticket (create Ticket,Update Ticket Status).
* **Customer Registration:** If a user does not have an account yet, they can visit the `/register` page to    create one.After registering and logging in, they will gain access to the Customer Panel, where they can:

     View their own Ticket List

     Create new tickets

     Track the history of their submitted tickets

     Check the current status of each ticket.