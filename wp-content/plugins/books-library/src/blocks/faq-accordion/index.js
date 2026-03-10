import { registerBlockType } from "@wordpress/blocks";
import {
	useBlockProps,
	InnerBlocks,
	RichText,
	InspectorControls,
} from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

import "./editor.scss";
import "./style.scss";

const ALLOWED_BLOCKS = [ "books-library/faq-item" ];

registerBlockType("books-library/faq-accordion", {
	edit({ attributes, setAttributes }) {
		const { heading, iconType } = attributes;

		const blockProps = useBlockProps({
			className: `faq-accordion faq-accordion--icons-${iconType}`,
		});

		return (
			<>
				<InspectorControls>
					<PanelBody title={__("Settings", "books-library")} initialOpen={true}>
						<SelectControl
							label={__("Icon style", "books-library")}
							value={iconType}
							options={[
								{ label: __("Chevron", "books-library"), value: "chevron" },
								{ label: __("Plus / Minus", "books-library"), value: "plus-minus" },
							]}
							onChange={(value) => setAttributes({ iconType: value })}
						/>
					</PanelBody>
				</InspectorControls>

				<section {...blockProps}>
					<RichText
						tagName="h2"
						className="faq-accordion__heading"
						value={heading}
						onChange={(value) => setAttributes({ heading: value })}
						placeholder={__("Add FAQ heading…", "books-library")}
					/>

					<div className="faq-accordion__items">
						<InnerBlocks
							allowedBlocks={ALLOWED_BLOCKS}
							renderAppender={InnerBlocks.ButtonBlockAppender}
						/>
					</div>
				</section>
			</>
		);
	},

	save({ attributes }) {
		const { heading, iconType } = attributes;

		const blockProps = useBlockProps.save({
			className: `faq-accordion faq-accordion--icons-${iconType}`,
		});

		return (
			<section {...blockProps}>
				<RichText.Content
					tagName="h2"
					className="faq-accordion__heading"
					value={heading}
				/>

				<div className="faq-accordion__items">
					<InnerBlocks.Content />
				</div>
			</section>
		);
	},
});