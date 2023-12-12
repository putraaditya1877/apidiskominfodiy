--user
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, email, password, created_at, updated_at)
VALUES
('Andi', 'andi@gmail.com', '12345', '2019-01-28 05:15:29', '2019-01-28 05:15:29'),
('Budi', 'budi@gmail.com', '67890', '2019-01-28 05:15:29', '2019-01-28 05:15:29'),
('Caca', 'caca@gmail.com', 'abcde', '2019-01-28 05:15:29', '2019-01-28 05:15:29'),
('Deni', 'deni@gmail.com', 'fghij', '2019-01-28 05:15:29', '2019-01-28 05:15:29'),
('Euis', 'euis@gmail.com', 'klmno', '2019-01-28 05:15:29', '2019-01-28 05:15:29'),
('Fafa', 'fafa@gmail.com', 'pqrst', '2019-01-28 05:15:29', '2019-01-28 05:15:29');


--courses
CREATE TABLE courses (
    id SERIAL PRIMARY KEY,
    course VARCHAR(50) NOT NULL,
    mentor VARCHAR(50) NOT NULL,
    title VARCHAR(50) NOT null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO courses (course, mentor, title)
VALUES
('C++', 'Ari', 'Dr.'),
('C#', 'Ari', 'Dr.'),
('C#', 'Ari', 'Dr.'),
('CSS', 'Cania', 'S.Kom'),
('HTML', 'Cania', 'S.Kom'),
('Javascript', 'Cania', 'S.Kom'),
('Python', 'Barry', 'S.T.'),
('Micropython', 'Barry', 'S.T.'),
('Java', 'Darren', 'M.T.'),
('Ruby', 'Darren', 'M.T.');


--userCourse
CREATE TABLE userCourse (
    id SERIAL PRIMARY KEY,
    id_user INT NOT NULL,
    id_course INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (id_course) REFERENCES courses(id) ON DELETE CASCADE
);

INSERT INTO userCourse (id_user, id_course)
VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 7),
(3, 8),
(3, 9),
(4, 1),
(4, 3),
(4, 5),
(5, 2),
(5, 4),
(5, 6),
(6, 7),
(6, 8),
(6, 9);


--menampilkan semua daftar
--peserta didik beserta mata kuliah yang diikutinya, lengkap dengan nama &
--gelar mentornya
SELECT
    u.username,
    c.course,
    c.mentor,
    c.title
FROM userCourse AS uc
JOIN courses AS c ON uc.id_course = c.id
JOIN users AS u ON uc.id_user = u.id;


--tampilkan daftar peserta didik
--beserta mata kuliah yang diikutinya, yang mentornya bergelar sarjana.
SELECT
    u.username,
    c.course,
    c.mentor,
    c.title
FROM userCourse AS uc
JOIN courses AS c ON uc.id_course = c.id
JOIN users AS u ON uc.id_user = u.id
WHERE c.title LIKE '%S.Kom%' OR c.title LIKE '%S.T%';


--tampilkan daftar peserta didik
--beserta mata kuliah yang diikutinya, yang mentornya bergelar selain
--sarjana
SELECT
    u.username,
    c.course,
    c.mentor,
    c.title
FROM userCourse AS uc
JOIN courses AS c ON uc.id_course = c.id
JOIN users AS u ON uc.id_user = u.id
WHERE c.title NOT LIKE '%S.Kom%' AND c.title NOT LIKE '%S.T%';


--tampilkan jumlah peserta didik
--untuk setiap mata kuliah
SELECT
    c.course,
    c.mentor,
    c.title,
    COUNT(uc.id_user) AS jumlah_peserta
FROM userCourse AS uc
JOIN courses AS c ON uc.id_course = c.id
JOIN users AS u ON uc.id_user = u.id
GROUP BY c.course, c.mentor, c.title
ORDER BY c.mentor ASC;


--tampilkan jumlah peserta didik
--beserta total fee untuk setiap mentor. Total fee dihitung dengan besaran Rp
--2.000.000,- per peserta didik
SELECT
    c.mentor,
    COUNT(uc.id_user) AS jumlah_peserta,
    COUNT(uc.id_user) * 2000000 AS total_fee
FROM userCourse uc
JOIN courses AS c ON c.id = uc.id_course
GROUP BY c.mentor
ORDER BY c.mentor;

