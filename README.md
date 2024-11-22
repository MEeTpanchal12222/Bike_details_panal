


# Bike Management System

The **Bike Management System** is a web application built using PHP, MySQL, HTML, CSS, and Bootstrap. It provides a user-friendly interface for managing bike details, including CRUD (Create, Read, Update, Delete) operations. The system is designed to handle bike-related information, such as name, type, mileage, top speed, engine type, and images.

---

## Features

### 1. **User-Friendly Interface**
   - Professional and responsive UI designed with Bootstrap.
   - Easy navigation through all pages.

### 2. **CRUD Operations**
   - **Create:** Add new bike details, including images.
   - **Read:** View all bike details in a structured table.
   - **Update:** Edit bike information seamlessly.
   - **Delete:** Remove unwanted bike entries.

### 3. **Image Management**
   - Upload and display bike images dynamically.

### 4. **Dynamic Database**
   - Uses a MySQL database to store and manage bike details.

### 5. **Navigation**
   - Intuitive navigation with a responsive header.
   - Includes a **Back** button for better user experience.

### 6. **Error Handling**
   - Ensures all inputs are validated.
   - Displays appropriate error messages for missing or incorrect data.

---

## Screenshots

### Home Page (List of Bikes)
![Home Page](https://github.com/user-attachments/assets/a02fd64f-9336-4881-9bd2-0d41df827cbf)
![Home Page](https://github.com/user-attachments/assets/29bdd38d-09c7-436f-91ae-d201f8614528)



### Edit Bike Details
![Add Bike](https://github.com/user-attachments/assets/26d63988-5bf9-4919-b47d-0868f3b46ff1)
![Add Bike](https://github.com/user-attachments/assets/a6be026d-5306-47e7-a3c6-e47032fa66ec)



### Add New Bike
![Edit Bike](https://github.com/user-attachments/assets/289ba173-99ac-4a0a-acfc-bca222061089)


---
## Video



https://github.com/user-attachments/assets/23173f91-4a29-479c-ba5d-36838ed1922a


---

## Technologies Used

- **Frontend:**
  - HTML5
  - CSS3
  - Bootstrap 5

- **Backend:**
  - PHP 8.2

- **Database:**
  - MySQL

---

## Installation Guide

### Prerequisites
- XAMPP or any web server with PHP and MySQL support.
- A browser to access the application.

### Steps
1. Download and install [XAMPP](https://www.apachefriends.org/index.html).
2. Clone this repository or download the ZIP file.
3. Extract the project to the `htdocs` folder of your XAMPP installation directory.
   - Example path: `C:/xampp/htdocs/Bike_details_panal/`
4. Start Apache and MySQL in XAMPP Control Panel.
5. Open PHPMyAdmin in your browser: [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
6. Create a new database:
   - Name: `bikes`
   - Import the SQL file: `bikes.sql` included in the project.
7. Access the application in your browser:
   - [http://localhost/Bike_details_panal/](http://localhost/Bike_details_panal/)

---

## Project Structure

```plaintext
Bike_details_panal/
├── add_bike.php          # Page to add new bikes
├── bikes.php             # Main page to list all bikes
├── edit_bike.php         # Page to edit existing bike details
├── delete_bike.php       # Script to delete bike details
├── uploads/              # Folder to store uploaded images
├── css/                  # Optional custom CSS (if used)
└── screenshots/          # Screenshots for documentation
```

---

## Future Enhancements

- Add user authentication for admin access.
- Implement search and filter functionality for bike details.
- Enhance image handling with cropping and preview before upload.
- Add a feature to export bike data as CSV or PDF.
- Responsive enhancements for mobile devices.

---

## Contribution

Contributions are welcome! If you have suggestions or improvements, feel free to open a pull request or raise an issue.

---

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

