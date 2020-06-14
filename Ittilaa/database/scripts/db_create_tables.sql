CREATE TABLE X_NOTIFICATIONS (
    notice_id int AUTO_INCREMENT PRIMARY KEY,
    title varchar(255) NOT NULL,
    category enum('NOTICE', 'JOB', 'TENDER', 'POLICY'),
    notice_path varchar(255) NOT NULL,
    notice_ext varchar(8) NOT NULL,
    description text,
    region varchar(255) NOT NULL,
    approval_by varchar(255),
    approval_date DATETIME,
    publishing_authority varchar(255),
    publish_date DATETIME,
    notifier varchar(255),
    notifier_designation varchar(255),
    source_url varchar(255)
);

CREATE TABLE X_TAGS(
    tag_id int AUTO_INCREMENT PRIMARY KEY,
    tag varchar(255) NOT NULL UNIQUE
);

CREATE TABLE X_NOTICE_TAGS(
    id int AUTO_INCREMENT PRIMARY KEY,
    notice_id int NOT NULL,
    tag_id int NOT NULL,
    FOREIGN KEY (notice_id) REFERENCES X_NOTIFICATIONS(notice_id),
    FOREIGN KEY (tag_id) REFERENCES X_TAGS(tag_id)
);

CREATE TABLE X_ORG_STRUCTURE(
    dept_id int AUTO_INCREMENT PRIMARY KEY,
    dept_name varchar(255) NOT NULL UNIQUE,
    head_dept_id int,
    FOREIGN KEY (head_dept_id) REFERENCES X_ORG_STRUCTURE(dept_id)
);

CREATE TABLE X_REGIONS(
    region_id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) NOT NULL UNIQUE
);

CREATE TABLE X_USERS(
    user_id int AUTO_INCREMENT PRIMARY KEY,
    password varchar(255) NOT NULL,
    category enum ('GUEST', 'DATA_ENTRY_OPERATOR', 'ADMIN') NOT NULL
);

CREATE TABLE X_USER_NOTIFICATION_FEEDBACK(
    id int AUTO_INCREMENT PRIMARY KEY,
    notice_id int NOT NULL,
    user_id int NOT NULL,
    comment varchar(255),
    FOREIGN KEY (notice_id) REFERENCES X_NOTIFICATIONS(notice_id),
    FOREIGN KEY (user_id) REFERENCES X_USERS(user_id)
);