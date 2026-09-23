/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from "@wordpress/i18n";
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, useInnerBlocksProps } from "@wordpress/block-editor";

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
  const TEMPLATE = [
    [
      "core/query",
      { query: { postType: "property", perPage: 6 } },
      [
        [
          "core/post-template",
          {},
          [["create-block/keystone-property-card", {}]],
        ],
      ],
    ],
  ];
  const blockProps = useBlockProps({
    className: "featured-properties-container",
  });
  const innerBlockProps = useInnerBlocksProps(
    { className: "featured-properties-track" },
    { template: TEMPLATE },
  );

  return (
    <div {...blockProps}>
      <button className="featured-properties-btn prev-btn">&#10094;</button>
      <div {...innerBlockProps}></div>
      <button className="featured-properties-btn next-btn">&#10095;</button>
    </div>
  );
}
