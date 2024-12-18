# **Voting App**

A simple web application to vote on products and manage them through an admin interface.

---

## **Setup Instructions**

### **1. Prepare the Database**
1. Open PhpMyAdmin or your preferred database tool.
2. Create a new database (e.g., `voting_app`).
3. Paste and execute the following SQL script:

```sql
CREATE DATABASE voting_app;
USE voting_app;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image_filename VARCHAR(255) NOT NULL,
    upvotes INT DEFAULT 0,
    downvotes INT DEFAULT 0
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
```

---

### **2. Start the Application**
1. Navigate to the project folder in your terminal.
2. Start the PHP built-in server:
   ```bash
   php -S localhost:8000
   ```
3. Open your browser and visit:  
   [http://localhost:8000](http://localhost:8000)

---

### **3. Login Credentials**

#### **User Login**
- **Username:** `user`  
- **Password:** `user`  

#### **Admin Login**
- **Username:** `admin`  
- **Password:** `admin`

---

### **Features**
- **Users:**
  - View products.
  - Vote (upvote/downvote) on products.
- **Admins:**
  - Add new products with images.
  - Delete or update product titles.


---

Enjoy using the **Voting App**! 🚀
