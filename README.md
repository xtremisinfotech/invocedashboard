# Stripe Invoice Dashboard UI - Laravel & Livewire

This project recreates a simplified version of the Stripe Invoice Dashboard UI using **Laravel**, **Livewire**, and **TailwindCSS**. The dashboard features tabs for filtering invoices, a table with dynamic rows, and a dropdown for each invoice. It’s designed to be responsive on desktop screens.

## Features
- **Tabs with Filtering**: Implement clickable tabs (All invoices, Draft, Outstanding, Paid) that filter the table rows dynamically using Livewire.
- **Invoice Table**: A table with the following columns:
  - Amount
  - Invoice Number
  - Customer Email
  - Status (e.g., Draft, Paid) with colored labels.
  - Created Date
- **Dynamic Dropdown**: A dropdown menu for each row that shows placeholder like Download, Delete.
- **Styling**: TailwindCSS for styling, replicating the look and feel of Stripe's invoice dashboard.
- **Responsive Design**: The layout is optimized for desktop view.

## Technical Setup

### Prerequisites
Make sure you have the following installed:
- **PHP 8.1+**
- **Composer**: For PHP package management
- **Node.js** (for compiling assets)
- **MySQL** (or any other database Laravel supports)

### Steps to Run Locally

1. **Clone the Repository**
    ```bash
    git clone https://github.com/xtremisinfotech/invocedashboard.git
    cd invocedashboard
    ```

2. **Install Dependencies**
    - Install **Composer** dependencies:
    ```bash
    composer install
    ```

    - Install **Node.js** dependencies:
    ```bash
    npm install
    ```

3. **Setup Environment File**
    - Copy the `.env.example` to `.env`:
    ```bash
    cp .env.example .env
    ```
    - Open the `.env` file and configure your database connection settings.

4. **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5. **Migrate Database**
    - Run migrations (if you have any database tables):
    ```bash
    php artisan migrate
    ```

6. **Compile Assets**
    - Compile the CSS and JavaScript assets using Laravel Mix:
    ```bash
    npm run dev
    ```

7. **Start the Development Server**
    - Run the Laravel development server:
    ```bash
    php artisan serve
    ```

    - Visit the app in your browser:
    ```
    http://localhost:8000
    ```

### Features Implementation

1. **Livewire Filtering**:
    - Tabs (All invoices, Draft, Outstanding, Paid) are implemented using **Livewire** components for dynamic content updates.
    - Filter invoices by their status with Livewire-powered filtering.

2. **Invoice Table**:
    - The table rows are populated with seeder invoice data (30 rows).
    - The table includes the following columns:
        - Amount
        - Invoice Number
        - Customer Email
        - Status (Draft, Paid) with color-coded labels
        - Created Date

3. **Dynamic Dropdown**:
    - Each row in the table has a dropdown with placeholder options (Download, Delete).
    - The dropdown is implemented using **Livewire** to toggle the visibility dynamically.

4. **Styling**:
    - TailwindCSS is used for styling. The project is built to resemble the Stripe Invoice Dashboard UI as closely as possible.

5. **Responsive Design**:
    - The layout is designed to be responsive on desktop devices. (Mobile responsiveness is not implemented fully it can be viewed in mobile though).

### Export Action (New Feature)
- Added an export button that allows users to export data based on the active filter.

## License

This project is open-source and available under the [MIT License](LICENSE).
