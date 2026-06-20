CREATE DATABASE IF NOT EXISTS rp_online CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE rp_online;

DROP TABLE IF EXISTS articles;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(80) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    category VARCHAR(80) NOT NULL,
    image VARCHAR(255) NOT NULL,
    summary TEXT NOT NULL,
    content MEDIUMTEXT NOT NULL,
    author VARCHAR(120) NOT NULL,
    published TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATE NOT NULL
);

INSERT INTO users (username, password_hash, role) VALUES
('admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin');

INSERT INTO articles (title, slug, category, image, summary, content, author, published, created_at) VALUES
('Dortmund und Bayern uben sich in Psychospielchen', 'dortmund-und-bayern-psychospielchen', 'Sport', 'assets/img/article-hero.png', 'Im Fernduell mit den Munchnern um die Meisterschaft redet sich der BVB stark. Die Bayern antworten mit selbstbewussten Tonen.', 'Dusseldorf. Im Fernduell mit den Munchnern um die Meisterschaft redet sich der BVB stark. Er beansprucht die Position des Teams, das alles zu gewinnen hat.\n\nDie Psychospielchen zwischen den beiden seit langem fuhrenden deutschen Klubs wurden schon mal mit groberen Werkzeugen ausgetragen. Heute geht es eher um Worte und Zeichen.', 'Robert Peters', 1, '2019-05-17'),
('Cacau halt mildes Urteil nach Rassismus-Eklat fur sehr bitter', 'cacau-urteil-rassismus-eklat', 'Sport', 'assets/img/sport-2.png', 'Drei Manner haben Nationalspieler beleidigt. Der Integrationsbeauftragte Cacau reagiert enttauscht auf das Urteil.', 'Der fruhere Nationalspieler Cacau hat das milde Urteil nach einem Rassismus-Eklat deutlich kritisiert. Fur ihn bleibt die Entscheidung ein falsches Signal.', 'Philipp Oldenburg', 1, '2019-05-17'),
('Max Kruse verlasst Werder Bremen', 'max-kruse-verlasst-werder-bremen', 'Sport', 'assets/img/sport-3.png', 'Mannschaftskapitan Max Kruse verlasst nach der Saison Werder Bremen. Der Vertrag lauft zum 30. Juni aus.', 'Max Kruse wird Werder Bremen verlassen. Der Klub teilte mit, dass es keine Verlangerung des auslaufenden Vertrags geben wird.', 'RP Redaktion', 1, '2019-05-17'),
('USA heben Zolle gegen Mexiko und Kanada auf', 'usa-heben-zolle-auf', 'Politik', 'assets/img/politik-1.png', 'US-Prasident Donald Trump kundigte die Aufhebung der Zolle an und rief den Kongress zur Billigung eines Handelspakts auf.', 'Die USA heben Zolle gegen Mexiko und Kanada auf. Die Entscheidung soll den Weg fur ein neues Handelsabkommen freimachen.', 'RP Redaktion', 1, '2019-05-17'),
('Zahlreiche EU-Diplomaten sind sauer auf Rumanien', 'eu-diplomaten-kritisieren-rumanien', 'Politik', 'assets/img/politik-2.png', 'Rumanien hat derzeit den Vorsitz unter den EU-Staaten inne. Diplomaten kritisieren die Nutzung der Rolle fur eigene Zwecke.', 'In Brussel wachst die Kritik an Rumanien. Mehrere Diplomaten sehen die Ratsprasidentschaft durch innenpolitische Interessen belastet.', 'RP Redaktion', 1, '2019-05-17'),
('Labour erklart Brexit-Gesprache fur gescheitert', 'labour-brexit-gesprache-gescheitert', 'Politik', 'assets/img/politik-3.png', 'Wochenlang wurde verhandelt, die Gesprache enden nun in einer Sackgasse. Das Rennen um die Nachfolge ist in vollem Gang.', 'Die britische Labour-Partei hat die Gesprache mit der Regierung uber einen Brexit-Kompromiss fur gescheitert erklart.', 'RP Redaktion', 1, '2019-05-17');
