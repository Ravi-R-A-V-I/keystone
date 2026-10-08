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
import {
  useBlockProps,
  MediaUpload,
  InspectorControls,
  MediaPlaceholder,
} from "@wordpress/block-editor";
import { Button, PanelBody } from "@wordpress/components";
import { ServerSideRender } from "@wordpress/server-side-render";
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
  const blockProps = useBlockProps();
  const { logoUrl, logoId } = attributes;

  function onSelectLogo(image) {
    setAttributes({ logoUrl: image.url, logoId: image.id });
  }

  return (
    <div {...blockProps} style={{ position: "relative" }}>
      {/* The Sidebar Controls (Always accessible) */}
      <InspectorControls>
        <PanelBody title="Footer Settings">
          <MediaUpload
            onSelect={onSelectLogo}
            type="image"
            value={logoId}
            render={({ open }) => (
              <Button onClick={open} variant="primary">
                {__("Upload Logo", "keystone")}
              </Button>
            )}
          />
        </PanelBody>
      </InspectorControls>

      {/* NEW: The Canvas Placeholder (ONLY visible when logo is missing) */}
      {!logoUrl && (
        <div className={"keystone-logo"}>
          <MediaUpload
            onSelect={onSelectLogo}
            type="image"
            render={({ open }) => (
              <Button onClick={open} variant="primary">
                Upload Logo
              </Button>
            )}
          />
        </div>
      )}
      <div style={{ pointerEvents: "none" }}>
        {/* The Live PHP Preview */}
        <ServerSideRender
          block="create-block/keystone-footer"
          attributes={attributes}
        />
      </div>
    </div>
  );
}
