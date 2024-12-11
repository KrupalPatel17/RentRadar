# <span style="font-size: 3em; font-weight: bold;">RentRadar 🏡</span>

**Your ultimate solution for seamless house rentals!**

<div style="display: flex; align-items: center; justify-content: space-between;">
  <img src="https://cdn.dribbble.com/users/5068307/screenshots/14301530/media/a549df3302d078abacc7955d46c70a77.gif" alt="RentRadar Banner" width="400" style="margin-left: 20px;">
</div>

---

## 🏠 Overview

RentRadar is a web application designed to streamline the house rental process. With dedicated sections for admins, owners, and users, it ensures a smooth and interactive experience for all stakeholders. Whether you want to list a house, browse rentals, or manage your rental data, RentRadar has got you covered.

---

## 🎯 Features

### Admin Panel
- Approve or deny owner registrations and documents.
- Manage user and owner details.
- Track house listings.

### Owner Portal
- Register and upload necessary documents for admin approval.
- List houses with detailed information and images.
- Manage house listings and view user requests.

### User Experience
- Browse houses with filters for state and city.
- Live search functionality for quick results.
- Contact owners through a request system.

---

## 🚀 Tech Stack

| Frontend  | Backend  | Database | Other Tools         |
|-----------|----------|----------|---------------------|
| HTML5     | PHP      | MySQL    | AJAX                |
| CSS3      | jQuery   |          | Bootstrap           |
| JavaScript|          |          |                    |

---

## 📂 Project Structure

```
RentRadar/
├── ajax/                   # AJAX scripts for dynamic updates
├── DataBase/               # DataBase Files
├── img/                    # store house upload images
├── ScreenShort/            # Website screenshot 
├── index.php               # Landing page
└── README.md               # Documentation
```

---

## 🖥️ Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/KrupalPatel17/RentRadar.git
   ```

2. **Setup the Database**
   - Import the SQL file located in `sql/` into your MySQL database.

3. **Configure the Environment**
   - Update the database connection details in `config.php`.

4. **Start the Server**
   - Run the project using [XAMPP](https://www.apachefriends.org/) or any PHP server.

5. **Access the Application**
   - Open your browser and navigate to `http://localhost/RentRadar/`.

---

## 🎨 Live Demo (Optional Animation Section)

```mermaid
sequenceDiagram
    User->>Owner: Browse houses
    User->>Owner: Send contact request
    Owner->>Admin: Submit documents
    Admin->>Owner: Approve/Reject
    Owner->>User: Share contact details
```

---

## 💻 Screenshots

### Landing Page
![Landing Page](https://github.com/KrupalPatel17/RentRadar/blob/main/Screenshort/User/Web%20capture_6-12-2024_143123_localhost.jpeg?raw=true)

### Admin Dashboard
![Admin Dashboard](https://github.com/KrupalPatel17/RentRadar/blob/main/Screenshort/Admin/Web%20capture_6-12-2024_144716_localhost.jpeg?raw=true)

### Owner Portal
![Owner Portal](https://github.com/KrupalPatel17/RentRadar/blob/main/Screenshort/Owner/Web%20capture_6-12-2024_144451_localhost.jpeg?raw=true)

### User Side
![User Side](https://github.com/KrupalPatel17/RentRadar/blob/main/Screenshort/User/Web%20capture_6-12-2024_143151_localhost.jpeg?raw=true)

---

## 🤝 Contributions

Contributions are welcome! Please follow these steps:
1. Fork the repository.
2. Create a new branch for your feature: `git checkout -b feature-name`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature-name`
5. Create a pull request.

---

## 🌟 Acknowledgments
- Inspired by real-world rental challenges.
- Developed with ❤️ by Krupal Patel.


---

## 📧 Contact
For any queries or support, feel free to reach out to me:
- **GitHub**: [Krupal Patel](https://github.com/KrupalPatel17)


![Footer](https://via.placeholder.com/1200x100?text=Thank+You+for+Exploring+RentRadar)
