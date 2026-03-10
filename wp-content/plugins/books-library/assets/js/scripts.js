document.addEventListener("DOMContentLoaded", () => {
  const relatedBooksContainer = document.querySelector("#books-library-related");

  if (!relatedBooksContainer) {
    return;
  }

  if (!window.booksLibraryData || !window.booksLibraryData.restUrl) {
    relatedBooksContainer.innerHTML = "<p>REST URL is missing.</p>";
    return;
  }

  const currentBookId = relatedBooksContainer.dataset.currentBookId;

  if (!currentBookId) {
    relatedBooksContainer.innerHTML = "<p>Current book ID is missing.</p>";
    return;
  }

  const endpointUrl = `${window.booksLibraryData.restUrl}?current_book_id=${encodeURIComponent(currentBookId)}`;

  fetch(endpointUrl)
    .then((response) => {
      if (!response.ok) {
        throw new Error(`Failed to fetch related books. Status: ${response.status}`);
      }

      return response.json();
    })
    .then((books) => {
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
          <a class="related-book-card" href="${book.link}">
            ${book.image && book.image.medium ? `
              <div class="related-book-card__image-wrapper">
                <img
                  class="related-book-card__image"
                  src="${book.image.medium}"
                  alt="${book.title}"
                  loading="lazy"
                >
              </div>
            ` : ""}

            <div class="related-book-card__content">
              ${genres ? `<p class="related-book-card__genre">${genres}</p>` : ""}

              <p class="related-book-card__date">${book.date}</p>

              <h3 class="related-book-card__title">${book.title}</h3>

              <p class="related-book-card__excerpt">${book.excerpt || ""}</p>
            </div>
          </a>
        `;

        list.appendChild(item);
      });

      relatedBooksContainer.innerHTML = "";
      relatedBooksContainer.appendChild(list);
    })
    .catch((error) => {
      console.error(error);
      relatedBooksContainer.innerHTML = "<p>Unable to load books.</p>";
    });
});