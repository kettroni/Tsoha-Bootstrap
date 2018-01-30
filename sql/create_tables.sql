-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Account(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Tasklist(
  id SERIAL PRIMARY KEY,
  account_id INTEGER REFERENCES Account,
  name varchar(50) NOT NULL
);

CREATE TABLE Task(
  id SERIAL PRIMARY KEY,
  tasklist_id INTEGER REFERENCES Tasklist,
  name varchar(50) NOT NULL,
  done boolean DEFAULT FALSE,
  description varchar(400),
  added DATE
);

CREATE TABLE Category(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL
);

CREATE TABLE Taskcategory(
  task_id INTEGER REFERENCES Task,
  category_id INTEGER REFERENCES Category
);
