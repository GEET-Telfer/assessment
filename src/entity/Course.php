<?php

/**
 * Data model fro course
 */
class Course {
	private ?int $id = null; # Auto-incremented Id assigned from database
	private ?string $uuid = null; #UUIDv4
	private ?string $title = null; # course title
	private ?string $videoLink = null; # youtube video link
	private ?string $content = null; # content of the course
	private ?string $courseStatus = null; # draft/ under_review/ publish

	public function __construct() {}

	public function __destruct() {}

    /**
	 * setter for id
	 * @param int|null $id
	 */
	function setId( ?int $id ): void {
		$this->id = $id;
	}

	/**
	 * setter for uuid
	 */
	function setUUID( ?string $uuid ): void {
		$this->uuid = $uuid;
	}

	/**
	 * setter for status
	 */
	function setCourseStatus( ?string $courseStatus ): void {
		$this->courseStatus = $courseStatus;
	}

    /**
	 * setter for title 
	 * @param int|null
	 */
	function setTitle( ?string $title ): void {
		$this->title = $title;
	}

    /**
	 * setter for videoLink 
	 * @param int|null
	 */
	function setVideoLink( ?string $videoLink ): void {
		$this->videoLink = $videoLink;
	}

    /**
	 * setter for content 
	 * @param int|null
	 */
	function setContent( ?string $content ): void {
		$this->content = $content;
	}

	/**
	 * return an associative array of the assessment question object.
	 * @return array
	 */
	public function toArray(): array {
		$arr = [
			'uuid' 		    => $this->uuid,
			'title'         => $this->title,
			'video_link'    => $this->videoLink,
			'content'       => $this->content,
			'course_status' => $this->courseStatus
		];
		if ( ! is_null( $this->id ) ) {
			$arr['id'] = $this->id;
		}

		return $arr;
	}
}