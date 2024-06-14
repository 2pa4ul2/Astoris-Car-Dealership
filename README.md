<p align="center">
    <img width="60%" src="https://github.com/2pa4ul2/Astoris-Car-Dealership/blob/main/assets/images/AstorisLogo.png" alt="home"/>
</p>

<h1 align = "center">Astoris Car Dealership</h1>
<h4 align = "center">Database Final Project on Computer Science Electives (CSE4) Using PHPMyAdmin and SQL</h4>


## Features
 
  - User Authentication: Secure user login and registration system.
  - Dynamic Content: Content management using a MySQL database.
  - Admin Panel: Admin interface for managing users and content.
  - CRUD Operations: Full Create, Read, Update, and Delete functionality.

## Requirements
  ### Running the App
  - XAMPP (Download from Apache Friends)
  - Web browser (e.g., Chrome, Firefox)
  - Text editor (e.g., VSCode, Sublime Text)

  ### Technologies
  - PHP
  - MySQL
  - HTML
  - CSS
  - JavaScript
  - Tailwind CSS
  - Flowbite

## Installation & Usage

1. Install `XAMPP Application`
2. Install `PHP Server` in VScode Extensions
3. Clone the repository:
   ```bash
   git clone https://github.com/2pa4ul2/Astoris-Car-Dealership.git
   ```
4. Place the cloned repository in `htdocs` file of the `XAMPP Application` folder
5. Run `Apache` and `MySQL` in XAMPP Application
6. Open `localhost/phpmyadmin` and `localhost/Astoris-Car-Dealership`
7. In localhost/phpmyadmin create a database named `carlink` with the ff. table

   - `supplier`
     - supplier_name, contact_person, contact_number
   - `category`
     - category_id, category_name
   - `product`
     - product_id, product_name, supplier_id, category_id
   - `admn`
     - admin_id, first_name, last_name, username, password, created
   - `customer`
     - customer_id, first_name, last_name, username, password, created
   - `manager`
     - manager_id, first_name, last_name, username, password, created
   - `order`
     - order_id, product_id, product_name, price, quantity, total, order_date
     - 
## Key Take Aways From This Project
- ### PHP and phpMyAdmin for Database Management
  - `Database Management`: Created and managed tables, ran SQL queries, and established relationships using PHP and phpMyAdmin.
  - `PHP Integration`: Developed dynamic web pages by integrating PHP with HTML/CSS.
  - `Data Visualization`: Integrated and customized ChartJS for dynamic data visualization.
  - `Tailwind CSS`: Designed responsive web interfaces quickly using Tailwind CSS.
  - `Flowbite`: Used Flowbite for pre-designed UI components like tables, modals, and forms.
  - `CRUD Operations`: Implemented complete CRUD functionality with PHP and MySQL.
- These experiences helped me build a solid foundation in web development, database management, and UI design.

## Contact
- For questions, suggestions, or feedback, please contact:

  - Email: pauladrian0224@gmail.com
  - GitHub: 2pa4ul2
  
## Website Demo

<p align="center">
    

https://github.com/2pa4ul2/Astoris-Car-Dealership/assets/95076322/8f579f1e-9706-464a-8278-01a113944449


</p>


<h5 align="center">Created By Paul Adrian Torres</h5>
