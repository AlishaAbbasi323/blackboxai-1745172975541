
Built by https://www.blackbox.ai

---

```markdown
# Free Book Exchange

## Project Overview
Free Book Exchange is a web-based application that allows users to log in and exchange books. Users can add their books, view available listings, edit their own books, and manage their accounts. The application is created using PHP and leverages a simple JSON file to store user and book data.

## Installation
To set up the Free Book Exchange on your local machine, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/your_username/free-book-exchange.git
   ```
2. Navigate into the project directory:
   ```bash
   cd free-book-exchange
   ```
3. Make sure you have a server running that supports PHP (e.g., XAMPP, WAMP, or a live server).
4. Place the project files in the server's root directory (e.g., `htdocs` for XAMPP).
5. Open your web browser and navigate to `http://localhost/free-book-exchange/login.php`.

## Usage
1. **Login**: Use the default credentials to log in:
   - Username: `admin`
   - Password: `admin123`
   
2. **Manage Books**: Once logged in, you can:
   - Add new books.
   - View all available books.
   - Edit or delete your own listings if you're the owner or if you're an admin.

3. **Logout**: Click on the "Logout" link to exit your session.

## Features
- User authentication (login/logout).
- Admin and user roles.
- Adding new book listings.
- Viewing available books with details.
- Editing and deleting personal book listings.
- Simple and responsive design using Tailwind CSS.

## Dependencies
This project uses the following dependencies:
- [Tailwind CSS](https://tailwindcss.com/) for styling (included via CDN).
- [Font Awesome](https://fontawesome.com/) for icons (included via CDN).

## Project Structure
```
├── add_book.php         # Page to add a new book
├── delete_book.php      # Script to delete a book
├── edit_book.php        # Page to edit an existing book
├── index.php            # Home page displaying available books
├── login.php            # Login page
├── logout.php           # Script to handle user logout
├── save_book.php        # Script to save a new book to JSON
├── user.php             # User account page displaying their books
├── users.json           # JSON file storing usernames and passwords
└── books.json           # JSON file storing book listings
```

## Contributing
Contributions are welcome! Please fork the repository and create a pull request for any changes or improvements.

## License
This project is open source and available under the [MIT License](LICENSE).
```