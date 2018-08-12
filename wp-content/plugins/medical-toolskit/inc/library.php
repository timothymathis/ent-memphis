<?php
/**
 * Common functions for the Medical toolkit
 *
 * @package WordPress
 * @subpackage Health & Medical
 * @since Health & Medical 1.0
 */

class Wpl_Toolskit_Common {

	static function return_medical_icons() {

		$icons = array(
			'icon-medical-ambulance' => __( 'Ambulance', 'medical-toolskit' ),
			'icon-medical-asclepius-sign' => __( 'Asclepius sign', 'medical-toolskit' ),
			'icon-medical-bacterium-cells' => __( 'Bacterium cells', 'medical-toolskit' ),
			'icon-medical-badge' => __( 'Badge', 'medical-toolskit' ),
			'icon-medical-biohazard-sign' => __( 'Biohazard sign', 'medical-toolskit' ),
			'icon-medical-bladder' => __( 'Bladder', 'medical-toolskit' ),
			'icon-medical-blood-pressure-kit' => __( 'Blood pressure kit', 'medical-toolskit' ),
			'icon-medical-body-scales' => __( 'Body scales', 'medical-toolskit' ),
			'icon-medical-bone-joint' => __( 'Bone joint', 'medical-toolskit' ),
			'icon-medical-brain' => __( 'Brain', 'medical-toolskit' ),
			'icon-medical-broken-pill' => __( 'Broken pill', 'medical-toolskit' ),
			'icon-medical-bulb-full' => __( 'Bulb full', 'medical-toolskit' ),
			'icon-medical-bulb-reaction' => __( 'Bulb reaction', 'medical-toolskit' ),
			'icon-medical-bulb' => __( 'Bulb', 'medical-toolskit' ),
			'icon-medical-cell' => __( 'Cell', 'medical-toolskit' ),
			'icon-medical-chromosome' => __( 'Chromosome', 'medical-toolskit' ),
			'icon-medical-clinical-record' => __( 'Clinical record', 'medical-toolskit' ),
			'icon-medical-clyster' => __( 'Clyster', 'medical-toolskit' ),
			'icon-medical-cross' => __( 'Cross', 'medical-toolskit' ),
			'icon-medical-crutches' => __( 'Crutches', 'medical-toolskit' ),
			'icon-medical-disabled' => __( 'Disabled', 'medical-toolskit' ),
			'icon-medical-dna' => __( 'Dna', 'medical-toolskit' ),
			'icon-medical-doctor' => __( 'Doctor', 'medical-toolskit' ),
			'icon-medical-drop-counter' => __( 'Drop counter', 'medical-toolskit' ),
			'icon-medical-drop' => __( 'Drop', 'medical-toolskit' ),
			'icon-medical-dropper' => __( 'Dropper', 'medical-toolskit' ),
			'icon-medical-drug-blister' => __( 'Drug blister', 'medical-toolskit' ),
			'icon-medical-drug-bottle' => __( 'Drug bottle', 'medical-toolskit' ),
			'icon-medical-drugs' => __( 'Drugs', 'medical-toolskit' ),
			'icon-medical-ear' => __( 'Ear', 'medical-toolskit' ),
			'icon-medical-emergency-call' => __( 'Emergency call', 'medical-toolskit' ),
			'icon-medical-emergency-cross' => __( 'Emergency cross', 'medical-toolskit' ),
			'icon-medical-empty-test-tube' => __( 'Empty test tube', 'medical-toolskit' ),
			'icon-medical-eye-drop' => __( 'Eye drop', 'medical-toolskit' ),
			'icon-medical-eye-sign' => __( 'Eye sign', 'medical-toolskit' ),
			'icon-medical-eyeball' => __( 'Eyeball', 'medical-toolskit' ),
			'icon-medical-facial-plastic-surgery-2' => __( 'Facial plastic surgery 2', 'medical-toolskit' ),
			'icon-medical-facial-plastic-surgery' => __( 'Facial plastic surgery', 'medical-toolskit' ),
			'icon-medical-female-sign' => __( 'Female sign', 'medical-toolskit' ),
			'icon-medical-fertilization' => __( 'Fertilization', 'medical-toolskit' ),
			'icon-medical-footsteps' => __( 'Footsteps', 'medical-toolskit' ),
			'icon-medical-full-test-tube' => __( 'Full test tube', 'medical-toolskit' ),
			'icon-medical-fungus-cells' => __( 'Fungus cells', 'medical-toolskit' ),
			'icon-medical-glasses' => __( 'Glasses', 'medical-toolskit' ),
			'icon-medical-hand-with-patch' => __( 'Hand with patch', 'medical-toolskit' ),
			'icon-medical-heart-attack' => __( 'Heart attack', 'medical-toolskit' ),
			'icon-medical-heart-checklist' => __( 'Heart checklist', 'medical-toolskit' ),
			'icon-medical-heart-sign' => __( 'Heart sign', 'medical-toolskit' ),
			'icon-medical-heart' => __( 'Heart', 'medical-toolskit' ),
			'icon-medical-helicopter' => __( 'Helicopter', 'medical-toolskit' ),
			'icon-medical-help' => __( 'Help', 'medical-toolskit' ),
			'icon-medical-hospital-bed' => __( 'Hospital bed', 'medical-toolskit' ),
			'icon-medical-hospital-sign' => __( 'Hospital sign', 'medical-toolskit' ),
			'icon-medical-hospital' => __( 'Hospital', 'medical-toolskit' ),
			'icon-medical-intestines' => __( 'Intestines', 'medical-toolskit' ),
			'icon-medical-kidneys' => __( 'Kidneys', 'medical-toolskit' ),
			'icon-medical-liver' => __( 'Liver', 'medical-toolskit' ),
			'icon-medical-lungs' => __( 'Lungs', 'medical-toolskit' ),
			'icon-medical-magnifying-glass' => __( 'Magnifying glass', 'medical-toolskit' ),
			'icon-medical-male-sign' => __( 'Male sign', 'medical-toolskit' ),
			'icon-medical-medic' => __( 'Medic', 'medical-toolskit' ),
			'icon-medical-medical-alert' => __( 'Medical alert', 'medical-toolskit' ),
			'icon-medical-medical-checklist' => __( 'Medical checklist', 'medical-toolskit' ),
			'icon-medical-medicine-chest' => __( 'Medicine chest', 'medical-toolskit' ),
			'icon-medical-men-urogenital-system' => __( 'Men urogenital system', 'medical-toolskit' ),
			'icon-medical-microscope' => __( 'Microscope', 'medical-toolskit' ),
			'icon-medical-muscle' => __( 'Muscle', 'medical-toolskit' ),
			'icon-medical-nasopharynx' => __( 'Nasopharynx', 'medical-toolskit' ),
			'icon-medical-neurology' => __( 'Neurology', 'medical-toolskit' ),
			'icon-medical-nurse-cap' => __( 'Nurse cap', 'medical-toolskit' ),
			'icon-medical-nurse' => __( 'Nurse', 'medical-toolskit' ),
			'icon-medical-patch' => __( 'Patch', 'medical-toolskit' ),
			'icon-medical-pill' => __( 'Pill', 'medical-toolskit' ),
			'icon-medical-pulse' => __( 'Pulse', 'medical-toolskit' ),
			'icon-medical-radiation-sign' => __( 'Radiation sign', 'medical-toolskit' ),
			'icon-medical-ribbon' => __( 'Ribbon', 'medical-toolskit' ),
			'icon-medical-Rx-sign' => __( 'Rx sign', 'medical-toolskit' ),
			'icon-medical-sex-signs' => __( 'Sex signs', 'medical-toolskit' ),
			'icon-medical-shot' => __( 'Shot', 'medical-toolskit' ),
			'icon-medical-skin' => __( 'Skin', 'medical-toolskit' ),
			'icon-medical-skull-bones' => __( 'Skull bones', 'medical-toolskit' ),
			'icon-medical-skull' => __( 'Skull', 'medical-toolskit' ),
			'icon-medical-snakes-cup' => __( 'Snakes cup', 'medical-toolskit' ),
			'icon-medical-snellen-chart' => __( 'Snellen chart', 'medical-toolskit' ),
			'icon-medical-spermatozoids' => __( 'Spermatozoids', 'medical-toolskit' ),
			'icon-medical-stethoscope' => __( 'Stethoscope', 'medical-toolskit' ),
			'icon-medical-stomach' => __( 'Stomach', 'medical-toolskit' ),
			'icon-medical-surgery' => __( 'Surgery', 'medical-toolskit' ),
			'icon-medical-syringe' => __( 'Syringe', 'medical-toolskit' ),
			'icon-medical-tablet' => __( 'Tablet', 'medical-toolskit' ),
			'icon-medical-test-tubes' => __( 'Test tubes', 'medical-toolskit' ),
			'icon-medical-thermometer' => __( 'Thermometer', 'medical-toolskit' ),
			'icon-medical-thyroid-gland' => __( 'Thyroid gland', 'medical-toolskit' ),
			'icon-medical-tooth-paste' => __( 'Tooth paste', 'medical-toolskit' ),
			'icon-medical-tooth' => __( 'Tooth', 'medical-toolskit' ),
			'icon-medical-trolley' => __( 'Trolley', 'medical-toolskit' ),
			'icon-medical-ultrasonic-diagnostic' => __( 'Ultrasonic diagnostic', 'medical-toolskit' ),
			'icon-medical-virus' => __( 'Virus', 'medical-toolskit' ),
			'icon-medical-women-urogenital-system' => __( 'Women urogenital system', 'medical-toolskit' ),
		);

		return $icons;

	}

	static function output_icon_picker( $field_choices = array(), $field_value, $location ) {

		ob_start();
		?>

			<div class="icon-picker <?php echo ( !empty( $location ) ? $location : 'plugin-location' ); ?>">
				<div class="icon-list">

					<?php foreach( $field_choices as $code => $name ) : ?>
						<div class="item <?php echo ( $code == $field_value ? 'selected' : '' ); ?>" data-code="<?php echo $code; ?>">
							<div class="item-wrapper">
								<div class="item-image">
									<i class="<?php echo $code; ?>"></i>
								</div>

								<span class="item-name"><?php echo $name; ?></span>
							</div>
						</div>
					<?php endforeach; ?>

				</div>

				<div class="show-more">
					<div class="background"></div>
					<button type="button" class="button show-more-button"><?php _e( 'Show all icons', 'healthmedical-wpl' ); ?></button>
				</div>
			</div>

		<?php
		echo ob_get_clean();

	}

}

?>
