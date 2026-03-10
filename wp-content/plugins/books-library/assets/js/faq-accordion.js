document.addEventListener("DOMContentLoaded", () => {
	const accordions = document.querySelectorAll(".faq-accordion");

	if (!accordions.length) {
		return;
	}

	accordions.forEach((accordion) => {
		const buttons = accordion.querySelectorAll(".faq-accordion__question");

		buttons.forEach((button) => {
			button.addEventListener("click", () => {
				const item = button.closest(".faq-accordion__item");
				const answer = item ? item.querySelector(".faq-accordion__answer") : null;

				if (!item || !answer) {
					return;
				}

				const isExpanded = button.getAttribute("aria-expanded") === "true";

				button.setAttribute("aria-expanded", String(!isExpanded));
				item.classList.toggle("is-open", !isExpanded);
				answer.hidden = isExpanded;
			});
		});
	});
});