document.addEventListener("DOMContentLoaded", () => {
	const cards = document.querySelectorAll("[data-book-card]");

	if (!cards.length) {
		return;
	}

	cards.forEach((card) => {
		const toggleButton = card.querySelector("[data-book-card-toggle]");
		const closeButton = card.querySelector("[data-book-card-close]");
		const backFace = card.querySelector(".book-flip-card__face--back");

		if (!toggleButton) {
			return;
		}

		const setCardState = (shouldFlip) => {
			card.classList.toggle("is-flipped", shouldFlip);
			toggleButton.setAttribute("aria-expanded", String(shouldFlip));
		};

		toggleButton.addEventListener("click", () => {
			const isFlipped = card.classList.contains("is-flipped");
			setCardState(!isFlipped);
		});

		if (backFace) {
			backFace.addEventListener("click", (event) => {
				const interactiveElement = event.target.closest("a, button");

				if (interactiveElement) {
					return;
				}

				const isFlipped = card.classList.contains("is-flipped");
				setCardState(!isFlipped);
			});
		}

		if (closeButton) {
			closeButton.addEventListener("click", () => {
				setCardState(false);
				toggleButton.focus();
			});
		}
	});
});