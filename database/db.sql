CREATE DATABASE teams_management
Use teams_management 
    
CREATE TABLE teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(255) NOT NULL,
    team_size INT NOT NULL,
    year INT NOT NULL,
    department VARCHAR(255) NOT NULL
);

CREATE TABLE team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_id INT NOT NULL,
    member_name VARCHAR(255) NOT NULL,
    roll_no VARCHAR(50) NOT NULL,
    member_role VARCHAR(50) NOT NULL,
    member_email VARCHAR(255) NOT NULL,
    member_phone VARCHAR(15) NOT NULL,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE CASCADE
);

CREATE TABLE projects_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    leader VARCHAR(255) NOT NULL,
    members TEXT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    ppt VARCHAR(255) NOT NULL,
    abstract TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);