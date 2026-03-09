document.addEventListener("DOMContentLoaded", () => {
  const relatedBooksContainer = document.querySelector(
    "#books-library-related",
  );

  if (!relatedBooksContainer) {
    console.error("Books Library: related books container not found.");
    return;
  }

  if (!window.booksLibraryData || !window.booksLibraryData.restUrl) {
    relatedBooksContainer.innerHTML = "<p>REST URL is missing.</p>";
    console.error(
      "Books Library: booksLibraryData.restUrl is missing.",
      window.booksLibraryData,
    );
    return;
  }

  const currentBookId = relatedBooksContainer.dataset.currentBookId;

  if (!currentBookId) {
    relatedBooksContainer.innerHTML = "<p>Current book ID is missing.</p>";
    console.error("Books Library: current book ID is missing.");
    return;
  }

  const endpointUrl = `${window.booksLibraryData.restUrl}?current_book_id=${encodeURIComponent(currentBookId)}`;

  console.log("Books Library: fetching", endpointUrl);

  fetch(endpointUrl)
    .then((response) => {
      console.log("Books Library: response status", response.status);

      if (!response.ok) {
        throw new Error(
          `Failed to fetch related books. Status: ${response.status}`,
        );
      }

      return response.json();
    })
    .then((books) => {
      console.log("Books Library: response data", books);

      if (!Array.isArray(books) || books.length === 0) {
        relatedBooksContainer.innerHTML = "<p>No other books found.</p>";
        return;
      }

      const list = document.createElement("ul");
      list.className = "books-library-related-list";

      books.forEach((book) => {
        const item = document.createElement("li");
        item.className = "books-library-related-list__item";

        const genres =
          Array.isArray(book.genre) && book.genre.length
            ? book.genre.join(", ")
            : "";

        item.innerHTML = `
          <article class="related-book-card">
            <h3 class="related-book-card__title">
              <a href="${book.link}">${book.title}</a>
            </h3>
            <div class="related-book-card__meta">
              <span class="related-book-card__date">${book.date}</span>
              ${genres ? `<span class="related-book-card__genre">${genres}</span>` : ""}
            </div>
            <div class="related-book-card__excerpt">
              <p>${book.excerpt || ""}</p>
            </div>
          </article>
        `;

        list.appendChild(item);
      });

      relatedBooksContainer.innerHTML = "";
      relatedBooksContainer.appendChild(list);
    })
    .catch((error) => {
      relatedBooksContainer.innerHTML = "<p>Unable to load books.</p>";
      console.error("Books Library:", error);
    });
});
