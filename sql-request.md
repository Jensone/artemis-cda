# Liste des requêtes SQL pour l'app Artemis

## Récupération globale

```sql
SELECT * FROM Book;
SELECT * FROM Author;
SELECT * FROM Publisher;
SELECT * FROM Client;
SELECT * FROM Loan;
```
---

## Récupération d'un élément

```sql
SELECT * FROM Book WHERE id = 1;
SELECT * FROM Author WHERE id = 1;
SELECT * FROM Publisher WHERE id = 1;
SELECT * FROM Client WHERE id = 1;
SELECT * FROM Loan WHERE id = 1;
```
---

## Récupération d'un élément avec ses relations

### Un livre avec les noms des auteur et éditeur

```sql
SELECT
    Book.title AS BookTitle,
    Author.name AS AuthorName,
    Publisher.name AS PublisherName
FROM
    Book
JOIN
    Author ON Book.author_id = Author.id
JOIN
    Publisher ON Book.publisher_id = Publisher.id
WHERE
    Book.id = 1;
```

### Un emprunt avec les dates, le status, le nom du client qui l'a emprunté et le titre du livre

```sql
SELECT
    Loan.id AS LoanId,
    Loan.start_date AS LoanStartDate,
    Loan.end_date AS LoanEndDate,
    Loan.returned AS LoanReturned,
    Client.name AS ClientName,
    Book.title AS BookTitle
FROM
    Loan
JOIN
    Client ON Loan.client_id = Client.id
JOIN
    Book ON Loan.book_id = Book.id
WHERE
    Loan.id = 1;
```