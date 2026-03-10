import { registerBlockType } from "@wordpress/blocks";
import { RichText, useBlockProps } from "@wordpress/block-editor";
import { useEffect } from "@wordpress/element";
import { __ } from "@wordpress/i18n";

registerBlockType("books-library/faq-item", {
	edit({ attributes, setAttributes, clientId }) {
		const { question, answer, buttonId, panelId } = attributes;

		useEffect(() => {
			if (buttonId && panelId) {
				return;
			}

			const normalizedId = clientId.replace(/-/g, "");

			setAttributes({
				buttonId: buttonId || `faq-button-${normalizedId}`,
				panelId: panelId || `faq-panel-${normalizedId}`,
			});
		}, [buttonId, panelId, clientId, setAttributes]);

		const blockProps = useBlockProps({
			className: "faq-accordion__item",
		});

		return (
			<div {...blockProps}>
				<RichText
					tagName="div"
					className="faq-accordion__question"
					value={question}
					onChange={(value) => setAttributes({ question: value })}
					placeholder={__("Add question…", "books-library")}
					allowedFormats={[]}
				/>

				<RichText
					tagName="div"
					className="faq-accordion__answer"
					value={answer}
					onChange={(value) => setAttributes({ answer: value })}
					placeholder={__("Add answer…", "books-library")}
				/>
			</div>
		);
	},

	save({ attributes }) {
		const { question, answer, buttonId, panelId } = attributes;

		const blockProps = useBlockProps.save({
			className: "faq-accordion__item",
		});

		return (
			<div {...blockProps}>
				<h3 className="faq-accordion__title">
					<button
						className="faq-accordion__question"
						type="button"
						id={buttonId}
						aria-expanded="false"
						aria-controls={panelId}
					>
						<span className="faq-accordion__question-text">
							<RichText.Content value={question} />
						</span>

						<span className="faq-accordion__icon" aria-hidden="true" />
					</button>
				</h3>

				<div
					className="faq-accordion__answer"
					id={panelId}
					role="region"
					aria-labelledby={buttonId}
					hidden
				>
					<RichText.Content value={answer} />
				</div>
			</div>
		);
	},
});