class Book {
    constructor(_title, _author, _numOfPages) {
      this.title = _title;
      this.author = _author;
      this.numOfPages = _numOfPages;
      this.onPage = 0;
    }
  
    setOnPage(_onPage) {
      this.onPage = _onPage;
    }
  }
  
  let book1 = new Book('The Secrets We Keep', 'Oliver Mitchell', 256);
  book1.setOnPage(256);
  
  let book2 = new Book('Shadows of the Past', 'Benjamin Foster', 432);
  book2.setOnPage(269);
  
  let book3 = new Book('The Midnight Library', 'Charlie Brown', 336);
  book3.setOnPage(215);
  
  let book4 = new Book('The Labyrinth of Dreams', 'Rachel Thompson', 384);
  book4.setOnPage(384);
  
  let book5 = new Book('A Dance with Shadows', 'Sophia Williams', 288);
  book5.setOnPage(78);
  
  let books = [book1, book2, book3, book4, book5];
  
  const list = document.getElementById('booksList');
  
  // Function to generate a table row for a book
  function generateTableRow(book, index) {
    let row = document.createElement('tr');
    row.innerHTML = `
          <th>${index + 1}</th>
          <td>${book.title}</td>
          <td>${book.author}</td>
          <td>${book.numOfPages}</td>
          <td>${book.onPage}</td>
      `;
  
    let progressCol = document.createElement('td');
    row.appendChild(progressCol);
    let bookProgress = document.createElement('div');
    bookProgress.setAttribute('class', 'bookProgress');
    progressCol.appendChild(bookProgress);
    let progressBar = document.createElement('div');
    progressBar.setAttribute('class', 'progressBar');
    bookProgress.appendChild(progressBar);
  
    move(book, progressBar);
  
    return row;
  }
  
  // Function to add a book to the table and update the progress bar
  function addBookToTable(book, index) {
    const tbody = document.querySelector('tbody');
    const newRow = generateTableRow(book, index);
  
    tbody.appendChild(newRow);
  }
  
  // Initial book listing
  books.forEach(function (value, index) {
    let li = document.createElement('li');
    if (value.numOfPages === value.onPage) {
      li.textContent = `You already read "${value.title}" by ${value.author}`;
      li.style.color = 'green';
      li.setAttribute('class', 'list-group-item');
    } else {
      li.textContent = `You still need to read "${value.title}" by ${value.author}`;
      li.style.color = 'red';
      li.setAttribute('class', 'list-group-item');
    }
    list.appendChild(li);
  
    addBookToTable(value, index)
  });
  
  // Progress bar function
  function move(book, progressBar) {
    let width = Math.round((book.onPage / book.numOfPages) * 100);
    let progress = 0;
    let intervalId = setInterval(frame, 10);
  
    function frame() {
      if (progress >= width) {
        clearInterval(intervalId);
        if (width === 100) {
          progressBar.style.borderRadius = '8px';
        }
      } else {
        progress += 1;
        progressBar.style.width = progress + '%';
        progressBar.innerHTML = progress + '%';
        book.setOnPage(Math.floor((width / 100) * book.numOfPages));
      }
    }
  }
  
  // Adding new book through form
  const form = document.getElementById('addBook');
  let bookCounter = books.length;
  
  form.addEventListener('submit', function (e) {
    e.preventDefault();
  
    const title = document.getElementById('title').value;
    const author = document.getElementById('author').value;
    const numOfPages = parseInt(document.getElementById('numOfPages').value);
    const onPage = parseInt(document.getElementById('onPage').value);
  
    const newBook = new Book(title, author, numOfPages);
    newBook.setOnPage(onPage);
    books.push(newBook);
  
    const bookProgress = document.createElement('div');
    bookProgress.setAttribute('class', 'bookProgress');
  
    const progressBar = document.createElement('div');
    progressBar.setAttribute('class', 'progressBar');
  
    bookProgress.appendChild(progressBar);
  
    const progressCol = document.createElement('td');
    progressCol.appendChild(bookProgress);
  
    addBookToTable(newBook, bookCounter)

    bookCounter++;
  
    move(newBook, progressBar);
  });
  