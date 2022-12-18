<?php
function admin_assessment_ui(): void {
	$labels = [
		'name'          => _x( 'Assessments', 'Post type general name', 'Assessments' ),
		'singular_name' => _x( 'Assessment', 'Post type singular name', 'Assessments' ),
	];
	$args   = [
		'labels'          => $labels,
		'public'          => false,
		'show_ui'         => true,
		'show_in_menu'    => true,
		'query_var'       => true,
		'rewrite'         => [ 'slug' => 'assessment' ],
		'capability_type' => 'post',
		'hierarchical'    => false,
		'menu_position'   => null,
		'supports'        => [ 'thumbnail' ],
		'show_in_rest'    => true
	];

	register_post_type( 'assessment', $args );
}

function CreateAssessmentDetails(): void {
	add_meta_box(
		"assessment_create",
		"Create Assessment Question",
		"CreateAssessment",
		"assessment",
		"normal",
		"low"
	);
}

function CreateAssessment(): void {
	wp_enqueue_style( 'bootstrap-css', '//cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css' );
	wp_enqueue_script( 'bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js' );
	wp_enqueue_script( 'create-assessment', plugins_url( '/script/handleCreateAssessment.js', __FILE__ ), array( 'jquery' ) );
	?>
    <form id="form-create-assessment">
        <div class="input-group mb-3">
            <label for="component" class="input-group-text">Component</label>
            <select class="form-select" id="component" required>
                <option selected value="">Options</option>
                <option value="Commitment to Equity, Diversity & Inclusion">Commitment to Equity, Diversity &
                    Inclusion
                </option>
                <option value="Gender Expertise">Gender Expertise</option>
                <option value="Access to Resources">Access to Resources</option>
                <option value="Program Design">Program Design</option>
                <option value="Program Development">Program Development</option>
                <option value="Program Delivery">Program Delivery</option>
                <option value="Program Evaluation">Program Evaluation</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Question Description</label>
            <input type="text" class="form-control" id="description">
        </div>

        <div class="mb-3">
            <label for="scoring" class="form-label">Max Scoring:
                <output id="amount" name="amount" for="rangeInput">5</output>
            </label>
            <input type="range" class="form-range" min="1" max="10" step="2" value="5" id="scoring"
                   oninput="amount.value=this.value">
        </div>

        <div class="mb-3">
            <label class="form-check-label" for="hasNA">
                Has Not Applicable
            </label>
            <input class="form-check-input" type="checkbox" value="" id="hasNA">
        </div>

        <button type="submit" class="btn btn-primary btn-submit">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
	<?php
}

function findAllAssessmentDetails(): void {
	add_meta_box(
		"assessment_find_all",
		"Display Assessment Question",
		"findAllAssessment",
		"assessment",
		"normal",
		"low"
	);
}

function findAllAssessment(): void {
	wp_enqueue_style( 'bootstrap-css', '//cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css' );
	wp_enqueue_script( 'bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js' );
	wp_enqueue_script( 'find-all-assessment', plugins_url( '/script/handleFindAllAssessment.js', __FILE__ ), array( 'jquery' ) );
	?>
    <button class="btn btn-primary btn-fetch">Fetch</button>
	<?php
}