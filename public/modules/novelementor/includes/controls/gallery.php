<?php
namespace NovElementor;

defined('_PS_VERSION_') or exit;

class ControlGallery extends ControlBase {

	public function getType() {
		return 'gallery';
	}

	public function contentTemplate() {
		?>
		<div class="elementor-control-field">
			<div class="elementor-control-title">{{{ data.label }}}</div>
			<div class="elementor-control-input-wrapper">
				<# if ( data.description ) { #>
				<div class="elementor-control-field-description">{{{ data.description }}}</div>
				<# } #>
				<div class="elementor-control-media__content elementor-control-tag-area">
					<div class="elementor-control-gallery-status elementor-control-dynamic-switcher-wrapper">
						<span class="elementor-control-gallery-status-title"></span>
						<span class="elementor-control-gallery-clear elementor-control-unit-1"><i class="eicon-trash-o" aria-hidden="true"></i></span>
					</div>
					<div class="elementor-control-gallery-content">
						<div class="elementor-control-gallery-thumbnails"></div>
						<div class="elementor-control-gallery-edit"><span><i class="eicon-pencil" aria-hidden="true"></i></span></div>
						<button class="elementor-button elementor-control-gallery-add" aria-label="<?php echo __( 'Add Images', 'elementor' ); ?>"><i class="eicon-plus-circle" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	protected function getDefaultSettings() {
        return array(
            'label_block' => true,
        );
	}

	public function getDefaultValue()
    {
        return array();
    }
}
