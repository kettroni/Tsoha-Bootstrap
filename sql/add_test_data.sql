-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Account (name, password) VALUES ('Testaaja', 'Salainen');
INSERT INTO Tasklist (name, account_id) VALUES ('Minun muistilistani', 1);
INSERT INTO Task (name, description, added, tasklist_id, priority) VALUES ('Ensimmäinen asia', 'Tässä on tietoa ensimmäisestä asiasta',
   NOW(), 1, 4);
INSERT INTO Category (name) VALUES ('Kategoriani');
INSERT INTO Taskcategory (task_id, category_id) VALUES (1, 1);
INSERT INTO Account (name, password) VALUES ('Toinen', 'Salainen');
INSERT INTO Tasklist (name, account_id) VALUES ('Tämä onkin toisen', 2);
INSERT INTO Task (name, description, added, tasklist_id, priority) VALUES ('Asia1', 'Asia numero 1'
  , NOW(), 2, 1);
INSERT INTO Category (name) VALUES ('Toka kategoria');
INSERT INTO Taskcategory (task_id, category_id) VALUES (2, 2);
