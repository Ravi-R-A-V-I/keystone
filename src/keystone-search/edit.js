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
import { useBlockProps, InspectorControls } from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";

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
  const { size, alignment } = attributes;
  const blockProps = useBlockProps();

  return (
    <>
      <InspectorControls>
        <PanelBody title="Search Bar Settings">
          <SelectControl
            label="Bar Size"
            value={size}
            options={[
              { label: "Small", value: "small" },
              { label: "Medium", value: "medium" },
              { label: "Large", value: "large" },
            ]}
            onChange={(newSize) => setAttributes({ size: newSize })}
          />
          <SelectControl
            label="Alignment"
            value={alignment}
            options={[
              { label: "Left", value: "left" },
              { label: "Center", value: "center" },
              { label: "Right", value: "right" },
            ]}
            onChange={(newAlign) => setAttributes({ alignment: newAlign })}
          />
        </PanelBody>
      </InspectorControls>
      <div {...blockProps}>
        <div
          className={`keystone-search-group size-${size} align-${alignment}`}
        >
          <input
            type="text"
            id="filter-search"
            placeholder="Address, neighborhood, city, ZIP"
          />
          <button id="clear-button" style={{ display: "none" }}>
            <span className="dashicons dashicons-no-alt"></span>
          </button>
          <button id="location-button">
            <span className="dashicons dashicons-location"></span>
          </button>
          <button id="search-button">
            <span className="dashicons dashicons-search"></span>
          </button>
          <div id="search-suggestions"></div>
        </div>
      </div>
    </>
  );
}
