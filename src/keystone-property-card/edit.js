import image from "./images/property-demo.jpg";
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
import { useBlockProps } from "@wordpress/block-editor";

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
  const blockProps = useBlockProps({
    className: "property-card",
  });

  return (
    <div {...blockProps}>
      <div>
        <img className="property-image is-active" src={image} alt="" />

        <button className="gallery__arrow gallery__arrow--prev">
          &#10094;
        </button>
        <button className="gallery__arrow gallery__arrow--next">
          &#10095;
        </button>
        <div className="gallery-indicators">
          <span className="gallery-dot"></span>
        </div>

        <div>
          <button className="favorite-btn">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="w-6 h-6"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"
              />
            </svg>
          </button>
        </div>
      </div>
      <div>
        <h2>$438,000</h2>
        <p>
          <span>5 bds</span> |<span>3 ba</span> |<span>2978 sqft</span> |
          <span>sale</span>
        </p>
        <p>QR35+58X Yokuts Valley, California, USA</p>
      </div>
    </div>
  );
}
