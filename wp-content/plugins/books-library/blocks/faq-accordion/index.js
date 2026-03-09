(function (blocks, blockEditor, element, components, i18n) {
  const { registerBlockType } = blocks;
  const { __ } = i18n;
  const { createElement: el, Fragment } = element;
  const { InspectorControls, RichText, InnerBlocks, useBlockProps } =
    blockEditor;
  const { PanelBody, SelectControl } = components;

  const ALLOWED_BLOCKS = ["books-library/faq-item"];

  registerBlockType("books-library/faq-accordion", {
    edit: function (props) {
      const attributes = props.attributes;
      const setAttributes = props.setAttributes;

      const blockProps = useBlockProps({
        className: "faq-accordion faq-accordion--icons-" + attributes.iconType,
      });

      return el(
        Fragment,
        {},
        el(
          InspectorControls,
          {},
          el(
            PanelBody,
            {
              title: __("Settings", "books-library"),
              initialOpen: true,
            },
            el(SelectControl, {
              label: __("Icon style", "books-library"),
              value: attributes.iconType,
              options: [
                { label: __("Chevron", "books-library"), value: "chevron" },
                {
                  label: __("Plus / Minus", "books-library"),
                  value: "plus-minus",
                },
              ],
              onChange: function (value) {
                setAttributes({ iconType: value });
              },
            }),
          ),
        ),
        el(
          "section",
          blockProps,
          el(RichText, {
            tagName: "h2",
            className: "faq-accordion__heading",
            value: attributes.heading,
            onChange: function (value) {
              setAttributes({ heading: value });
            },
            placeholder: __("Add FAQ heading…", "books-library"),
          }),
          el(
            "div",
            { className: "faq-accordion__items" },
            el(InnerBlocks, {
              allowedBlocks: ALLOWED_BLOCKS,
              renderAppender: InnerBlocks.ButtonBlockAppender,
            }),
          ),
        ),
      );
    },

    save: function (props) {
      const attributes = props.attributes;

      const blockProps = useBlockProps.save({
        className: "faq-accordion faq-accordion--icons-" + attributes.iconType,
      });

      return el(
        "section",
        blockProps,
        el(RichText.Content, {
          tagName: "h2",
          className: "faq-accordion__heading",
          value: attributes.heading,
        }),
        el(
          "div",
          { className: "faq-accordion__items" },
          el(InnerBlocks.Content),
        ),
      );
    },
  });

  registerBlockType("books-library/faq-item", {
    edit: function (props) {
      const attributes = props.attributes;
      const setAttributes = props.setAttributes;

      const blockProps = useBlockProps({
        className: "faq-accordion__item",
      });

      return el(
        "div",
        blockProps,
        el(RichText, {
          tagName: "div",
          className: "faq-accordion__question",
          value: attributes.question,
          onChange: function (value) {
            setAttributes({ question: value });
          },
          placeholder: __("Add question…", "books-library"),
          allowedFormats: [],
        }),
        el(RichText, {
          tagName: "div",
          className: "faq-accordion__answer",
          value: attributes.answer,
          onChange: function (value) {
            setAttributes({ answer: value });
          },
          placeholder: __("Add answer…", "books-library"),
        }),
      );
    },

    save: function (props) {
      const attributes = props.attributes;

      const blockProps = useBlockProps.save({
        className: "faq-accordion__item",
      });

      return el(
        "div",
        blockProps,
        el(
          "button",
          {
            className: "faq-accordion__question",
            type: "button",
            "aria-expanded": "false",
          },
          el(
            "span",
            { className: "faq-accordion__question-text" },
            el(RichText.Content, {
              value: attributes.question,
            }),
          ),
          el("span", {
            className: "faq-accordion__icon",
            "aria-hidden": "true",
          }),
        ),
        el(
          "div",
          {
            className: "faq-accordion__answer",
            hidden: true,
          },
          el(RichText.Content, {
            value: attributes.answer,
          }),
        ),
      );
    },
  });
})(
  window.wp.blocks,
  window.wp.blockEditor,
  window.wp.element,
  window.wp.components,
  window.wp.i18n,
);
