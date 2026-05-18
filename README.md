# Task-System

Simple web application for project and task management built with PHP and MySQL.

---

## Technologies Used

- **Language:** PHP 7.4 or higher
- **Database:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3, JavaScript (`js/app.js`)
- **Web Server:** Apache / Nginx compatible

---

## Key Features

- **User Authentication:** Integrated registration and login management (`registro.php` / `login.php`).
- **Project Organization:** Dedicated module to create, list, and manage distinct projects.
- **Task Management:** Dynamic workflow inside projects to add, describe, and update task statuses.
- **Client-Side Logic:** Clean interactions handled via JavaScript for an improved user experience.
- **Modular Architecture:** Structured codebase separating core configuration, views, and action endpoints.

---

## System Requirements

- PHP 7.4 or higher
- Web server (Apache, Nginx) with PHP enabled
- MySQL or MariaDB Server

---

## Database Schema

The application relies on the following database structure. Ensure your server is running and execute this script:

```sql
CREATE DATABASE task_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE task_system;

CREATE TABLE proyectos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL
);

CREATE TABLE tareas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  proyecto_id INT NOT NULL,
  titulo VARCHAR(255) NOT NULL,
  descripcion TEXT,
  estado TINYINT DEFAULT 0,
  creada_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (proyecto_id) REFERENCES proyectos(id) ON DELETE CASCADE
);

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

```

---

## Installation and Setup

Follow these steps to deploy and run the project locally on your web server:

### 1. Clone the project

Copy the project folder to your web server's public directory (e.g., `htdocs` or `www`):

```bash
git clone [https://github.com/loreennzzo016/Task-System.git](https://github.com/loreennzzo016/Task-System.git)

```

### 2. Configure Database Connection

Open and edit the database configuration file with your local credentials:

```text
inc/conexion.php

```

### 3. Run the Application

Open your preferred web browser and navigate to the project URL to register a new user:

```text
http://localhost/Task-System/

```

---

## Project Structure

- `index.php` - Main entry point and presentation layer.
- `inc/conexion.php` - Database connection and configuration setup.
- `js/app.js` - Client-side logic handles.
- `vistas/` - Views, templates, and layout assets.
- `php/` - Server-side action endpoints (add, edit, delete, status changes).

---

## Contributing

If you want to improve the project, fix bugs, or add new features:

1. Fork this repository.
2. Create a branch for your feature (`git checkout -b feature/NewFeature`).
3. Commit your changes (`git commit -m 'Add: New functionality'`).
4. Push the branch (`git push origin feature/NewFeature`).
5. Open a Pull Request.

---

Developed by [loreennzzo016](https://github.com/loreennzzo016).
