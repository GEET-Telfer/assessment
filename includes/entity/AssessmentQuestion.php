<?php

class AssessmentQuestion {
	private string $component;
	private string $componentAbbrev;
	private string $description;
	private string $scoring;

	/**
	 * @param string $component
	 * @param string $componentAbbrev
	 * @param string $description
	 * @param array $scoring
	 */
	public function __construct( string $component, string $componentAbbrev, string $description, array $scoring ) {
		$this->component       = $component;
		$this->componentAbbrev = $componentAbbrev;
		$this->description     = $description;
		$this->scoring         = json_encode($scoring);
	}

	public function toArray() {
		return [
			'component'        => $this->component,
			'component_abbrev' => $this->componentAbbrev,
			'description'      => $this->description,
			'scoring'          => $this->scoring
		];
	}
}