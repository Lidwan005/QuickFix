-- ============================================================
--  STACK SQUAD - SERVICE BOOKING PLATFORM DATABASE
--  DATABASE NAME: SS2027
-- ============================================================

CREATE DATABASE IF NOT EXISTS SS2027;
USE SS2027;

-- ============================================================
-- 1. USER TABLE
-- ============================================================
CREATE TABLE User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    user_type ENUM('customer', 'provider', 'admin') NOT NULL DEFAULT 'customer',
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- 2. PROVIDER PROFILE (one-to-one with User)
-- ============================================================
CREATE TABLE Provider_Profile (
    provider_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    business_name VARCHAR(150) NOT NULL,
    description TEXT,
    service_category VARCHAR(120),
    rating DECIMAL(3,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_provider_user
        FOREIGN KEY (user_id) REFERENCES User(user_id)
        ON DELETE CASCADE
);

-- ============================================================
-- 3. SERVICE (offered by providers)
-- ============================================================
CREATE TABLE Service (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    provider_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    duration_minutes INT NOT NULL,
    category VARCHAR(120),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_service_provider
        FOREIGN KEY (provider_id) REFERENCES Provider_Profile(provider_id)
        ON DELETE CASCADE
);

-- ============================================================
-- 4. BOOKING (links customers to providers & services)
-- ============================================================
CREATE TABLE Booking (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    provider_id INT NOT NULL,
    service_id INT NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    status ENUM('pending', 'approved', 'completed', 'cancelled') 
        DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_booking_customer
        FOREIGN KEY (customer_id) REFERENCES User(user_id)
        ON DELETE CASCADE,

    CONSTRAINT fk_booking_provider
        FOREIGN KEY (provider_id) REFERENCES Provider_Profile(provider_id)
        ON DELETE CASCADE,

    CONSTRAINT fk_booking_service
        FOREIGN KEY (service_id) REFERENCES Service(service_id)
        ON DELETE CASCADE
);

-- ============================================================
-- 5. REVIEW (one review per booking)
-- ============================================================
CREATE TABLE Review (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL UNIQUE,
    customer_id INT NOT NULL,
    provider_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    review_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_review_booking
        FOREIGN KEY (booking_id) REFERENCES Booking(booking_id)
        ON DELETE CASCADE,

    CONSTRAINT fk_review_customer
        FOREIGN KEY (customer_id) REFERENCES User(user_id)
        ON DELETE CASCADE,

    CONSTRAINT fk_review_provider
        FOREIGN KEY (provider_id) REFERENCES Provider_Profile(provider_id)
        ON DELETE CASCADE
);

-- ============================================================
-- 6. NOTIFICATION (messages shown in dashboards)
-- ============================================================
CREATE TABLE Notification (
    notification_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    status ENUM('unread', 'read') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_notification_user
        FOREIGN KEY (user_id) REFERENCES User(user_id)
        ON DELETE CASCADE
);

-- ============================================================
-- END OF SCHEMA
-- ============================================================
