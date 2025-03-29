-- Create the users table
CREATE TABLE users (
    user_id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    user_type ENUM('admin', 'sub-admin', 'cashier') NOT NULL
);

-- Create the nationalities table
CREATE TABLE nationalities (
    nationality_id int(11) AUTO_INCREMENT PRIMARY KEY,
    nationality_name VARCHAR(100) NOT NULL
);

-- Create the religions table
CREATE TABLE `religions` (
    `religion_id` int(11) AUTO_INCREMENT PRIMARY KEY,
    `religion_name` VARCHAR(100) NOT NULL
);

-- Create the school_year table
CREATE TABLE `school_year` (
    `school_year_id` int(11) AUTO_INCREMENT PRIMARY KEY,
    `school_year` VARCHAR(20) UNIQUE NOT NULL,
    `is_active` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create the grade_levels table
CREATE TABLE grade_levels (
    grade_level_id int(11) AUTO_INCREMENT PRIMARY KEY,
    grade_name VARCHAR(255) NOT NULL,
    department ENUM('Early Education', 'Elementary', 'Junior High School', 'Senior High School') NOT NULL
);

-- Drop existing tables if they exist
DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS refregion;
DROP TABLE IF EXISTS refprovince;
DROP TABLE IF EXISTS refcitymun;
DROP TABLE IF EXISTS refbrgy;

-- Create refregion table
CREATE TABLE refregion (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    psgcCode VARCHAR(255) DEFAULT NULL,
    regDesc TEXT,
    regCode VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create refprovince table
CREATE TABLE refprovince (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    psgcCode VARCHAR(255) DEFAULT NULL,
    provDesc TEXT,
    regCode VARCHAR(255) DEFAULT NULL,
    provCode VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create refcitymun table
CREATE TABLE refcitymun (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    psgcCode VARCHAR(255) DEFAULT NULL,
    citymunDesc TEXT,
    regDesc VARCHAR(255) DEFAULT NULL,
    provCode VARCHAR(255) DEFAULT NULL,
    citymunCode VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create refbrgy table
CREATE TABLE refbrgy (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    brgyCode VARCHAR(255) DEFAULT NULL,
    brgyDesc TEXT,
    regCode VARCHAR(255) DEFAULT NULL,
    provCode VARCHAR(255) DEFAULT NULL,
    citymunCode VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create the students table
CREATE TABLE students (
    student_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    last_name VARCHAR(100) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100) NOT NULL,
    suffix VARCHAR(10),
    region_id INT(11) NOT NULL,
    province_id INT(11) NOT NULL,
    municipality_id INT(11) NOT NULL,
    barangay_id INT(11) NOT NULL,
    street_address VARCHAR(255) NOT NULL,
    zip_code VARCHAR(10) NOT NULL,
    date_of_birth DATE NOT NULL,
    place_of_birth VARCHAR(100) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    nationality_id INT(11) NOT NULL,
    religion_id INT(11) NOT NULL,
    prev_grade_lvl INT(11) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    contact VARCHAR(20) NOT NULL,
    school_last_attended VARCHAR(255) NOT NULL,
    school_address VARCHAR(255) NOT NULL,
    father_name VARCHAR(100) NOT NULL,
    father_occupation VARCHAR(100) NOT NULL,
    father_contact_number VARCHAR(20) NOT NULL,
    mother_name VARCHAR(100) NOT NULL,
    mother_occupation VARCHAR(100) NOT NULL,
    mother_contact_number VARCHAR(20) NOT NULL,
    guardian_name VARCHAR(100) NOT NULL,
    guardian_relationship VARCHAR(100) NOT NULL,
    guardian_contact_number VARCHAR(20) NOT NULL,
    school_year_id INT(11) NOT NULL,
    type_of_student ENUM('New/Transferee', 'Old') NOT NULL,
    grade_applying_for INT(11) NOT NULL,
    academic_track VARCHAR(100) DEFAULT NULL,
    academic_semester VARCHAR(50) DEFAULT NULL,
    appointment_date DATE DEFAULT NULL,
    appointment_time TIME DEFAULT NULL,
    birth_certificate VARCHAR(255) NOT NULL,
    report_card VARCHAR(255) NOT NULL,
    id_picture VARCHAR(255) NOT NULL,

    -- Foreign Key Constraints
    FOREIGN KEY (region_id) REFERENCES refregion(id) ON DELETE CASCADE,
    FOREIGN KEY (province_id) REFERENCES refprovince(id) ON DELETE CASCADE,
    FOREIGN KEY (municipality_id) REFERENCES refcitymun(id) ON DELETE CASCADE,
    FOREIGN KEY (barangay_id) REFERENCES refbrgy(id) ON DELETE CASCADE,
    FOREIGN KEY (nationality_id) REFERENCES nationalities(nationality_id) ON DELETE CASCADE,
    FOREIGN KEY (religion_id) REFERENCES religions(religion_id) ON DELETE CASCADE,
    FOREIGN KEY (prev_grade_lvl) REFERENCES grade_levels(grade_level_id) ON DELETE CASCADE,
    FOREIGN KEY (school_year_id) REFERENCES school_year(school_year_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
